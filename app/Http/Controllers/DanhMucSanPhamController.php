<?php

namespace App\Http\Controllers;

use App\danhmucsanpham;
use App\Http\Requests\RuleNhapDanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DanhMucSanPhamController extends Controller
{
    public function getPageDanhMuc()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $danhmucs = danhmucsanpham::paginate(10);
        return view('admin.danhmucsanpham', [
            'user' => $adminUser,
            'danhmucs' => $danhmucs
        ]);
    }

    public function getPageDanhMucAdd()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $danhmucs = danhmucsanpham::get();
        return view('admin.danhmucsanphamadd', [
            'user' => $adminUser,
            'danhmucs' => $danhmucs,
        ]);
    }

    public function getPageDanhMucEdit($id)
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $danhmucdacap = danhmucsanpham::get();
        $danhmucs = danhmucsanpham::find($id);
        return view('admin.danhmucsanphamedit', [
            'user' => $adminUser,
            'danhmucs' => $danhmucs,
            'danhmucdacap' => $danhmucdacap,
        ]);
    }

    public function storeDanhMuc(RuleNhapDanhMuc $request)
    {
        $danhmuc = new danhmucsanpham;

        $danhmuc->tenDM = $request->tenDM;
        $danhmuc->moTa = $request->moTa;
        $danhmuc->parent_id = $request->parent_id;
        $danhmuc->trangThai = $request->trangThai;

        $insertData = $danhmuc->save();
        if ($insertData) {
            Session::flash('success', 'Thêm danh mục sản phẩm thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        return redirect()->back();
    }
    public function editDanhMuc( Request $request ,$id)
    {
        $danhmuc = danhmucsanpham::find($id);
        $danhmuc->tenDM = $request->tenDM;
        $danhmuc->parent_id = $request->parent_id;
        $danhmuc->moTa = $request->moTa;
        $updateData = $danhmuc->save();
        if ($updateData) {
            Session::flash('success', 'Sửa danh mục thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }
        return redirect()->back();;
    }
    public function deleteDanhMuc($id)
    {
        $deleteData = danhmucsanpham::destroy($id);
        if ($deleteData ) {
            Session::flash('success', 'Xóa danh mục thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();;
    }

    public function editAn($id)
    {
        $an = danhmucsanpham::find($id);
        $an->trangThai = '0';
        $updateData = $an->save();
        if ($updateData) {
            Session::flash('success', 'Ẩn danh mục thành công!');
        } else {
            Session::flash('error', 'Ẩn thất bại!');
        }
        return redirect()->route('admin.danhmucsanpham');
    }
    public function editHien($id)
    {
        $hien = danhmucsanpham::find($id);

        $hien->trangThai = '1';
        $updateData = $hien->save();
        if ($updateData) {
            Session::flash('success', 'Hiện danh mục thành công!');
        } else {
            Session::flash('error', 'Hiện thất bại!');
        }
        return redirect()->route('admin.danhmucsanpham');
    }
}
