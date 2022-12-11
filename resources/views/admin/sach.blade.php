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
                        <h3 class="card-title">QUẢN LÝ SÁCH</h3>
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
                                <div class="add-sach">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success mr-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm Sách" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm Sách</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form action="{{ Route('admin.storesach') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="name">Tên sản phẩm</label>
                                                            <input name="tenSach" type="text" class="form-control" value="{{ old('tenSach') }}" required>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <?php
                                                                function showDanhmucs($danhmucs, $parent_id = 0, $char = '')
                                                                {
                                                                    foreach ($danhmucs as $key => $item) {

                                                                        // Nếu là chuyên mục con thì hiển thị

                                                                        if ($item['parent_id'] == $parent_id) {

                                                                            echo '<option value="' . $item['id'] . '">';

                                                                            echo $char . $item['tenDM'];

                                                                            echo '</option>';

                                                                            // Xóa chuyên mục đã lặp

                                                                            unset($danhmucs[$key]);
                                                                            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                                                                            showDanhmucs($danhmucs, $item['id'], $char . '|---');
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                <label for="name">Danh Mục Sản Phẩm</label>
                                                                <select class="form-control" name="id_DM" id="">
                                                                    <?php echo showDanhmucs($danhmucs) ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="name">Loại sách</label>
                                                                <select name="loaisach" class="form-control">
                                                                    @foreach($loaisachs as $loaisach)
                                                                    <option value="{{ $loaisach->id}}"> {{ $loaisach->tenLoai}} </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="name">Ngôn ngữ</label>
                                                                <select name="ngonNgu" class="form-control">
                                                                    @foreach($NNs as $NN)
                                                                    <option value="{{ $NN->id}}"> {{ $NN->tenNN}} </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Tác giả</label>
                                                            <input name="tacGia" type="text" class="form-control" value="{{ old('tacGia') }}" required>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="name">Nhà xuất bản</label>
                                                                <select name="NXB" class="form-control">
                                                                    @foreach($NXBs as $NXB)
                                                                    <option value="{{ $NXB->id}}"> {{ $NXB->tenNXB}} </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="name">Ngày sản xuất</label>
                                                                <input name="ngaySanXuat" type="date" class="form-control" value="{{ old('ngaySanXuat') }}"  required>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group  col-md-4">
                                                                <label for="name">Kích thước</label>
                                                                <input name="kichThuoc" type="text" class="form-control" value="{{ old('kichThuoc') }}" required>
                                                            </div>
                                                            <div class="form-group  col-md-4">
                                                                <label for="name">Số trang</label>
                                                                <input name="soTrang" type="number" min="1" class="form-control" value="{{ old('soTrang') }}" required>
                                                            </div>
                                                            <div class="form-group  col-md-4">
                                                                <label for="name">Số lượng </label>
                                                                <input name="soLuong" type="number"  min="1" class="form-control" value="{{ old('soLuong') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="name">Giá Bìa</label>
                                                                <input name="giaBia" type="number"  min="1000" class="form-control" value="{{ old('giaBia') }}" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="name">Giá Bán</label>
                                                                <input name="giaBan" type="number"  min="1000" class="form-control" value="{{ old('giaBan') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Hình </label>
                                                            <input name="hinh" type="file" class="form-control" value="{{ old('hinh') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Mô tả</label>
                                                            <textarea class="form-control" name="moTa" id="editor1" value="{{ old('moTa') }}" required></textarea>
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
                                    <th>Tên Sách</th>
                                    <th>Loại Sách</th>
                                    <th>Tác Giả</th>
                                    <th>Nhà Xuất Bản</th>
                                    <th>Giá Bìa</th>
                                    <th>Giá Bán</th>
                                    <th>Số Lượng</th>
                                    <th>Hình</th>
                                    <th>Thêm Hình</th>
                                    <th>Xem Chi Tiết</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $sachs as $sach)
                                <tr>
                                    <td>{{ $sach->id }}</td>
                                    <td>{{ $sach->tenSach }}</td>
                                    <td>{{ $sach->tenLoai }}</td>
                                    <td>{{ $sach->tacGia }}</td>
                                    <td>{{ $sach->tenNXB }}</td>
                                    <td>{{ number_format($sach->giaBia) }}</td>
                                    <td>{{ number_format($sach->giaBan) }}</td>
                                    <td>{{ $sach->soLuong }}</td>
                                    <td>
                                        <div class="content_zoom">
                                            <a data-fancybox="gallery" href="/storage/product/{{ $sach->hinh }}" data-caption="{{ $sach->tenSach }}"><img src="/storage/product/{{ $sach->hinh }}" alt="hinhSach" style="max-width: 100px"></a>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ Route('sach.gethinhsach',$sach->id) }}">
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm hình">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Route('sach.getdetail',$sach->id) }}">
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xem chi tiết">
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Route('sach.getedit',$sach->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa thông tin">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Route('admin.deletesach',$sach->id) }}" onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"> <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
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
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card -->

@endsection('content')