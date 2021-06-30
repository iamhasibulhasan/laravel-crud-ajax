<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Show index view with all data
     */
    public function index(){
        return view('student.index');
    }

    /**
     * Store Data In Database with the store function
     */
    public function store( Request $request){

        if ( $request->hasFile('photo') ) {
            $img = $request->file('photo');
            $unique_name = md5(time().rand()).'.'.$img->getClientOriginalExtension();
            $img ->move(public_path('media/students'), $unique_name);
        }
        Student::create([
            'name'  =>  $request -> name,
            'email'  =>  $request -> email,
            'cell'  =>  $request -> cell,
            'uname'  =>  $request -> uname,
            'gender'  =>  $request -> gender,
            'photo'  =>  $unique_name
        ]);
    }

    /**
     * All student data
     */

    public function all(){
        $all_student = Student::all();
        $i = 1;
        $content='';
        foreach ($all_student as $student){
            $content .= '<tr>';
                $content .= '<td>'.$i;$i++.'</td>';
                $content .= '<td>'.$student->name.'</td>';
                $content .= '<td>'.$student->email.'</td>';
                $content .= '<td>'.$student->cell.'</td>';
                $content .= '<td>'.$student->uname.'</td>';
                $content .= '<td>'.$student->gender.'</td>';
                $content .= '<td><img src="media/students/'.$student->photo.'"></td>';
                $content .= '<td>'.
                                '<a id="single_student_view_btn" view_id="'.$student->id.'" href="" class="btn btn-warning btn-sm">View</a>'.' '.
                                '<a id="edit_student_modal_btn" edit_id="'.$student->id.'"  href="" class="btn btn-primary btn-sm">Edit</a>'.' '.
                                '<a id="delete_student_modal_btn" delete_id="'.$student->id.'" href="" class="btn btn-danger btn-sm">Delete</a>'
                            .'</td>';
            $content .= '</tr>';
        }
        echo $content;
    }

//    Single Student Show
    public function show($id){
        $student = Student::find($id);
        $content='';

        $content .= '<span style=" margin: 0px auto;"><img style="width: 200px;height: 200px;border-radius: 50%;" src="media/students/'.$student->photo.'"></span>';

        $content.='<tr>';
            $content .= '<td>'.'Name'.'</td>';
            $content .= '<td>'.$student->name.'</td>';
        $content.='</tr>';

        $content.='<tr>';
        $content .= '<td>'.'Email'.'</td>';
        $content .= '<td>'.$student->email.'</td>';
        $content.='</tr>';

        $content.='<tr>';
        $content .= '<td>'.'Cell'.'</td>';
        $content .= '<td>'.$student->cell.'</td>';
        $content.='</tr>';

        $content.='<tr>';
        $content .= '<td>'.'Username'.'</td>';
        $content .= '<td>'.$student->uname.'</td>';
        $content.='</tr>';

        $content.='<tr>';
        $content .= '<td>'.'Gender'.'</td>';
        $content .= '<td>'.$student->gender.'</td>';
        $content.='</tr>';

        echo $content;
    }
    /**
     * Delete Data from students database
     */

    public function delete($id){
        $delete_student = Student::find($id);
        if (file_exists('media/students/'. $delete_student->photo)) {
            unlink('media/students/'. $delete_student->photo);
        }
        $delete_student -> delete();
    }

    /**
     * Edit Data From Students Database
     */

    public function edit($id){
        $student_id = Student::find($id);
        $sid = $student_id ->id;
        $name = $student_id ->name;
        $email = $student_id ->email;
        $cell = $student_id ->cell;
        $uname = $student_id ->uname;
        $gender = $student_id ->gender;
        $photo = $student_id ->photo;

        return [$name,$email,$cell, $uname, $gender, $photo, $sid];
    }

    /**
     * Student Update
     */

    public function update(Request $request, $id)
    {

        if ($request-> hasFile('new_photo')) {
            $file_name = $request -> file('new_photo');
            $unique_name = md5(time().rand()).'.'.$file_name-> getClientOriginalExtension();
            $file_name -> move(public_path('media/students'), $unique_name);

            if (file_exists('media/students/'. $request->old_photo)) {
                unlink('media/students/'. $request->old_photo);
            }
        }else{
            $unique_name = $request ->old_photo;
        }

        $update_data = Student::find($id);
        $update_data -> name = $request -> up_name;
        $update_data -> email = $request -> up_email;
        $update_data -> cell = $request -> up_cell;
        $update_data -> uname = $request -> up_uname;
        $update_data -> gender = $request -> up_gender;
        $update_data -> photo = $unique_name;
        $update_data ->update();

    }

}
