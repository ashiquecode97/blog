<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'aadhaar',
        'phone',
        'class',
        'image',
    ];
}
