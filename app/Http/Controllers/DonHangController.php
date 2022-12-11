<?php

namespace App\Http\Controllers;

use App\chitietdonhang;
use App\donhang;
use App\sach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DonHangController extends Controller
{
    public function getPageDonHang()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $donhangs = donhang::orderby('ngayDH', 'DESC')->get();
        return view(
            'admin.donhang',
            [
                'user' => $adminUser,
                'donhangs' => $donhangs
            ]
        );
    }
    public function getPageDonHangCho()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $donhangs = donhang::where('trangThai','=','Đang chờ xử lý')->get();
        return view(
            'admin.donhang',
            [
                'user' => $adminUser,
                'donhangs' => $donhangs
            ]
        );
    }
    public function getPageDonHangThanhCong()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $donhangs = donhang::where('trangThai','=','Đã xác nhận')->get();
        return view(
            'admin.donhang',
            [
                'user' => $adminUser,
                'donhangs' => $donhangs
            ]
        );
    }


    public function getPageChiTietDonHang($id)
    {

        $adminUser = Auth::guard('nhanvien')->user();
        $donhang = DB::table('donhang')
            ->join('khachhang', 'donhang.id_KH', '=', 'khachhang.id')
            ->join('hinhthucthanhtoan', 'donhang.id_HTTT', '=', 'hinhthucthanhtoan.id')
            ->select('hinhthucthanhtoan.*', 'donhang.*', 'khachhang.email')
            ->where('donhang.id', '=', $id)->first();
        $chitietdonhangs = DB::table('chitietdonhang')
            ->join('sach', 'chitietdonhang.id_Sach', '=', 'sach.id')
            ->select('sach.tenSach', 'sach.giaBan', 'sach.soLuong as soLuongTon', 'chitietdonhang.*')
            ->where('chitietdonhang.id_DH', '=', $id)->get();

        return view(
            'admin.donhangchitiet',
            [
                'user' => $adminUser,
                'donhang' => $donhang,
                'chitietdonhangs' => $chitietdonhangs,
            ]
        );
    }

    public function inHoaDon($id)
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $donhang = DB::table('donhang')
            ->join('khachhang', 'donhang.id_KH', '=', 'khachhang.id')
            ->join('hinhthucthanhtoan', 'donhang.id_HTTT', '=', 'hinhthucthanhtoan.id')
            ->select('hinhthucthanhtoan.*', 'donhang.*', 'khachhang.email')
            ->where('donhang.id', '=', $id)->first();
        $chitietdonhangs = DB::table('chitietdonhang')
            ->join('sach', 'chitietdonhang.id_Sach', '=', 'sach.id')
            ->select('sach.tenSach', 'sach.giaBan', 'sach.soLuong as soLuongTon', 'chitietdonhang.*')
            ->where('chitietdonhang.id_DH', '=', $id)->get();

        return view(
            'admin.donhangin',
            [
                'user' => $adminUser,
                'donhang' => $donhang,
                'chitietdonhangs' => $chitietdonhangs,
            ]
        );
    }

    public function deleteDonHang($id)
    {
        $donhang = donhang::find($id);
        $donhang->delete();

        if ($donhang) {
            Session::flash('success', 'Xóa đơn hàng thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }

    public function statusDonHang(Request $request, $id)
    {

        $donhang = donhang::find($id);
        $adminUser = Auth::guard('nhanvien')->user();


        if ($request->trangThai == "Đã xác nhận") {
            if ($donhang->trangThai == "Đã xác nhận") {
                Session::flash('error', 'Thay đổi trạng thái thất bại!');
                return redirect()->back();
            } else {
                $donhang->trangThai = $request->trangThai;
                $donhang->id_NV = $adminUser->id;
                $updatedata = $donhang->save();

                foreach ($request->id as $key => $value) {
                    $soLuongMoi = $request->soLuongTon[$key] - $request->soLuong[$key];
                    $sachSoLuong = sach::find($value);
                    $sachSoLuong->soLuong = $soLuongMoi;
                    $updateSoluong = $sachSoLuong->save();
                }
            }
        } elseif ($request->trangThai == "Hoàn trả") {
            if ($donhang->trangThai == "Hoàn trả") {
                Session::flash('error', 'Thay đổi trạng thái thất bại!');
                return redirect()->back();
            } else {
                $donhang->trangThai = $request->trangThai;
                $donhang->id_NV = $adminUser->id;
                $updatedata = $donhang->save();

                foreach ($request->id as $key => $value) {
                    $soLuongMoi = $request->soLuongTon[$key] + $request->soLuong[$key];
                    $sachSoLuong = sach::find($value);
                    $sachSoLuong->soLuong = $soLuongMoi;
                    $updateSoluong = $sachSoLuong->save();
                }
            }
        } else {
            $donhang->trangThai = $request->trangThai;
            $donhang->id_NV = $adminUser->id;
            $updatedata = $donhang->save();
            $updateSoluong = "null";
        }
        if ($updatedata && $updateSoluong) {
            Session::flash('success', 'Thay đổi trạng thái thành công!');
        } else {
            Session::flash('error', 'Thay đổi trạng thái  thất bại!');
        }
        return redirect()->back();
    }
}
