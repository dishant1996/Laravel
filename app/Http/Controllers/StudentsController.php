<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use app\Models\Student;
use Illuminate\Http\Request;



class StudentsController extends Controller
{
    public function CreateStudents(Request $req){

        $students = new Student();
        $students->id = $req->input('id');
        $students->fname = $req->input('fname');
        $students->Lname = $req->input('Lname');
        $students->email = $req->input('email');
        $students->designation = $req->input('designation');
        $students->save();
        return response()->json($students);
        }
        public function GetStudents(Request $req){
            $students = Student::all();
            return response()->json([$students]);
        
        
    }
}
