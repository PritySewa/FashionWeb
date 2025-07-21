<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'phone_no',
        'address',
        'email'

    ];
    use HasFactory;
}
