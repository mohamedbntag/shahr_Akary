<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use App\Models\Section;
use App\Models\Side;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CityController extends Controller
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

    public function index () {
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        $governorates = Governorate::all();
        $sections     = Section::orderBy('id', 'desc')->get();
        return view('form_city', compact('testimonials', 'governorates', 'sections'));
    }

    public function store_side (Request $request) {
        $validator = validator::make($request->all(), [
            'section'    => 'required',
            'side'       => 'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        $add_new_side                 = new Side();
        $add_new_side->section_id     = $request->section;
        $add_new_side->side           = $request->side;
        $add_new_side->save();
        return response()->json('تم اضافة الناحية بنجاح');
    }

    public function store_section(Request $request){
        $validator = validator::make($request->all(), [
            'governorate'    => 'required',
            'new_section'    => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        $add_new_section                 = new Section();
        $add_new_section->governorate_id = $request->governorate;
        $add_new_section->section        = $request->new_section;
        $add_new_section->save();
        $last_id = Section::orderBy('id', 'desc')->get()->first();
        return response()->json(   ['massage'=> 'تم اضافة القسم بنجاح', 'id'=>$last_id->id]);
    }








}
