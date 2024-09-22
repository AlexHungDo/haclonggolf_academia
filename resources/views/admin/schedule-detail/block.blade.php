@extends('layouts.base_admin')

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid pt-4 px-4">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <!-- Thẻ div tiêu đề -->
                <div class="mb-4">
                    <h3 class="text-center" style="color: #343a40;">Danh sách buổi học của lớp học</h3>
                </div>
                @foreach($schedule_details as $schedule_detail)
                    @php
                        $datetime = new DateTime($schedule_detail->class_time);
                        $time = $datetime->format('H:i');
                        $date = $datetime->format('d/m/Y');
                    @endphp
                    <div class="card mb-3 shadow-sm" style="background-color: #f8f9fa; color: #495057;">
                        <div class="card-body d-flex align-items-center justify-content-between" style="line-height: 1.5;">
                            <div>
                                <h5 class="card-title" style="color: #007bff;">Mã lớp học: {{$schedule_detail->schedule_id}}</h5>
                                <p class="card-text" style="margin-bottom: 0.5em; color: #6c757d;"><strong>Tên khóa học: {{$schedule_detail->schedule->course->course_name}}</strong></p>
                                <p class="card-text" style="margin-bottom: 0.5em; color: #6c757d;"><strong>Buổi số: {{$schedule_detail->session_number}}</strong></p>
                                <p class="card-text" style="margin-bottom: 0.5em; color: #6c757d;"><strong>Tên học viên: <span>{{$schedule_detail->schedule->student->full_name}}</span></strong></p>
                                <p class="card-text" style="margin-bottom: 0.5em;">
                                    Trạng thái buổi học:
                                    <strong>
                                    <span style="color: #495057; background-color: {{$schedule_detail->status == 'Chưa hoàn thành' ? '#ffc107' : '#28a745'}}; padding: 0.2em; border-radius: 0.2em;">
                                        {{$schedule_detail->status}}
                                    </span>
                                    </strong>
                                </p>
                            </div>
                            <div class="text-center">
                                <span style="color: #dc3545; font-size: 1.5em;">{{$time}}</span>
                                <br>
                                <span style="color: #007bff; font-size: 1em;">{{$date}}</span>
                                <br>
                                <div class="d-flex justify-content-center mt-2">
                                    <a href="#" class="btn btn-outline-info btn-sm me-2">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
