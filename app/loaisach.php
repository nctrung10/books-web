<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loaisach extends Model
{
    protected $table = 'loaisach';
    protected $fillable = ["id","maLoai","tenLoai","created_at", "updated_at"];
}
