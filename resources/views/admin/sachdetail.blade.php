@extends('adminmaster')
@section('title')
<title>Xem Chi Tiết</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">XEM CHI TIẾT</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="product-info">
                            <div class="container all-content">
                                @foreach($sachs as $sach)
                                <div class="row">
                                    <div class="col-md-3 product-img">
                                        <div class="float-left">
                                            <img src="/storage/product/{{ $sach->hinh }}" style="max-width: 300px;">
                                        </div>
                                    </div>
                                    <div class="col-md-4 product-content">
                                        <div class="float-left">
                                            <p class="product-title text-capitalize">
                                                {{ $sach->tenSach }}
                                            </p>
                                            <div class="puslisher mt-4">
                                                Nhà xuất bản:
                                                <b>{{ $sach->tenNXB }}</b>
                                            </div>
                                            <div class="author mt-1">
                                                Tác giả:
                                                <b>{{ $sach->tacGia }}</b>
                                            </div>
                                            <div class="price my-4">
                                                Giá bìa:
                                                <b>{{ number_format( $sach->giaBia) }}đ</b>
                                            </div>
                                            <div class="price my-4">
                                                Giá bán:
                                                <b>{{ number_format( $sach->giaBan) }}đ</b>
                                            </div>
                                            <p class="quantity">
                                                Số lượng hiện tại:
                                                <b>{{ $sach->soLuong }}</b>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-5 product-detail float-right">
                                        <div class="card mb-3">
                                            <h5 class="pt-3 pl-3 pr-3">
                                                Thông tin chi tiết
                                            </h5>
                                            <div class="card-body">
                                                <table class="table table-striped table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="detail">Mã sách</td>
                                                            <td>{{ $sach->id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="detail">Tên Loại</td>
                                                            <td>{{ $sach->tenLoai }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="detail">Tác giả</td>
                                                            <td>{{ $sach->tacGia }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="detail">NXB</td>
                                                            <td>{{ $sach->tenNXB }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="detail">Ngày xuất bản</td>
                                                            <td>{{ $sach->ngaySanXuat }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="detail">Ngôn ngữ</td>
                                                            <td>{{ $sach->tenNN }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="detail">Kích thước</td>
                                                            <td>{{ $sach->kichThuoc }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="detail">Số trang</td>
                                                            <td>{{ $sach->soTrang }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container describe-product">
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                                                <div class="card mb-3">
                                                    <div class="card-header text-uppercase">
                                                        Mô tả sản phẩm
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="card-text book-content">
                                                            <p>
                                                                {{ $sach->moTa }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card-footer text-right">
                    <a href="{{ Route('admin.sach') }}"><input type="button" class="btn btn-secondary" value="Trở về"></a>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- /.card -->

@endsection('content')