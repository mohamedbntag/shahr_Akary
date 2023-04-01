@extends('layouts.app')
@section('linkCss')
    <link rel="stylesheet" href="{{asset("css/master.css")}}">
    <link rel="stylesheet" href="{{asset("css/home.css")}}">
    <link rel="stylesheet" href="{{asset("css/form_city.css")}}">
@endsection
@section('content')


    <div class="content">
        @include('includes.nav')
        <div class="contain ">

            <div class="form_city">
                <div class="move_btn">
                    <button type="button" class="btn btn_side city_btn active">اضافة ناحية او شياخة</button>
                    <button type="button" class="btn btn_section city_btn">اضافة قسم او مركز </button>
                </div>

                <hr>

                <div class="contain_forms">

                    <form id="form_side" action="{{route('form_city_side.store')}}" method="POST">
                        @Csrf
                        <div class="box_form_city">
                            <select name="governorate" value="{{old('governorate')}}" id="governorate" class="form-select" aria-label="Default select example">
                                <option selected disabled>اختر المحافظة..</option>
                                @foreach($governorates as $governorate)
                                    <option data-id="{{$governorate->id}}" class="governorate" value="{{$governorate->id}}" >{{$governorate->governorate}}</option>
                                @endforeach
                            </select>
                            <span class="alert text-danger governorate_error"></span>
                        </div>

                        <div class="box_form_city">
                            <select name="section"  id="section" class="form-select" aria-label="Default select example">
                                <option selected disabled class="section_choose">اختر القسم / المركز..</option>
                                @foreach($sections as $section)
                                    <option class="section section-{{$section->governorate_id}}" value="{{$section->id}}" >{{$section->section}}</option>
                                @endforeach
                            </select>
                            <span class="alert text-danger section_error"></span>
                        </div>

                        <div class="box_form_city">
                            <input type="text"  id="side" name="side" class="form-control" placeholder="اضافة ناحية او شياخة">
                            <span class="alert text-danger side_error"></span>
                        </div>

                        <div class="box_form_city">
                            <input type="submit" value="اضـافـــة ناحية جديدة " id="submit" class="form-control btn-primary">
                        </div>

                    </form>

                    <form id="form_section" action="{{route('form_city_section.store')}}" method="POST">
                        @Csrf
                        <div class="box_form_city">
                            <select name="governorate" value="{{old('governorate')}}" id="governorate_section" class="form-select" aria-label="Default select example">
                                <option selected disabled>اختر المحافظة..</option>
                                @foreach($governorates as $governorate)
                                    <option class="governorate" value="{{$governorate->id}}" >{{$governorate->governorate}}</option>
                                @endforeach
                            </select>
                            <span class="alert text-danger governorate_error"></span>
                        </div>

                        <div class="box_form_city">
                            <input type="text"  name="new_section" class="form-control" id="new_section" placeholder="اضافة قسم او مركز">
                            <span class="alert text-danger new_section_error"></span>
                        </div>

                        <div class="box_form_city">
                            <input type="submit" value="اضـافـــة قســم جديد " id="submit" class="form-control btn-primary">
                        </div>

                    </form>



                </div>


            </div>

        </div>

            {{--end of content--}}
        @include('add_editors')
    </div>

@endsection

@section('script')
    <script src="{{asset('js/master.js')}}"></script>
    <script src="{{asset('js/all_testimonials.js')}}"></script>
    <script src="{{asset('js/form_city.js')}}"></script>

@endsection
