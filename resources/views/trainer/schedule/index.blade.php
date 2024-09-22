@extends('layouts.base_trainer')
<script type="text/javascript">
    function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null;};
</script>
@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0 text-dark">Danh sách lịch học của tôi</h6>
                <div>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModalClass">Đăng ký lịch học cho lớp </a>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModalStudent">Đăng ký lịch học cho học viên</a>
                    <a href="#" class="btn btn-light ms-2">Hiển thị hết</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-light text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">Mã lịch học</th>
                        <th scope="col">Học viên</th>
                        <th scope="col">Khóa học</th>
                        <th scope="col">Lớp học</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">Lựa chọn</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schedules as $schedule)
                        <tr class="text-dark">
                            <td>{{ $schedule->id }}</td>
                            <td>{{ $schedule->student->full_name ?? 'N/A' }}</td>
                            <td>{{ $schedule->course->course_name ?? 'N/A' }}</td>
                            <td>{{ $schedule->allClass2->class_name ?? 'N/A' }}</td>
                            <td>{{ $schedule->start_date }}</td>
                            <td>123</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="#" class="btn btn-success" title="View"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning edit-trainer-btn" title="Edit"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$schedule->id}}"><i class="fa-solid fa-trash"></i></a>
                                    <a href="{{ route('schedule_details.show', $schedule->id) }}" class="btn btn-primary" title="Danh sách buổi học"><i class="fa-solid fa-list"></i></a>
                                </div>
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="exampleModal{{$schedule->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$schedule->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" id="exampleModalLabel{{$schedule->id}}">Xác nhận xóa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-dark">
                                                Bạn có chắc chắn muốn xóa lớp có id {{$schedule->id}}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <form action="{{ route('schedules.destroy', ['schedule' => $schedule->id]) }}" method="POST">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Schedule Modal -->
    <div class="modal fade" id="addScheduleModalClass" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="addScheduleModalLabel">Thêm lịch học mới (cho lớp)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('schedules.storeForTrainer') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control bg-white text-dark" name="student_id" value="">
                        <div class="form-group mb-3">
                            <label for="courseName" class="form-label text-dark">Tên khóa học</label>
                            <select class="form-control" id="courseName" name="course_id">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="studentName" class="form-label text-dark">Tên lớp</label>
                            <select class="form-control" id="studentName" name="class_id">
                                @foreach($allClass as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="startDate" class="form-label text-dark">Ngày giờ bắt đầu</label>
                            <input type="datetime-local" class="form-control bg-white text-dark" id="startDate" name="start_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
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
    <div class="modal fade" id="addScheduleModalStudent" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="addScheduleModalLabel">Thêm lịch học mới(cho học viên)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('schedules.storeForTrainer') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control bg-white text-dark" name="class_id" value="">
                        <div class="form-group mb-3">
                            <label for="courseName" class="form-label text-dark">Tên khóa học</label>
                            <select class="form-control" id="courseName" name="course_id">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="studentName" class="form-label text-dark">Tên học viên</label>
                            <select class="form-control" id="studentName" name="student_id">
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="startDate" class="form-label text-dark">Ngày giờ bắt đầu</label>
                            <input type="datetime-local" class="form-control bg-white text-dark" id="startDate" name="start_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
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
