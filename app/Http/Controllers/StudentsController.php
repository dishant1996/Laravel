<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use app\Models\Student;
use Illuminate\Http\Request;
use illuminate\support\facades\Validator;
use PhpParser\Node\Stmt\Return_;




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

        public function ValidateStudents(Request $req) {
           
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

        $students = new Student();
        $students->id = $req->input('id');
        $students->fname = $req->input('fname');
        $students->Lname = $req->input('Lname');
        $students->email = $req->input('email');
        $students->designation = $req->input('designation');
        $students->save();

        return response()->json(['message' => 'students created succesfully']);
        }
    }
