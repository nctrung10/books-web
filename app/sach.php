<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sach extends Model
{
    protected $table = 'sach';
    protected $fillable = ["id", "maSach","id_DM", "id_Loai", "id_NN", "id_NXB", "id_KM", "tenSach", "tacGia", "soLuong", "giaBia", "giaBan", "kichThuoc", "soTrang", "ngaySanXuat", "hinh", "moTa",  "created_at", "updated_at"];

}
