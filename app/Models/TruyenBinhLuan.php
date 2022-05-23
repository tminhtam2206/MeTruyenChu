<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruyenBinhLuan extends Model
{
    use HasFactory;

    protected $table = 'truyen_binh_luan';

    public function Truyen(){
        return $this->belongsTo('App\Models\Truyen', 'truyen_id', 'id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
