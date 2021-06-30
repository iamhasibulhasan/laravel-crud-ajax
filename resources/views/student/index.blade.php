<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Students Area</title>
    <!-- ALL CSS FILES  -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css' )}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css' )}}">
</head>
<body>



	<div class="wrap-table">
        <a id="student_add_modal_btn" href="" class="btn btn-primary btn-sm">Add Student</a>
        <br>
        <br>
        <div class="msg"></div>
        <div class="card shadow">

			<div class="card-body">
				<h2>All Student</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Username</th>
							<th>Gender</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="all_students">



					</tbody>
				</table>
			</div>
		</div>
	</div>

{{--    Student Add Modal Starts   --}}

    <div id="student_add_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centred">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new student</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

{{--            error msg show in this div          --}}
                <div class="msg"></div>

                <div class="modal-body">
                    <form action="" id="student_add_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>

                        <div class="form-group">
                            <label for="">Cell</label>
                            <input type="text" class="form-control" name="cell">
                        </div>

                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="uname">
                        </div>

                        <div class="form-group">
                            <label for="">Gender</label><br>
                            <input type="radio" name="gender" id="male" value="Male"> <label
                                for="male">Male</label>
                            <input type="radio" name="gender" id="female" value="Female"> <label
                                for="female">Female</label>
                        </div>

                        <div class="form-group">
                            <label for="">Photo</label>
                            <input type="file" class="form-control" name="photo">
                        </div>
                        <input type="submit" value="Add Student" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--    Student Add Modal Ends--}}

{{--       Single Student View Modal Starts     --}}
    <div id="single_student_view_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Single Student</h5>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tbody id="single_student">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{--       Single Student View Modal Ends     --}}

{{--       Student Delete View Modal Starts     --}}
    <div id="delete_student_modal_view" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure wants to delete this student ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                    <meta name="csrf-token" content="{{ csrf_token() }}"> {{--  For delete route  --}}
                    <button id="delete_student_btn" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

{{--       Student Delete View Modal Ends     --}}


{{--       Student Edit Modal Starts     --}}

    <div class="modal fade" id="edit_student_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Student Edit</h4>
                    <button class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="up_msg"></div>
                <div class="modal-body">
                    <form id="student_update_form" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="name" name="up_name">
                            <input type="hidden" class="form-control" id="sid" name="id"> {{--For form update--}}
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" id="email" name="up_email">
                        </div>

                        <div class="form-group">
                            <label for="">Cell</label>
                            <input type="text" class="form-control" id="cell" name="up_cell">
                        </div>

                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" id="uname" name="up_uname">
                        </div>

                        <div class="form-group">
                            <label for="">Gender</label><br>
                            <input type="radio" name="up_gender" id="up_male" value="Male"> <label
                                for="up_male">Male</label>
                            <input type="radio" name="up_gender" id="up_female" value="Female"> <label
                                for="up_female">Female</label>
                        </div>

                        <div class="form-group">
                            <img style="width: 150px;height: 150px;" id="show_photo" alt=""><br>
                            <label for="">Photo</label>
                            <input type="file" class="form-control" id="n_photo" name="new_photo">
                            <input type="hidden" class="form-control" id="o_photo" name="old_photo">
                        </div>
                        <input type="submit" value="Update Student" class="btn btn-primary">

                    </form>
                </div>
            </div>
        </div>
    </div>

{{--       Student Edit Modal Ends     --}}



    <!-- JS FILES  -->
    <script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/functions.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>
