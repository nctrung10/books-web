<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IN HÓA ĐƠN</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('Css/chitietdonhang.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>

<body>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="{{asset('Admin/plugins/jquery/jquery.min.js')}} "></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('Admin/plugins/jquery-ui/jquery-ui.min.js')}} "></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src=" {{ asset('Admin/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src=" {{ asset('Admin/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src=" {{ asset('Admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src=" {{ asset('Admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('Admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('Admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('Admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('Admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('Admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Admin/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('Admin/dist/js/pages/dashboard.js') }}"></script>
</body>

</html>