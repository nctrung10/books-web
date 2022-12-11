@extends('adminmaster')
@section('title')
<title>Khuyến Mãi</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">QUẢN LÝ KHUYỄN MÃI</h3>
                    </div>
                    <!-- THÊM LOẠI SÁCH -->
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
                        <div class="col">
                            <div class="row justify-content-end">
                                <div class="add-khuyenmai">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success mr-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm Khuyến Mãi" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm Khuyến Mãi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form action="{{ Route('admin.storekhuyenmai') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="name">Tên Khuyến Mãi</label>
                                                            <input name="tenKM" type="text" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Mô Tả Khuyến Mãi</label>
                                                            <textarea name="moTaKM" class="form-control" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Mã Khuyến Mãi</label>
                                                            <input name="code" type="text" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Hình Thức</label>
                                                            <select name="hinhThuc" class="form-control">
                                                                <option value="0">Khuyến mãi theo %</option>
                                                                <option value="1">Khuyến mãi theo tiền</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Giá Trị</label>
                                                            <input name="giaTri" type="number" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Số Lượng</label>
                                                            <input name="soLuong" type="number" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Ngày Bắt Đầu</label>
                                                            <input name="ngayBatDau" type="date" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Ngày Kết Thúc</label>
                                                            <input name="ngayKetThuc" type="date" class="form-control" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TÊN KHUYẾN MÃI</th>
                                    <th>MÃ KHUYẾN MÃI</th>
                                    <th>HÌNH THỨC</th>
                                    <th>GIÁ TRỊ</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>NGÀY BẮT ĐẦU</th>
                                    <th>NGÀY KẾT THÚC</th>
                                    <th>SỬA</th>
                                    <th>XÓA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $khuyenmais as $khuyenmai)
                                <tr>
                                    <td>{{ $khuyenmai->id }}</td>
                                    <td>{{ $khuyenmai->tenKM }}</td>
                                    <td>{{ $khuyenmai->code }}</td>
                                    <td>
                                        @if( $khuyenmai->hinhThuc == 0 )
                                        Khuyến mãi theo %
                                        @else
                                        Khuyến mãi theo tiền
                                        @endif
                                    </td>
                                    <td>
                                        @if( $khuyenmai->hinhThuc == 0 )
                                        Giảm {{ $khuyenmai->giaTri }} %
                                        @else
                                        Giảm {{ number_format( $khuyenmai->giaTri )}} đ
                                        @endif
                                    </td>
                                    <td>{{ $khuyenmai->soLuong }}</td>
                                    <td>{{ date('d/m/Y',strtotime($khuyenmai->ngayBatDau)) }}</td>
                                    <td>{{ date('d/m/Y',strtotime($khuyenmai->ngayKetThuc))  }}</td>
                                    <td>
                                        <a href=""><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa thông tin">
                                                <i class="fas fa-edit"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" onclick="return confirm('Bạn có chắc là muốn xóa khuyến mãi này không?')"> <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
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
                    <div class="card-footer">
                        <div class="row  justify-content-end">
                            {!! $khuyenmais->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card -->

@endsection('content')