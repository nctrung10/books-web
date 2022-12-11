<?php

namespace App\Http\Controllers;

use App\danhmucsanpham;
use App\donhang;
use App\sach;
use App\khuyenmai;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
session_start();
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class GioHangController extends Controller
{
    public function saveGioHang(Request $request){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $idSach = $request->idSach;
        $sach = DB::table('sach')
        ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
        ->select('sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
        ->where('sach.id', '=', $idSach)->first();

        if($sach->giaTri != NULL && $sach->ngayBatDau <= $now && $sach->ngayKetThuc >= $now){
            $price = $sach->giaBan - ($sach->giaBan * $sach->giaTri )/100 ;
        }else{
            $price = $sach->giaBan;
        }

        $data['id'] = $idSach;
        $data['qty'] = '1';
        $data['name'] = $sach->tenSach;
        $data['price'] = $price;
        $data['weight'] = '1';
        $data['options']['image'] = $sach->hinh;
        $add =Cart::add($data);
        if($add){
            toast('Thêm vào giỏ hàng thành công','success','top-right');
        }else{
            toast('Thêm vào giỏ hàng thất bại','success','top-right');
        }

         return redirect()->route('khachhang.trangchu');

    }

    public function saveGioHangDetail(Request $request){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $idSach = $request->idSach;
        $qty = $request->qty;
        $sach = DB::table('sach')
        ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
        ->select('sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
        ->where('sach.id', '=', $idSach)->first();
//dd($sach); exit;
        if($sach->giaTri != NULL && $sach->ngayBatDau <= $now && $sach->ngayKetThuc >= $now){
            $price = $sach->giaBan - ($sach->giaBan * $sach->giaTri )/100 ;
        }else{
            $price = $sach->giaBan;
        }

        $data['id'] = $idSach;
        $data['qty'] = $qty;
        $data['name'] = $sach->tenSach;
        $data['price'] = $price;
        $data['weight'] = '1';
        $data['options']['image'] = $sach->hinh;
        $add = Cart::add($data);
        if($add){
            toast('Thêm vào giỏ hàng thành công','success','top-right');
        }else{
            toast('Thêm vào giỏ hàng thất bại','success','top-right');
        }

         return redirect()->route('khachhang.giohang');

    }

    public function saveGioHangIndex(Request $request){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $idSach = $request->idSach;
        $sach = DB::table('sach')
        ->leftJoin('giamgia_sach','giamgia_sach.id_Sach','=','sach.id')
        ->select('sach.*','giamgia_sach.giaTri','giamgia_sach.ngayBatDau','giamgia_sach.ngayKetThuc')
        ->where('sach.id', '=', $idSach)->first();
//dd($sach); exit;
        if($sach->giaTri != NULL && $sach->ngayBatDau <= $now && $sach->ngayKetThuc >= $now){
            $price = $sach->giaBan - ($sach->giaBan * $sach->giaTri )/100 ;
        }else{
            $price = $sach->giaBan;
        }

        $data['id'] = $idSach;
        $data['qty'] = '1';
        $data['name'] = $sach->tenSach;
        $data['price'] = $price;
        $data['weight'] = '1';
        $data['options']['image'] = $sach->hinh;
        $add = Cart::add($data);
        if($add){
            toast('Thêm vào giỏ hàng thành công','success','top-right');
        }else{
            toast('Thêm vào giỏ hàng thất bại','success','top-right');
        }

         return redirect()->route('khachhang.giohang');

    }

    public function deleteItem($rowId){

        Cart::remove($rowId);

         return redirect()->route('khachhang.giohang');

    }

    public function updateItem(Request $request){
        $idSach = $request->idSach;
        $qty = $request->qty;

        Cart::update($idSach,$qty);

         return redirect()->route('khachhang.giohang');

    }

    public function getPageGioHang(){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $user = Auth::guard('khachhang')->user();
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();
        $sach = sach::all();
        $khuyenmai = khuyenmai::where('ngayKetThuc','>=',$now)->get();

        
        return view('khachhang.giohang',[
            'user' => $user,
            'danhmucs' => $danhmucs,
            'sach' => $sach,
            'khuyenmai' => $khuyenmai,
        ]);
    }

    public function check_khuyenmai(Request $request){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $data = $request->all();
        $khuyenmai = khuyenmai::where('code',$data['code'])->where('ngayKetThuc','>=',$now)->first();
        if($khuyenmai){
            $count_khuyenmai = $khuyenmai->count();
            if($count_khuyenmai>0){
                $khuyenmai_session = Session::get('khuyenmai');
                if($khuyenmai_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'khuyenmai_code' => $khuyenmai->code,
                            'khuyenmai_condition' => $khuyenmai->hinhThuc,
                            'khuyenmai_number' => $khuyenmai->giaTri,

                        );
                        Session::put('khuyenmai',$cou);
                    }
                }else{
                    $cou[] = array(
                        'khuyenmai_code' => $khuyenmai->code,
                        'khuyenmai_condition' => $khuyenmai->hinhThuc,
                        'khuyenmai_number' => $khuyenmai->giaTri,

                    );
                    Session::put('khuyenmai',$cou);
                }
                Session::save();
                alert('Thêm mã giảm giá thành công','Successfully', 'success');
                return redirect()->route('khachhang.giohang');
            }

        }else{
            alert('Mã giảm giá không đúng','', 'error');
            return redirect()->route('khachhang.giohang');
        }
    }

}
