<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhaxuatban extends Model
{
    protected $table = 'nhaxuatban';
    protected $fillable = ['id','maNXB','tenNXB','emailNXB','diaChiNXB','created_at','updated_at'];
}
