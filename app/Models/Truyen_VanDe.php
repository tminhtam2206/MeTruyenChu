<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen_VanDe extends Model
{
    use HasFactory;

    protected $table = 'truyen_van_de';

    public function Truyen(){
        return $this->belongsTo('App\Models\Truyen', 'truyen_id', 'id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
