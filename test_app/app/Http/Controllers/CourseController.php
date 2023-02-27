<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Course;
use Illuminate\Http\Request;
use DB;
use Session;

class CourseController extends Controller
{
    public $image,$imageName,$directory,$imgUrl;

    public function addCourse(){
        return view('admin.course.add-course');
    }
    public function manageCourse(){
        $courses=DB::table('courses')
            ->join('teachers','courses.teacher_id','teachers.id')
            ->select('courses.*','teachers.name')
            ->get();
        return view('admin.course.manage-course',[
            'courses'=>$courses
        ]);
    }

    public function saveCourse(Request $request){
        $this->validate($request,[
            'course_name'=>'required|unique:courses,course_name|string',
            'slug'=>'required|unique:courses,slug|string'
        ]);
        $course=new Course();
        $course->teacher_id =$request->teacher_id;
        $course->course_name =$request->course_name;
        $course->slug =$this->makeSlug($request);
        $course->course_code =$request->course_code;
        $course->description =$request->description;
        $course->image =$this->saveImage($request);
        $course->save();
        return back();
    }
    public function makeSlug($request){
        if ($request->slug){
            $str=$request->slug;
            return preg_replace('/\s+/u','-',trim($str));
        }
        $str=$request->course_name;
        return preg_replace('/\s+/u','-',trim($str));

    }
    public function manageCourseEdit($id)
    {
        $course = Course::find($id);
        return view('admin.course.edit_course',[
            'course'=>$course
        ]);
    }
    public function updateCourse(Request $request, $id)
    {
        $this->validate($request,[
            'course_name'=>'required|string',
            'slug'=>'required|string'
        ]);
        $course=Course::find($id);
        $course->teacher_id =$request->teacher_id;
        $course->course_name =$request->course_name;
        $course->slug =$this->makeSlug($request);
        $course->course_code =$request->course_code;
        $course->description =$request->description;
        if($request->has('image')) {
            $course->image =$this->saveImage($request);
        }
        $course->update();
        return redirect()->route('manage-course');
    }

    public function course_delete($id)
    {
        $course = Course::where('id', $id)->delete();

        return redirect()->route('manage-course');
    }

    public function deleteApplicant($id)
    {
        $course = Admission::where('id', $id)->delete();

        return redirect()->route('manage-applicant');
    }

    private function saveImage($request){
        $this->image=$request->file('image');
        $this->imageName=rand().'.'.$this->image->getClientOriginalExtension();
        $this->directory='adminAsset/course-image/';
        $this->imgUrl=$this->directory.$this->imageName;
        $this->image->move($this->directory,$this->imageName);
        return $this->imgUrl;
    }
    public function manageApplicant(){
        $applicants=DB::table('admissions')
            ->join('students','admissions.student_id','students.id')
            ->join('courses','admissions.course_id','courses.id')
            ->select('students.student_name',
                'students.student_email','students.student_phone',
                'courses.course_name','courses.course_code','courses.teacher_id',
                'admissions.id','admissions.confirmation')
            ->where('courses.teacher_id','=',Session::get('teacherId'))
            ->get();
//        return  $applicants;
        return view('admin.teacher.manage-applicant',[
            'applicants'=>$applicants
        ]);
    }

}
