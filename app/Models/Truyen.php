<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;

    protected $table = 'truyen';

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function Truyen_Record(){
        return $this->hasMany('App\Models\Truyen_Record', 'truyen_id', 'id');
    }

    public function Truyen_VanDe(){
        return $this->hasMany('App\Models\Truyen_VanDe', 'truyen_id', 'id');
    }

    public function TruyenBinhLuan(){
        return $this->hasMany('App\Models\TruyenBinhLuan', 'truyen_id', 'id');
    }

    public function TuSach(){
        return $this->hasMany('App\Models\TuSach', 'truyen_id', 'id');
    }
}
