@extends('master')
@section('title')
<title>Quên mật khẩu</title>
@endsection

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 offset-md-4">
                <div class="form my-5 border border-1 bg-light" style="
                border-radius: 5px;
            box-shadow:
                0 2.8px 2.2px rgba(0, 0, 0, 0.034),
                0 6.7px 5.3px rgba(0, 0, 0, 0.048),
                0 12.5px 10px rgba(0, 0, 0, 0.06),
                0 22.3px 17.9px rgba(0, 0, 0, 0.072),
                0 41.8px 33.4px rgba(0, 0, 0, 0.086),
                0 100px 80px rgba(0, 0, 0, 0.12)">
                    <h3 class="text-center mt-5">QUÊN MẬT KHẨU</h3>
                    <form action="{{ Route('khachhang.postquenmatkhau') }}" class="mx-3" method="POST">
                    @csrf
                        <label for="email my-2">EMAIL</label>
                        <input type="email" name="fg_email"  class="form-control my-2 " placeholder="Email" required>
                        <button class="form-control btn btn-primary my-2" style="max-width: 100px;">Gửi email</button>
                    </form>
                    <div class="mx-3 my-1">
                        <small>Chưa có tài khoản?</small> &nbsp; <a href="{{ Route('khachhang.dangky') }}">Đăng ký ngay</a><br>
                        <small>Đã có tài khoản?</small> &nbsp; <a href="">Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection