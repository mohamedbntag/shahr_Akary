<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Editor;
use App\Models\Search_editor;
use Alkoumi\LaravelArabicNumbers\Numbers;
use Carbon\Carbon;

class EditorsController extends Controller
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
        $testimonials = Testimonial::orderBy('id', 'DESC')->paginate(8);
        return view('editors', compact('testimonials'));
    }

    public function store(Request $request){
        $validator = validator::make($request->all(),[
            'testimonial_id'     =>'required',
            'publication_num'    =>'required',
            'publication_year'   =>'required',
            'editor_type'        =>'required',
            'against_name_editor'=>'required',
            'favor_name_editor'  =>'required',
            'statement'          =>'required',
            'dept'               =>'required',
            //'notes'              =>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error' => $validator->errors()->toArray()]);
        }
        $editors = new Editor();
        $editors->testimonial_id     = $request->testimonial_id;
        $editors->publication_num    = Numbers::ShowInArabicDigits($request->publication_num);
        $editors->publication_year   = Numbers::ShowInArabicDigits($request->publication_year);
        $editors->editor_type        = $request->editor_type;
        $editors->against_name_editor= $request->against_name_editor;
        $editors->favor_name_editor  = $request->favor_name_editor;
        $editors->statement          = Numbers::ShowInArabicDigits($request->statement);
        $editors->dept               = Numbers::ShowInArabicDigits($request->dept);
        $editors->notes              = Numbers::ShowInArabicDigits($request->notes);
        $editors->save();
        return response()->json($editors->id);
    }

    public function destroy($id){
        $editors = Editor::find($id);
        $editors->delete();
        return response()->json();
    }



}
