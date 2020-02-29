<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Validator;
class AjaxdataController extends Controller
{
    //
    function index(){
        return view('student.index');
    }
    function getdata(){
        $student = Student::paginate(5);
        return $student;
    }
    function postdata(Request $request){
        $customMessage = [
            'required'=>'Bạn cần điền vào trường này'
        ];
        $validation = Validator::make($request->all(),[
            'first_name'=>'required|exists:students,first_name',
            'last_name'=>'required'
        ],$customMessage);

        $success_output='';
        $errors=[];
        if($validation->fails()){
            $errors = $validation->errors()->all();
        }else{
            if($request->input('button_action') == 'insert'){
                $student = new Student([
                    'first_name'=>$request->get('first_name'),
                    'last_name'=>$request->get('last_name')
                ]);
                $student->save();
                $success_output = '<div class="alert alert-success">Data Insert</div>';
            }
            if($request->input('button_action')=='update'){
                $student = Student::findOrFail($request->input('student_id'));
                $student->first_name = $request->first_name;
                $student->last_name = $request->last_name;
                $student->save();
                $success_output = '<div class="alert alert-success">Data Insert</div>';
            }
        }
        $output = array (
            'error'=>$errors,
            'success'=>$success_output
        );
        echo json_encode($output);
    }
    function getfetchdata(Request $request){
        $id = $request->input('id');
        $student = Student::findOrFail($id);
        echo $student;
    }
    function deletedata(Request $request){
        $student = Student::findOrFail($request->get('student_id'));
        $student->delete();
        $success_output = 'Delete success';
        $output = array('success'=>$success_output);
        echo $success_output;
    }
}
