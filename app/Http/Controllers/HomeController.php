<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Governorate;
use App\Models\Section;
use App\Models\Side;
use Alkoumi\LaravelArabicNumbers\Numbers;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class HomeController extends Controller
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
    public function index()
    {

        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        $governorates = Governorate::all();
        $sections     = Section::all();
        $sides        = Side::all();
        return view('home', compact('testimonials', 'governorates', 'sections', 'sides'));
    }






}
