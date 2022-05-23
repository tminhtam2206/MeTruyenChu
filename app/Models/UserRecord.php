<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRecord extends Model
{
    use HasFactory;

    protected $table = 'user_record';

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
