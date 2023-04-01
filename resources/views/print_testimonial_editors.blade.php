@extends('layouts.app')
@section('title')
    <title>{{$data->pre_number_year}}</title>
@endsection
@section('linkCss')
    <link rel="stylesheet" href="{{asset("css/master.css")}}">
    <link rel="stylesheet" href="{{asset("css/print_testimonial_editors.css")}}">
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
                {{Numbers::ShowInArabicDigits( "( نموذج رقم 19 'عقارى' )")}}
            </div>
            <!------------start header title left for real_model----------------------------->
        </header>
    <!------------ end header ----------------------------->

        <!------------start section 1 title certificate----------------------------->
        <section class="certificate">
            <h1>شهادة عقارية</h1>
            <div>
                <p>رقــــم اسبقيــــة الطلـــب :<span>{{$data->pre_number}}</span></p>
                <p>السنــــــــــــــة :<span>{{$data->year}}</span></p>
                <p style="width:380px"> رقم وتاريخ إيصال تحصيل الرسوم:<span>{{$data->receipt_number}} / {{$data->receipt_date}}</span></p>
            </div>
        </section>
        <!------------End section 1 title certificate----------------------------->

        <!------------start section 2 details----------------------------->
        <section class="details">
                <p>بناء على طلب : <span>{{$data->favor_name}}</span></p>
                <p>صادر البحث فى دفاتر الشهر بهذا المكتب فتبين وجود التسجيلات والقيود الموضحة بالكشف ادناه متوقعه ضد :
                    <br>
                    <span>@foreach (explode("\n", $data->against_name) as $line)
                                    {{$line}}  ،
                          @endforeach
                    </span>
                </p>

                <div class="places">
                    <p>الموضوع :    <span>{{$data->subject}}</span></p>
                    <p>كائنة بناحية او شياخة :    <span>{{$data->side}}</span></p>
                </div>

                <div class="places">
                    <p>مركز/قسم :    <span>{{$data->section}}</span></p>
                    <p> محافظة  :    <span>{{$data->governorate}}</span></p>
                </div>

                <div class="places">
                    <p> وذلك عن المدة ابتداءً من  :    <span>{{$data->start_date}}</span></p>
                    <p> الى المدة  :    <span>{{$data->end_date}}</span></p>
                </div>

                <p>ولقد حررت هذه الشهادة وسلمت لطالبها مع احتفاظ مكتب الشهر بكافة الحقوق الممنوحة قانوناً خصوصاً ماتعلق بتحريف الأسماء او اختلاف بيان العقار الوارد فى الطلب المذكور وذلك بالبحث فى فهارس المحاكم المختلطة </p>

        </section>
        <!------------End section 2 details----------------------------->

        <!------------start   table----------------------------->

        <table class="table text-center">
            <thead class="main_color">
            <tr>
                <th style="width:5%" scope="col" class="main_color">م</th>
                <th style="width:13%" scope="col"> رقم الشهر </th>
                <th style="width:11%" scope="col">نوع المحرر</th>
                <th style="width:15%" scope="col">صادر ضده</th>
                <th style="width:15%" scope="col">صادر لصالحه</th>
                <th style="width:22%" scope="col">بيان العقار</th>
                <th style="width:9%" scope="col">المقابل</th>
                <th style="width:10%" scope="col">ملاحظات</th>
            </tr>
            </thead>
            <tbody class="added_row_js_{{$data->id}}">
            <?php  $num=0 ?>
            @foreach($data->editors as $editor)
                <tr id="table-Row-editors-{{$editor->id}}">
                    <td class="main_color"><?php echo ++$num ?></td>
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

        <!-------------------footer---------------->
        <footer><span> المترجم</span> <span> المراجع</span> <span> اميــن المكتــــب</span></footer>
        <!-------------------footer---------------->


    </div>

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
