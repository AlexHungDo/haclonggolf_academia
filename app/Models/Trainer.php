<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'full_name',
        // Các thuộc tính khác bạn muốn cho phép mass assignment
       'address',
        'phone_number',
        'user_id'
    ];
    use HasFactory;
}
