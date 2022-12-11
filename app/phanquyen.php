<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phanquyen extends Model
{
    protected $table = 'phanquyen';
    protected $fillable = ['id','id_NV','id_VaiTro'];
}
