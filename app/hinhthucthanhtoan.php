<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hinhthucthanhtoan extends Model
{
    protected $table = 'hinhthucthanhtoan';
    protected $fillable = ['id','tenHTTT','moTa'];
}
