<?php

namespace App\Http\Controllers;

use App\Charts\OrderChart;
use App\Charts\RevenueChart;
use App\donhang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\sach;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function postLogin(Request $request)
    {
        $auth = Auth::guard('nhanvien');
        $arr = $request->only('email', 'password');
        if ($auth->attempt($arr)) {
            toast('Đăng nhập thành công','success','top-right');
            return redirect()->route('admin.dashboard');
        } else {
            return redirect('login')->with('error', 'Email hoặc Password không đúng!');
        }
    }

    public function getDashBoard(Request $request)
    {

        //THỐNG KÊ DOANH THU
        if ($request->from && $request->to) {
            $from = $request->from;
            $to = $request->to;
            $doanhthungay = DB::table('donhang')
                ->where('trangThai', '=', 'Đã xác nhận')
                ->whereBetween('ngayDH', [$from, $to])
                ->selectRaw('DATE_FORMAT(ngayDH, "%Y-%m-%d") AS day, sum(tongTien) AS total')
                ->groupBy('day')->get();
            $ngayDH = array();
            $tongTien = array();
            foreach ($doanhthungay as $value) {
                $ngayDH[] = $value->day;
                $tongTien[] = $value->total;
            }
        } else {
            $doanhthungay = DB::table('donhang')
                ->where('trangThai', '=', 'Đã xác nhận')
                ->selectRaw('DATE_FORMAT(ngayDH, "%Y-%m-%d") AS day, sum(tongTien) AS total')
                ->groupBy('day')->get();
            $ngayDH = array();
            $tongTien = array();
            foreach ($doanhthungay as $value) {
                $ngayDH[] = $value->day;
                $tongTien[] = $value->total;
            }
        }

        $revenueChart = new RevenueChart;
        $revenueChart->labels($ngayDH);
        //$revenueChart->minimalist(true);
        $revenueChart->dataset('Doanh thu', 'line', $tongTien)
            ->color("rgb(255, 99, 132)")
            ->backgroundcolor("rgb(255, 99, 132)");
        //THỐNG KÊ ĐƠN HÀNG
        $order = DB::table('donhang')
            ->selectRaw('trangThai, count(trangThai) AS total')
            ->groupBy('trangThai')->get();
        $trangThai = array();
        $toTal = array();
        foreach ($order as $value) {
            $trangThai[] = $value->trangThai;
            $toTal[] = $value->total;
        }
        $borderColors = [
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(0, 0, 0, 1); ",
            "rgba(255, 99, 132, 1.0)",
        ];
        $fillColors = [
            "rgba(22,160,133, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(0, 0, 0, 1); ",
            "rgba(255, 99, 132, 0.2)",
        ];
        $orderChart = new OrderChart;
        $orderChart->labels($trangThai);
        //$orderChart->minimalist(true);
        $orderChart->dataset('Số Lượng', 'doughnut', $toTal)
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        $adminUser = Auth::guard('nhanvien')->user();
        $donhangcho = donhang::where('trangThai', '=', 'Đang chờ xử lý')->count();
        $donhangthanhcong = donhang::where('trangThai', '=', 'Đã xác nhận')->count();
        $doanhthuthang = DB::table('donhang')
        ->where('trangThai', '=', 'Đã xác nhận')
        ->selectRaw('DATE_FORMAT(ngayDH, "%m-%Y") AS month, sum(tongTien) AS total')
        ->groupByRaw('Month(ngayDH)')
        ->orderBy('month','DESC')
        ->first();
        $doanhthuthangs = DB::table('donhang')
        ->where('trangThai', '=', 'Đã xác nhận')
        ->selectRaw('DATE_FORMAT(ngayDH, "%m-%Y") AS month, sum(tongTien) AS total')
        ->groupByRaw('Month(ngayDH)')->get();
        $sachhet = sach::where('soLuong', '<=', '10')->count();
        return view(
            'admin.dashboard',
            [
                'user' => $adminUser,
                'sachhet' => $sachhet,
                'donhangcho' => $donhangcho,
                'donhangthanhcong' => $donhangthanhcong,
                'doanhthuthang' => $doanhthuthang,
                'doanhthuthangs' => $doanhthuthangs,
                'revenueChart' => $revenueChart,
                'orderChart' => $orderChart,
            ]
        );
    }

    public function logOut()
    {
        Auth::guard('nhanvien')->logout();
        alert('Đăng xuất thành công','','success');
        return redirect('login');
    }
}
