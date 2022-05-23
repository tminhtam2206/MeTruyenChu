<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'display_name',
        'email',
        'password',
        'exp',
        'exp_level',
        'coin',
        'lock',
        'role',
        'avatar',
        'avatar_cover',
        'truyen_da_dang',
        'tu_truyen',
        'binh_luan',
        'status',
        'change_avatar',
        'date_change_avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Truyen(){
        return $this->hasMany('App\Models\Truyen', 'user_id', 'id');
    }

    public function UserRecord(){
        return $this->hasMany('App\Models\UserRecord', 'user_id', 'id');
    }

    public function Chuong(){
        return $this->hasMany('App\Models\Chuong', 'user_id', 'id');
    }

    public function NhanVat(){
        return $this->hasMany('App\Models\NhanVat', 'user_id', 'id');
    }

    public function Truyen_Record(){
        return $this->hasMany('App\Models\Truyen_Record', 'user_id', 'id');
    }

    public function Truyen_VanDe(){
        return $this->hasMany('App\Models\Truyen_VanDe', 'user_id', 'id');
    }

    public function TruyenBinhLuan(){
        return $this->hasMany('App\Models\TruyenBinhLuan', 'user_id', 'id');
    }

    public function TuSach(){
        return $this->hasMany('App\Models\TuSach', 'user_id', 'id');
    }

    public function TruyenDanhGia(){
        return $this->hasMany('App\Models\TruyenDanhGia', 'user_id', 'id');
    }

    public function ThongBao(){
        return $this->hasMany('App\Models\ThongBao', 'user_id', 'id');
    }

    public function DienDan_BaiDang(){
        return $this->hasMany('App\Models\DienDan_BaiDang', 'user_id', 'id');
    }
}
