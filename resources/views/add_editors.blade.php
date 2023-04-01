<!-- start success card form for insert data----->
<div class="messages added_success">
    <div class="contain_card">
        <div class="icon"><i class="active fa fa-check " aria-hidden="true"></i></div>
        <div class="success">تم تسجيل الطلب بنجاح</div>
        <button class="form-danger">Done</button>
    </div>
</div>

<div class="messages message_error">
    <div class="contain_card">
        <div class="icon" style="background-color: #dc3545"><i class="active fa fa-close " aria-hidden="true"></i></div>
        <div class="success">خطا فى البيانات</div>
        <button class="form-danger" style="background-color: #dc3545">error</button>
    </div>
</div>
<!-- end success card form for insert data----->

<div class="model_page page_for_editors">
    <div class="mainBox">
        <div class="iconClose"><i class="fa fa-times-circle-o fa-3x" aria-hidden="true"></i></div>
        <div class="row">
            <!--box left side start-->
            <div class="col-3 rightSide">
                <h4>تسجيل المحررات</h4>
                <div class="step">
                    <p>اضافة المحررات لارقام الاسبقية</p>
                </div>
                <div class="departments">
                    <!--personal box-->
                    <div class="boxs personal">
                        <div class="circle">
                            <div class="num">1</div>
                        </div>
                        <div class="title"><a href="{{route('home')}}">الصفحة الرئيسية</a></div>
                    </div>
                    <!--Education box-->
                    <div class="boxs education">
                        <div class="circle">
                            <div class="circle">
                                <div class="num">2</div>
                                <div class="line"></div>
                            </div>
                            <div class="line"></div>
                        </div>
                        <div class="title"><a href="{{route('testimonials.index')}}">عرض التقارير</a></div>
                    </div>

                </div>

            </div>
            <!--box left side End-->

            <!--box right side start-->
            <div class="col-9 leftSide">
                <!-- <div class="icon"><i class="fa fa-smile-o" aria-hidden="true"></i></div>-->
                <form id="editors_form" action="{{route('editors.store')}}" method="POST">
                    @csrf
                    <div class="form_box">
                        <div class="row d-flex justify-content-center">
                            <div class="col-9">
                                <label for="testimonial_id" class="form-label"> اختر رقم الاسبقية لإضافة المحرارت عليه </label>
                                <select name="testimonial_id" value="{{old('testimonial_id')}}" id="testimonial_id" class="form-select testimonial_id" aria-label="Default select example">
                                    @foreach($testimonials as $testimonial)
                                        <option value="{{$testimonial->id}}">{{$testimonial->pre_number_year}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form_box">
                        <div class="row">

                            <div class="col-4">
                                <label for="publication_num" class="form-label">رقم الشهر</label>
                                <input class="form-control" id="publication_num" type="number" min="0" name="publication_num" value="{{old('publication_num')}}" placeholder="رقم الشهر " >
                                <span class="alert text-danger publication_num_error"></span>
                            </div>
                            <div class="col-4">
                                <label for="publication_year" class="form-label">تاريخ الشهر</label>
                                <input class="form-control" id="publication_year" type="number" min="0" name="publication_year" value="{{old('publication_year')}}" placeholder="تاريخ الشهر " >
                                <span class="alert text-danger publication_year_error"></span>
                            </div>

                            <div class="col-4">
                                <label for="editor_type" class="form-label">نوع المحرر</label>
                                <input class="form-control" id="editor_type" type="text" min="0" name="editor_type" value="{{old('editor_type')}}" placeholder="نوع المحرر " >
                                <span class="alert text-danger editor_type_error"></span>
                            </div>

                        </div>
                    </div>

                    <div class="form_box">
                        <div class="row">
                            <div class="col-6">
                                <label for="against_name_editor" class="form-label">الصادر ضده الشهر</label>
                                <textarea class="form-control against_name_editor" type="text" id="against_name_editor" name="against_name" value="{{old('against_name')}}" placeholder="كل اسم على سطر خاص به.." ></textarea>
                                <span class="alert text-danger against_name_editor_error"></span>
                            </div>
                            <div class="col-6">
                                <label for="favor_name_editor" class="form-label">الصادر لصالحه الشهر</label>
                                <textarea class="form-control favor_name_editor" type="text" id="favor_name_editor" name="favor_name" value="{{old('favor_name')}}" placeholder="كل اسم على سطر خاص به.." ></textarea>
                                <span class="alert text-danger favor_name_editor_error"></span>
                            </div>

                        </div>
                    </div>

                    <div class="form_box">
                        <div class="row">
                            <div class="col-4">
                                <label for="statement" class="form-label">بيانات العقار</label>
                                <textarea class="form-control statement" type="text" id="statement" name="statement" value="{{old('statement')}}" placeholder="اضف البيانات الخاصة بالعقار" ></textarea>
                                <span class="alert text-danger statement_error"></span>
                            </div>
                            <div class="col-4">
                                <label for="dept" class="form-label">بيان المقابل او مقدار الدين </label>
                                <textarea class="form-control dept" type="text" id="dept" name="dept" value="{{old('dept')}}" placeholder="كل اسم على سطر خاص به.." ></textarea>
                                <span class="alert text-danger dept_error"></span>
                            </div>
                            <div class="col-4">
                                <label for="notes" class="form-label">ملاحظــــات</label>
                                <textarea class="form-control notes" type="text" id="notes" name="notes" value="{{old('notes')}}" placeholder="كتابة بيانات اضافية " ></textarea>
                                <span class="alert text-danger notes_error"></span>
                            </div>

                        </div>
                    </div>

                    <div class="form_box">
                        <input type="submit" class="btn btn-success" value="اضافة محرر او اكثر">
                        <button class="btn btn-danger" id="move_to_search_editors">انهاء</button>
                    </div>

                </form>
            </div>
            <!--box right side start-->
        </div>
    </div>

    <!------links header --------->
</div>

<!-----start page added search----------------->
<div class="model_page page_added_search">
    <div class="mainBox">
        <div class="iconClose"><i class="fa fa-times-circle-o fa-3x" aria-hidden="true"></i></div>

                <!-- <div class="icon"><i class="fa fa-smile-o" aria-hidden="true"></i></div>-->
                <form id="Add_search_editors_form" action="{{route('search_editors.store')}}" method="POST">
                    @csrf
                    <div class="form_box">
                        <div class="row d-flex justify-content-center">
                            <div>
                                <label for="search_testimonial_id" class="form-label"> اختر رقم الاسبقية لإضافة بحث فى الفهارس الابجدية </label>
                                <select name="testimonial_id" value="{{old('testimonial_id')}}" id="search_testimonial_id" class="form-select testimonial_id" aria-label="Default select example">
                                    @foreach($testimonials as $testimonial)
                                        <option value="{{$testimonial->id}}">{{$testimonial->pre_number_year}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form_box">
                                <label for="search_year" class="form-label">السنة</label>
                                <textarea class="form-control search_year" type="text" id="search_year" name="search_year" value="{{old('search_year')}}" placeholder="اضف السنين الخاصة بالطلب" ></textarea>
                                <span class="alert text-danger search_year_error">يرجى كتابة كل سنة على سطر خاص *</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form_box">
                                <label for="recording_numbers" class="form-label">ارقام التسجيلات والقيود</label>
                                <textarea class="form-control recording_numbers" type="text" id="recording_numbers" name="recording_numbers" value="{{old('recording_numbers')}}" placeholder="اضف ارقام التسجيلات والقيود " ></textarea>
                                <span class="alert text-danger recording_numbers_error">يرجى كتابة كل رقم على سطر خاص *</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form_box">
                                <label for="subjects" class="form-label">الموضوع</label>
                                <textarea class="form-control subjects" type="text" id="subjects" name="subjects" value="{{old('subjects')}}" placeholder="الموضوعات" ></textarea>
                                <span class="alert text-danger subjects_error">يرجى كتابة كل موضوع على سطر خاص *</span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form_box">
                                <label for="add_notes" class="form-label">ملاحظـــات</label>
                                <textarea class="form-control add_notes" type="text" id="add_notes" name="add_notes" value="{{old('add_notes')}}" placeholder="الملاحظات" ></textarea>
                                <span class="alert text-danger add_notes_error">يرجى كتابة كل ملاحظة على سطر خاص *</span>
                            </div>
                        </div>
                    </div>

                    <div class="form_box">
                        <input type="submit" class="btn btn-success" value="اضافة البحث">
                    </div>

                </form>

    </div>

    <!------links header --------->
</div>
<!-----End page added search----------------->

