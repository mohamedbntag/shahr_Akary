$(document).ready(function() {
    //$('.flash').slideUp(5000);
    /*--------Start show selected sections when click for governrate---------*/
    $("#governorate").change(function(){
        $('.section').hide();
        var conceptName = $(this).find('option:selected').attr("data-id");
        $('.section-'+conceptName).show();
    });
        /*------------show selected side-----------*/
    $("#section").change(function(){
        $('.side').hide();
        var conceptName2 = $(this).find('option:selected').attr("data-id");
        $('.side-'+conceptName2).show();
    });

    /*--------End show selected sections when click for governrate---------*/

    /*----start js for send data from form1*/
    $('#main_form').on('submit', function (e) {
        e.preventDefault();
        let url           = $(this).attr('action');
        let _token        = $('input[name=_token]').val();
        let pre_number    = $('#pre_number').val();
        let year          = $('#year').val();
        let receipt_number= $('#receipt_number').val();
        let receipt_date  = $('#receipt_date').val();
        let favor_name    = $('#favor_name').val();
        let against_name  = $('#against_name').val();
        let subject       = $('#subject').val();
        let governorate   = $('#governorate').val();
        let section      = $('#section').val();
        let side          = $('#side').val();
        let start_date    = $('#start_date').val();
        let end_date      = $('#end_date').val();

        $.ajax({
            url: url,
            type: 'POST',
            /*processData: false,
            contentType: false,
            dataType: 'json',*/
            data: {
                _token        : _token,
                pre_number    : pre_number,
                year          : year,
                receipt_number: receipt_number,
                receipt_date  : receipt_date,
                favor_name    : favor_name,
                against_name  : against_name,
                subject       : subject,
                governorate   : governorate,
                section       : section,
                side          : side,
                start_date    : start_date,
                end_date      : end_date
            },
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (data) {
                $('.text-danger').text('');
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $("." + prefix + '_error').text(val[0]);
                    });
                } else if (data.already_exist == 0) {
                    $('.message_error .success').text(data.requestNum);
                    $('.message_error').fadeIn(1000);
                    setTimeout( function() {
                        $('.messages').hide(2000)}, 2000);
                } else {
                    $('#main_form')[0].reset();
                    $('#editors_form #testimonial_id').prepend("<option selected value=" + data.id+'>' +year + "/" + pre_number + '</option>');
                    $('#Add_search_editors_form #search_testimonial_id').prepend("<option selected value=" + data.id+'>' +year + "/" + pre_number + '</option>');
                    $('.added_success .success').text(data.success);
                    $('.added_success').fadeIn(1000);
                    setTimeout(function () {
                        $('.added_success').hide(2000, function(){
                            $('.page_for_editors').slideDown(2000);
                        });
                    }, 2000);
                }

            }
            /*------end success function-----*/
        })
    })
    /*----end js for send data from form1-----*/

/*===================
=start second page for add editors and tables
===================== */
    $('.add_editors').on('click', function () {
        $('.page_for_editors').slideDown(2000);
    });

    $('.add_search').on('click', function () {
        $('.page_added_search').fadeIn(2000);
    });

    $('.model_page .iconClose i').on('click', function () {
        $('.model_page').slideUp(2000);
    });

    $('#editors_form').on('submit', function(e){
        e.preventDefault();
       let url                = $(this).attr('action');
       let _token             = $('input[name=_token]').val();
       let testimonial_id     = $('#testimonial_id').val();
       let publication_num    = $('#publication_num').val();
       let publication_year   = $('#publication_year').val();
       let editor_type        = $('#editor_type').val();
       let against_name_editor= $('#against_name_editor').val();
       let favor_name_editor  = $('#favor_name_editor').val();
       let statement          = $('#statement').val();
       let dept               = $('#dept').val();
       let notes              = $('#notes').val();
       $.ajax({
           url : url,
           type: 'POST',
           data: {
               _token             : _token,
               testimonial_id     : testimonial_id,
               publication_num    : publication_num,
               publication_year   : publication_year,
               editor_type        : editor_type,
               against_name_editor: against_name_editor,
               favor_name_editor  : favor_name_editor,
               statement          : statement,
               dept               : dept,
               notes              : notes
           },
           success: function(data){
             $('.text-danger').text('');
             if(data.status == 0) {
                 $.each(data.error, function(prefix, val){
                     $('.' + prefix + '_error').text(val[0]);
                 });

             }
             else {
                 $('#editors_form')[0].reset();
                 $('.added_success .success').text('تم اضافة المحررات بنجاح');
                 $('.added_success').fadeIn(1000);
                 setTimeout( function() {
                     $('.added_success').hide(2000);
                 }, 2000);
                 $('.added_row_js_'+testimonial_id).append(
                     "<tr id=table-Row-editors-"+data+">" +
                     "<td>0</td>" +
                     "<td><button data-id="+data+" data-token="+_token+" class= \"btn btn-danger remove_editors_testimonial\"  style=\"padding: 5px\">حذف</button></td>" +
                     "<td>"+publication_num + "/" + publication_year+"</td>" +
                     "<td>"+editor_type+"</td>" +
                     "<td>"+against_name_editor+"</td>" +
                     "<td>"+favor_name_editor+"</td>" +
                     "<td>"+statement+"</td>" +
                     "<td>"+dept+"</td>" +
                     "<td>"+notes+"</td>" +
                     "</tr>"
                 );

             }
           },
       })
    });

$('#move_to_search_editors').on('click', function(){
    $('.model_page').slideUp(2000);
    $('.page_added_search').slideDown(3000);
});
/*===================
=ُEnd second page for add editors and tables
===================== */

/*===================
=Start Add_search_editors_form
===================== */
    $('#Add_search_editors_form').on('submit', function(e) {
        e.preventDefault();
        let url                  = $(this).attr('action');
        let _token               = $('input[name=_token]').val();
        let testimonial_id= $('#search_testimonial_id').val();
        let search_year          = $('#search_year').val();
        let recording_numbers    = $('#recording_numbers').val();
        let subjects             = $('#subjects').val();
        let add_notes            = $('#add_notes').val();
        $.ajax({
            url : url,
            type: 'POST',
            data: {
                _token           : _token,
                testimonial_id   : testimonial_id,
                search_year      : search_year,
                recording_numbers: recording_numbers,
                subjects         : subjects,
                add_notes        : add_notes,
            },
            success: function(data){
                $('.text-danger').text('');
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                       $('.' + prefix + '_error' ).text(val[0]);
                    });
                } else if (data.already_exist == 0) {
                    $('.message_error .success').text(data.requestNum);
                    $('.message_error').fadeIn(1000);
                    setTimeout( function() {
                        $('.messages').hide(2000)}, 2000);
                }
                else {
                    $('#Add_search_editors_form')[0].reset();
                    $('.added_success .success').text('تم اضافة البحث فى الفهارس الأبجدية بنجاح');
                    $('.added_success').fadeIn(1000);
                    setTimeout( function() {
                        $('.added_success').hide(2000,
                            function(){
                            //location.href="http://localhost:8000/home";
                            location.reload();
                            });
                    }, 2000);
                }
            }
        });
    })

/*===================================================================
=End Add_search_editors_form
===================================================================== */






})


/*----------comment code */
/*
    $(function(){

        $("#main_form").on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.status == 0){
                        $.each(data.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        });
                    }else{
                        $('#main_form')[0].reset();
                        alert(data.msg);
                    }
                }
            });
        });
    });
*/
