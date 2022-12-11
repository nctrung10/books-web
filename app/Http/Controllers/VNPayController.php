<?php

namespace App\Http\Controllers;

use App\donhang;
use App\chitietdonhang;
use App\payment;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VNPayController extends Controller
{
    public function createPayment(Request $request)
    {

        $length = 9;
        $maDH = substr(str_shuffle("0123456789"), 0, $length);
        $vnp_TxnRef = $maDH; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $contents = Cart::content();
        $request->session()->put('item', $contents);

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => env('vnp_TmnCode'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => env('vnp_Returnurl'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = env('vnp_Url') . "?" . $query;
        $vnp_HashSecret = env('vnp_HashSecret');
        if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        
        //dd($vnp_Url);exit;
        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        // dd($request->toArray()); exit;

        if (session()->has('donhang') && session()->has('item') &&  $request->vnp_ResponseCode == "00") {
            // Thêm bảng đơn hàng
            $donhang = Session('donhang');
            $adddonhang = new donhang;
            $adddonhang = array();
            $adddonhang['id_KH'] = $donhang[0];
            $adddonhang['id_HTTT'] = $donhang[1];
            $adddonhang['hoTenKH'] = $donhang[2];
            $adddonhang['diaChiKH'] = $donhang[3];
            $adddonhang['sdtKH'] = $donhang[4];
            $adddonhang['giamGia'] = $donhang[5];
            $adddonhang['tongTien'] = $donhang[6];
            $adddonhang['ngayDH'] = $donhang[7];
            $adddonhang['trangThai'] =  $donhang[8];
            $idadddonhang = DB::table('donhang')->insertGetId($adddonhang);
            // Thêm bảng chi tiết đơn hàng
            foreach (Session('item') as $content) {
                $chitietdonhang = new chitietdonhang;
                $chitietdonhang['id_DH'] = $idadddonhang;
                $chitietdonhang['id_Sach'] = $content->id;
                $chitietdonhang['soLuong'] = $content->qty;
                $chitietdonhang['donGia'] = $content->price;
                $saveChiTietDonHang = $chitietdonhang->save();
            }
            // Thêm bảng Payment

            $payment = new payment;

            $payment['id_DH'] = $idadddonhang;
            $payment['p_transaction_id'] = $request->vnp_TxnRef;
            $payment['p_user_id'] = $donhang[0];
            $payment['p_money'] = ($request->vnp_Amount) / 100;
            $payment['p_note'] = $request->vnp_OrderInfo;
            $payment['p_vnp_reponse_code'] = $request->vnp_ResponseCode;
            $payment['p_code_vnpay'] = $request->vnp_TransactionNo;
            $payment['p_code_bank'] = $request->vnp_BankCode;
            $payment['p_time'] = date('Y-m-d H:i', strtotime($request->vnp_PayDate));

            $savePayment = $payment->save();


            if ($saveChiTietDonHang && $savePayment) {
                alert('Thanh toán thành công!', '', 'success');
            } else {
                alert('Thanh toán  thất bại!', '', 'error');
            }
            Session::forget('donhang');
            Session::forget('item');
            Cart::destroy();
            return view('khachhang.vnpay_return');
        } else {
        }
    }
}
