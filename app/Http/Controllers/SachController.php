<?php

namespace App\Http\Controllers;

use App\danhmucsanpham;
use App\GiamGia;
use App\GiamGiaSach;
use App\sach;
use App\hinhsach;
use App\Http\Requests\RuleNhapSach;
use App\loaisach;
use App\ngonngu;
use App\nhaxuatban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SachController extends Controller
{
    public function getPageSach()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $loaisachs = loaisach::all();
        $NNs = ngonngu::all();
        $NXBs = nhaxuatban::all();
        $danhmucs = danhmucsanpham::all();
        $sachs = DB::table('sach')
            ->join('loaisach', 'sach.id_Loai', '=', 'loaisach.id')
            ->join('nhaxuatban', 'sach.id_NXB', '=', 'nhaxuatban.id')
            ->join('ngonngu', 'sach.id_NN', '=', 'ngonngu.id')
            ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
            ->select('loaisach.tenLoai', 'nhaxuatban.tenNXB', 'ngonngu.tenNN', 'danhmucsanpham.tenDM', 'sach.*')
            ->orderby('sach.id', 'ASC')->get();
        return view(
            'admin.sach',
            [
                'user' => $adminUser,
                'loaisachs' => $loaisachs,
                'NNs' => $NNs,
                'NXBs' => $NXBs,
                'danhmucs' => $danhmucs,
                'sachs' => $sachs
            ]
        );
    }

    public function getPageSachHet()
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $loaisachs = loaisach::all();
        $NNs = ngonngu::all();
        $NXBs = nhaxuatban::all();
        $danhmucs = danhmucsanpham::all();
        $sachs = DB::table('sach')
            ->join('loaisach', 'sach.id_Loai', '=', 'loaisach.id')
            ->join('nhaxuatban', 'sach.id_NXB', '=', 'nhaxuatban.id')
            ->join('ngonngu', 'sach.id_NN', '=', 'ngonngu.id')
            ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
            ->select('loaisach.tenLoai', 'nhaxuatban.tenNXB', 'ngonngu.tenNN', 'danhmucsanpham.tenDM', 'sach.*')
            ->where('soLuong','<=','10')
            ->orderby('sach.id', 'ASC')->get();
        return view(
            'admin.sach',
            [
                'user' => $adminUser,
                'loaisachs' => $loaisachs,
                'NNs' => $NNs,
                'NXBs' => $NXBs,
                'danhmucs' => $danhmucs,
                'sachs' => $sachs
            ]
        );
    }
    public function getPageHinhSach($id)
    {
        $id_Sach = $id;
        $adminUser = Auth::guard('nhanvien')->user();
        $hinhsachs = hinhsach::where('id_Sach','=',$id)->paginate(10);
        return view(
            'admin.sachhinh',
            [
                'user' => $adminUser,
                'hinhsachs' => $hinhsachs,
                'id_Sach' => $id_Sach,
            ]
        );

    }

    public function storeSach(RuleNhapSach $request)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        if ($request->hasFile('hinh')) {

            $request->validate([
                'hinh' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            $request->hinh->store('product', 'public');
            // Store the record, using the new file hashname which will be it's new filename identity.
            $sach = DB::table('sach')->insertGetId([
                "id_DM" => $request->id_DM,
                "id_Loai" => $request->get('loaisach'),
                "id_NN" => $request->get('ngonNgu'),
                "id_NXB" => $request->get('NXB'),
                "tenSach" => $request->get('tenSach'),
                "tacGia" => $request->get('tacGia'),
                "soLuong" => $request->get('soLuong'),
                "giaBia" => $request->get('giaBia'),
                "giaBan" => $request->get('giaBan'),
                "kichThuoc" => $request->get('kichThuoc'),
                "soTrang" => $request->get('soTrang'),
                "ngaySanXuat" => $request->get('ngaySanXuat'),
                "moTa" => $request->get('moTa'),
                "created_at" => $now,
                "hinh" => $request->hinh->hashName(),
            ]);


            $giamgia = GiamGia::where('id_DM_GG','=',$request->id_DM)->get();
            if(Count($giamgia) > 0 ){
                foreach($giamgia as $value){
                    $giamgia_sach = new GiamGiaSach;

                    $giamgia_sach->id_GiamGia = $value->id;
                    $giamgia_sach->id_Sach = $sach;
                    $giamgia_sach->giaTri = $value->giaTri;
                    $giamgia_sach->ngayBatDau = $value->ngayBatDau;
                    $giamgia_sach->ngayKetThuc = $value->ngayKetThuc;
                    $giamgia_sach->save();
                }
            }

            //Kiểm tra Insert để trả về một thông báo
            if ($sach) {
                Session::flash('success', 'Thêm sản phẩm thành công!');
            } else {
                Session::flash('error', 'Thêm thất bại!');
            }
        }
        return redirect()->back();
    }

    public function getPageEditSach($id)
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $loaisachs = loaisach::all();
        $NNs = ngonngu::all();
        $NXBs = nhaxuatban::all();
        $danhmucs = danhmucsanpham::all();
        $sachs = DB::table('sach')
            ->join('loaisach', 'sach.id_Loai', '=', 'loaisach.id')
            ->join('nhaxuatban', 'sach.id_NXB', '=', 'nhaxuatban.id')
            ->join('ngonngu', 'sach.id_NN', '=', 'ngonngu.id')
            ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
            ->select('loaisach.tenLoai', 'nhaxuatban.tenNXB', 'ngonngu.tenNN', 'danhmucsanpham.tenDM', 'sach.*')
            ->where('sach.id', '=', $id)->paginate(5);

        return view(
            'admin.sachedit',
            [
                'user' => $adminUser,
                'danhmucs' => $danhmucs,
                'loaisachs' => $loaisachs,
                'NNs' => $NNs,
                'NXBs' => $NXBs,
                'sachs' => $sachs
            ]
        );
    }
    public function getPageDetailSach($id)
    {
        $adminUser = Auth::guard('nhanvien')->user();
        $sachs = DB::table('sach')
            ->join('loaisach', 'sach.id_Loai', '=', 'loaisach.id')
            ->join('nhaxuatban', 'sach.id_NXB', '=', 'nhaxuatban.id')
            ->join('ngonngu', 'sach.id_NN', '=', 'ngonngu.id')
            ->join('danhmucsanpham', 'sach.id_DM', '=', 'danhmucsanpham.id')
            ->select('loaisach.tenLoai', 'nhaxuatban.tenNXB', 'ngonngu.tenNN', 'danhmucsanpham.tenDM', 'sach.*')
            ->where('sach.id', '=', $id)->paginate(1);
        return view(
            'admin.sachdetail',
            [
                'user' => $adminUser,
                'sachs' => $sachs
            ]
        );
    }

    public function editSach(Request $request, $id)
    {

        $sach = new sach;
        if (!$request->hasFile("hinh")) {

            $sach->hinh = $request->hinh;
        } else {

            $request->hinh->store('product', 'public');

            $sach = sach::find($id);

            $sach->id_DM = $request->tenDM;
            $sach->id_Loai = $request->tenLoai;
            $sach->id_NN = $request->ngonNgu;
            $sach->id_NXB = $request->NXB;
            $sach->tenSach = $request->tenSach;
            $sach->tacGia = $request->tacGia;
            $sach->soLuong = $request->soLuong;
            $sach->giaBia = $request->giaBia;
            $sach->giaBan = $request->giaBan;
            $sach->kichThuoc = $request->kichThuoc;
            $sach->soTrang = $request->soTrang;
            $sach->ngaySanXuat = $request->ngaySanXuat;
            $sach->moTa = $request->moTa;
            $sach->hinh = $request->hinh->hashName();
        }
        $updateData = $sach->save();
        //Kiểm tra lệnh update để trả về một thông báo
        if ($updateData) {
            Session::flash('success', 'Sửa thông tin thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }

        return redirect()->back();
    }

    public function deleteSach($id)
    {
        $deleteData = sach::destroy($id);
        if ($deleteData) {
            Session::flash('success', 'Xóa sách thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }
}
