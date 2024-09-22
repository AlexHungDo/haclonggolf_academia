@extends('layouts.base_trainer')

@section('main')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Chỉnh sửa lớp học  {{$class->class_name}}</h6>
                <a href="{{ route('class.index') }}" class="btn btn-light">Quay lại danh sách</a>
            </div>
            <div class="bg-dark text-white rounded p-4">
                <form id="editCourseForm" method="POST" action="{{route('class.update', $class->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editCourseId" name="class_id" value="{{$class->id}}">
                    <div class="mb-3">
                        <label for="editClassName" class="form-label text-start">Tên lớp học</label>
                        <input type="text" class="form-control bg-light text-dark" id="editClassName" name="class_name" value="{{$course->course_name}}">
                    </div>
                    <div class="mb-3">
                        <label for="course" class="form-label text-dark">Chọn khóa học </label>
                        <select class="form-control" id="course" name="course_id">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="course" class="form-label text-dark">Chọn khóa học </label>
                        <select class="form-control" id="trainer" name="trainer_id">
                            @foreach($trainers as $trainer)
                                <option value="{{ $trainer->id }}">{{ $trainer->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('class.index') }}" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
