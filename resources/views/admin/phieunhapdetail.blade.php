@extends('adminmaster')
@section('title')
<title>Chi Tiết hiếu Nhập</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">CHI TIẾT PHIẾU NHẬP</h3>
                    </div>
                    <div class="row  m-2">
                        <div class="col">
                            <!-- HIỂN THỊ THÔNG BÁO -->
                            <div class="thong-bao">
                                @if ( Session::has('success') )
                                <div class="alert alert-success alert-dismissible text-center" role="alert">
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>
                                @endif
                                <?php //Hiển thị thông báo lỗi
                                ?>
                                @if ( Session::has('error') )
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="invoice-body ">
                            <div class="container content-invoice p-2">
                                <div class="row">
                                    <div class="col-md-12 describe-invoice d-flex">
                                        <div class="col-md-3">
                                            <div class="logo-invoice text-start">
                                                <img src="/logo.png">
                                                <span>TTD Book Store</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12 col-sm-12">
                                            <h4 class="text-uppercase text-center py-3 mb-0">Chi tiết phiếu nhập</h4>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-seller text-end">
                                                <p>19004399</p>
                                                <p>ttd99@gmail.com</p>
                                                <p>3/2 Ninh Kiều, Cần Thơ, Việt Nam</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="main-invoice-info">
                                            <ul class="p-2 m-0">
                                                <li>
                                                    <span class="title-mii">Mã phiếu</span>
                                                    #<span>{{ $phieunhaps->id }}</span>
                                                </li>
                                                <li>
                                                    <span class="title-mii">Ngày lập:</span>
                                                    <span>{{ date('d-m-Y',strtotime($phieunhaps->created_at)) }}</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="info-customer my-4">
                                            <h5 class="text-uppercase">Nhân viên nhập</h5>
                                            <div class="text-capitalize">
                                                {{ $phieunhaps->hoTenNV }}
                                            </div>
                                            <div>
                                            {{ $phieunhaps->email }}
                                            </div>
                                            <div>
                                            {{ $phieunhaps->sdtNV }}
                                            </div>
                                            <div class="text-capitalize">
                                            {{ $phieunhaps->diaChiNV }}
                                            </div>
                                        </div>

                                        <div class="info-order mt-4">
                                            <h5 class="text-uppercase">Thông tin đơn hàng</h5>
                                            <table class="table table-ordered-product">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sản Phẩm</th>
                                                        <th scope="col">Số lượng tồn</th>
                                                        <th scope="col">Số lượng nhập</th>
                                                        <th scope="col" class="text-end">Giá nhập</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="info-ordered-product">
                                                <?php 
                                                    $total = 0;

                                                ?>
                                                    @foreach($chitietphieunhaps as $row)
                                                    <tr>
                                                        <td>{{ $row->tenSach }}</td>
                                                        <td>{{ ($row->soLuongTon) - ($row->soLuong)   }}</td>
                                                         <td>{{ $row->soLuong   }}</td>
                                                        <td class="text-end">{{ number_format($row->donGia ) }}đ</td>
                                                    </tr>
                                                <?php  $total  +=  $row->soLuong * $row->donGia   ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="total-invoice">
                                                <div class="general-price-custom">
                                                    Tạm tính
                                                    <span class="price-custom">{{ number_format($total ) }}đ</span>
                                                </div>
                                                <div class="general-price-custom">
                                                    Phí vận chuyển
                                                    <span class="price-custom">0đ</span>
                                                </div>
                                                <div class="general-price-custom">
                                                    Giảm giá
                                                    <span class="price-custom">0đ</span>
                                                </div>
                                                <div class="general-price-custom">
                                                    Tổng tiền
                                                    <span class="price-custom total">{{ number_format($total ) }}đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card -->

@endsection('content')