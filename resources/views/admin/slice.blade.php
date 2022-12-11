@extends('adminmaster')
@section('title')
<title>Slide</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">QUẢN LÝ SLIDE</h3>
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
                                <div class="add-slice">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success mr-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm Slide" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm Slide</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form action="{{ Route('admin.storeslice') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="name">Tên slide</label>
                                                            <input name="tenSlice" type="text" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Mô tả</label>
                                                            <textarea name="moTa" class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Hình</label>
                                                            <input name="hinh" type="file" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Vị trí</label>
                                                            <select name="viTri" class="form-control">
                                                                <option value="1">Trái</option>
                                                                <option value="2">Phải</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Trạng thái</label>
                                                            <select name="trangThai" class="form-control">
                                                                <option value="0">Ẩn</option>
                                                                <option value="1">Hiện</option>
                                                            </select>
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
                                    <th>TÊN SLIDE</th>
                                    <th>MÔ TẢ</th>
                                    <th>HÌNH</th>
                                    <th>VỊ TRÍ</th>
                                    <th>TRẠNG THÁI</th>
                                    <th>SỬA</th>
                                    <th>XÓA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slices as $slice)
                                <tr>
                                    <td>{{ $slice->id }}</td>
                                    <td>{{ $slice->tenSlice }}</td>
                                    <td>{{ $slice->moTa }}</td>
                                    <td> <img src="/storage/slice/{{ $slice->hinh }}" alt="slice" style="max-width: 100px;"></td>
                                    <td>
                                        @if($slice->viTri == 1)
                                        Trái
                                        @else
                                        Phải
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $slice->trangThai == 0)
                                        <form action="{{ Route('slice.edithien',$slice->id) }}" method="POST">
                                            @csrf
                                            @method('post')
                                            <button class="btn btn-outline-light" type="submit"><i class="fas fa-thumbs-down" style="color : red; font-size:30px"></i></button>
                                        </form>
                                        @else
                                        <form action="{{ Route('slice.editan',$slice->id) }}" method="POST">
                                            @csrf
                                            @method('post')
                                            <button class="btn btn-outline-light" type="submit"><i class="fas fa-thumbs-up" style="color : green; font-size:30px"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ Route('slice.getedit',$slice->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa thông tin">
                                                <i class="fas fa-edit"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Route('admin.deleteslice',$slice->id) }}" onclick="return confirm('Bạn có chắc là muốn xóa slide này không?')"> <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
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
                            {!! $slices->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card -->

@endsection('content')