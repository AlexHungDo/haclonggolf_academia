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
                <h6 class="mb-0 text-dark">Danh sách khóa học</h6>
                <div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                        Thêm khóa học mới
                    </button>
                    <a href="" class="text-dark">Hiển thị hết</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-light text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">Mã khóa</th>
                        <th scope="col">Tên khóa học</th>
                        <th scope="col">Số buổi</th>
                        <th scope="col">Giá tiền</th>
                        <th scope="col">Lựa chọn</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr class="text-dark">
                            <td>{{$course->id}}</td>
                            <td>{{$course->course_name}}</td>
                            <td>{{$course->number_of_sessions}}</td>
                            <td>{{$course->fee}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="#" class="btn btn-success" title="View"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('courses.edit', $course)}}" class="btn btn-warning edit-trainer-btn" title="Edit"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$course->id}}"><i class="fa-solid fa-trash"></i></a>
                                </div>
                                <div class="modal fade" id="exampleModal{{$course->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận xóa</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa khóa học {{$course->course_name}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Hủy
                                                </button>
                                                <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
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
                    <!-- Các dòng khóa học khác -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="addStudentModalLabel">Thêm học viên mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCourseForm" method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="courseName" class="form-label text-dark">Tên khóa học</label>
                            <input type="text" class="form-control" id="studentName" name="course_name" value="">
                        </div>
                        <div class="mb-3">
                            <label for="hometown" class="form-label text-dark">Số buổi</label>
                            <input type="number" class="form-control" id="hometown" name="number_of_sessions" required>
                        </div>
                        <div class="mb-3">
                            <label for="fee" class="form-label text-dark">Giá tiền</label>
                            <input type="number" class="form-control" id="phone_number" name="fee" required>
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
