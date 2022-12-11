<?php

namespace App\Http\Controllers;

use App\phieunhap;
use App\chitietphieunhap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\sach;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PhieuNhapController extends Controller
{
    public function getPagePhieuNhap()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $sachs = sach::get();
     /*    $phieunhap = DB::table('phieunhap')
        ->join('chitietphieunhap','phieunhap.id','chitietphieunhap.id_PhieuNhap')
        ->join('nhanvien','phieunhap.id_NV','nhanvien.id')
        ->select('phieunhap.*','chitietphieunhap.*','nhanvien.hoTenNV')
        ->get(); */
        $phieunhaps = phieunhap::get();
        return view('admin.phieunhap', [
            'user' => $adminUser,
            'sachs' => $sachs,
            'phieunhaps' => $phieunhaps,
        ]);
    }

    public function getPageDetailPhieuNhap($id){
        $adminUser = Auth::guard('nhanvien')->user();
        $phieunhaps = DB::table('phieunhap')
        ->join('nhanvien','phieunhap.id_NV','=','nhanvien.id')
        ->select('phieunhap.*','nhanvien.hoTenNV','nhanvien.email','nhanvien.sdtNV','nhanvien.diaChiNV')
        ->where('phieunhap.id','=',$id)->first();
        $chitietphieunhaps = DB::table('chitietphieunhap')
        ->join('phieunhap','chitietphieunhap.id_PhieuNhap','=','phieunhap.id')
        ->join('sach','chitietphieunhap.id_Sach','=','sach.id')
        ->select('phieunhap.id','chitietphieunhap.*','sach.tenSach','sach.soLuong as soLuongTon')
        ->where('chitietphieunhap.id_PhieuNhap','=',$id)->get();
        //dd($chitietphieunhaps); exit;

        return view('admin.phieunhapdetail', [
            'user' => $adminUser,
            'phieunhaps' => $phieunhaps,
            'chitietphieunhaps' => $chitietphieunhaps,
        ]);
    }

    public function storePhieuNhap(Request $request)
    {

        //THÊM PHIẾU NHẬP
        $phieunhap = new phieunhap;
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $phieunhap = array();
        $phieunhap['id_NV'] = $request->idNV;
        $phieunhap['chuDe'] = $request->chuDe;
        $phieunhap['moTa'] = $request->moTa;
        $phieunhap['created_at'] = $dt;
        $phieunhap['updated_at'] = $dt;
        $idPhieuNhap = DB::table('phieunhap')->insertGetId($phieunhap);


        // THÊM CHI TIẾT PHIẾU NHẬP
        $id_Sach = $request->id_Sach;
        $soLuong = $request->soLuong;
        $donGia = $request->giaBia;
        foreach ($id_Sach as $key => $value) {
            $tt = [
                'id_PhieuNhap' => $idPhieuNhap,
                'id_Sach' => $value,
                'soLuong' => $soLuong[$key],
                'donGia' => $donGia[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $savechitietphieunhap = chitietphieunhap::insert($tt);

        $sach = sach::where('id','=',$value)->first();

        $sach->soLuong =  $sach->soLuong + $soLuong[$key];

        $sach->save();

        }
        if ($savechitietphieunhap) {
            Session::flash('success', 'Nhập sản phẩm thành công!');
        } else {
            Session::flash('error', 'Nhập sản phẩm  thất bại!');
        }

        return redirect()->route('admin.phieunhap');
    }
}
