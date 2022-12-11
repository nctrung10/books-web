<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\danhmucsanpham;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\sach;
use Illuminate\Support\Carbon;

class TimKiemController extends Controller
{
    public function getPageTimKiem(Request $request)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $keyword = $request->timkiem;
        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();
        $sachs = DB::table('sach')
            ->join('loaisach', 'sach.id_Loai', '=', 'loaisach.id')
            ->join('nhaxuatban', 'sach.id_NXB', '=', 'nhaxuatban.id')
            ->join('ngonngu', 'sach.id_NN', '=', 'ngonngu.id')
            ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
            ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
            ->select('loaisach.tenLoai', 'nhaxuatban.tenNXB', 'ngonngu.tenNN', 'danhmucsanpham.id', 'danhmucsanpham.tenDM', 'sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
            ->where('tenSach', 'LIKE', '%' . $keyword . '%')
            ->orderby('sach.id', 'ASC')->get();

        return view('khachhang.timkiem', [
            'user' => $user,
            'danhmucs' => $danhmucs,
            'sachs' => $sachs,
            'now' => $now,
        ]);
    }

    public function autocomplete(Request $request)
    {
        $sachs = sach::select('tenSach')
            ->where('tenSach', 'LIKE', "%{$request->terms}%")
            ->get();
        $data = array();
        foreach ($sachs as $sach) {
            $data[] = $sach->tenSach;
        }
        return response()->json($data);
    }
}
