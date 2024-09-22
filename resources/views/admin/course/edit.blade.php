@extends('layouts.base_admin')

@section('main')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Chỉnh sửa khóa học {{$course->course_name}}</h6>
                <a href="{{ route('courses.index') }}" class="btn btn-light">Quay lại danh sách</a>
            </div>
            <div class="bg-dark text-white rounded p-4">
                <form id="editCourseForm" method="POST" action="{{route('courses.update', $course->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editCourseId" name="course_id" value="{{$course->id}}">
                    <div class="mb-3">
                        <label for="editCourseName" class="form-label text-start">Tên khóa học</label>
                        <input type="text" class="form-control bg-light text-dark" id="editCourseName" name="course_name" value="{{$course->course_name}}">
                    </div>
                    <div class="mb-3">
                        <label for="editNumberOfSessions" class="form-label text-start">Số buổi</label>
                        <input type="number" class="form-control bg-light text-dark" id="editNumberOfSessions" name="number_of_sessions" value="{{$course->number_of_sessions}}">
                    </div>
                    <div class="mb-3">
                        <label for="editFee" class="form-label text-start">Giá tiền</label>
                        <input type="number" class="form-control bg-light text-dark" id="editFee" name="fee" value="{{$course->fee}}">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
