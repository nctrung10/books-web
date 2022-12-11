<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiamGiaSach extends Model
{
    protected $table = 'giamgia_sach';
    protected $fillable = ['id','id_GiamGia','id_Sach','giaTri','ngayBatDau','ngayKetThuc','created_at','updated_at'];
}
