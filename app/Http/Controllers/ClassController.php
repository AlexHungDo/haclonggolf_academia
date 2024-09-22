<?php

namespace App\Http\Controllers;

use App\Models\Class_Detail;
use App\Models\ClassModel;
use App\Models\Course;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index()
    {
      $user = Auth::user();
      $courses = Course::all();
      $trainers = Trainer::all();
      $students = Student::all();
      $trainer1 = Trainer::where('user_id',$user->id)->first();
      $allClass = ClassModel::where('trainer_id',$trainer1->id)->with(['course', 'trainer'])->get();
      return view('trainer.class.index',compact('allClass','courses','trainers','students'));
    }
    public function store(Request $request)
    {
        //
        $request->validate([
            'class_name' => 'required',
            'course_id' => 'required',
            'trainer_id' => 'required',
        ]);

        $class = new ClassModel();
        $class->class_name=$request->class_name;
        $class->course_id = $request->course_id;
        $class->trainer_id=$request->trainer_id;
        $class->save();
        return redirect()->route('class.index')->with('success', 'Thêm thành công!');
    }
    public function edit(ClassModel $class)
    {
        $trainers = Trainer::all();
        $courses = Course::all();
        return view('trainer.class.edit', compact('class','trainers','courses'));
    }
    public function update(Request $request, ClassModel $class){
        $request->validate([
            'class_name' => 'required',
            'trainer_id' => 'required',
            'course_id' => 'required',
        ]);

        $class -> update([
            $class->class_name = $request->input('class_name'),
            $class->trainer_id = $request->input('trainer_id'),
            $class->course_id = $request->input('course_id')
        ]);

        return redirect()->route('class.index')->with('success', 'Sửa thành công!');
    }
    public function destroy(ClassModel $class)
    {
        //
        $class->delete();
        return redirect()->route('class.index');
    }
    public function addStudent(Request $request)
    {
        $request->validate([
            'student_ids' => 'required',
            'class_id'=>'required'
        ]);
        $selectedStudents[] = $request->input('student_ids');
        $class_id = $request->input('class_id');
        foreach ($selectedStudents as $student) {
            $class_detail = new Class_Detail();
            $class_detail->	class_id=$class_id;
            $class_detail->student_id=$student;
            $class_detail->save();
        }
        return redirect()->route('class.index');
    }
}
