<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitietphieunhap extends Model
{
    protected $table = 'chitietphieunhap';
    protected $fillable = ['id','id_PhieuNhap','id_Sach','soLuong','donGia','created_at','updated_at'];
}
