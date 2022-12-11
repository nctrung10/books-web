@extends('adminmaster')
@section('title')
<title>SỬA THÔNG TIN</title>

@endsection('title')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">SỬA THÔNG TIN SÁCH</h3>
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
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @foreach($sachs as $key => $sach)
                        <form action="{{ Route('admin.editsach', $sach->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">ID</label>
                                <input name="tenSach" type="text" class="form-control" value="{{ $sach->id}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input name="tenSach" type="text" class="form-control" value="{{ $sach->tenSach}}" required>
                            </div>
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
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="name">Danh Mục Sản Phẩm</label>
                                    <select class="form-control" name="tenDM" id="">
                                        <?php echo showDanhmucs($danhmucs) ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="name">Loại sách</label>
                                    <select name="tenLoai" class="form-control">
                                        @foreach($loaisachs as $loaisach)
                                        @if($loaisach->id==$sach->id_Loai)
                                        <option selected value="{{ $loaisach->id}}">{{ $loaisach->tenLoai}}</option>
                                        @else
                                        <option value="{{ $loaisach->id}}"> {{ $loaisach->tenLoai}} </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="name">Ngôn ngữ</label>
                                    <select name="ngonNgu" class="form-control">
                                        @foreach($NNs as $NN)
                                        @if($NN->id==$sach->id_NN)
                                        <option selected value="{{ $NN->id}}"> {{ $NN->tenNN}} </option>
                                        @else
                                        <option value="{{ $NN->id}}"> {{ $NN->tenNN}} </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="name">Tác giả</label>
                                    <input name="tacGia" type="text" class="form-control" value="{{ $sach->tacGia}}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nhà xuất bản</label>
                                    <select name="NXB" class="form-control">
                                        @foreach($NXBs as $NXB)
                                        @if($NXB->id==$sach->id_NXB)
                                        <option selected value="{{ $NXB->id}}"> {{ $NXB->tenNXB}} </option>
                                        @else
                                        <option value="{{ $NXB->id}}"> {{ $NXB->tenNXB}} </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Ngày xuất bản</label>
                                    <input name="ngaySanXuat" type="date" class="form-control" value="{{ date('Y-m-d',strtotime($sach->ngaySanXuat)) }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Kích thước</label>
                                    <input name="kichThuoc" type="text" class="form-control" value="{{ $sach->kichThuoc}}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Số trang</label>
                                    <input name="soTrang" type="number" class="form-control" value="{{ $sach->soTrang}}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Số lượng </label>
                                    <input name="soLuong" type="number" class="form-control" value="{{ $sach->soLuong}}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Giá Bìa</label>
                                    <input name="giaBia" type="number" class="form-control" value="{{ $sach->giaBia}}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Giá Bán</label>
                                    <input name="giaBan" type="number" class="form-control" value="{{ $sach->giaBan }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Hình </label>
                                <input name="hinh" type="file" class="form-control" required>
                                <img class="mt-2" src="/storage/product/{{ $sach->hinh }}" alt="" style="max-width: 150px;">
                            </div>
                            <div class="form-group">
                                <label for="name">Mô tả</label>
                                <textarea class="form-control" name="moTa" id="" cols="60" rows="5" required>{{ $sach->moTa}}</textarea>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ Route('admin.sach') }}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về</button></a>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </form>
                        @endforeach

                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
</section>

<!-- /.card -->

@endsection('content')