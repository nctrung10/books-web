<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiamGia extends Model
{
    protected $table = 'giamgia';
    protected $fillable = ['id','tenGiamGia','giaTri','id_DM_GG','trangThai','ngayBatDau','ngayKetThuc','created_at','updated_at'];
}
