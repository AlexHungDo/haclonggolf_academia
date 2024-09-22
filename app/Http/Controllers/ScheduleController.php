<?php

namespace App\Http\Controllers;

use App\Models\Class_Detail;
use App\Models\ClassModel;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Student;
use App\Models\Trainer;
use Ramsey\Uuid\Type\Integer;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with(['trainer', 'student', 'course'])->get();
        $courses = Course::all();
        $students = Student::all();
        $trainers = Trainer::all();
        $schedule_Details = ScheduleDetail::all();
        $schedules2 = Schedule::all();
        //Kiểm tra lich hoc đã hoàn thành chưa
        foreach ($schedule_Details as $scheduleDetail) {
            if ($scheduleDetail->class_time->startOfDay()<Carbon::now()->startOfDay()){
                $scheduleDetail->status = 'đã hoàn thành';
                $scheduleDetail->save();
            }
        }
        //Kiểm tra lớp đã hoàn thành chưa:

        foreach ($schedules2 as $schedule) {
            $schedule_Details2 = ScheduleDetail::where('schedule_id', $schedule->id)->get();
            $lastValue = $schedule_Details2->last();
            if ($lastValue->class_time!=null){
            if ($lastValue->class_time->startOfDay()<Carbon::now()->startOfDay()){
                $schedule->status='Đã hoàn thành';
                $schedule->save();
            }
            }
        }
        // Kiểm tra vai trò người dùng hiện tại
        $user = Auth::user();
        if ($user->role != 2) {
            // Nếu không phải là trainer (role != 2), hiển thị giao diện admin
            return view('admin.schedule.index', compact('courses', 'students', 'trainers', 'schedules'));
        } elseif ($user->role == 2) {
            $trainers = Trainer::where('user_id', $user->id)->first();
            $trainer_id=$trainers->id;
            $classSchedules = Schedule::with('allClass2')
                ->whereHas('allClass2', function($query) use ($trainer_id) {
                    $query->where('trainer_id', $trainer_id);
                })
                ->get();
            $studentSchedules = Schedule::with('student')
                ->whereHas('student', function($query) use ($trainer_id) {
                    $query->where('trainer_id', $trainer_id);
                })
                ->get();
            $schedules = $classSchedules->merge($studentSchedules);
            $allClass =  ClassModel::where('trainer_id',$trainers->id)->get();
            // Nếu là trainer (role == 2), hiển thị giao diện trainer
            return view('trainer.schedule.index', compact('courses', 'students', 'trainers', 'schedules','allClass'));
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
        $request->validate([
            'class_id' => 'required',
            'student_id' => 'required',
            'course_id' => 'required',
            'start_date' => 'required',
        ]);

        $schedule = new Schedule();
        $schedule->class_id = $request->class_id;
        $schedule->student_id = $request->student_id;
        $schedule->course_id = $request->course_id;
        $schedule->start_date = $request->start_date;
        $schedule->save();

        $course = Course::where('id', $schedule->course_id)->first();
        $oneWeekApart = Carbon::parse($schedule->start_date);

        for ($i = 0; $i < $course->number_of_sessions; $i++) {
            $scheduleDetail = new ScheduleDetail();
            $scheduleDetail->schedule_id = $schedule->id;
            $scheduleDetail->session_number = $i + 1;
            $scheduleDetail->class_time = $oneWeekApart->toDateTimeString();

            // Add one week to the date for the next session
            $oneWeekApart->addWeek();

            $scheduleDetail->note = $request->note;

            if ($request->status == null) {
                $scheduleDetail->status = 'Chưa hoàn thành';
            } else {
                $scheduleDetail->status = $request->status;
            }

            $scheduleDetail->save();
        }

        return redirect()->route('schedules.index')->with('success', 'Thêm thành công!');
    }

    public function storeForTrainer(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'course_id' => 'required',
            'start_date' => 'required'
        ]);
        // Tạo mới một Schedule và lưu thông tin
        $schedule = new Schedule();
        $schedule->class_id = $request->class_id;
        $schedule->student_id = $request->student_id;
        $schedule->course_id = $request->course_id;
        $schedule->start_date = $request->start_date;
        $schedule->save();
        // Lặp qua các buổi học để tạo ScheduleDetail
        $startTime = $request->start_date;
        $oneWeekApart = Carbon::parse($startTime);
        $course = Course::where('id', $schedule->course_id)->first();
        for ($i = 0; $i < $course->number_of_sessions; $i++) {
            $scheduleDetail = new ScheduleDetail();
            $scheduleDetail->schedule_id = $schedule->id;
            $scheduleDetail->session_number = $i + 1;
            // Đặt thời gian bắt đầu cho buổi học
            if ($i == 0) {
                // Nếu là buổi học đầu tiên, sử dụng start_date của Schedule
                $scheduleDetail->class_time = $schedule->start_date;
            } else {
                // Nếu không, thêm một tuần vào thời gian bắt đầu của buổi học trước đó
                $scheduleDetail->class_time = $oneWeekApart->addWeek()->toDateTimeString();
            }

            // Thiết lập các giá trị khác cho ScheduleDetail
            $scheduleDetail->save();
        }

        return redirect()->route('schedules.index')->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //h
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
        $user = Auth::user();
        $courses = Course::all();
        $students = Student::all();
        $trainers = Trainer::all();
        if ($user->role != 2) {
            // Nếu không phải là trainer (role != 2), hiển thị giao diện admin
            return view('admin.schedule.edit', compact('schedule', 'courses', 'students', 'trainers'));
        } elseif ($user->role == 2) {
            $trainers = Trainer::where('user_id', $user->id)->first();
            $schedules = Schedule::where('trainer_id', $trainers->id)->get();
            // Nếu là trainer (role == 2), hiển thị giao diện trainer
            return view('trainer.schedule.edit', compact('courses', 'students', 'trainers', 'schedule'));
        } else {
            // Nếu không phải admin hoặc trainer, chuyển hướng đến trang chủ hoặc trang lỗi
            return redirect('/login');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
        $user = Auth::user();
        if ($user->role != 2) {
            $request->validate([
                'trainer_id' => 'required',
                'student_id' => 'required',
                'course_id' => 'required',
                'status' => 'required',
                'start_date' => 'required',
                'notes' => 'required',
            ]);

            $schedule -> update([
                $schedule->trainer_id = $request->input('trainer_id'),
                $schedule->student_id = $request->input('student_id'),
                $schedule->course_id = $request->input('course_id'),
                $schedule->start_date = $request->input('start_date'),
                $schedule->status = $request->input('status'),
                $schedule->notes = $request->input('notes'),
            ]);
        } elseif ($user->role == 2) {
            $request->validate([
                'student_id' => 'required',
                'course_id' => 'required',
                'status' => 'required',
                'start_date' => 'required',
                'notes' => 'required',
            ]);

            $schedule -> update([
                $schedule->student_id = $request->input('student_id'),
                $schedule->course_id = $request->input('course_id'),
                $schedule->start_date = $request->input('start_date'),
                $schedule->status = $request->input('status'),
                $schedule->notes = $request->input('notes'),
            ]);
        } else {
            // Nếu không phải admin hoặc trainer, chuyển hướng đến trang chủ hoặc trang lỗi
            return redirect('/login');
        }


        return redirect()->route('schedules.index')->with('success', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
        $schedule->delete();
        return redirect()->route('schedules.index');
    }
}
