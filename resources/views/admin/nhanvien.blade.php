@extends('adminmaster')
@section('title')
<title>Quản Lý Nhân Viên</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">QUẢN LÝ NHÂN VIÊN</h3>
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
                                <div class="add-nhanvien">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success mr-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm Nhân Viên" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm Nhân Viên</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form action="{{ Route('admin.storenhanvien') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="name">Tên Nhân Viên</label>
                                                            <input name="hoTenNV" type="text" class="form-control" value="{{ old('hoTenNV') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Email</label>
                                                            <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Địa Chỉ</label>
                                                            <input name="diaChiNV" type="text" class="form-control" value="{{ old('diaChiNV') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Số Điện Thoại</label>
                                                            <input name="sdtNV" type="number" class="form-control" value="{{ old('sdtNV') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Lương</label>
                                                            <input name="luongNV" type="number" class="form-control" value="{{ old('luongNV') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Hình</label>
                                                            <input name="hinhNV" type="file" class="form-control"  required>
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
                                    <th>TÊN NHÂN VIÊN</th>
                                    <th>EMAIL</th>
                                    <th>ĐỊA CHỈ</th>
                                    <th>SỐ ĐIỆN THOẠI</th>
                                    <th>LƯƠNG</th>
                                    <th>HÌNH</th>
                                    <th>THÊM TÀI KHOẢN</th>
                                    <th>SỬA</th>
                                    <th>XÓA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $nhanviens as $nhanvien)
                                <tr>
                                    <td>{{ $nhanvien->id }}</td>
                                    <td>{{ $nhanvien->hoTenNV }}</td>
                                    <td>{{ $nhanvien->email }}</td>
                                    <td>{{ $nhanvien->diaChiNV }}</td>
                                    <td>{{ $nhanvien->sdtNV }}</td>
                                    <td>{{ number_format($nhanvien->luongNV) }}đ</td>
                                    <td> <img src="/storage/nhanvien/{{ $nhanvien->hinhNV }}" alt="avt" style="max-width:100px;"></td>
                                    <td>
                                        <a href="{{ Route('nhanvien.getaddtk',$nhanvien->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm tài khoản">
                                                <i class="fas fa-user"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Route('nhanvien.getedit',$nhanvien->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa thông tin">
                                                <i class="fas fa-edit"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Route('admin.deletenhanvien',$nhanvien->id) }}" onclick="return confirm('Bạn có chắc là muốn xóa nhân viên này không?')"> <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
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
                            {!! $nhanviens->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.card -->
@endsection('content')