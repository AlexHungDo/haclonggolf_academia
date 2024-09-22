<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }
    protected $fillable = ['full_name', 'address','phone_number','height','date_of_birth','gmail','note'];

}
