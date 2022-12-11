<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class nhanvien extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'nhanvien';
    protected $fillable = ["id","maNV", "email", "password", "hoTenNV", "diaChiNV", "sdtNV", "luongNV", "hinhNV","created_at", "updated_at"];


}
