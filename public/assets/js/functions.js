

//Custom msg
function customMsg(msg, type){
    return'<p class="alert alert-'+ type +'">'+ msg +'<button class="close" data-dismiss= "alert">&times; </button></p>';
}

// All student data

function all_student(){
    $.ajax({
        url :   'student/all',
        success :   function (data){
            $('#all_students').html(data);
            // alert(data);
        }

    });
}
all_student();
