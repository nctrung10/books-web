<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieunhap extends Model
{
    protected $table = 'phieunhap';
    protected $fillable = ['id','id_NV','chuDe','moTa','created_at','updated_at'];

}
