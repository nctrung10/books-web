<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitietdonhang extends Model
{
    protected $table = 'chitietdonhang';
    protected $fillable = ['id','id_DH','id_Sach','soLuong','donGia'];
}
