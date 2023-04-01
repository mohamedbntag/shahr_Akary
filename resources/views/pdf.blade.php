<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>New Laravel</title>

        <!-- Fonts -->

    </head>
    <style>
        body { font-family: 'XBRiyaz', sans-serif; }
    </style>
    <body class="antialiased">

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
                <p>رقم وتاريخ إيصال تحصيل الرسوم :<span>{{$data->year}}</span></p>
            </div>
        </section>
        <!------------End section 1 title certificate----------------------------->

        <!------------start section 2 details----------------------------->
        <section class="details">
            <p>بناء على الطلب :<span>{{$data->favor_name}}</span></p>
            <p>صادر البحث فى دفاتر الشهر بهذا المكتب فتبين وجود التسجيلات والقيود الموضحة بالكشف ادناه :
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
                <p>مركز اوقسم :    <span>{{$data->section}}</span></p>
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
            <thead>
            <tr>
                <th style="width:3%" scope="col">التسلسل</th>
                <th style="width:9%" scope="col"> رقم الشهر </th>
                <th style="width:11%" scope="col">نوع المحرر</th>
                <th style="width:16%" scope="col">صادر ضده</th>
                <th style="width:16%" scope="col">صادر لصالحه</th>
                <th style="width:22%" scope="col">بيان العقار</th>
                <th style="width:9%" scope="col">المقابل</th>
                <th style="width:14%" scope="col">ملاحظات</th>
            </tr>
            </thead>
            <tbody class="added_row_js_{{$data->id}}">
            <?php  $num=0 ?>
            @foreach($data->editors as $editor)
                <tr id="table-Row-editors-{{$editor->id}}">
                    <td><?php echo ++$num ?></td>
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
        <footer>اميــن المكتــــب</footer>
        <!-------------------footer---------------->


    </div>
    </body>
</html>
