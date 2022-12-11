<?php

namespace App\Http\Controllers;

use App\danhmucsanpham;
use Illuminate\Http\Request;
use App\GiamGia;
use App\GiamGiaSach;
use App\Http\Requests\RuleNhapKM;
use App\loaisach;
use App\sach;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class GiamGiaController extends Controller
{
    public function getPageGiamGia()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $adminUser = Auth::guard('nhanvien')->user();
        $giamgias = GiamGia::paginate(5);
        $danhmucs = danhmucsanpham::where('parent_id', '!=', '0')->get();
        return view('admin.giamgia', [
            'user' => $adminUser,
            'giamgias' => $giamgias,
            'danhmucs' => $danhmucs,
            'now' => $now
        ]);
    }

    public function getPageEditGiamGia($id)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $adminUser = Auth::guard('nhanvien')->user();
        $giamgias = GiamGia::find($id);
        $danhmucs = danhmucsanpham::where('parent_id', '!=', '0')->get();

        return view('admin.giamgiaedit', [
            'user' => $adminUser,
            'giamgias' => $giamgias,
            'danhmucs' => $danhmucs,
            'now' => $now
        ]);
    }

    public function getPageSPGiamGia($id)
    {

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $adminUser = Auth::guard('nhanvien')->user();
        $giamgia_sach = DB::table('giamgia_sach')
        ->join('sach','giamgia_sach.id_sach','=','sach.id')
        ->select('sach.*','giamgia_sach.*')
        ->where('id_GiamGia','=',$id)
        ->paginate(10);
//dd( $giamgia_sach); exit;
        return view('admin.giamgiasanpham', [
            'user' => $adminUser,
            'giamgia_sach' => $giamgia_sach,
            'now' => $now
        ]);
    }

    public function storeGiamGia(RuleNhapKM $request)
    {

        $giamgia = new GiamGia;
        $giamgia = array();
        $giamgia['tenGiamGia'] = $request->tenGiamGia;
        $giamgia['giaTri'] = $request->giaTri;
        $giamgia['id_DM_GG'] = $request->id_DM_GG;
        $giamgia['ngayBatDau'] = $request->ngayBatDau;
        $giamgia['ngayKetThuc'] = $request->ngayKetThuc;
        $giamgia['trangThai'] = '0';
        $idgiamgia = DB::table('giamgia')->insertGetId($giamgia);


        $sachs = sach::where('id_DM', '=', $request->id_DM_GG)->get();

        foreach ($sachs as $sach) {
            $giamgia_sach = new GiamGiaSach;
            $giamgia_sach->id_GiamGia =  $idgiamgia;
            $giamgia_sach->id_Sach =  $sach->id;
            $giamgia_sach->giaTri =  $request->giaTri;
            $giamgia_sach->ngayBatDau =  $request->ngayBatDau;
            $giamgia_sach->ngayKetThuc =  $request->ngayKetThuc;
            $updated = $giamgia_sach->save();
        }


        if ($idgiamgia && $updated) {
            Session::flash('success', 'Thêm chương trình thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        return redirect()->back();
    }

    public function editGiamGia(Request $request, $id)
    {

        $updatedGiamGia = DB::table('giamgia')->where('id', $id)
            ->update(
                [
                    'tenGiamGia' => $request->tenGiamGia,
                    'giaTri' => $request->giaTri,
                    'ngayBatDau' => $request->ngayBatDau,
                    'ngayKetThuc' => $request->ngayKetThuc,
                ]
            );

        $updated = DB::table('giamgia_sach')->where('id_GiamGia', $id)
            ->update(
                [
                    'giaTri' => $request->giaTri,
                    'ngayBatDau' => $request->ngayBatDau,
                    'ngayKetThuc' => $request->ngayKetThuc,
                ]
            );

        if ($updatedGiamGia && $updated) {
            Session::flash('success', 'Cập nhật chương trình thành công!');
        } else {
            Session::flash('error', 'Cập nhật thất bại!');
        }

        return redirect()->back();
    }
    public function deleteGiamGia($id)
    {

        $giamgia = GiamGia::destroy($id);


        if ($giamgia) {
            Session::flash('success', 'Xóa chương trình thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }

        return redirect()->back();
    }
}
