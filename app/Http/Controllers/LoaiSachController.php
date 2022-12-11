<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleNhapLoai;
use App\loaisach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoaiSachController extends Controller
{
    public function getPageLoaiSach()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $loaisachs = loaisach::paginate(10);
        return view('admin.loaisach', ['user' => $adminUser, 'loaisachs' => $loaisachs]);
    }

    public function storeLoaiSach(RuleNhapLoai $request)
    {
        $loaiSach = new loaisach;
        $loaiSach->tenLoai =  $request->tenLoai;
        $insertData = $loaiSach->save();
        if ($insertData) {
            Session::flash('success', 'Thêm loại thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        return redirect()->back();
    }

    public function getPageEditLoaiSach($id)
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $loaisachs = loaisach::find($id);
        return view('admin.loaisachedit', ['user' => $adminUser, 'loaisachs' => $loaisachs]);
    }

    public function editLoaiSach(RuleNhapLoai $request, $id)
    {

        $loaisach = loaisach::find($id);
        $loaisach->tenLoai = $request->tenLoai;
        $updateData = $loaisach->save();
        if ($updateData) {
            Session::flash('success', 'Sửa loại sách thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }
        return redirect()->back();
    }

    public function deleteLoaiSach($id)
    {
        $deleteData = loaisach::destroy($id);
        if ($deleteData) {
            Session::flash('success', 'Xóa loại sách thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }
}
