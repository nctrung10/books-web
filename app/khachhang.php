<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class khachhang extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'khachhang';
    protected $fillable = ['id','email','password','hoTenKH','gioiTinhKH','ngaySinhKH','diaChiKH','sdtKH','created_at','updated_at'];

}
