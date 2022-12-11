@extends('adminmaster')
@section('title')
<title>Chi Tiết Đơn Hàng</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">CHI TIẾT ĐƠN HÀNG</h3>
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
                        <div class="invoice-body">
                            <div class="container content-invoice p-2">
                                <div class="row">
                                    <div class="col-md-12 describe-invoice d-flex">
                                        <div class="col-md-3">
                                            <div class="logo-invoice text-start">
                                                <img src=" {{ asset('/logo.png') }}" style="max-width: 60px;">
                                                <span>TTD Book Store</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12 col-sm-12">
                                            <h4 class="text-uppercase text-center py-3 mb-0">chi tiết đơn hàng</h4>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-seller text-right">
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
                                                    <span class="title-mii">Đơn hàng:</span>
                                                    #<span>{{ $donhang->id }}</span>
                                                </li>
                                                <li>
                                                    <span class="title-mii">Ngày lập:</span>
                                                    <span>{{ date('d-m-Y',strtotime($donhang->ngayDH )) }}</< /span>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <span class="title-mii">Hình thức thành toán:</span>
                                                    @if($donhang->id_HTTT == 1)
                                                    <span class="badge badge-info">Thanh toán khi nhận hàng</span>
                                                    @else
                                                    <span class="badge badge-success">Online</span>
                                                    @endif
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <span class="title-mii">Trạng thái:</span>
                                                    @if( $donhang->trangThai == "Đã xác nhận")
                                                    <span class="badge bg-success"> {{ $donhang->trangThai }}</span>
                                                    @elseif( $donhang->trangThai == "Đang chờ xử lý")
                                                    <span class="badge bg-warning"> {{ $donhang->trangThai }}</span>
                                                    @elseif( $donhang->trangThai == "Hủy")
                                                    <span class="badge bg-danger"> {{ $donhang->trangThai }}</span>
                                                    @elseif( $donhang->trangThai == "Hoàn trả")
                                                    <span class="badge bg-dark"> {{ $donhang->trangThai }}</span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="info-customer my-4">
                                            <h5 class="text-uppercase">Thông tin người nhận</h5>
                                            <div class="text-capitalize">
                                                <span class="title-mii" style="font-weight: bold;">Họ&Tên:</span>
                                                {{ $donhang->hoTenKH  }}
                                            </div>
                                            <div>
                                                <span class="title-mii" style="font-weight: bold;">Email:</span>
                                                {{ $donhang->email  }}
                                            </div>
                                            <div>
                                                <span class="title-mii" style="font-weight: bold;">Số điện thoại:</span>
                                                {{ $donhang->sdtKH  }}
                                            </div>
                                            <div class="text-capitalize">
                                                <span class="title-mii" style="font-weight: bold;">Địa chỉ:</span>
                                                {{ $donhang->diaChiKH  }}
                                            </div>
                                        </div>

                                        <div class="info-order mt-4">
                                            <h5 class="text-uppercase">Thông tin đơn hàng</h5>
                                            <table class="table table-ordered-product">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sản Phẩm</th>
                                                        <th scope="col">Số lượng</th>
                                                        <th scope="col" class="text-end">Giá thành</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="info-ordered-product">
                                                    @foreach($chitietdonhangs as $row)
                                                    <tr>
                                                        <td>{{$row->tenSach}}</td>
                                                        <td>{{$row->soLuong}}</td>
                                                        <td class="text-end">{{ number_format($row->giaBan) }}đ</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="total-invoice">
                                                <div class="general-price-custom">
                                                    Tạm tính
                                                    <span class="price-custom">{{ number_format(($donhang->giamGia) + ($donhang->tongTien)) }}đ</span>
                                                </div>
                                                <div class="general-price-custom">
                                                    Phí vận chuyển
                                                    <span class="price-custom">0đ</span>
                                                </div>
                                                <div class="general-price-custom">
                                                    Giảm giá
                                                    <span class="price-custom">{{ number_format($donhang->giamGia) }}đ</span>
                                                </div>
                                                <div class="general-price-custom">
                                                    Tổng tiền
                                                    <span class="price-custom total">{{ number_format($donhang->tongTien) }}đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <form action="{{ Route('admin.statusdonhang',$donhang->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                @foreach($chitietdonhangs as $row)
                                <input name="id[]" type="hidden" value="{{$row->id_Sach}}">
                                <input name="soLuongTon[]" type="hidden" value="{{$row->soLuongTon}}">
                                <input name="soLuong[]" type="hidden" value="{{$row->soLuong}}">
                                @endforeach
                                <div class="col-auto">
                                    <label for="trangThai my-1">Thay đổi trạng thái:</label>
                                </div>
                                <div class="col-auto">
                                    <select name="trangThai" class="form-control" id="">
                                        <option value="Đang chờ xử lý">Đang chờ xử lý</option>
                                        <option value="Đã xác nhận">Đã xác nhận</option>
                                        <option value="Hoàn trả">Hoàn trả</option>
                                        <option value="Hủy">Hủy</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button class="form-control btn btn-primary" type="submit">Thay đổi</button>
                                </div>
                                <div class="col">
                                    <a href="{{ Route('admin.donhang') }}"><button type="button" class="form-control btn btn-secondary" style="width:100px; float:right;">Trở về</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card -->

@endsection('content')