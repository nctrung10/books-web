<?php

namespace App\Http\Controllers;

use App\danhmucsanpham;
use App\loaisach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DanhMucSanPhamKHController extends Controller
{
    public function getPageDanhMuc($tenDM, $id, $parent_id)
    {

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $id = $id;
        $tenDM = $tenDM;
        $parent_id = $parent_id;
        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();

        if ($parent_id == 0) {
            $sachs = DB::table('sach')
                ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
                ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
                ->select('danhmucsanpham.*', 'sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
                ->where('parent_id', '=', $id)
                ->orderby('sach.id', 'ASC')->paginate(3);

        } else {
            $sachs = DB::table('sach')
                ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
                ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
                ->select('danhmucsanpham.*', 'sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
                ->where('danhmucsanpham.id', '=', $id)
                ->orderby('sach.id', 'ASC')->paginate(3);
               
        }
       // dd($sachs); exit;
        $loaiSachs = loaisach::get();

        return view('khachhang.danhmucsanpham', [
            'user' => $user,
            'danhmucs' => $danhmucs,
            'tenDM' => $tenDM,
            'sachs' => $sachs,
            'id' => $id,
            'parent_id' => $parent_id,
            'loaiSachs' => $loaiSachs,
            'now' => $now,
        ]);
    }

    public function getPageDanhMucPrice(Request $request, $tenDM, $id, $parent_id)
    {
        $start = $request->start;
        $end = $request->end;
        $id = $id;
        $tenDM = $tenDM;
        $parent_id = $parent_id;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();
        $loaiSachs = loaisach::get();
        if ($parent_id == 0) {
            $sachs = DB::table('sach')
                ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
                ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
                ->select('danhmucsanpham.*', 'sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
                ->where('parent_id', '=', $id)
                ->whereBetween('giaBan', array($start, $end))
                ->orderby('sach.id', 'ASC')->paginate(3);
        } else {
            $sachs = DB::table('sach')
                ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
                ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
                ->select('danhmucsanpham.*', 'sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
                ->where('danhmucsanpham.id', '=', $id)
                ->whereBetween('giaBan', array($start, $end))
                ->orderby('sach.id', 'ASC')->paginate(3);
        }


        return view('khachhang.danhmucsanpham', [
            'user' => $user,
            'danhmucs' => $danhmucs,
            'tenDM' => $tenDM,
            'sachs' => $sachs,
            'id' => $id,
            'parent_id' => $parent_id,
            'loaiSachs' => $loaiSachs,
            'now' => $now
        ]);
    }
    public function getPageDanhMucPriceSort(Request $request, $tenDM, $id, $parent_id)
    {
        $id = $id;
        $tenDM = $tenDM;
        $parent_id = $parent_id;
        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();
        $loaiSachs = loaisach::get();
        if ($parent_id == 0) {
            if ($request->gia == 1) {
                $sachs = DB::table('sach')
                    ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
                    ->select('danhmucsanpham.*', 'sach.*')
                    ->where('parent_id', '=', $id)
                    ->orderby('sach.giaBan', 'ASC')->paginate(3);
            } else {
                $sachs = DB::table('sach')
                    ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
                    ->select('danhmucsanpham.*', 'sach.*')
                    ->where('danhmucsanpham.id', '=', $id)
                    ->orderby('sach.giaBan', 'DESC')->paginate(3);
            }
        } else {
            if ($request->gia == 1) {
                $sachs = DB::table('sach')
                    ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
                    ->select('danhmucsanpham.*', 'sach.*')
                    ->where('parent_id', '=', $id)
                    ->orderby('sach.giaBan', 'ASC')->paginate(3);
            } else {
                $sachs = DB::table('sach')
                    ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
                    ->select('danhmucsanpham.*', 'sach.*')
                    ->where('danhmucsanpham.id', '=', $id)
                    ->orderby('sach.giaBan', 'DESC')->paginate(3);
            }
        }
        return view('khachhang.danhmucsanpham', [
            'user' => $user,
            'danhmucs' => $danhmucs,
            'tenDM' => $tenDM,
            'sachs' => $sachs,
            'id' => $id,
            'parent_id' => $parent_id,
            'loaiSachs' => $loaiSachs
        ]);
    }
}
