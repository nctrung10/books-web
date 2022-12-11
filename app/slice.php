<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slice extends Model
{
    protected $table = 'slide';
    protected $fillable = ['id','tenSlice','moTa','hinh','viTri','trangThai','created_at','updated_at'];
}
