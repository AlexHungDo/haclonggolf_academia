<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\ScheduleDetail; // Đặt `use` statement ở đây
use App\Models\Student;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleDetailsController extends Controller
{
    public function index()
    {
        // Kiểm tra xem đã có lịch học nào hết hạn chưa
        $schedule_Details = ScheduleDetail::all();
        foreach ($schedule_Details as $scheduleDetail) {
            if ($scheduleDetail->class_time->startOfDay() < Carbon::now()->startOfDay()) {
                $scheduleDetail->status = 'đã hoàn thành';
                $scheduleDetail->save();
            }
        }
        $user = Auth::user();

        if ($user->role != 2) {
            // Nếu không phải là trainer (role != 2), hiển thị giao diện admin
            $schedule_details = ScheduleDetail::with(['schedule.course', 'schedule.student'])
                ->orderBy('class_time')
                ->get();
            return view('admin.schedule_detail', compact('schedule_details'));
        } elseif ($user->role == 2) {
            // Nếu là trainer (role == 2), hiển thị giao diện trainer
            $trainer = Trainer::where('user_id', $user->id)->first();
            $schedules = Schedule::all();

            $schedule_details = ScheduleDetail::whereIn('schedule_id', $schedules->pluck('id'))
                ->with(['schedule.course', 'schedule.student'])
                ->orderBy('class_time')
                ->get();

            return view('trainer.schedule_detail', compact('schedule_details'));
        } else {
            // Nếu không phải admin hoặc trainer, chuyển hướng đến trang chủ hoặc trang lỗi
            return redirect('/login');
        }
    }



    public function busyDateUpdate(Request $request)
    {
        $id = $request->input('id');
        $schedule_detail = ScheduleDetail::findOrFail($id);
        $schedule_detail->update([
            'note' => 'trainer_busy'
        ]);
        $this->index();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('trainer.time_table',);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();

        if ($user->role != 2) {
            // Nếu không phải là trainer (role != 2), hiển thị giao diện admin
            $schedule_details = ScheduleDetail::with(['schedule.course', 'schedule.student'])
                ->where('schedule_id', $id) // Lọc theo schedule_id
                ->orderBy('class_time')
                ->get();
            return view('admin.schedule-detail.block', compact('schedule_details'));
        } elseif ($user->role == 2) {
            // Nếu là trainer (role == 2), hiển thị giao diện trainer
            $trainer = Trainer::where('user_id', $user->id)->first();
            $schedules = Schedule::where('trainer_id', $trainer->id)->pluck('id');

            $schedule_details = ScheduleDetail::whereIn('schedule_id', $schedules)
                ->where('schedule_id', $id) // Lọc theo schedule_id
                ->with(['schedule.course', 'schedule.student'])
                ->orderBy('class_time')
                ->get();

            return view('trainer.schedule-detail.block', compact('schedule_details'));
        } else {
            // Nếu không phải admin hoặc trainer, chuyển hướng đến trang chủ hoặc trang lỗi
            return redirect('/login');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScheduleDetail $schedule_detail)
    {
        //

        return view('admin.schedule-detail.edit', compact('schedule_detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'class_time' => 'required|date',
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $schedule_detail = ScheduleDetail::findOrFail($id);
        $schedule_detail->update([
            'class_time' => $request->class_time,
            'status' => $request->status,
            'note' => $request->note,
        ]);

        return redirect()->route('schedule_details.index')->with('success', 'Lịch học đã được cập nhật thành công');
    }
    public function block()
    {
        $user = Auth::user();

        if ($user->role != 2) {
            // Nếu không phải là trainer (role != 2), hiển thị giao diện admin
            $schedule_details = ScheduleDetail::with(['schedule.course', 'schedule.student'])
                ->where('status', '!=', 'đã hoàn thành') // Giả sử 'completed' là trạng thái hoàn thành
                ->orderBy('class_time')
                ->get();
            return view('admin.schedule_detail', compact('schedule_details'));
        } elseif ($user->role == 2) {
            // Nếu là trainer (role == 2), hiển thị giao diện trainer
            $trainer = Trainer::where('user_id', $user->id)->first();
            $schedules = Schedule::where('trainer_id', $trainer->id)->get();

            $schedule_details = ScheduleDetail::whereIn('schedule_id', $schedules->pluck('id'))
                ->where('status', '!=', 'đã hoàn thành') // Giả sử 'completed' là trạng thái hoàn thành
                ->with(['schedule.course', 'schedule.student'])
                ->orderBy('class_time')
                ->get();

            return view('trainer.schedule_detail', compact('schedule_details'));
        } else {
            // Nếu không phải admin hoặc trainer, chuyển hướng đến trang chủ hoặc trang lỗi
            return redirect('/login');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



}
