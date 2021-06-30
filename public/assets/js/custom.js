(function ($){


    $(document).ready(function (){

        // Add new student modal view
        $('a#student_add_modal_btn').click(function (e){

            e.preventDefault();
            $('#student_add_modal').modal('show');
        });


        //Not working[dont know]
        // Single student modal view
        // $('a#single_student_view_btn').click(function (e){
        //
        //     e.preventDefault();
        //     $('#single_student_view_modal').modal('show');
        //     alert();
        // });

        $(document).on('click', 'a#single_student_view_btn', function(e){
            e.preventDefault();
            let id = $(this).attr('view_id');
            $.ajax({
                url :   'student/show/'.concat(id),
                success :   function (data){
                    $('#single_student').html(data);
                    // alert(data.name);
                }

            });

            $('#single_student_view_modal').modal('show');
        });

        //Add new student form submit
        $(document).on('submit', 'form#student_add_form', function (e){
            e.preventDefault();

            let name = $('#student_add_form input[name = "name"]').val();
            let email = $('#student_add_form input[name = "email"]').val();
            let cell = $('#student_add_form input[name = "cell"]').val();
            let uname = $('#student_add_form input[name = "uname"]').val();

            let checkEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if ( name == "" || email == "" || cell == "" || uname == "" ){
                $('.msg').html(customMsg( 'All fields are required!', 'danger' ));
            }else if (checkEmail.test(email) == false) {
                $('.msg').html(customMsg( 'This email is invalid!', 'warning' ));
            }else {
                $.ajax({
                    url :   '/student/store',
                    method  : 'POST',
                    data    : new FormData(this),
                    contentType: false,
                    processData: false,
                    success : function (data){
                        all_student();
                        $('form#student_add_form')[0].reset();
                        $('.msg').html(customMsg( 'Student added successful!', 'success' ));
                    }
                });

            }
        });

    //    Student Delete modal View
        $(document).on('click', 'a#delete_student_modal_btn', function(e){
            e.preventDefault();
            let id = $(this).attr('delete_id');
            // alert(id);
            let deleteId = document.getElementById('delete_student_btn');
            deleteId.setAttribute('value', id);
            $('#delete_student_modal_view').modal('show');
        });

        /*  Student Delete    */
        $(document).on('click', '#delete_student_btn', function(e){
            e.preventDefault();
            let id = $(this).attr('value');
            let token = $("meta[name='csrf-token']").attr("content"); /* For Delete Route */
            $('#delete_student_modal_view').modal('hide');

            $.ajax({
                url :   'student/delete/'.concat(id),
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success :   function (data){
                    all_student();
                    $('.msg').html(customMsg( 'Student deleted successful!', 'success' ));
                    // alert(data);
                }

            });
        });

        /*      Student Edit Modal Starts       */

        $(document).on('click', '#edit_student_modal_btn', function(e){
            e.preventDefault();
            let id = $(this).attr('edit_id');
            all_student();
            $.ajax({
                url :   '/student/edit/'.concat(id),
                success : function (data){
                    $('#name').val(data[0]);
                    $('#email').val(data[1]);
                    $('#cell').val(data[2]);
                    $('#uname').val(data[3]);
                    $('#o_photo').val(data[5]);
                    $('#show_photo').attr('src', 'media/students/'.concat(data[5]));

                    /*radio btn checked with jQuery*/
                    if (data[4] == 'Male'){
                        $("#up_male").prop("checked", true);
                    }else {
                        $("#up_female").prop("checked", true);
                    }
                    $('#sid').val(data[6]);
                    // alert(data);

                }
            });

            $('#edit_student_modal').modal('show');


        });


        /*      Student Edit Modal Ends       */

        /*      Student Update Starts       */

        $(document).on('submit', 'form#student_update_form', function (e){
            e.preventDefault();
            let id = $('#student_update_form input[name = "id"]').val();
            let up_name = $('#student_update_form input[name = "up_name"]').val();
            let up_email = $('#student_update_form input[name = "up_email"]').val();
            let up_cell = $('#student_update_form input[name = "up_cell"]').val();
            let up_uname = $('#student_update_form input[name = "up_uname"]').val();

            let checkEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if ( up_name == "" || up_email == "" || up_cell == "" || up_uname == "" ){
                $('.up_msg').html(customMsg( 'All fields are required!', 'danger' ));
            }else if (checkEmail.test(up_email) == false) {
                $('.up_msg').html(customMsg( 'This email is invalid!', 'warning' ));
            }else {
                $.ajax({
                    url :   '/student/update/'.concat(id),
                    method  : 'POST',
                    data    : new FormData(this),
                    contentType: false,
                    processData: false,
                    success : function (data){
                        all_student();
                        $('.msg').html(customMsg( 'Student Updated successful!', 'success' ));
                        $('#edit_student_modal').modal('hide');
                        alert(id);
                    }
                });

            }
        });

        /*      Student Update Ends       */








    });


})(jQuery)
