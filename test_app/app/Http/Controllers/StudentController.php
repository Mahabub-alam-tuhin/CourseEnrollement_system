<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Student;
use Illuminate\Http\Request;
use Session;

class StudentController extends Controller
{
    public $image,$imageName,$directory,$imgUrl;
    public function studentRegister(){
        return view('frontEnd.student.register');
    }
    public function studentLogin(){
        return view('frontEnd.student.login');
    }
    public function saveStudent(Request $request){
        $student =new Student();
        $student->student_name = $request->student_name;
        $student->student_email = $request->student_email;
        $student->student_phone = $request->student_phone;
        $student->password = bcrypt($request->password);
        if ($request->file('image')){
            $student->image = $this->saveImage($request);
        }
        $student->address = $request->address;
        $student->save();
        return back();
    }
    private function saveImage($request){
        $this->image=$request->file('image');
        $this->imageName=rand().'.'.$this->image->getClientOriginalExtension();
        $this->directory='adminAsset/student-image/';
        $this->imgUrl=$this->directory.$this->imageName;
        $this->image->move($this->directory,$this->imageName);
        return $this->imgUrl;
    }
    public function studentLoginCheck(Request $request){
            $studentInfo=Student::where('student_email',$request->user_name)
                ->orWhere('student_phone',$request->user_name)
                ->first();
            if ($studentInfo){
                $expass=$studentInfo->password;
                if (password_verify($request->password,$expass)){
                    Session::put('studentId',$studentInfo->id);
                    Session::put('studentName',$studentInfo->student_name);
                    return redirect('/');
                }else{
                    return back()->with('message','invalid password');
                }
            }else{
                return back()->with('message','invalid User Name');
            }
    }
    public function studentLogout(){
        Session::forget('studentId');
        Session::forget('studentName');
        return redirect('/');
    }
    public function admission(Request $request){
        $admission=new Admission();
        $admission->course_id = $request->course_id;
        $admission->student_id = $request->student_id;
        $admission->confirmation = $request->confirmation;
        $admission->save();
        return back();
    }
}
