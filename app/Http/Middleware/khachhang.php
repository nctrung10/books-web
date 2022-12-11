<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class khachhang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('khachhang')->check()) {
            return $next($request);
        } else {
            alert()->html('Vui lòng đăng nhập trước khi thanh toán'," Bạn có thể
            <a href='' data-bs-toggle='modal' data-bs-target='#exampleModal'><u>ĐĂNG NHẬP NGAY</u></a> tại đây",'warning');
            return redirect()->route('khachhang.giohang');
        }
    }
}
