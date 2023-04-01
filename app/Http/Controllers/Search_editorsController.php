<?php

namespace App\Http\Controllers;

use Alkoumi\LaravelArabicNumbers\Numbers;
use App\Models\Search_editor;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Search_editorsController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /*--------------start Add_search_editors_form store----------------*/
    public function store(Request $request){
        $validate = validator::make($request->all(),[
            'testimonial_id'    => 'required',
            'search_year'       => 'required',
            'recording_numbers' => 'required',
            'subjects'          => 'required',
        ]);

        if(!$validate->passes()){
            return response()->json(['status' => 0, 'error' => $validate->errors()->toArray()]);
        }

        $users = Search_editor::where('testimonial_id',$request->testimonial_id)->pluck('testimonial_id')->toArray();
        if(!empty($users)){
            return response()->json(['already_exist' => 0, 'requestNum' => 'تم اضافة هذا البحث من قبل لتلك الأسبقية']);
        }

        $search_editors = new Search_editor();
        $search_editors->testimonial_id   = $request->testimonial_id;
        $search_editors->search_year      = Numbers::ShowInArabicDigits($request->search_year);
        $search_editors->recording_numbers= Numbers::ShowInArabicDigits($request->recording_numbers);
        $search_editors->subjects         = Numbers::ShowInArabicDigits($request->subjects);
        $search_editors->add_notes        = Numbers::ShowInArabicDigits($request->add_notes);
        $search_editors->save();
        return response()->json();
    }

    public function edit($id){
        $editor = Search_editor::find($id);
        $testimonials = Testimonial::orderBy('id', 'DESC')->paginate(6);
        return view('update_search_editors', compact('editor', 'testimonials'));
    }

    public function update(Request $request, $id){

        $validate = validator::make($request->all(), [
            'search_year'       => 'required',
            'recording_numbers' => 'required',
            'subjects'          => 'required',
            'add_notes'          => 'required',
        ]);
        if(!$validate->passes()){
            return response()->json(['status' => 0, 'error' => $validate->errors()->toArray()]);
        }
        $data                    = Search_editor::find($id);
        $data->search_year       = $request->search_year;
        $data->recording_numbers = $request->recording_numbers;
        $data->subjects          = $request->subjects;
        $data->add_notes         = $request->add_notes;
        $data->save();
        return response()->json('تم تعديل فهرس البحث بنجاح');
    }

    public function destroy($id){
        $editors = Search_editor::find($id);
        $editors->delete();
        return response()->json();
    }








}
