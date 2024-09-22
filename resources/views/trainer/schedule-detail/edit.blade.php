@extends('layouts.base_trainer')

@section('main')
    <div class="container-fluid pt-4 px-4">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card mb-3 shadow-sm" style="background-color: #1d1f21; color: #E7D1B5;">
                    <div class="card-body">
                        <h3 class="card-title text-center" style="color: #FFD700;">Chỉnh sửa buổi học</h3>
                        <form action="{{ route('schedule_details.update', $schedule_detail->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="class_time" class="text-white">Thời gian học</label>
                                <div class="input-group">
                                    <input type="datetime-local" class="form-control bg-white text-dark" id="class_time" name="class_time" value="{{ \Carbon\Carbon::parse($schedule_detail->class_time)->format('Y-m-d\TH:i') }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Chưa hoàn thành" {{ $schedule_detail->status == 'Chưa hoàn thành' ? 'selected' : '' }}>Chưa hoàn thành</option>
                                    <option value="Đã hoàn thành" {{ $schedule_detail->status == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="note" name="note" rows="3">{{ $schedule_detail->note }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('schedule_details.index') }}" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
