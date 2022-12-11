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
                <article>
                    <div class="inner-ttkh">
                        <h3 class="title-inner-ttkh">Lịch sử đơn hàng</h3>
                        @if(count($donhangs) == 0)
                        <div class="inner-ttkh">
                            <form method="" action="">
                                <div class="main-info-ttkh text-center">
                                    <img src="{{ asset('lsdh.png ')}}" style="width:180px;">
                                    <div class="pb-3">
                                        <span>Bạn chưa có đơn hàng nào</span>
                                    </div>
                                    <a href="{{ Route('khachhang.trangchu') }}" class="btn btn-warning btn-update-ttkh pt-2">Tiếp tục mua hàng</a>
                                </div>
                            </form>
                        </div>
                        @else
                        @foreach($donhangs as $key => $donhang)
                        <form method="POST" action="">
                            <div class="main-info-ttkh order-history">
                                <h5 class="text-center">CHI TIẾT ĐƠN HÀNG</h5>
                                <div>
                                    <span class="fw-bold">Đơn hàng </span>
                                    #<span>{{ $donhang->id}}</span>
                                </div>
                                <div>
                                    <span class="fw-bold">Ngày:</span>
                                    <span>{{ date('d-m-Y', strtotime($donhang->ngayDH)) }}</span>
                                </div>
                                <div>
                                    <span class="fw-bold">Trạng thái đơn hàng:</span>
                                    @if( $donhang->trangThai == "Đã xác nhận")
                                    <span class="badge bg-success status-order"> {{ $donhang->trangThai }}</span>
                                    @elseif( $donhang->trangThai == "Đang chờ xử lý")
                                    <span class="badge bg-warning status-order "> {{ $donhang->trangThai }}</span>
                                    @elseif( $donhang->trangThai == "Hủy")
                                    <span class="badge bg-danger status-order "> {{ $donhang->trangThai }}</span>
                                    @elseif( $donhang->trangThai == "Hoàn trả")
                                    <span class="badge bg-dark status-order "> {{ $donhang->trangThai }}</span>
                                    @endif
                                </div>

                                <table class="table table-responsive table-bordered table-order-history">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sản Phẩm</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col" class="text-end">Giá thành</th>
                                        </tr>
                                    </thead>
                                    <tbody class="info-ordered-product">
                                        @php
                                        $id = $donhang->id;
                                        $chitietdonhangs = DB::table('chitietdonhang')
                                        ->join('sach', 'chitietdonhang.id_Sach', '=', 'sach.id')
                                        ->select('sach.tenSach', 'sach.giaBan', 'sach.soLuong as soLuongTon', 'chitietdonhang.*')
                                        ->where('chitietdonhang.id_DH', '=', $id)->get();
                                        @endphp
                                        @foreach($chitietdonhangs as $key => $row)
                                        <tr>
                                            <td>{{$row->tenSach}}</td>
                                            <td>{{$row->soLuong}}</td>
                                            <td class="text-end">{{ number_format($row->donGia) }}đ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="text-end">Tạm tính</td>
                                            <td class="text-end">{{ number_format(($donhang->giamGia) + ($donhang->tongTien)) }}đ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end">Vận chuyển</td>
                                            <td class="text-end">0đ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end">Giảm giá</td>
                                            <td class="text-end">{{ number_format($donhang->giamGia) }}đ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end fw-bold">Tổng</td>
                                            <td class="text-end fw-bold">{{ number_format($donhang->tongTien) }}đ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        @endforeach
                        <div class="bg-light my-2">
                            <div style="float:right;">
                                {{ $donhangs->links() }}
                            </div>
                        </div>
                        @endif
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
</div>

@endsection