@extends('layouts.base_trainer')

@section('main')
    <!-- Nút thời khóa biểu -->
    <div class="text-center mt-4 mb-2">
        <a href="#" class="btn btn-primary">Thời khóa biểu</a>
    </div>

    <!-- Form thời khóa biểu -->
    <div class="container-fluid pt-4 px-4">
        <!-- Thẻ div cho việc hiển thị tuần hiện tại -->
        <div>
            <!-- Chọn tuần -->
            <div class="mb-3">
                <label for="week">Chọn tuần:</label>
                <input type="date" id="week" name="week" class="form-control" required>
            </div>
            <!-- Nút tìm kiếm -->

        </div>
    </div>
    <!-- Script JavaScript -->
    <script>
        // Hàm để xem thời khóa biểu
        function viewTimetable() {
            // Lấy giá trị tuần từ input
            var selectedWeek = document.getElementById('week').value;
            // Đoạn logic xử lý khi nhấn nút "Xem thời khóa biểu"
            // ...
        }

        // Lấy ngày đầu tiên của tuần hiện tại
        var today = new Date();
        var firstDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
        var lastDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 6));

        // Định dạng ngày theo yyyy-MM-dd để sử dụng cho input type="date"
        var formattedFirstDay = firstDayOfWeek.toISOString().slice(0, 10);
        var formattedLastDay = lastDayOfWeek.toISOString().slice(0, 10);

        // Đặt giá trị cho trường input type="date"
        document.getElementById('week').value = formattedFirstDay;

        // Đặt giá trị tối đa cho trường input type="date"
        document.getElementById('week').max = formattedLastDay;
    </script>

@endsection
