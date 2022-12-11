@extends('adminmaster')
@section('title')
<title>Chi Tiết Khách Hàng</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if($khachhangs->gioiTinhKH == "Nam")
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('/nam.jpg') }}" alt="User profile picture">
                            @else
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('/nu.jpg') }}" alt="User profile picture">
                            @endif
                        </div>
                        <h3 class="profile-username text-center">{{ $khachhangs->hoTenKH }}</h3>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Đơn Hàng Đang Chờ</b> <a class="float-right"> {{ count($dangcho) }} </a>
                            </li>
                            <li class="list-group-item">
                                <b>Đơn Hàng Thành Công</b> <a class="float-right"> {{ count($thanhcong) }} </a>
                            </li>
                            <li class="list-group-item">
                                <b>Đơn Hàng Hủy</b> <a class="float-right"> {{ count($huy) }} </a>
                            </li>
                            <li class="list-group-item">
                                <b>Đơn Hàng Hoàn Trả</b> <a class="float-right"> {{ count($hoantra) }} </a>
                            </li>
                            <li class="list-group-item">
                                <b>Tổng Đơn Hàng</b> <a class="float-right"> {{ count($donhangs) }} </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin khách hàng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-envelope-square mr-1"></i> Email</strong>
                        <p class="text-muted">{{ $khachhangs->email }}</p>
                        <hr>
                        <strong> <i class="fas fa-phone mr-1"></i>Số Điện Thoại</strong>

                        <p class="text-muted">{{ $khachhangs->sdtKH }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Địa Chỉ</strong>

                        <p class="text-muted">{{ $khachhangs->diaChiKH }}</p>
                        <hr>

                        <strong><i class="fas fa-child mr-1"></i> Giới Tính</strong>

                        <p class="text-muted">{{ $khachhangs->gioiTinhKH }}</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        DANH SÁCH ĐƠN HÀNG
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TÊN KHÁCH HÀNG</th>
                                    <th>ĐỊA CHỈ</th>
                                    <th>SỐ ĐIỆN THOẠI</th>
                                    <th>NGÀY ĐẶT HÀNG</th>
                                    <th>TRẠNG THÁI</th>
                                    <th>HÌNH THỨC THANH TOÁN</th>
                                    <th>XEM CHI TIẾT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $donhangs as $donhang)
                                <tr>
                                    <td>{{ $donhang->id }}</td>
                                    <td>{{ $donhang->hoTenKH }}</td>
                                    <td>{{ $donhang->diaChiKH }}</td>
                                    <td>{{ $donhang->sdtKH }}</td>
                                    <td>{{ date('d/m/Y',strtotime($donhang->ngayDH)) }}</td>
                                    <td class="text-center">
                                        @if( $donhang->trangThai == "Đã xác nhận")
                                        <span class="badge badge-success"> {{ $donhang->trangThai }}</span>
                                        @elseif( $donhang->trangThai == "Đang chờ xử lý")
                                        <span class="badge badge-warning"> {{ $donhang->trangThai }}</span>
                                        @elseif( $donhang->trangThai == "Hủy")
                                        <span class="badge badge-danger"> {{ $donhang->trangThai }}</span>
                                        @elseif( $donhang->trangThai == "Hoàn trả")
                                        <span class="badge badge-dark"> {{ $donhang->trangThai }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($donhang->id_HTTT == 1)
                                        <span class="badge badge-info">Thanh toán khi nhận hàng</span>
                                        @else
                                        <span class="badge badge-success">Online</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ Route('donhang.getchitietdh',$donhang->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xem chi tiết">
                                                <i class="fas fa-info"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ Route('admin.khachhang') }}"><button type="button" class="form-control btn btn-secondary" style="width:100px; float:right;">Trở về</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection('content')