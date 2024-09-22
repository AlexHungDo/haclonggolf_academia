<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use  App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Kiểm tra vai trò người dùng hiện tại
        $user = Auth::user();
        $students = Student::with('trainer')->get();
        $trainers = Trainer::all();
        $trainerUser = Trainer::where('user_id',$user->id)->first();
        if ($user->role != 2) {
            // Nếu không phải là trainer (role != 2), hiển thị giao diện admin
            return view('admin.student.index', compact('students','trainers'));
        } elseif ($user->role == 2) {
            $students = Student::where('trainer_id',$trainerUser->id)->with('trainer')->get();
            // Nếu là trainer (role == 2), hiển thị giao diện trainer
            return view('trainer.student.index',compact('students','trainers'));
        } else {
            // Nếu không phải admin hoặc trainer, chuyển hướng đến trang chủ hoặc trang lỗi
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'student_name' => 'required',
            'student_address' => 'required',
            'phone_number' => 'required',
            'height' => 'required',
            'date_year' => 'required',
            'gmail' => 'required',
            'note' => 'required',
            'trainer_id' => 'required',
        ]);

        $student = new Student();
        $student->full_name = $request->student_name;
        $student->phone_number = $request->phone_number;
        $student->date_of_birth=$request->date_year;
        $student->gmail=$request->gmail;
        $student->note=$request->note;
        $student->height=$request->height;
        $student->trainer_id=$request->trainer_id;
        $student->save();
        return redirect()->route('students.index')->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
        return view('admin.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
        $request->validate([
            'student_name' => 'required',
            'student_address' => 'required',
            'phone_number' => 'required',
        ]);

        $student -> update([
            $student->full_name = $request->input('student_name'),
            $student->address = $request->input('student_address'),
            $student->phone_number = $request->input('phone_number')
        ]);

        return redirect()->route('students.index')->with('success', 'Sửa thành công!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
        $student->delete();
        return redirect()->route('students.index');
    }
}
