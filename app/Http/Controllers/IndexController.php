<?php

namespace App\Http\Controllers;

use App\chitietdonhang;
use App\danhmucsanpham;
use App\sach;
use App\slice;
use App\danhgia;
use App\GiamGia;
use App\GiamGiaSach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{
    public function getIndex(Request $request)
    {

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();
        $danhmuccontents = danhmucsanpham::where('trangThai', '1')->where('parent_id', '=', 0)->get();
        $danhmuccons = danhmucsanpham::where('parent_id','!=',0)->get();
        $vanhocs = DB::table('sach')
            ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
            ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
            ->select('danhmucsanpham.*', 'sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
            ->orderby('sach.id', 'ASC')->paginate(20);
        $giamgias = GiamGiaSach::get();
       
      
         
        $sachmois = DB::table('sach')
            ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
            ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
            ->select('danhmucsanpham.*', 'sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
            ->orderby('sach.created_at', 'DESC')->skip(0)->take(10)->paginate(10);
        $banchays = DB::table('chitietdonhang')
            ->join('sach', 'chitietdonhang.id_Sach', '=', 'sach.id')
            ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
            ->select('sach.*', 'chitietdonhang.id_Sach', DB::raw('SUM(chitietdonhang.soLuong) AS soLuongTong'),'giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
            ->groupBy(DB::raw("chitietdonhang.id_Sach"))
            ->orderBy('soLuongTong', 'DESC')
            ->skip(0)->take(10)->paginate(10);


        $slices = slice::get()->where('trangThai', '1');

        return view('khachhang.trangchu', [
            'user' => $user,
            'danhmucs' => $danhmucs,
            'danhmuccontents' => $danhmuccontents,
            'danhmuccons' => $danhmuccons,
            'vanhocs' => $vanhocs,
            'sachmois' => $sachmois,
            'banchays' => $banchays,
            'giamgias' => $giamgias,
            'now' => $now,
            'slices' => $slices,
        ]);
    }
}
