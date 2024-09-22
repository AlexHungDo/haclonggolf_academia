<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_Detail extends Model
{
    protected $fillable = [	'class_id','student_id'];
    protected $table = 'class_detail';

    use HasFactory;
}
