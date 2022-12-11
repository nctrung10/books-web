<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class donhang extends Model
{
    protected $table = 'donhang';
    protected $fillable = ['id','id_NV','id_KH','id_HTTT','hoTenKH','diaChiKH','sdtKH','giamGia','tongTien','ngayDH','trangThai'];
}
