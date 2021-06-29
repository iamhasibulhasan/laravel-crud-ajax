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
                                '<a href="#" class="btn btn-warning btn-sm">View</a>'.' '.
                                '<a href="#" class="btn btn-primary btn-sm">Edit</a>'.' '.
                                '<a href="#" class="btn btn-danger btn-sm">Delete</a>'
                            .'</td>';
            $content .= '</tr>';
        }
        echo $content;
    }
}
