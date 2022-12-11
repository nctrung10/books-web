<?php

use App\khachhang;
use App\nhanvien;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(sach::class);
        $this->call(khachhang::class);
    }
}
