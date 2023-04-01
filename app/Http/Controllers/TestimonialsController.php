<?php

namespace App\Http\Controllers;

use \PDF;

//use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Editor;
use App\Models\Search_editor;
use Alkoumi\LaravelArabicNumbers\Numbers;
use Carbon\Carbon;

class TestimonialsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return// \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        $testimonials = Testimonial::orderBy('id', 'DESC')->paginate(6);
        $pre_number_years = Testimonial::get()->sortBy('pre_number_en');// الترتيب من الاصغر الى الاكبر حسب الارقام
        if(request()->testimonial_num){
            $testimonials = Testimonial::where('id', request()->testimonial_num)->paginate(6);
        }
        return view('all_testimonials', compact('testimonials', 'pre_number_years'));
    }

    public function store(Request $request)
    {
        // $year = $request->pre_number."/".$request->year ;
        $validator = validator::make($request->all(),[
            "pre_number"    => "required|numeric|min:0",
            "year"          => "required",
            "receipt_number"=> "required|numeric|min:0",
            "receipt_date"  => "required|date",
            "favor_name"    => "required|string|max:100",
            "against_name"  => "required|string|max:100",
            "subject"       => "required|string",
            "governorate"   => "required",
            "section"      => "required",
            "side"          => "required",
            "start_date"    => "required",
            "end_date"      => "required",
        ]);
        /* $errors = $request->validate(["pre_number"    => "required|numeric|min:0",]);*/

        /*-----change number from english to arabic to inert it database---------*/
        $pre_number = Numbers::ShowInArabicDigits($request->pre_number);
        $year       = Numbers::ShowInArabicDigits($request->year);
        /*----- end change number from english to arabic to inert it database---------*/
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $users = Testimonial::where('pre_number_year',$year."/".$pre_number)->pluck('pre_number_year')->toArray();
        if(!empty($users)){
            return response()->json(['already_exist' => 0, 'requestNum' => 'تم اضافة رقم الاسبقية من قبل لتلك السنة']);
        }
        $applications                 = new Testimonial();
        $applications->user_id        = auth()->user()->id;
        $applications->pre_number_en  = $request->pre_number;
        $applications->pre_number     = $pre_number;
        $applications->year           = $year;
        $applications->pre_number_year= $year."/".$pre_number;
        $applications->receipt_number = Numbers::ShowInArabicDigits($request->receipt_number);
        $applications->receipt_date   = Numbers::ShowInArabicDigits(Carbon::createFromFormat('Y-m-d', $request->receipt_date)->format('d-m-Y'));
        $applications->favor_name     = $request->favor_name;
        $applications->against_name   = $request->against_name;
        $applications->subject        = Numbers::ShowInArabicDigits($request->subject);
        $applications->governorate    = $request->governorate;
        $applications->section        = $request->section;
        $applications->side           = $request->side;
        $applications->start_date     = Numbers::ShowInArabicDigits(Carbon::createFromFormat('Y-m-d', $request->start_date)->format('d-m-Y'));
        $applications->end_date       = Numbers::ShowInArabicDigits(Carbon::createFromFormat('Y-m-d', $request->end_date)->format('d-m-Y'));
        $applications->save();
        $last_id = Testimonial::orderBy('id','desc')->get()->first();
        return response()->json(['success' => 'تم تسجيل الطلب بنجاح', 'id' => $last_id->id]);
    }

    /*------- Start print_testimonial_editors end page ---------*/
   /* public function pdf($id){
        $data = Testimonial::find($id);
        $pdf = PDF::loadView('pdf', compact('data'));
        return $pdf->download('pdf.pdf');
    }*/

    public function printPage($id){
        $data = Testimonial::find($id);
        return view ('print_testimonial_editors', compact('data'));
    }
    public function print_search_editors($id){
        $data = Testimonial::find($id);
        return view ('print_search_editors', compact('data'));
    }
    /*------- End print_testimonial_editors end page ---------*/
    /*public function show($id) {
        $testimonial = Testimonial::find($id);
        return view('editors_testimonial', compact('testimonial'));
    }*/

    public function destroy($id){
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return response()->json('تم الحذف');
    }



}
