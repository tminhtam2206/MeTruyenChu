<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoaiTruyen extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'the_loai_truyen';
}
