<?php

namespace App\Http\Controllers;

use App\khuyenmai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KhuyenMaiController extends Controller
{
    public function getPageKhuyenMai(){
        $adminUser = Auth::guard('nhanvien')->user();
        $khuyenmais = khuyenmai::paginate(5);

        return view('admin.khuyenmai', [
            'user' => $adminUser,
            'khuyenmais' => $khuyenmais
        ]);
    }

    public function storeKhuyenMai(Request $request){
        $khuyenmai = new khuyenmai;
        $khuyenmai->tenKM = $request->tenKM;
        $khuyenmai->code = $request->code;
        $khuyenmai->moTaKM = $request->moTaKM;
        $khuyenmai->hinhThuc = $request->hinhThuc;
        $khuyenmai->giaTri = $request->giaTri;
        $khuyenmai->soLuong =  $request->soLuong;
        $khuyenmai->ngayBatDau =  $request->ngayBatDau;
        $khuyenmai->ngayKetThuc =  $request->ngayKetThuc;
        $insertData = $khuyenmai->save();
        if ($insertData) {
            Session::flash('success', 'Thêm khuyến mãi thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        return redirect()->back();
    }

    public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){
          
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}
}
