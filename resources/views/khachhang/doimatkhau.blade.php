@extends('master')
@section('title')
<title>Tài khoản của tôi | TTD</title>
@endsection

@section('content')
<!-- Breadcrumb -->
<section>
    <div class="container mx-auto">
        <div class="row">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <div class="col-12">
                    <ul class="breadcrumb mt-2">
                        <li class="breadcrumb-item">
                            <a href="{{ Route('khachhang.trangchu') }}" class="back-cart">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item">Tài khoản của tôi</li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</section>
<!-- Main Content -->
<div class="maincontent">
    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar-ttkh">
                <div class="top-infor">
                    <div class="name-ttkh">
                        Xin chào
                        <b>{{ $user->hoTenKH }}</b>
                    </div>
                </div>
                <div class="sidebar-menu-ttkh">
                    <div class="sidebar-item">
                        <a class="py-2" href="{{ Route('khachhang.ttcanhan') }}">
                            <i class="fas fa-user icon-ttkh"></i>
                            <span>Thông tin khách hàng</span>
                        </a>
                    </div>
                    <div class="sidebar-item">
                        <a class="py-2" href="{{ Route('khachhang.lichsudonhang') }}">
                            <i class="fas fa-file-invoice icon-ttkh"></i>
                            <span>Lịch sử đơn hàng</span>
                        </a>
                    </div>
                    <div class="sidebar-item">
                        <a class="py-2" href="{{ Route('khachhang.doimatkhau') }}">
                            <i class="fas fa-unlock-alt icon-ttkh"></i>
                            <span>Thay đổi mật khẩu</span>

                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9 content-ttkh">
                <div class="inner-ttkh">
                    <form method="POST" action="{{ Route('khachhang.updatepw') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <h3 class="title-inner-ttkh">Thay đổi mật khẩu</h3>
                        <div class="main-info-ttkh">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mkc_ttkh ">Mật khẩu cũ</label>
                                <div class="col-sm-6">
                                    <input type="password" placeholder="Nhập mật khẩu cũ" class="form-control" id="mkc_ttkh" name="matkhaucu" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mkm_ttkh">Mật khẩu mới</label>
                                <div class="col-sm-6">
                                    <input type="password" placeholder="Mật khẩu từ 6 đến 32 ký tự" class="form-control" id="mkm_ttkh" name="matkhau" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="xnmk_ttkh">Nhập lại mật khẩu</label>
                                <div class="col-sm-6">
                                    <input type="password" placeholder="Nhập lại mật khẩu mới" class="form-control" id="xnmk_ttkh" name="xacnhan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2"></label>
                                <div class="col-sm-6">
                                    <input type="submit" class="btn btn-warning btn-update-ttkh" value="Cập Nhật">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="inner-ttkh">
                    <form method="POST" action="">
                        <h3 class="title-inner-ttkh">Địa chỉ của tôi</h3>
                        <div class="user-info-ttkh">
                            <div class="show-info-address mb-4">
                                <div class="name mb-2 d-flex">
                                    <span style="font-weight: bold; text-transform: capitalize;">Nguyễn chí trung</span>
                                    <span class="ms-3" style="font-weight: normal; color: #26bc4e">
                                        <i class="fas fa-check-circle"></i>
                                        Địa chỉ mặc định
                                    </span>
                                </div>
                                <div class="address d-flex">
                                    <span class="pe-1" style="color: rgb(155, 155, 155);">Địa chỉ:</span>
                                    <span>Đường Lê Lai, Ninh Kiều, Cần Thơ</span>
                                </div>
                                <div class="phone d-flex">
                                    <span class="pe-1" style="color: rgb(155, 155, 155);">Điện thoại:</span>
                                    <span>0932842351</span>
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-4">Thay đổi địa chỉ</h5>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mkc_ttkh">Họ & Tên</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="ht_ttkh" name="hoten">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mkm_ttkh">Số điện thoại</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="sdt_ttkh" name="sdt">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="xnmk_ttkh">Địa chỉ</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="dc_ttkh" name="diachi">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2"></label>
                                <div class="col-sm-6">
                                    <input type="submit" class="btn btn-warning btn-update-ttkh" value="Cập Nhật">
                                </div>
                            </div>
                        </div>
                    </form>
                </div> -->
            </div>
        </div>
    </div>
</div>
</div>
@endsection