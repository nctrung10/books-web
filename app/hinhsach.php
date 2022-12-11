<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hinhsach extends Model
{
    protected $table = 'hinhsach';
    protected $fillable = ['id','id_Sach','hinh'];
}
