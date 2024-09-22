@extends('layouts.base_trainer')
@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0 text-dark">Danh sách lớp học </h6>
                <div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">
                        Thêm lớp học mới
                    </button>
                    <a href="#">Hiển thị hết</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-light text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">Mã lớp </th>
                        <th scope="col">Tên lớp</th>
                        <th scope="col">Khóa học</th>
                        <th scope="col">Huấn luyện viên</th>
                        <th scope="col">Lựa chọn</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allClass as $class)
                        <tr class="text-dark">
                            <td>{{$class->id}}</td>
                            <td>{{$class->class_name}}</td>
                            <td>{{$class->course->course_name}}</td>
                            <td>{{$class->trainer->full_name}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="#" class="btn btn-success" title="View"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('class.edit', $class) }}" class="btn btn-warning edit-course-btn" title="Edit"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$class->id}}"><i class="fa-solid fa-trash"></i></a>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentClass" data-class-id="{{ $class->id }}">
                                        Thêm học viên
                                    </button>
                                </div>
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{$class->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$class->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{$class->id}}">Xác nhận xóa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa lớp học {{$class->class_name}}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <form action="{{ route('class.destroy', $class->id) }}" method="POST">
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
    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="addCourseModalLabel">Thêm khóa học mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCourseForm" method="POST" action="{{ route('class.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="className" class="form-label text-dark">Tên lớp học</label>
                            <input type="text" class="form-control" id="className" name="class_name" required>
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
                            <label for="trainer" class="form-label text-dark">Chọn HLV</label>
                            <select class="form-control" id="trainer" name="trainer_id">
                                @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}">{{ $trainer->full_name }}</option>
                                @endforeach
                            </select>
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
    <div class="modal fade" id="addStudentClass" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="addCourseModalLabel">Thêm học viên mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm" method="POST" action="{{ route('class.addStudent') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="class_id" id="modalClassId" value="">
                        <div class="mb-3">
                            <label for="student_ids" class="form-label text-dark">Chọn học viên </label>
                            <select  class="form-control" id="student_ids" name="student_ids">
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->full_name}}</option>
                                @endforeach
                            </select>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var addStudentModal = document.getElementById('addStudentClass');
            addStudentModal.addEventListener('show.bs.modal', function (event) {
                // Lấy nút mà kích hoạt modal
                var button = event.relatedTarget;

                // Lấy giá trị class_id từ thuộc tính data-class-id của nút
                var classId = button.getAttribute('data-class-id');

                // Lấy input ẩn trong modal và cập nhật giá trị của nó
                var modalClassIdInput = document.getElementById('modalClassId');
                modalClassIdInput.value = classId;
            });
        });
    </script>
@endsection
