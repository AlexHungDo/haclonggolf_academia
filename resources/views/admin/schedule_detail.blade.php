@extends('layouts.base_admin')

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="month">Tháng:</label>
                    <select id="month" class="form-control">
                        @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="year">Năm:</label>
                    <select id="year" class="form-control">
                        @foreach (range(date('Y'), date('Y') + 2) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div id="calendar"></div>
                <div>
                    <h1><span id="selected-date"></span></h1>
                </div>
    </div>

    <style>
        .calendar-day {
            width: 100%;
            padding: 10px;
            border: none;
            background: none;
        }
        .current-day {
            background-color: #ffc107;
        }
        .selected-day {
            background-color: #28a745;
            color: white;
        }
        #calendar {
            overflow-x: auto;
        }
        table {
            width: 100%;
            table-layout: fixed;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to render calendar and show schedule details for the current day
        function showCurrentDaySchedule() {
            const currentDate = new Date();
            const currentDay = currentDate.getDate();
            const currentMonth = currentDate.getMonth();
            const currentYear = currentDate.getFullYear();

            // Render calendar for the current month and year
            renderCalendar(currentMonth, currentYear);

            // Show schedule details for the current day
            showScheduleDetails(currentDay, currentMonth, currentYear);
        }

        // Function to show schedule details for a specific day
        function showScheduleDetails(day, month, year) {
            const selectedDateDiv = document.getElementById('selected-date');

            // AJAX request to fetch schedule details for the selected day
            $.ajax({
                url: '{{ route('selectedDate.route') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    day: day,
                    month: month + 1, // Month needs to be adjusted because JavaScript months are zero-indexed
                    year: year
                },
                success: function(response) {
                    // Clear previous schedule details
                    selectedDateDiv.innerHTML = '';

                    // Process response data and display schedule details
                    var scheduleDetails = {!! json_encode($schedule_details->map(function($detail) {
                return [
                    'day' => (new DateTime($detail->class_time))->format('d'),
                    'month' => (new DateTime($detail->class_time))->format('m'),
                    'year' => (new DateTime($detail->class_time))->format('Y'),
                    'time' => (new DateTime($detail->class_time))->format('H:i'),
                    'courseName' => $detail->schedule->course->course_name ?? '',
                    'classId' => $detail->schedule_id,
                    'numClass'=>$detail->session_number,
                    'studentName'=>$detail->schedule->student->full_name  ?? ''
                ];
            })) !!};

                    var matchedItems = scheduleDetails.filter(function(item) {
                        return item.day == day && item.month == month + 1 && item.year == year;
                    });

                    if (matchedItems.length === 0) {
                        selectedDateDiv.innerHTML = 'Không có lịch học';
                    } else {
                        matchedItems.forEach(function(item) {
                            var card = `
                        <div class="card mb-3 shadow-sm" style="background-color: #f8f9fa; color: #495057; font-size: 0.875rem;">
                            <div class="card-body" style="line-height: 1.5;">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5 class="card-title" style="color: #007bff; font-size: 1.25rem;">Mã lớp học: ${item.classId}</h5>
                                        <p class="card-text" style="color: #6c757d; margin-bottom: 0.25em;"><strong>Tên học viên: ${item.studentName}</strong></p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: #6c757d; font-size: 0.875rem;"><strong>Khóa học: ${item.courseName}</strong></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: #6c757d; font-size: 0.875rem;"><strong>Buổi số: ${item.numClass}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span style="color: #dc3545; font-size: 1.5rem;">${item.time}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                            selectedDateDiv.innerHTML += card;
                        });
                    }
                }
            });
        }

        // Function to render calendar
        function renderCalendar(month, year) {
            const currentDate = new Date();
            const currentDay = currentDate.getDate();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const firstDay = new Date(year, month, 1).getDay();
            let calendarHTML = '<table class="table table-bordered">';
            calendarHTML += '<thead><tr><th>Chủ nhật</th><th>Thứ hai</th><th>Thứ ba</th><th>Thứ tư</th><th>Thứ năm</th><th>Thứ sáu</th><th>Thứ bảy</th></tr></thead>';
            calendarHTML += '<tbody><tr>';

            for (let i = 0; i < firstDay; i++) {
                calendarHTML += '<td></td>';
            }

            for (let day = 1; day <= daysInMonth; day++) {
                if (day === currentDay && currentDate.getMonth() === month && currentDate.getFullYear() === year) {
                    calendarHTML += `<td><button class="btn btn-link calendar-day current-day" data-day="${day}">${day}</button></td>`;
                } else {
                    calendarHTML += `<td><button class="btn btn-link calendar-day" data-day="${day}">${day}</button></td>`;
                }
                if ((firstDay + day) % 7 === 0) {
                    calendarHTML += '</tr><tr>';
                }
            }

            calendarHTML += '</tr></tbody></table>';
            document.getElementById('calendar').innerHTML = calendarHTML;

            // Add click event listener to each day button
            const dayButtons = document.querySelectorAll('.calendar-day');
            dayButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove selected-day class from previously selected day
                    const selectedDayButton = document.querySelector('.calendar-day.selected-day');
                    if (selectedDayButton) {
                        selectedDayButton.classList.remove('selected-day');
                    }

                    // Add selected-day class to the clicked day
                    button.classList.add('selected-day');

                    // Get day from data-day attribute
                    const selectedDay = parseInt(button.getAttribute('data-day'));

                    // Show schedule details for the selected day
                    showScheduleDetails(selectedDay, month, year);
                });
            });
        }

        // Set up initial calendar and schedule details display when the page is loaded
        document.addEventListener('DOMContentLoaded', function() {
            showCurrentDaySchedule();
        });

    </script>
@endsection
