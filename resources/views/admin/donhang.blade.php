@extends('adminmaster')
@section('title')
<title>Quản Lý Đơn Hàng</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">QUẢN LÝ ĐƠN HÀNG</h3>
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
                                    <th>IN HÓA ĐƠN</th>
                                    <th>XÓA</th>
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
                                    <td  class="text-center">
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
                                    <td  class="text-center">
                                        <a href="{{ Route('donhang.getchitietdh',$donhang->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xem chi tiết">
                                                <i class="fas fa-info"></i></button>
                                        </a>
                                    </td>
                                    <td  class="text-center">
                                        <a href="{{ Route('donhang.gethoadon',$donhang->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="In hóa đơn">
                                        <i class="fas fa-print"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Route('admin.deletedonhang',$donhang->id) }}" onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')"> <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                 <!--    <div class="card-footer">
                        <div class="row  justify-content-end">
                          
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card -->

@endsection('content')