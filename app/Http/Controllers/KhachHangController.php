<?php

namespace App\Http\Controllers;

use App\khachhang;
use App\danhmucsanpham;
use App\donhang;
use App\Http\Requests\RuleDangKy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Aler;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class KhachHangController extends Controller
{
    public function getPageKhachHang()
    {

        $user = Auth::guard('nhanvien')->user();
        $khachhangs = khachhang::paginate(10);

        return view('admin.khachhang', [
            'user' => $user,
            'khachhangs' => $khachhangs,
        ]);
    }

    public function getPageDetailKhachHang($id){

        $user = Auth::guard('nhanvien')->user();
        $khachhangs = khachhang::find($id);
        $donhangs = donhang::where('id_KH','=',$id)->get();
        $thanhcong = donhang::where('id_KH','=',$id)->where('trangThai','=','Đã xác nhận')->get();
        $dangcho = donhang::where('id_KH','=',$id)->where('trangThai','=','Đang chờ xử lý')->get();
        $huy = donhang::where('id_KH','=',$id)->where('trangThai','=','Hủy')->get();
        $hoantra = donhang::where('id_KH','=',$id)->where('trangThai','=','Hoàn trả')->get();
        return view('admin.khachhangchitiet', [
            'user' => $user,
            'khachhangs' => $khachhangs,
            'donhangs' => $donhangs,
            'thanhcong' => $thanhcong,
            'dangcho' => $dangcho,
            'huy' => $huy,
            'hoantra' => $hoantra,
        ]);
    }
    public function getTTCaNhan()
    {

        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();

        return view('khachhang.thongtincanhan', [
            'user' => $user,
            'danhmucs' => $danhmucs,
        ]);
    }
    public function updateTTCaNhan(Request $request)
    {

        $khachhang = khachhang::find($request->id);

        $khachhang->hoTenKH  = $request->hoTenKH;
        $khachhang->email  = $request->email;
        $khachhang->sdtKH  = $request->sdtKH;
        $khachhang->ngaySinh  = $request->ngaySinh;
        $khachhang->gioiTinhKH  = $request->gioiTinhKH;
        $khachhang->diaChiKH  = $request->diaChiKH;

        $updatedData =  $khachhang->save();
        if ($updatedData) {
            alert('Cập nhật thông tin thành công!', '', 'success');
        } else {
            alert('Cập nhật thông tin thất bại!', '', 'error');
        }
        return redirect()->route('khachhang.ttcanhan');
    }

    public function getPageChangePW()
    {
        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();

        return view('khachhang.doimatkhau', [
            'user' => $user,
            'danhmucs' => $danhmucs,
        ]);
    }

    public function updatePW(Request $request)
    {
        $khachhang = khachhang::find($request->id);
        if ($request->matkhau != $request->xacnhan) {
            alert('Nhập lại mật khẩu không khớp', '', 'warning');
            return redirect()->route('khachhang.doimatkhau');
        } else {
            if (Hash::check($request->matkhaucu, $khachhang->password)) {

                $update = khachhang::find($request->id);

                $update->password = Hash::make($request->matkhau);

                $updated = $update->save();

                if ($updated) {
                    alert('Thay đổi mật khẩu thành công!', '', 'success');
                    Auth::guard('khachhang')->logout();
                } else {
                    alert('Đổi mật khẩu  thất bại!', '', 'error');
                }
                return redirect()->route('khachhang.trangchu');
            } else {
                alert('Mật khẩu cũ không đúng!', '', 'error');
                return redirect()->route('khachhang.doimatkhau');
            }
        }
    }

    public function deleteKhachHang($id)
    {

        $deleteData = khachhang::destroy($id);

        if ($deleteData) {
            Session::flash('success', 'Xóa khách hàng thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }

    public function getPageDangKy()
    {

        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();

        return view('khachhang.dangky', [
            'user' => $user,
            'danhmucs' => $danhmucs,
        ]);
    }
    public function getPageLichSuDH()
    {

        $user = Auth::guard('khachhang')->user();
        $id = $user->id;
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();
        $donhang = DB::table('donhang')
            ->join('khachhang', 'donhang.id_KH', '=', 'khachhang.id')
            ->join('hinhthucthanhtoan', 'donhang.id_HTTT', '=', 'hinhthucthanhtoan.id')
            ->select('hinhthucthanhtoan.*', 'donhang.*', 'khachhang.email')
            ->where('donhang.id_KH', '=', $id)->paginate(3);

        return view('khachhang.lichsudonhang', [
            'user' => $user,
            'danhmucs' => $danhmucs,
            'donhangs' => $donhang,
        ]);
    }
    public function dangKyKH(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'emailKH' => 'required|unique:khachhang,email',
            'sdtKH' => 'required|min:10|max:11|unique:khachhang',
            'matkhau' => 'required|min:3|max:20',
            'xacnhan' => 'required|same:matkhau',
        ]);

        if ($validator->fails()) {
           alert('Đăng ký tài khoản thất bại!', '', 'error');
            return redirect()->route('khachhang.dangky');
        }

        $khachhang = new khachhang;
        $khachhang->email = $request->emailKH;
        $khachhang->password = Hash::make($request->matkhau);
        $khachhang->hoTenKH = $request->hoTenKH;
        $khachhang->gioiTinhKH = $request->gioiTinhKH;
        $khachhang->ngaySinh = $request->ngaySinh;
        $khachhang->diaChiKH = $request->diaChiKH;
        $khachhang->sdtKH = $request->sdtKH;
        $createUser = $khachhang->save();

        if ($createUser) {
            alert('Đăng ký tài khoản thành công!', '', 'success');
        } else {
            alert('Đăng ký tài khoản thất bại!', '', 'error');
        }
        return redirect()->route('khachhang.trangchu');
    }

    public function postLogin(Request $request)
    {
        $auth = Auth::guard('khachhang');
        $arr = $request->only('email', 'password');
        if ($auth->attempt($arr)) {
            alert('Đăng nhập thành công', '', 'success');
            return redirect()->route('khachhang.trangchu');
        } else {
            alert('Email hoặc Password không đúng!', '', 'error');
            return redirect()->route('khachhang.trangchu');
        }
    }

    public function logOut(Request $request)
    {
        Auth::guard('khachhang')->logout();
        alert('Đăng xuất thành công', '', 'success');
        return redirect('trangchu');
    }

}
