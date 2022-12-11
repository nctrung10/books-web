@extends('adminmaster')
@section('title')
<title>Giảm Giá</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">QUẢN LÝ GIẢM GIÁ</h3>
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
                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="row justify-content-end">
                                <div class="add-giamgia">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success mr-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm Khuyến Mãi" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm Giảm Giá</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form action="{{ Route('admin.storegiamgia') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="name">Tên giảm giá</label>
                                                            <input name="tenGiamGia" type="text" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Nhóm giảm giá</label>
                                                            <select name="id_DM_GG" class="form-control">
                                                                @foreach($danhmucs as $danhmuc)
                                                                <option value="{{ $danhmuc->id }}">{{ $danhmuc->tenDM }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Giá Trị</label>
                                                            <input name="giaTri" type="number" min='1' max='100' class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Ngày Bắt Đầu</label>
                                                            <input name="ngayBatDau" type="date" class="form-control" min="{{ $now }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Ngày Kết Thúc</label>
                                                            <input name="ngayKetThuc" type="date" class="form-control" min="{{ $now }}" required>
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
                                    <th>TÊN GIẢM GIÁ</th>
                                    <th>NHÓM GIẢM GIÁ</th>
                                    <th>GIÁ TRỊ</th>
                                    <th>NGÀY BẮT ĐẦU</th>
                                    <th>NGÀY KẾT THÚC</th>
                                    <th>SẢN PHẨM</th>
                                    <th>SỬA</th>
                                    <th>XÓA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $giamgias as $giamgia)
                                <tr>
                                    <td>{{ $giamgia->id }}</td>
                                    <td>{{ $giamgia->tenGiamGia }}</td>
                                    <td>{{ $giamgia->id_DM_GG }}</td>
                                    <td>
                                        {{ $giamgia->giaTri }}%
                                    </td>
                                    <td>{{ date('d/m/Y',strtotime($giamgia->ngayBatDau)) }}</td>
                                    <td>{{ date('d/m/Y',strtotime($giamgia->ngayKetThuc))  }}</td>
                                    <td>
                                        <a href="{{ Route('admin.spgiamgia',$giamgia->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Sản phẩm giảm giá">
                                                <i class="fas fa-list text-light"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Route('admin.geteditgiamgia',$giamgia->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa thông tin">
                                                <i class="fas fa-edit"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Route('admin.deletegiamgia',$giamgia->id) }}" onclick="return confirm('Bạn có chắc là muốn xóa giảm giá này không?')"> <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
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
                            {!! $giamgias->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card -->

@endsection('content')