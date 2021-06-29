(function ($){


    $(document).ready(function (){

        // Add new student modal view
        $('a#student_add_modal_btn').click(function (e){

            e.preventDefault();
            $('#student_add_modal').modal('show');
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

    });


})(jQuery)
