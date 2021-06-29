<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Students Area</title>
    <!-- ALL CSS FILES  -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
</head>
<body>



	<div class="wrap-table">
        <a id="student_add_modal_btn" href="" class="btn btn-primary btn-sm">Add Student</a>
        <br>
        <br>
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





    <!-- JS FILES  -->
    <script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/functions.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>
