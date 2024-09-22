@extends('layouts.base_trainer')

@section('main')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Chỉnh sửa thông tin học viên {{$student->full_name}}</h6>
                <a href="{{ route('students.index') }}" class="btn btn-light">Quay lại danh sách</a>
            </div>
            <div class="bg-dark text-white rounded p-4">
                <form id="editStudentForm" method="POST" action="{{route('students.update', $student->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editStudentId" name="student_id" value="{{$student->id}}">
                    <div class="mb-3">
                        <label for="editStudentName" class="form-label text-start d-block text-white">Họ và tên</label>
                        <input type="text" class="form-control bg-light text-dark" id="editStudentName" name="student_name" value="{{$student->full_name}}">
                    </div>
                    <div class="mb-3">
                        <label for="editHometown" class="form-label text-start d-block text-white">Quê quán</label>
                        <input type="text" class="form-control bg-light text-dark" id="editHometown" name="student_address" value="{{$student->address}}">
                    </div>
                    <div class="mb-3">
                        <label for="editPhoneNumber" class="form-label text-start d-block text-white">SĐT</label>
                        <input type="number" class="form-control bg-light text-dark" id="editPhoneNumber" name="phone_number" value="{{$student->phone_number}}">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
