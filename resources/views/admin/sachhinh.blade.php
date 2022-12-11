@extends('adminmaster')
@section('title')
<title>Sách</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">QUẢN LÝ HÌNH SÁCH</h3>
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
                        <div class="col">
                            <div class="row justify-content-end">
                                <div class="add-sach">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success mr-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm Hình" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm Hình</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form action="{{ Route('admin.storehinhsach') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="name">ID SÁCH: {{ $id_Sach }} </label>
                                                            <input class="form-control" type="hidden" value="{{ $id_Sach }}" name="idSach">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Hình </label>
                                                            <input name="hinhsach[]" type="file" class="form-control" multiple required>
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
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hình</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $hinhsachs as $hinhsach)
                                <tr>
                                    <td>{{ $hinhsach->id }}</td>
                                    <td> <img src="/storage/product/{{ $hinhsach->hinh }}" alt="hinhsach" style="max-width: 100px"> </td>
                                    <td>
                                        <a href=""><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa thông tin">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" onclick="return confirm('Bạn có chắc là muốn xóa hình sản phẩm này không?')"> <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
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
                        <a href="{{ Route('admin.sach') }}"><button type="button" class="form-control btn btn-secondary" style="width:100px; float:right;">Trở về</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card -->

@endsection('content')