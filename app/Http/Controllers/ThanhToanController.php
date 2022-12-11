<?php

namespace App\Http\Controllers;

use App\chitietdonhang;
use App\danhmucsanpham;
use App\donhang;
use App\khuyenmai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\hinhthucthanhtoan;
use App\Http\Requests\RuleThanhToan;
use App\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Notifications\TestNotification;

class ThanhToanController extends Controller
{
    public function getPageThanhToan()
    {
        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();
        $httts = hinhthucthanhtoan::all();

        return view('khachhang.thanhtoan', [
            'user' => $user,
            'danhmucs' => $danhmucs,
            'httts' => $httts
        ]);
    }

    public function saveDonHang(RuleThanhToan $request)
    {
        if ($request->httt == 1) {
            if (Session::get('khuyenmai')) {
                //TRỪ MÃ KHUYẾN MÃI
                $khuyenmai = khuyenmai::where('code', $request->magiam)->first();

                $khuyenmai->soLuong =  $khuyenmai->soLuong - 1;

                $khuyenmai->save();

                //Thêm đơn hàng
                $donhang = new donhang;
                $dt = Carbon::now('Asia/Ho_Chi_Minh');

                $donhang = array();
                $donhang['id_KH'] = $request->id_KH;
                $donhang['id_HTTT'] = $request->httt;
                $donhang['hoTenKH'] = $request->hoTenKH;
                $donhang['diaChiKH'] = $request->diaChiKH;
                $donhang['sdtKH'] = $request->sdtKH;
                $donhang['giamGia'] = $request->khuyenmai;
                $donhang['tongTien'] = $request->tongTien;
                $donhang['ngayDH'] = $dt;
                $donhang['trangThai'] = 'Đang chờ xử lý';
                $idDonHang = DB::table('donhang')->insertGetId($donhang);

                //Thêm chi tiết đơn hàng


                $contents = Cart::content();
                foreach ($contents as $content) {
                    $chitietdonhang = new chitietdonhang;
                    $chitietdonhang['id_DH'] = $idDonHang;
                    $chitietdonhang['id_Sach'] = $content->id;
                    $chitietdonhang['soLuong'] = $content->qty;
                    $chitietdonhang['donGia'] = $content->price;
                    $saveChiTietDonHang = $chitietdonhang->save();
                }
                Cart::destroy();
                Session::forget('khuyenmai');
                alert(' Thanh toán thành công, cảm ơn bạn đã mua sản phẩm của chúng tôi!','Successfully', 'success');
                return redirect()->route('khachhang.trangchu');
            } else {

                //Thêm đơn hàng
                $donhang = new donhang;
                $dt = Carbon::now('Asia/Ho_Chi_Minh');

                $donhang = array();
                $donhang['id_KH'] = $request->id_KH;
                $donhang['id_HTTT'] = $request->httt;
                $donhang['hoTenKH'] = $request->hoTenKH;
                $donhang['diaChiKH'] = $request->diaChiKH;
                $donhang['sdtKH'] = $request->sdtKH;
                $donhang['giamGia'] = $request->khuyenmai;
                $donhang['tongTien'] = $request->tongTien;
                $donhang['ngayDH'] = $dt;
                $donhang['trangThai'] = 'Đang chờ xử lý';
                $idDonHang = DB::table('donhang')->insertGetId($donhang);

                //Thêm chi tiết đơn hàng


                $contents = Cart::content();
                //dd($contents); exit;
                foreach ($contents as $content) {
                    $chitietdonhang = new chitietdonhang;
                    $chitietdonhang['id_DH'] = $idDonHang;
                    $chitietdonhang['id_Sach'] = $content->id;
                    $chitietdonhang['soLuong'] = $content->qty;
                    $chitietdonhang['donGia'] = $content->price;
                    $saveChiTietDonHang = $chitietdonhang->save();
                }
         /*        $thongbao = new ThongBao;
                $datathongbao = [
                    'abc',
                    'bcd'
                ];
                $thongbao->notify(new TestNotification($datathongbao)); */
                Cart::destroy();
                Session::forget('khuyenmai');
                alert('Thanh toán thành công, cảm ơn bạn đã mua sản phẩm của chúng tôi!','','success');
                return redirect()->route('khachhang.trangchu');
            }
        } else {
        
                $dt = Carbon::now('Asia/Ho_Chi_Minh');
                $donhang = array(
                $donhang['id_KH'] = $request->id_KH,
                $donhang['id_HTTT'] = $request->httt,
                $donhang['hoTenKH'] = $request->hoTenKH,
                $donhang['diaChiKH'] = $request->diaChiKH,
                $donhang['sdtKH'] = $request->sdtKH,
                $donhang['giamGia'] = $request->khuyenmai,
                $donhang['tongTien'] = $request->tongTien,
                $donhang['ngayDH'] = $dt,
                $donhang['trangThai'] = 'Đang chờ xử lý',
            );
            $request->session()->put('donhang', $donhang);
            $total = $request->tongTien;

            return view('khachhang.vnpay', [
                'tongtien' => $total,
                
            ]);
        }

    }
}
