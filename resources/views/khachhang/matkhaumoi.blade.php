@extends('master')
@section('title')
<title>Mật Khẩu Mới</title>
@endsection

@section('content')

<section>
@php 
    $email = $_GET['email'];
    $token = $_GET['token'];
@endphp
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
                    <h3 class="text-center mt-5">MẬT KHẨU MỚI</h3>
                    <form action="{{ Route('khachhang.newpass') }}" class="mx-3" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{$email}}" >
                    <input type="hidden" name="token" value="{{$token}}" >
                        <label for="password my-2">NHẬP PASSWORD MỚI</label>
                        <input type="password" name="password"  class="form-control my-2 " placeholder="Nhập password" required>
                        <label for="password my-2">NHẬP LẠI PASSWORD</label>
                        <input type="password" name="cf_password"  class="form-control my-2 " placeholder="Nhập lại password" required>
                        <div class="text-center">
                        </div>
                        <button class="form-control btn btn-primary my-2" style="max-width: 100px;">Đồng ý</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection