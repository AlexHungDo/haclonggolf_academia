@extends('layouts.base_admin')
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
                <h6 class="mb-0 text-dark">Danh sách lớp học</h6>
                <div>
                    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">Đăng ký lớp học</a>
                    <a href="" class="btn btn-light ms-2">Hiển thị hết</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-light text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">Mã lớp học</th>
                        <th scope="col">Huấn luyện viên</th>
                        <th scope="col">Học viên</th>
                        <th scope="col">Khóa học</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Lựa chọn</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schedules as $schedule)
                        <tr class="text-dark">
                            <td>{{ $schedule->id }}</td>
                            <td>{{ $schedule->trainer->full_name ?? 'N/A' }}</td>
                            <td>{{ $schedule->student->full_name ?? 'N/A' }}</td>
                            <td>{{ $schedule->course->course_name ?? 'N/A' }}</td>
                            <td>{{ $schedule->start_date }}</td>
                            <td>
                                @if($schedule->status == 'chưa hoàn thành')
                                    <span class="badge bg-warning">{{ $schedule->status }}</span>
                                @else
                                    <span class="badge bg-success">{{ $schedule->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="#" class="btn btn-success" title="View"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning edit-trainer-btn" title="Edit"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$schedule->id}}"><i class="fa-solid fa-trash"></i></a>
                                    <a href="{{ route('schedule_details.show', $schedule->id) }}" class="btn btn-primary" title="Danh sách buổi học"><i class="fa-solid fa-list"></i></a>
                                </div>
                                <div class="modal fade" id="exampleModal{{$schedule->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận xóa</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa lớp có id {{$schedule->id}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Hủy
                                                </button>
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
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="addScheduleModalLabel">Thêm lịch học mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('schedules.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="courseName" class="text-dark">Tên khóa học</label>
                            <select class="form-control" id="courseName" name="course_id">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="studentName" class="text-dark">Tên học viên</label>
                            <select class="form-control" id="studentName" name="student_id">
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="trainerName" class="text-dark">Tên huấn luyện viên</label>
                            <select class="form-control" id="trainerName" name="trainer_id">
                                @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}">{{ $trainer->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="startDate" class="text-dark">Ngày giờ bắt đầu</label>
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
