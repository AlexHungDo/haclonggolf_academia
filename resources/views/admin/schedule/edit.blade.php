@extends('layouts.base_admin')

@section('main')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Chỉnh sửa lịch học {{$schedule->id}}</h6>
                <a href="{{ route('schedules.index') }}" class="btn btn-light">Quay lại danh sách</a>
            </div>
            <div class="bg-dark text-white rounded p-4">
                <form id="editScheduleForm" method="POST" action="{{ route('schedules.update', $schedule->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="courseName">Tên khóa học </label>
                        <select class="form-control" id="courseName" name="course_id">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $schedule->course_id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="studentName">Tên học viên </label>
                        <select class="form-control" id="studentName" name="student_id">
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ $student->id == $schedule->student_id ? 'selected' : '' }}>{{ $student->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="trainerName">Tên huấn luyện viên </label>
                        <select class="form-control" id="trainerName" name="trainer_id">
                            @foreach($trainers as $trainer)
                                <option value="{{ $trainer->id }}" {{ $trainer->id == $schedule->trainer_id ? 'selected' : '' }}>{{ $trainer->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="startDate" class="text-white">Ngày giờ bắt đầu</label>
                        <input type="datetime-local" class="form-control bg-white text-dark" id="startDate" name="start_date" value="{{ \Carbon\Carbon::parse($schedule->start_date)->format('Y-m-d\TH:i') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select class="form-control" id="status" name="status">
                            <option value="chưa hoàn thành" {{ $schedule->status == 'chưa hoàn thành' ? 'selected' : '' }}>Chưa hoàn thành</option>
                            <option value="hoàn thành" {{ $schedule->status == 'hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="notes" class="text-white">Ghi chú</label>
                        <textarea class="form-control bg-white text-dark" id="notes" name="notes" rows="3">{{ $schedule->notes ?? '' }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
