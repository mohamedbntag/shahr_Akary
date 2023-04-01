@extends('layouts.app')
@section('linkCss')
    <link rel="stylesheet" href="{{asset("css/master.css")}}">
    <link rel="stylesheet" href="{{asset("css/home.css")}}">
@endsection
@section('content')

    <!---------- start style cirlcl ---------------->
    <div class="body_circle"></div>
    <!---------- end style cirlcl ---------------->

    <div class="content">

        @include('includes.nav')

        <div class="contain">
            <h3> مصلحة الشهر العقاري</h3>

            <div class="form_log1">
                <h5>تسجيل شهادة عقارية</h5>
               <form action="{{route('testimonials.store')}}" method="POST" id="main_form">
                    @csrf
                    <!---------start first box form ------------------------>
                    <div class="form_box">
                        <div class="pre_number">
                            <div class="row">

                                <div class="col-3">
                                    <label for="pre_number" class="form-label">رقم الأسبقية</label>
                                    <input class="form-control" id="pre_number" type="number" min="0" name="pre_number" value="{{old('pre_number')}}" placeholder="رقم اسبقية الطلب " >
                                    <span class="alert text-danger pre_number_error"></span>
                                   {{--@error('pre_number')
                                    <span class="alert text-danger pre_number_error">{{ $message }} رقم الأسبقية</span>
                                    @enderror--}}
                                </div>
                                <div class="col-3">
                                    <label for="year" class="form-label">السنة</label>
                                    <select name="year" id="year" value="{{old('year')}}" class="form-select year" aria-label="Default select example">
                                        <option value="2023" selected>2023</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="receipt_number" class="form-label">رقم الايصال</label>
                                    <input class="form-control" type="number" min="0" id="receipt_number" name="receipt_number" value="{{old('receipt_number')}}" placeholder="رقم الايصال" >
                                    <span class="alert text-danger receipt_number_error"></span>
                                    {{--
                                    @error('receipt_number')
                                    <span class="alert text-danger receipt_number_error">{{ $message }}رقم الايصال</span>
                                    @enderror
                                    --}}

                                </div>
                                <div class="col-3">
                                    <label for="receipt_date" class="form-label">تاريخ الإيصال</label>
                                    <input class="form-control receipt_date" type="date" id="receipt_date" name="receipt_date" value="{{old('receipt_date')}}" placeholder="تاريخ الإيصال" >
                                    <span class="alert text-danger receipt_date_error"></span>
                                    {{--@error('receipt_date')
                                    <span class="alert text-danger">{{ $message }}تاريخ الإيصال</span>
                                    @enderror--}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <!---------End first box form ------------------------>

                    <!---------start second box form ------------------------>
                    <div class="form_box">
                        <div class="names">
                            <div class="row">

                                <div class="col-4">
                                    <label for="favor_name" class="form-label">اسم مقدم الطلب </label>
                                    <input class="form-control favor_name" type="text" id="favor_name" name="favor_name" value="{{old('favor_name')}}" placeholder="الاسم بالكامل" >
                                    <span class="alert text-danger favor_name_error"></span>
                                    {{--@error('favor_name')
                                    <span class="alert text-danger">{{ $message }}الأسم</span>
                                    @enderror--}}
                                </div>
                                <div class="col-4">
                                    <label for="against_name" class="form-label">اسماء الصادر ضدهم التعامل</label>
                                    <textarea class="form-control against_name" style="height:0" type="text" id="against_name" name="against_name" value="{{old('against_name')}}" placeholder="كل اسم على سطر خاص به.." ></textarea>
                                    <span class="alert text-danger against_name_error"></span>
                                    {{--@error('against_name')
                                    <span class="alert text-danger">{{ $message }}الأسم</span>
                                    @enderror--}}
                                </div>
                                <div class="col-4">
                                    <label for="subject" class="form-label">موضوع الطلب</label>
                                    <textarea class="form-control subject" style="height:0" type="text" id="subject" name="subject" value="{{old('subject')}}" placeholder="موضوع الطلب" ></textarea>
                                    <span class="alert text-danger subject_error"></span>
                                    {{--@error('against_name')
                                    <span class="alert text-danger">{{ $message }}الأسم</span>
                                    @enderror--}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <hr>
                        <!---------End second box form ------------------------>
                        <!---------start second box form ------------------------>
                    <div class="form_box">
                        <div class="city">
                            <div class="row">

                                <div class="col-4 mb-3">
                                    <label for="governorate" class="form-label">المحافظة</label>
                                    <select name="governorate" value="{{old('governorate')}}" id="governorate" class="form-select" aria-label="Default select example">
                                        <option selected disabled>اختر المحافظة..</option>
                                        @foreach($governorates as $governorate)
                                            <option data-id="{{$governorate->id}}" class="governorate" value="{{$governorate->governorate}}" >{{$governorate->governorate}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="section" class="form-label">مركز / قسم</label>
                                    <select name="section" value="{{old('section')}}" id="section" class="form-select" aria-label="Default select example">
                                        <option selected disabled>اختر القسم..</option>
                                        @foreach($sections as $section)
                                            <option class="section section-{{$section->governorate_id}}" data-id="{{$section->id}}" value="{{$section->section}}" >{{$section->section}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="side" class="form-label">ناحية او شياخة</label>
                                    <select name="side" value="{{old('side')}}" id="side" class="form-select" aria-label="Default select example">
                                        <option selected disabled>اختر الناحية..</option>
                                        @foreach($sides as $side)
                                            <option class="side side-{{$side->section_id}}" value="{{$side->side}}" >{{$side->side}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4 ">
                                    <label for="start_date" class="form-label">ابتداءً من المدة </label>
                                    <input class="form-control start_date" value="{{old('start_date')}}" type="date" id="start_date" name="start_date" placeholder="تاريخ الإيصال" >
                                    <span class="alert text-danger start_date_error"></span>
                                    {{--                                    @error('start_date')
                                    <span class="alert text-danger">{{ $message }}التاريخ</span>
                                    @enderror--}}

                                </div>
                                <div class="col-4">
                                    <label for="end_date" class="form-label">الى المدة </label>
                                    <input class="form-control end_date" type="date" id="end_date" name="end_date" value="{{old('end_date')}}" placeholder="تاريخ الإيصال" >
                                    <span class="alert text-danger end_date_error"></span>
                                    {{--@error('end_date')
                                    <span class="alert text-danger">{{ $message }}التاريخ</span>
                                    @enderror--}}
                                </div>

                            </div>
                        </div>
                    </div>
                        <!---------End second box form ------------------------>
                    <div class="form_box">
                        <input type="submit" class="btn btn-success" value="تسجيل الطلب">
                        <button class="btn btn-warning add_editors" type="button">اضافة محرارات على الشهادة </button>
                        <button class="btn btn-primary add_search" type="button">اضافة بحث</button>
                    </div>
                </form>
            </div>
            <!----------- end boxes for---------------

            -- start this number already exist----->
            <div class="alert alert-danger already_exist"></div>
            <!----------------------->


        </div>
        {{---------start contain page for ----------}}

        {{---------start second page Model for add editors and tables----------}}
        @include('add_editors')

        {{---------end second page for add editors and tables----------}}
            {{--end of content--}}
    </div>

@endsection

@section('script')
    <script src="{{asset('js/master.js')}}"></script>
@endsection
