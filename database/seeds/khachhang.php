<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class khachhang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('khachhang')->insert([ 
            'maKH' => "12345",
            'email' => "thai@gmail.com",
            'password' => bcrypt('12345678'),
            'hoTenKH' => "Trần Quốc Thái",
            'gioiTinhKH' => "Nam",
            'ngaySinh' => "1111111",
            'diaChiKH' => "Ô Môn, Cần Thơ",
            'sdtKH' => "0901036146",
        ]);
    }
}
