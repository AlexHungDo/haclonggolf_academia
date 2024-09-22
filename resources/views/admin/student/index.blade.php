@extends('layouts.base_admin')
@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0 text-dark">Danh sách học viên</h6>
                <div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        Thêm học viên mới
                    </button>
                    <a href="">Hiển thị hết</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-light text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">Mã HV</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Quê quán</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Chiều cao</th>
                        <th scope="col">Năm sinh</th>
                        <th scope="col">Gmail</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">HLV</th>
                        <th scope="col">Lựa chọn</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr class="text-dark">
                            <td>{{$student->id}}</td>
                            <td>{{$student->full_name}}</td>
                            <td>{{$student->address}}</td>
                            <td>{{$student->phone_number}}</td>
                            <td>{{$student->height}}</td>
                            <td>{{$student->date_of_birth}}</td>
                            <td>{{$student->gmail}}</td>
                            <td>{{$student->note}}</td>
                            @if($student->trainer)
                                <td>{{$student->trainer->full_name}}</td>
                            @else
                                <td>Chưa có huấn luyện viên phụ trách</td>
                            @endif
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="#" class="btn btn-success" title="View"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('students.edit', $student)}}" class="btn btn-warning edit-trainer-btn" title="Edit"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$student->id}}"><i class="fa-solid fa-trash"></i></a>
                                </div>
                                <div class="modal fade" id="exampleModal{{$student->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận xóa</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa học viên {{$student->full_name}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Hủy
                                                </button>
                                                <form action="{{ route('students.destroy', ['student' => $student->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <!-- Các dòng học viên khác -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="addStudentModalLabel">Thêm học viên mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm" method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="studentName" class="form-label text-dark">Họ và tên</label>
                            <input type="text" class="form-control" id="studentName" name="student_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="hometown" class="form-label text-dark">Quê quán</label>
                            <input type="text" class="form-control" id="hometown" name="student_address" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label text-dark">SĐT</label>
                            <input type="number" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label text-dark">Chiều cao</label>
                            <input type="number" class="form-control" id="height" name="height" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_year" class="form-label text-dark">Năm sinh</label>
                            <input type="number" class="form-control" id="date_year" name="date_year" required>
                        </div>
                        <div class="mb-3">
                            <label for="gmail" class="form-label text-dark">Gmail</label>
                            <input type="text" class="form-control" id="gmail" name="gmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label text-dark">Ghi chú</label>
                            <input type="text" class="form-control" id="note" name="note" required>
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
@endsection
