<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    use HasFactory;

    protected $table = 'tbl_landing';

    protected $fillable = [
        'description',
        'full_image',
        'description_image',
        'room_image',
    ];
}
