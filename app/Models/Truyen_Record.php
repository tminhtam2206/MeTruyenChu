<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen_Record extends Model
{
    use HasFactory;

    protected $table = 'truyen_record';

    public function Truyen(){
        return $this->belongsTo('App\Models\Truyen', 'truyen_id', 'id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
