<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleNhapAdmin;
use App\ngonngu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class NgonNguController extends Controller
{
    public function getPageNgonNgu()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $ngonngus = ngonngu::paginate(10);
        return view('admin.ngonngu', ['user' => $adminUser, 'ngonngus' => $ngonngus]);
    }

    public function storeNgonNgu(RuleNhapAdmin $request)
    {

        $ngonngu = new ngonngu;
        $ngonngu->tenNN =  $request->tenNN;
        $insertData = $ngonngu->save();
        if ($insertData) {
            Session::flash('success', 'Thêm ngôn ngữ thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        return redirect()->back();
    }

    public function getPageEditNgonNgu($id)
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $ngonngus = ngonngu::find($id);
        return view('admin.ngonnguedit', ['user' => $adminUser, 'ngonngus' => $ngonngus]);
    }

    public function editNgonNgu(RuleNhapAdmin $request, $id)
    {

        $ngonngu = ngonngu::find($id);
        $ngonngu->tenNN = $request->tenNN;
        $updateData = $ngonngu->save();
        if ($updateData) {
            Session::flash('success', 'Sửa ngôn ngữ thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }
        return redirect()->back();
    }

    public function deletengonngu($id)
    {
        $deleteData = ngonngu::destroy($id);
        if ($deleteData) {
            Session::flash('success', 'Xóa loại sách thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }
}
