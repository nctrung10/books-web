<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class danhgia extends Model
{
    protected $table = 'danhgia';
    protected $fillable = ['id','id_KH','id_Sach','soSao','binhLuan','created_at','updated_at'];
}
