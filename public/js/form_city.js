$(document).ready(function() {
    $('.city_btn').on('click', function () {

        $('.city_btn').removeClass('active');
        $(this).addClass('active');
    });

    /*-------start moving form from left to right-----*/
    $('.btn_section').on('click', function() {
        $('#form_section').animate({left : 0}, 1500);
        $('#form_side').animate({right : "-105%" }, 1500);
    });

    $('.btn_side').on('click', function() {
        $('#form_section').animate({left : "-105%"}, 1500);
        $('#form_side').animate({right : 0 }, 1500);
    });

    /*-------end moving form from left to right-----*/

    /*----------start add new side in form form_side--------------*/
    $('#form_side').on('submit', function(e) {
        e.preventDefault()
        let url    = $(this).attr('action');
        let _token = $('input[name=_token]').val();
        let section= $('#section').val();
        let side   = $('#side').val();
        $.ajax({
            url    : url,
            type   : 'POST',
            data   : {
                _token : _token,
                section: section,
                side   : side
            } ,
            success: function(data) {
                $('.text-danger').show().text('');
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        $('.' + prefix + '_error').text(val[0]);
                    })
                }
                else {
                    $('.text-danger').hide().text('')
                    $('#form_side')[0].reset();
                    $('.added_success .success').text(data);
                    $('.added_success').fadeIn(1000);
                    setTimeout(function () { $('.added_success').hide(2000); }, 2000);
                }
            },


        });
    });
    /*----------End add new side in form form_side--------------*/

    /*----------start add new section in form for form_side--------------*/
    $('#form_section').on('submit', function(e){
       e.preventDefault();
       let url        = $(this).attr('action');
       let _token     = $('#form_section input[name=_token]').val();
       let governorate= $('#governorate_section').val();
       let new_section= $('#new_section').val();

       $.ajax({
           url : url,
           type: "POST",
           data: {
               _token     : _token,
               governorate:governorate,
               new_section: new_section
           },
           success : function (data) {
               $('.text-danger').show().text('');
               if (data.status == 0) {
                   $.each(data.error, function(prefix, val) {
                      $('.' + prefix + '_error').text(val[0]);
                   });
               }
               else {
                   $('#form_side .section_choose').after("<option class= section-"+governorate +" class='section' value=" + data.id+'>' +new_section+ '</option>');
                   $('.section-'+governorate).addClass('section');
                   $('.text-danger').hide().text('')
                   $('#form_section')[0].reset();
                   $('.added_success .success').text(data.massage);
                   $('.added_success').fadeIn(1000);
                   setTimeout(function () { $('.added_success').hide(2000); }, 2000);
               }
           }



       })
    });
    /*----------End add new section in form for form_side--------------*/


})
