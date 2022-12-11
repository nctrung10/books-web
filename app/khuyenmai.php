<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khuyenmai extends Model
{
    protected $table = 'khuyenmai';
    protected $fillable = ['id','id_Sach','code','tenKM','moTaKM','hinhThuc','giaTri','soLuong','ngayBatDau','ngayKetThuc'];
}
