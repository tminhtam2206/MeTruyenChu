<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuSach extends Model
{
    use HasFactory;

    protected $table = 'tu_sach';

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function Truyen(){
        return $this->belongsTo('App\Models\Truyen', 'truyen_id', 'id');
    }
}
