<?php

namespace App\Http\Controllers;

use App\danhgia;
use App\danhmucsanpham;
use App\hinhsach;
use App\Http\Requests\RuleDanhGia;
use App\sach;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class DetailController extends Controller
{
    public function getPageChiTietSanPham($id)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();
        $sach = DB::table('sach')
            ->join('loaisach', 'sach.id_Loai', '=', 'loaisach.id')
            ->join('nhaxuatban', 'sach.id_NXB', '=', 'nhaxuatban.id')
            ->join('ngonngu', 'sach.id_NN', '=', 'ngonngu.id')
            ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
            ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
            ->select('loaisach.tenLoai', 'nhaxuatban.tenNXB', 'ngonngu.tenNN', 'danhmucsanpham.tenDM', 'sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
            ->where('sach.id', '=', $id)->get();

        $danhgias = DB::table('danhgia')
            ->join('khachhang', 'danhgia.id_KH', '=', 'khachhang.id')
            ->join('sach', 'danhgia.id_Sach', '=', 'sach.id')
            ->select('danhgia.*', 'khachhang.hoTenKH')
            ->where('sach.id', '=', $id)->paginate(2);
        $hinhsachs = hinhsach::where('id_Sach', '=', $id)->paginate(5);
        $sumcmt = danhgia::where('id_Sach', $id)->count();
        $sumstart = danhgia::where('id_Sach', $id)->sum('soSao');
        if ($sumcmt == 0 && $sumstart == 0) {
            $average = 'Chưa có đánh giá';
        } else {
            $average = $sumstart / $sumcmt;
        }
        return view('khachhang.chitietsanpham', [
            'user' => $user,
            'danhmucs' => $danhmucs,
            'sach' => $sach,
            'hinhsachs' => $hinhsachs,
            'danhgias' => $danhgias,
            'sumcmt' => $sumcmt,
            'now' => $now,
            'average' => $average
        ]);
    }

    public function danhGia(RuleDanhGia $request)
    {

        if (Auth::guard('khachhang')->check()) {


            $user = Auth::guard('khachhang')->user();

            $danhgia = new danhgia;

            $danhgia->id_KH = $user->id;
            $danhgia->id_Sach = $request->id_Sach;
            $danhgia->soSao = $request->rate;
            $danhgia->binhLuan = $request->binhLuan;
            $danhgia->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $insertData = $danhgia->save();
            if ($insertData) {
                alert('Thêm đánh giá thành công', 'Cảm ơn bạn đã góp ý!', 'success');
            } else {
                alert('Thêm đánh giá thất bại', ' Vui lòng thử lại sau!', 'error');
            }

            return redirect()->back();
        } else {
            alert('', 'Vui lòng đăng nhập trước khi đánh giá!', 'warning');
            return redirect()->back();
        }
    }
}
