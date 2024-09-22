<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use  App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        if ($user->role != 2) {
            // Nếu không phải là trainer (role != 2), hiển thị giao diện admin
            $courses=Course::all();
            return view('admin.course.index', compact('courses'));
        } elseif ($user->role == 2) {
            // Nếu là trainer (role == 2), hiển thị giao diện trainer
            $courses=Course::all();
            return view('trainer.course.index', compact('courses'));
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
            'course_name' => 'required',
            'number_of_sessions' => 'required',
            'fee' => 'required',
        ]);

        $course = new Course();
        $course->course_name = $request->course_name;
        $course->number_of_sessions = $request->number_of_sessions;
        $course->fee = $request->fee;
        $course->address=$request->address;
        $course->save();
        return redirect()->route('courses.index')->with('success', 'Thêm thành công!');
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
    public function edit(Course $course)
    {
        //
        return view('admin.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
        $request->validate([
            'course_name' => 'required',
            'number_of_sessions' => 'required',
            'fee' => 'required',
        ]);

        $course -> update([
            $course->course_name = $request->input('course_name'),
            $course->number_of_sessions = $request->input('number_of_sessions'),
            $course->fee = $request->input('fee')
        ]);

        return redirect()->route('courses.index')->with('success', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
        $course->delete();
        return redirect()->route('courses.index');
    }
}
