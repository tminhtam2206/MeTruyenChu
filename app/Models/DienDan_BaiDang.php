<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DienDan_BaiDang extends Model
{
    use HasFactory;

    protected $table = 'diendan_baidang';

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
