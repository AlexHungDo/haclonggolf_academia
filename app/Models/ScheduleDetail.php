<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    protected $casts = [
        'class_time' => 'datetime',
    ];
    protected $fillable = ['schedule_id','session_number','class_time', 'note','status'];
    use HasFactory;
}
