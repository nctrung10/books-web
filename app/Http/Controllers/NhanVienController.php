<?php

namespace App\Http\Controllers;

use App\nhanvien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RuleNhapNV;
use App\Http\Requests\RuleNhapNVBlade;
use Illuminate\Support\Facades\Hash;


class NhanVienController extends Controller
{
    public function getPageNhanVien()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $nhanviens = nhanvien::paginate(10);
        return view('admin.nhanvien', [
            'user' => $adminUser,
            'nhanviens' => $nhanviens
        ]);
    }

    public function getPageEditNhanVien($id)
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $nhanviens = nhanvien::find($id);
        return view('admin.nhanvienedit', [
            'user' => $adminUser,
            'nhanviens' => $nhanviens
        ]);
    }
    public function getPageAddTKNhanVien($id)
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $nhanviens = nhanvien::find($id);
        return view('admin.nhanvienaddtk', [
            'user' => $adminUser,
            'nhanviens' => $nhanviens
        ]);
    }

    public function storeNhanVien(RuleNhapNVBlade $request)
    {

        $nhanvien = new nhanvien;
        if (!$request->hasFile("hinhNV")) {

            $nhanvien->hinhNV = $request->hinhNV;
        } else {
            $request->hinhNV->store('nhanvien', 'public');
            $nhanvien->hoTenNV = $request->hoTenNV;
            $nhanvien->email = $request->email;
            $nhanvien->diaChiNV = $request->diaChiNV;
            $nhanvien->sdtNV = $request->sdtNV;
            $nhanvien->luongNV = $request->luongNV;
            $nhanvien->hinhNV = $request->hinhNV->hashName();
        }
        $insertData = $nhanvien->save();
        //Kiểm tra lệnh update để trả về một thông báo
        if ($insertData) {
            Session::flash('success', 'Thêm nhân viên thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        return redirect()->back();
    }

    public function editNhanVien(Request $request, $id)
    {
        $nhanvien = new nhanvien;
        if (!$request->hasFile("hinhNV")) {

            $nhanvien->hinhNV = $request->hinhNV;
            $nhanvien = nhanvien::find($id);
            $nhanvien->hoTenNV = $request->hoTenNV;
            $nhanvien->email = $request->email;
            $nhanvien->diaChiNV = $request->diaChiNV;
            $nhanvien->sdtNV = $request->sdtNV;
            $nhanvien->luongNV = $request->luongNV;
        } else {
            $request->hinhNV->store('nhanvien', 'public');
            $nhanvien = nhanvien::find($id);
            $nhanvien->hoTenNV = $request->hoTenNV;
            $nhanvien->email = $request->email;
            $nhanvien->diaChiNV = $request->diaChiNV;
            $nhanvien->sdtNV = $request->sdtNV;
            $nhanvien->luongNV = $request->luongNV;
            $nhanvien->hinhNV = $request->hinhNV->hashName();
        }

        $updateData = $nhanvien->save();
        //Kiểm tra lệnh update để trả về một thông báo
        if ($updateData) {
            Session::flash('success', 'Sửa thông tin thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }

        return redirect()->back();
    }

    public function deleteNhanVien($id)
    {

        $deleteData = nhanvien::destroy($id);

        if ($deleteData) {
            Session::flash('success', 'Xóa nhân viên thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }

    public function addTKNhanVien(RuleNhapNV $request, $id)
    {

        $password = nhanvien::find($id);

        $password->password = Hash::make($request->password);

        $updateData = $password->save();

        if ($updateData) {
            Session::flash('success', 'Thêm tài khoản thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }
        return redirect()->back();
    }
}
