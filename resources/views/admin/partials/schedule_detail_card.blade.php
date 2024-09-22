@php
    $datetime = new DateTime($schedule_detail->class_time);
    $time = $datetime->format('H:i');
    $date = $datetime->format('d/m/Y');
@endphp

<div class="card mb-3 shadow-sm" style="background-color: #1d1f21; color: #E7D1B5; font-size: 0.875rem;">
    <div class="card-body d-flex align-items-center justify-content-between" style="line-height: 1.2em;">
        <div>
            <h5 class="card-title" style="color: #FFD700; font-size: 1rem;">Mã lớp học: {{ $schedule_detail->schedule_id }}</h5>
            <p class="card-text" style="margin-bottom: 0.5em; color: #FFA07A;"><strong>Tên khóa học: {{ $schedule_detail->schedule->course->course_name }}</strong></p>
            <p class="card-text" style="margin-bottom: 0.5em; color: #20B2AA;"><strong>Buổi số: {{ $schedule_detail->session_number }}</strong></p>
            <p class="card-text" style="margin-bottom: 0.5em; color: #87CEEB;"><strong>Tên học viên: <span>{{ $schedule_detail->schedule->student->full_name }}</span></strong></p>
            <p class="card-text" style="margin-bottom: 0.5em;">
                Trạng thái buổi học:
                <strong>
                    <span style="color: #1d1f21; background-color: {{ $schedule_detail->status == 'Chưa hoàn thành' ? '#FFD700' : '#32CD32' }}; padding: 0.2em; border-radius: 0.2em;">
                        {{ $schedule_detail->status }}
                    </span>
                </strong>
            </p>
            <p class="card-text" style="margin-bottom: 0.5em; color: #20B2AA;"><strong>Ghi chú: {{ $schedule_detail->note }}</strong></p>
        </div>
        <div class="text-center">
            <span style="color: #FF4500; font-size: 1.25em;">{{ $time }}</span>
            <br>
            <span style="color: #FFD700; font-size: 1em;">{{ $date }}</span>
            <br>
            <div class="d-flex justify-content-center mt-2">
                <a href="#" class="btn btn-outline-info btn-sm me-2">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ route('schedule_details.edit', $schedule_detail) }}" class="btn btn-outline-warning btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
            </div>
        </div>
    </div>
</div>

