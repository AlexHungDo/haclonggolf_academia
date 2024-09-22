@extends('layouts.base_admin')

@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid pt-4 px-4">
        <div class="mt-3 text-center">
            <a href="{{ route('trainers.index') }}" class="btn btn-primary">Hiển thị danh sách tài khoản HLV</a>
            <p>Tạo tài khoản huấn luyện viên <a href="{{ route('registerTrainer') }}" class="text-decoration-none text-success">Đăng ký ngay</a></p>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0 text-dark">Danh sách huấn luyện viên</h6>
                <div>
                    <a href="">Hiển thị hết</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-light text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">Mã HLV</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Năm sinh</th>
                        <th scope="col">Quê quán</th>
                        <th scope="col">Lựa chọn</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trainers as $trainer)
                        <tr class="text-dark">
                            <td>{{$trainer->id}}</td>
                            <td>{{$trainer->full_name}}</td>
                            <td>{{$trainer->birth_year}}</td>
                            <td>{{$trainer->address}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="#" class="btn btn-success" title="View"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('trainers.edit', $trainer)}}" class="btn btn-warning edit-trainer-btn" title="Edit"><i class="fa-solid fa-user-pen"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Trainer Modal -->
    <div class="modal fade" id="addTrainerModal" tabindex="-1" aria-labelledby="addTrainerModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="addTrainerModalLabel">Thêm Huấn luyện viên mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTrainerForm" method="POST" action="{{ route('trainers.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="trainerName" class="form-label text-dark">Họ và tên</label>
                            <input type="text" class="form-control" id="trainerName" name="full_name" placeholder="Họ và tên" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="birthYear" class="form-label text-dark">Năm sinh</label>
                            <input type="number" class="form-control" id="birthYear" name="birth_year" placeholder="Năm sinh" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="hometown" class="form-label text-dark">Quê quán</label>
                            <input type="text" class="form-control" id="hometown" name="address" placeholder="Quê quán" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Trainer Modal -->
{{--    <div class="modal fade" id="editTrainerModal" tabindex="-1" aria-labelledby="editTrainerModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title text-dark" id="editTrainerModalLabel">Sửa Huấn luyện viên</h5>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form id="editTrainerForm" method="POST" action="{{route('trainers.update', $trainer->id)}}" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        @method('PUT')--}}
{{--                        <div class="form-group mb-3">--}}
{{--                            <label for="editTrainerName" class="form-label text-dark">Họ và tên</label>--}}
{{--                            <input type="text" class="form-control" id="editTrainerName" name="full_name" placeholder="Họ và tên" value="{{$trainer->full_name}}" required>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-3">--}}
{{--                            <label for="editBirthYear" class="form-label text-dark">Năm sinh</label>--}}
{{--                            <input type="number" class="form-control" id="editBirthYear" name="birth_year" placeholder="Năm sinh" value="{{$trainer->birth_year}}" required>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-3">--}}
{{--                            <label for="editHometown" class="form-label text-dark">Quê quán</label>--}}
{{--                            <input type="text" class="form-control" id="editHometown" name="address" placeholder="Quê quán" value="{{$trainer->address}}" required>--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>--}}
{{--                            <button type="submit" class="btn btn-primary">Lưu</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
