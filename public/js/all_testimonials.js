$(document).ready(function(){
    /*----------start remove testimonials----------------*/
    $('.removeBtn_table').on('click', function() {
        var id = $(this).data('id');
        var _token = $(this).data('token');
        $.ajax({
            url : '/testimonials/'+id,
            type: 'DELETE',
            data: {
                id     : id,
                _token : _token,
            },
            success: function () {
                $('.added_success .success').text('تم حذف الطلب');
                $('.added_success').fadeIn(1000);
                setTimeout( function() {
                    $('.added_success').hide(2000);
                }, 2000);
                $('#table-Row-'+id).hide(2000, function() {
                    $(this).remove();

                });

            }
        })

    })
    /*----------end remove testimonials----------------*/
    /*-------start show editors testimonial --------*/
    $('.btn_show_editors').on('click', function () {
        var id = $(this).data('id');
        $('#show_editors_'+id).fadeIn(2000);
    });

    $('.iconClose i').on('click', function () {
        $('.show_editors').fadeOut(2000);
        $('.show_search_editors').fadeOut(2000);
    })
    /*-------End show editors testimonial --------*/

    /*-------start show search editors testimonial --------*/
    $('.btn_show_search_editors').on('click', function () {
        var id = $(this).data('id');
        $('#show_search_editors_'+id).fadeIn(2000);
    });
    /*-------End show search editors testimonial --------*/

    /*========================================
    =start remove editors - testimonials
    ==========================================*/
    $('.remove_editors_testimonial').on('click', function() {
       var id    = $(this).data('id');
       var _token= $(this).data('token');

       $.ajax({
           url : '/editors/'+id,
           type: 'DELETE',
           data: {
               id    : id,
               _token: _token,
           },
           success: function () {
               $('.added_success .success').text('تم حذف المحرر');
               $('.added_success').fadeIn(1000);
               setTimeout( function() {
                   $('.added_success').hide(2000);
               }, 2000);
               $('#table-Row-editors-'+id).hide(2000, function() {
                   $(this).remove();

               });

           }
       })
    });

    /*----------end remove editors testimonials----------------*/


    /*========================================
    =start  remove_search_editors - testimonials
    ==========================================*/
    $('.remove_search_editors').on('click', function() {
       var id    = $(this).data('id');
       var _token= $(this).data('token');
       $.ajax({
           url : '/search_editors/'+id,
           type: 'DELETE',
           data: {
               id    : id,
               _token: _token,
           },
           success: function () {
               $('.added_success .success').text('تم حذف البحث');
               $('.added_success').fadeIn(1000);
               setTimeout( function() {
                   $('.added_success').hide(2000);
               }, 2000);
               $('#table-Row-Search_editors-'+id).hide(2000, function() {
                   $(this).remove();

               });

           }
       })
    });

    /*----------end remove editors testimonials----------------*/

})
