<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use illuminate\support\facades\Validator;
use PhpParser\Node\Stmt\Return_;




class StudentsController extends Controller
{
  
    
    public function Createstudents(Request $req){
       

        $student = new Student();
        $student->id = $req->input('id');
        $student->fname = $req->input('fname');
        $student->Lname = $req->input('Lname');
        $student->email = $req->input('email');
        $student->designation = $req->input('designation');
        $student->save();
        return response()->json($student);
        }


        public function Getstudents(Request $req){
            $student = Student::all();
            return response()->json([$student]);

        }

        public function Validatestudents(Request $req) {
           
        $rules = [
            "id"=>"required|integer|min:1|max:2",
            "fname"=>"required|string|min:10|max:50",
            "Lname"=>"required|string|min:10|max:50",
            "email"=>"required|email",
            "designation"=>"required|string|min:6|max:25"
        ];
$validator = Validator::make($req->all(),$rules);

if($validator->fails())
{
    return response()->json(['errors' => $validator->errors(),401]);
}

        $student = new Student();
        $student->id = $req->input('id');
        $student->fname = $req->input('fname');
        $student->Lname = $req->input('Lname');
        $student->email = $req->input('email');
        $student->designation = $req->input('designation');
        $student->save();

        return response()->json(['message' => 'student created succesfully']);
        }
    }
