<?php

namespace App\Http\Controllers;

use App\hinhsach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HinhSachController extends Controller
{
    public function storeHinhSach(Request $request)
    {

        //dd($request->idSach); exit;
        $hinhs = $request->file('hinhsach');
        if ($hinhs) {
            $request->validate([
                'hinh' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            foreach ($hinhs as $hinh) {
                $hinh->store('product', 'public');
                // Store the record, using the new file hashname which will be it's new filename identity.
                $hinhsach = new hinhsach([
                    "id_Sach" => $request->idSach,
                    "hinh" => $hinh->hashName(),
                ]);
                $insertData = $hinhsach->save();
                //Kiểm tra Insert để trả về một thông báo
            }
        }
        if ($insertData) {
            Session::flash('success', 'Thêm hình thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }
        return redirect()->back();
    }

    public function docThu(){
        
    }
}
