@extends('layouts.app')
@section('linkCss')
    <link rel="stylesheet" href="{{asset("css/master.css")}}">
    <link rel="stylesheet" href="{{asset("css/home.css")}}">
    <link rel="stylesheet" href="{{asset("css/all_testimonials.css")}}">
@endsection
@section('content')

    <!---------- start style cirlcl ---------------->
    <div class="body_circle"></div>
    <!---------- end style cirlcl ---------------->

    <div class="content">
        @include('includes.nav')
        <div class="contain testimonials_page">
            <h3> مصلحة الشهر العقاري</h3>

            <div class="row d-flex justify-content-center form_search m-0 mb-2">
                <div class="col-6">
                    <form action="{{route('testimonials.index')}}" method="get">
                            <label>
                                <select  name="testimonial_num" class=" form-select text-center" style="width:140px">
                                    <option selected disabled>اختر رقم البحث</option>
                                    @foreach($pre_number_years as $pre_number_year)
                                        <option value="{{$pre_number_year->id}}">{{$pre_number_year->pre_number_year}}</option>
                                    @endforeach
                                </select>
                            </label>

                        <input type="submit" value ="البحث" class="btn btn-success">
                        <a href="{{route('testimonials.index')}}" class="btn btn-warning">عرض الكل</a>
                    </form>
                </div>
            </div>

            <div class="row d-flex justify-content-center table_testimonials">
                <div class="col-12">
                    <table class="table text-center">
                        <thead style="background-color: #0d6efd;color: aliceblue;">
                        <tr>
                            <th style="width:25%" scope="col">#</th>
                            <th style="width:9%" scope="col"> رقم الاسبقية</th>
                            <th style="width:12%" scope="col">مقدم الطلب</th>
                            <th style="width:10%" scope="col">رقم الإيصال</th>
                            <th style="width:12%" scope="col">صادر ضد</th>
                            <th style="width:14%" scope="col">الموضوع</th>
                            {{--<th style="width:7%" scope="col">محافظة</th>--}}
                            <th style="width:9%" scope="col">مركز</th>
                            <th style="width:9%" scope="col" class="w-auto">ناحية</th>
                        </tr>
                        </thead>
                        <tbody style="background-color:#e7f1ff;">
                        @foreach($testimonials as $testimonial)

                        <tr id="table-Row-{{$testimonial->id}}">
                            <td>
                                <button data-id="{{$testimonial->id}}" data-token="{{csrf_token()}}" class="btn btn-danger removeBtn_table" style="padding: 5px">حذف</button>
                                <button data-id="{{$testimonial->id}}" class="btn btn-primary btn_show_editors" style="padding: 5px">عرض المحرر</button>
                                <button data-id="{{$testimonial->id}}" class="btn btn-dark btn_show_search_editors" style="padding: 5px">عرض الفهرس </button>
                            </td>
                            <td>{{$testimonial->pre_number_year}}</td>
                            <td>{{$testimonial->favor_name}}</td>
                            <td> {{$testimonial->receipt_number}} / {{$testimonial->receipt_date}}</td>
                            <td>{!! nl2br(e($testimonial->against_name)) !!}</td>
                            <td>{{$testimonial->subject}}</td>
                            {{--<td>{{$testimonial->governorate}}</td>--}}
                            <td>{{$testimonial->section}}</td>
                            <td>{{$testimonial->side}}</td>
                        </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!------start paginate----------------->

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{$testimonials->links('pagination::bootstrap-4')}}
                </div>
            </div>


            <!------start paginate----------------->

        </div>
        {{---------start contain page for ----------}}

        {{---------start second page Model for add editors and tables----------}}
        @foreach($testimonials as $testimonial)
        <div class="show_editors" id="show_editors_{{$testimonial->id}}">
            <div class="mainBox">
                <div class="iconClose"><i class="fa fa-times-circle-o fa-3x" aria-hidden="true"></i></div>
                <div class="row d-flex justify-content-center m-0 ">
                    <div class="col-11 print_editors"><a  href="{{route('testimonials.printPage',$testimonial->id)}}" class="btn btn-warning" style="padding: 5px; color:#fff">طباعة المحررات</a></div>
                    <div class="col-11" >
                        <table class="table text-center">
                                <thead style="background-color: #0d6efd;color: aliceblue;">
                                <tr>
                                    <th style="width:5%" scope="col">التسلسل</th>
                                    <th style="width:5%" scope="col">#</th>
                                    <th style="width:9%" scope="col"> رقم الشهر </th>
                                    <th style="width:9%" scope="col">نوع المحرر</th>
                                    <th style="width:17%" scope="col">صادر ضده</th>
                                    <th style="width:17%" scope="col">صادر لصالحه</th>
                                    <th style="width:14%" scope="col">بيان العقار</th>
                                    <th style="width:10%" scope="col">المقابل</th>
                                    <th style="width:14%" scope="col">ملاحظات</th>
                                </tr>
                                </thead>
                                <tbody style="background-color:#e7f1ff;" class="added_row_js_{{$testimonial->id}}">
                                <?php  $num=0 ?>
                                @foreach($testimonial->editors as $editor)
                                    <tr id="table-Row-editors-{{$editor->id}}">
                                        <td><?php echo ++$num ?></td>
                                        <td>
                                            <button data-id="{{$editor->id}}" data-token="{{csrf_token()}}" class="btn btn-danger remove_editors_testimonial" style="padding: 5px">حذف</button>
                                        </td>
                                        <td>{{$editor->publication_num}} / {{$editor->publication_year}}</td>
                                        <td> {{$editor->editor_type}}</td>
                                        <td>{!! nl2br(e($editor->against_name_editor)) !!}</td>
                                        <td>{!! nl2br(e($editor->favor_name_editor)) !!}</td>
                                        <td>{{$editor->statement}}</td>
                                        <td>{{$editor->dept}}</td>
                                        <td>{{$editor->notes}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>

            <!------links header --------->
        </div>
       @endforeach
        {{---------end second page for add editors and tables----------}}

        {{---------start page 3 Model for add search editors in tables----------}}
        @foreach($testimonials as $testimonial)
            <div class="show_search_editors" id="show_search_editors_{{$testimonial->id}}">
                <div class="mainBox">
                    <div class="iconClose"><i class="fa fa-times-circle-o fa-3x" aria-hidden="true"></i></div>
                    <div class="row d-flex justify-content-center m-0 ">
                        <div class="col-11 print_editors"><a  href="{{route('testimonials.print_search_editors',$testimonial->id)}}" class="btn btn-warning" style="padding: 5px; color:#fff">طباعة المحررات</a></div>
                        <div class="col-11" >
                            <table class="table text-center">
                                <thead style="background-color: #0d6efd;color: aliceblue;">
                                <tr>
                                    <th style="width:15%" scope="col"> #</th>
                                    <th style="width:15%" scope="col">صادر ضده</th>
                                    <th style="width:5%" scope="col">من المدة</th>
                                    <th style="width:5%" scope="col">الى المدة</th>
                                    <th style="width:7%" scope="col"> سنة </th>
                                    <th style="width:7%" scope="col">ارقام التسجيل</th>
                                    <th style="width:10%" scope="col">الناحية</th>
                                    <th style="width:20%" scope="col">عن</th>
                                    <th style="width:15%" scope="col">الموضوعات</th>
                                </tr>
                                </thead>
                                <tbody style="background-color:#e7f1ff;">
                                @foreach($testimonial->Search_editor as $editor)
                                    <tr id="table-Row-Search_editors-{{$editor->id}}">
                                        <td>
                                            <button data-id="{{$editor->id}}" data-token="{{csrf_token()}}" class="btn btn-danger remove_search_editors" style="padding: 5px">حذف</button>
                                            <a href="{{route('search_editors.edit', $editor->id)}}" class="btn btn-primary" style="padding: 5px">تعديل</a>
                                        </td>
                                        <td>{!! nl2br(e($testimonial->favor_name)) !!}</td>
                                        <td>{{$testimonial->start_date}}</td>
                                        <td>{{$testimonial->end_date}}</td>
                                        <td>{!! nl2br(e($editor->search_year)) !!}</td>
                                        <td>{!! nl2br(e($editor->recording_numbers)) !!}</td>
                                        <td>{{$testimonial->side}}</td>
                                        <td>{{$testimonial->subject}}</td>
                                        <td>{!! nl2br(e($editor->subjects)) !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!------links header --------->
            </div>
        @endforeach
        {{---------End page 3 Model for add search editors in tables----------}}
        @include('add_editors')
            {{--end of content--}}
    </div>

@endsection

@section('script')
    <script src="{{asset('js/master.js')}}"></script>
    <script src="{{asset('js/all_testimonials.js')}}"></script>

@endsection
