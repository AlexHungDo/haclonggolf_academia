<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    protected $fillable = ['course_id','class_name','trainer_id'];
    protected $table = 'class';
    use HasFactory;
}
