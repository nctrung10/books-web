<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class danhmucsanpham extends Model
{
    protected $table = 'danhmucsanpham';
    protected $fillable = ['id','tenDM','moTa','trangThai','created_at','updated_at'];
    
}
