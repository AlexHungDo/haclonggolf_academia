@extends('layouts.base_admin')

@section('main')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Chỉnh sửa thông tin huấn luyện viên {{$trainer->full_name}}</h6>
                <a href="{{ route('trainers.index') }}" class="btn btn-light">Quay lại danh sách</a>
            </div>
            <div class="bg-dark text-white rounded p-4">
                <form id="editTrainerForm" method="POST" action="{{route('trainers.update', $trainer->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="editTrainerName" class="form-label text-start">Họ và tên</label>
                        <input type="text" class="form-control bg-light text-dark" id="editTrainerName" placeholder="Họ và tên" name="full_name" value="{{$trainer->full_name}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="editBirthYear" class="form-label text-start">Năm sinh</label>
                        <input type="number" class="form-control bg-light text-dark" id="editBirthYear" placeholder="Năm sinh" name="address" value="{{$trainer->address}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="editHometown" class="form-label text-start">Quê quán</label>
                        <input type="text" class="form-control bg-light text-dark" id="editHometown" placeholder="Quê quán" name="phone_number" value="{{$trainer->phone_number}}">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('trainers.index') }}" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
