<?php

namespace App\Http\Controllers;

use App\slice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SliceController extends Controller
{
    public function getPageSlice()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $slices = slice::paginate(5);

        return view('admin.slice', [
            'user' => $adminUser,
            'slices' => $slices
        ]);
    }
    public function getPageEditSlice($id)
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $slices = slice::find($id);
        return view('admin.sliceedit', [
            'user' => $adminUser,
            'slices' => $slices
        ]);
    }

    public function storeSlice(Request $request)
    {

        $slice = new slice;
        if (!$request->hasFile("hinh")) {

            $slice->hinh = $request->hinh;
        } else {
            $request->hinh->store('slice', 'public');
            $slice->tenSlice = $request->tenSlice;
            $slice->moTa = $request->moTa;
            $slice->viTri = $request->viTri;
            $slice->hinh = $request->hinh->hashName();
            $slice->trangThai = $request->trangThai;
        }
        $insertData = $slice->save();
        //Kiểm tra lệnh update để trả về một thông báo
        if ($insertData) {
            Session::flash('success', 'Thêm slide thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        return redirect()->back();
    }

    public function editSlice(Request $request, $id)
    {
        $slice = new slice;
        if (!$request->hasFile("hinh")) {

            $slice->hinh = $request->hinh;
            $slice = slice::find($id);
            $slice->tenSlice = $request->tenSlice;
            $slice->moTa = $request->moTa;
            $slice->viTri = $request->viTri;
        } else {

            $request->hinh->store('slice', 'public');
            $slice = slice::find($id);
            $slice->tenSlice = $request->tenSlice;
            $slice->moTa = $request->moTa;
            $slice->viTri = $request->viTri;
            $slice->hinh = $request->hinh->hashName();
           
        }

        $updateData = $slice->save();
        //Kiểm tra lệnh update để trả về một thông báo
        if ($updateData) {
            Session::flash('success', 'Sửa thông tin thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }

        return redirect()->back();
    }
    
    public function editAn($id)
    {
        $an = slice::find($id);
        $an->trangThai = '0';
        $updateData = $an->save();
        if ($updateData) {
            Session::flash('success', 'Ẩn slide thành công!');
        } else {
            Session::flash('error', 'Ẩn thất bại!');
        }
        return redirect()->route('admin.slice');
    }
    public function editHien($id)
    {
        $hien = slice::find($id);

        $hien->trangThai = '1';
        $updateData = $hien->save();
        if ($updateData) {
            Session::flash('success', 'Hiện slide thành công!');
        } else {
            Session::flash('error', 'Hiện thất bại!');
        }
        return redirect()->route('admin.slice');
    }

    public function deleteSlice($id)
    {

        $deleteData = slice::destroy($id);

        if ($deleteData) {
            Session::flash('success', 'Xóa slide thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }
}
