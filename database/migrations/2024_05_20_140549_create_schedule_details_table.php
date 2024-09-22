<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedule_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade'); // Khóa ngoại từ bảng Lịch Học với onDelete cascade
            $table->integer('session_number'); // Thêm thuộc tính buổi số
            $table->dateTime('class_time'); // Thời gian học (cho phép nhập ngày và giờ)
            $table->string('note')->nullable(); // Ghi chú (cho phép null)
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_details');
    }
};
