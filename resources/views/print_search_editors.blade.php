@extends('layouts.app')
@section('title')
    <title>فهرس {{$data->pre_number_year}}</title>
@endsection
@section('linkCss')
    <link rel="stylesheet" href="{{asset("css/master.css")}}">
    <link rel="stylesheet" href="{{asset("css/print_search_editors.css")}}">
@endsection
@section('content')
    <div class="container">

        <!------------start header ----------------------------->
        <header>
            <!------------start header title right for ministry----------------------------->
            <div class="ministry">
                وزارة العدل <br>
                مصلحة الشهر العقارى والتوثيق <br>
                مكتب الأقصر
            </div>
            <!------------End header title right for ministry----------------------------->

            <!------------start header title left for real_model----------------------------->
            <div class="real_model">
                {{Numbers::ShowInArabicDigits( "( نموذج رقم 22 'عقارى' )")}}
                <br>
                <div class="order_num">رقم الطلب : {{Numbers::ShowInArabicDigits($data->pre_number)}}</div>
            </div>
            <!------------start header title left for real_model----------------------------->
        </header>
    <!------------ end header ----------------------------->

        <!------------start section 1 title certificate----------------------------->
        <section class="certificate">
            <h1> بحث فى الفهارس الأبجدية</h1>
        </section>
        <!------------End section 1 title certificate----------------------------->

        <!------------start section 2 details----------------------------->

                        {{--@foreach (explode("\n", $data->against_name) as $line)
                                    {{$line}}  ،
                          @endforeach--}}

        <!------------start   table----------------------------->

        <table class="table text-center">
            <thead class="main_color">
            <tr>
                <th style="width:50%" scope="col"> ضــــد </th>
                <th style="width:25%" scope="col">من المــدة</th>
                <th style="width:25%" scope="col">الى المــدة</th>
            </tr>
            </thead>
            <tbody>
            {{--@foreach($data->Search_editor as $editor--}}
                <tr>
                    <td>{!! nl2br(e($data->against_name)) !!}</td>
                    <td>{{$data->start_date}}</td>
                    <td>{{$data->end_date}}</td>
                </tr>
                <tr  class="side">
                    <td colspan="2">اعيان كائنة فى:
                        <br>
                        <div class="me-5">
                            {{$data->side}}
                            <br>
                            {{$data->subject}} </div>
                    </td>
                    <td>إمضاء رئيس القسم  </td>
                </tr>
            </tbody>
        </table>

        <table class="table text-center">
            <thead class="main_color">
            <tr>
                <th style="width:20%" scope="col"> سنة </th>
                <th style="width:20%" scope="col">ارقام التسجيلات والقيود</th>
                <th style="width:35%" scope="col">الموضوع</th>
                <th style="width:25%" scope="col">ملاحظات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->Search_editor as $editor)
                <tr>
                    <td>{!! nl2br(e($editor->search_year)) !!}</td>
                    <td>{!! nl2br(e($editor->recording_numbers)) !!}</td>
                    <td>{!! nl2br(e($editor->subjects)) !!}</td>
                    <td>{!! nl2br(e($editor->add_notes)) !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-------------------footer---------------->
        <footer class="container-fluid">
            <div>اسم وتوقيع القائم بالبحث /..........................................</div>
            <div class="text-start">اسم وتوقيع القائم بالبحث /..........................................</div>
            <div>تحريراً فى.....................سنة..................... </div>
            <div class="text-start">تحريراً فى.....................سنة.....................        </div>
        </footer>
        <!-------------------footer---------------->

@endsection
@section('script')
    <script>
       $(document).ready(function() {
            window.print();
            setTimeout(function(){
                location.replace('http://localhost:8000/testimonials');
            },2000)
        })

    </script>
@endsection
