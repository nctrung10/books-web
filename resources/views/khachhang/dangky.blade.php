@extends('master')
@section('title')
<title>Đăng ký | TTD</title>
@endsection

@section('content')
<!-- Breadcrumb -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section>
    <div class="container mx-auto">
        <div class="row">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <div class="col-12">
                    <ul class="breadcrumb mt-2">
                        <li class="breadcrumb-item">
                            <a href="{{ Route('khachhang.trangchu') }}" class="home-page">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item">Tạo tài khoản mới</li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</section>
<!-- Main Content -->
<!-- HIỂN THỊ THÔNG BÁO -->
<div class="container bg-white pt-3 mb-5">
    <h5 class="text-uppercase">Tạo tài khoản</h5>
    <hr>
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-6">
            <form method="POST" action="{{ Route('khachhang.dangkytk') }}">
                @csrf
                <h5 class="text-md-start">Điền thông tin cá nhân</h5>
                <br>
                <div class="form-group mb-3">
                    <label class="lb-name" for="hoten">Họ tên</label><span style="color: red;">*</span>
                    <input class="form-control" id="ht_dky" name="hoTenKH" type="text" required>
                </div>
                <div class="form-group mb-3">
                    <label class="lb-name" for="sdt">Số điện thoại</label><span style="color: red;">*</span>
                    <input class="form-control" id="sdt_dky" name="sdtKH" type="number" min="1" required>
                </div>
                <div class="form-group mb-3">
                    <label class="lb-name" for="ngaysinh">Ngày sinh</label><span style="color: red;">*</span>
                    <input class="form-control" id="ngaysinh_dky" name="ngaySinh" type="date" required>
                </div>
                <div class="form-group d-flex mb-3">
                    <label class="lb-name">Giới tính:</label>
                    <div class="form-check px-2">
                        <input class="form-check-input mx-1" value="Nam" type="radio" name="gioiTinhKH" id="flexRadioDefault1" checked="selected">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Nam
                        </label>
                    </div>
                    <div class="form-check px-2">
                        <input class="form-check-input mx-1" value="Nữ" type="radio" name="gioiTinhKH" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Nữ
                        </label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="lb-name" for="dc">Địa chỉ</label><span style="color: red;">*</span>
                    <input class="form-control" id="dc_dky" name="diaChiKH" type="text" required>
                </div>
                <div class="form-group mb-3">
                    <label class="lb-name" for="email">Email</label><span style="color: red;">*</span>
                    <input class="form-control" id="email_dky" name="emailKH" type="email" required>
                </div>
                <div class="form-group mb-3">
                    <label class="lb-name" for="mk">Mật khẩu</label><span style="color: red;">*</span>
                    <input class="form-control" id="mk-dky" name="matkhau" type="password" required>
                </div>
                <div class="form-group mb-4">
                    <label class="lb-name" for="mk2">Nhập lại mật khẩu</label><span style="color: red;">*</span>
                    <input class="form-control" id="mk2" name="xacnhan" type="password" required>
                </div>
                <div class="form-group">
                    <input class="form-control" id="dky" type="submit" value="TẠO TÀI KHOẢN">
                </div>
            </form>
            <div class="form-group my-4">
                Bạn đã có tài khoản? Vui lòng
                <a class="badge bg-dark" href="#" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Đăng nhập
                </a>
                @include('khachhang.dangnhap')
            </div>
        </div>
    </div>
</div>
@endsection