@extends('layouts.app')
@section('linkCss')
    <link rel="stylesheet" href="{{asset("css/master.css")}}">
    <link rel="stylesheet" href="{{asset("css/home.css")}}">
    <link rel="stylesheet" href="{{asset("css/update_search_editors.css")}}">
@endsection
@section('content')


    <div class="content">
        @include('includes.nav')
        <div class="contain ">
            <div class="contain_forms">
                <form action="{{route('search_editors.update', $editor->id )}}" method="POST" data-id="{{$editor->id}}" id="update_search">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form_box">
                                <label for="search_year" class="form-label">السنة</label>
                                <textarea class="form-control search_year" type="text" id="search_year" name="search_year" value="{{old('search_year')}}" placeholder="اضف السنين الخاصة بالطلب" >{{$editor->search_year}}</textarea>
                                <span class="alert text-danger search_year_error">يرجى كتابة كل سنة على سطر خاص *</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form_box">
                                <label for="recording_numbers" class="form-label">ارقام التسجيلات والقيود</label>
                                <textarea class="form-control recording_numbers" type="text" id="recording_numbers" name="recording_numbers" value="{{old('recording_numbers')}}" placeholder="اضف ارقام التسجيلات والقيود " >{{$editor->recording_numbers}}</textarea>
                                <span class="alert text-danger recording_numbers_error">يرجى كتابة كل رقم على سطر خاص *</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form_box">
                                <label for="subjects" class="form-label">الموضوع</label>
                                <textarea class="form-control subjects" type="text" id="subjects" name="subjects" value="{{old('subjects')}}" placeholder="الموضوعات" >{{$editor->subjects}}</textarea>
                                <span class="alert text-danger subjects_error">يرجى كتابة كل موضوع على سطر خاص *</span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form_box">
                                <label for="add_notes" class="form-label">ملاحظـــات</label>
                                <textarea class="form-control add_notes" type="text" id="add_notes" name="add_notes" value="{{old('add_notes')}}" placeholder="الملاحظات" >{{$editor->add_notes}}</textarea>
                                <span class="alert text-danger add_notes_error">يرجى كتابة كل ملاحظة على سطر خاص *</span>
                            </div>
                        </div>
                    </div>

                    <div class="form_box text-center">
                        <input type="submit" class="btn btn-success" value="تعديل البحث">
                    </div>

                    </form>
            </div>
        </div>

            {{--end of content--}}
        @include('add_editors')
    </div>

@endsection

@section('script')
    <script src="{{asset('js/master.js')}}"></script>
    <script src="{{asset('js/all_testimonials.js')}}"></script>
    <script>
        $(document).ready(function(){
           $('#update_search').on('submit', function(e){
               e.preventDefault();
               var url              = $(this).attr('action');
               var _token           = $('input[name=_token]').val();
               var id               = $(this).data('id');
               var search_year      = $('#search_year').val();
               var recording_numbers= $('#recording_numbers').val();
               var subjects         = $('#subjects').val();
               var add_notes        = $('#add_notes').val();
               $.ajax({
                   url : url,
                   type: 'PUT',
                   data: {
                       _token: _token,
                       id:id,
                       search_year:search_year,
                       recording_numbers:recording_numbers,
                       subjects: subjects,
                       add_notes: add_notes
                   },
                   success: function(data){
                      if(data.status == 0){
                          $.each(data.error, function(prefix, val){
                              $('.' + prefix + "_error").text(val[0]);
                          })
                      }
                      else {
                          $('#update_search')[0].reset();
                          $('.added_success .success').text(data);
                          $('.added_success').fadeIn(1000);
                          setTimeout(function () {
                              $('.added_success').hide(2000);
                          }, 2000);
                      }
                   }
               })
           })
        });
    </script>
@endsection
