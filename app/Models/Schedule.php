<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function allClass2()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    protected $fillable = ['trainer_id', 'student_id','course_id', 'notes'];
    use HasFactory;
}
