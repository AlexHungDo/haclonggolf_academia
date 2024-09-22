<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\ScheduleDetailsController;
use App\Models\ScheduleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
Route::get('/', function () {
    return redirect('schedule_details');
});

Route::get('/schedule_details', function () {
    return view('schedule_details.index');
})->middleware(['auth', 'verified'])->name('schedule_details');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('schedule_details',ScheduleDetailsController::class);
    Route::get('/schedule-details', 'ScheduleDetailController@index')->name('schedule-details.index');
    Route::resource('schedules',ScheduleController::class);
    Route::resource('class',\App\Http\Controllers\ClassController::class);
    Route::resource('courses',CourseController::class);
    Route::resource('students',StudentController::class);
    Route::post('/trainer/addStudentForClass', [ClassController::class, 'addStudent'])->name('class.addStudent');
    Route::post('/selectedDate', function (Request $request) {
        // Lấy biến từ JavaScript gửi lên
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');

        // Thực hiện xử lý hoặc trả về biến đó
        return response()->json([
            'day' => $day,
            'month' => $month,
            'year' => $year
        ]);
    })->name('selectedDate.route');
    Route::post('/schedules_details/busyDateChoose', [ScheduleDetailsController::class, 'busyDateUpdate'])->name('schedule_details_busy');
    Route::resource('trainers',TrainerController::class);
    Route::post('/schedules/createSchedule-for-trainer', [ScheduleController::class, 'storeForTrainer'])->name('schedules.storeForTrainer');
    Route::get('/schedule_details/block', [ScheduleDetailsController::class, 'block'])->name('schedule_details.block');
});


require __DIR__.'/auth.php';
//Route::middleware(['auth','adminMiddleware','verified'])->group(function () {
//Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules');
//});
Route::middleware(['auth','trainerMiddleware','verified'])->group(function () {
    Route::get('/trainer/schedule_details', [ScheduleController::class, 'index'])->name('trainer.schedule_details');
});



