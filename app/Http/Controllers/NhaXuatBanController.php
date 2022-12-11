<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleNhapNXB;
use App\nhaxuatban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class NhaXuatBanController extends Controller
{
    public function getPageNhaXuatBan()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $nhaxuatbans = nhaxuatban::paginate(10);
        return view('admin.nhaxuatban', ['user' => $adminUser, 'nhaxuatbans' => $nhaxuatbans]);
    }

    public function storeNhaXuatBan(RuleNhapNXB $request)
    {
        $nhaxuatban = new nhaxuatban;
        $nhaxuatban->tenNXB =  $request->tenNXB;
        $nhaxuatban->emailNXB =  $request->emailNXB;
        $nhaxuatban->diaChiNXB =  $request->diaChiNXB;
        $insertData = $nhaxuatban->save();
        if ($insertData) {
            Session::flash('success', 'Thêm nhà xuất bản thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        return redirect()->back();
    }

    public function getPageEditNhaXuatBan($id)
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $nhaxuatbans = nhaxuatban::find($id);
        return view('admin.nhaxuatbanedit', ['user' => $adminUser, 'nhaxuatbans' => $nhaxuatbans]);
    }

    public function editNhaXuatBan(RuleNhapNXB $request, $id)
    {

        $nhaxuatban = nhaxuatban::find($id);
        $nhaxuatban->tenNXB =  $request->tenNXB;
        $nhaxuatban->emailNXB =  $request->emailNXB;
        $nhaxuatban->diaChiNXB =  $request->diaChiNXB;
        $updateData = $nhaxuatban->save();
        if ($updateData) {
            Session::flash('success', 'Sửa nhà xuất bản thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }
        return redirect()->back();
    }

    public function deletenhaxuatban($id)
    {
        $deleteData = nhaxuatban::destroy($id);
        if ($deleteData) {
            Session::flash('success', 'Xóa nhà xuất bản thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }
}
