@extends('adminmaster')
@section('title')
<title>THÊM DANH MỤC SẢN PHẨM</title>

@endsection('title')


@section('content')
<?php
/*  foreach($loaisachs as $loaisach){
        dd($loaisachs->tenLoai); exit; 
    } */
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">THÊM DANH MỤC SẢN PHẨM</h3>
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
                        <form action="{{ Route('admin.storedanhmuc') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên Danh Mục</label>
                                <input name="tenDM" type="text" class="form-control" value="{{ old('tenDM') }}" required>
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
                            <div class="form-group">
                                <label for="name">Danh Mục Cha</label>
                                <select class="form-control" name="parent_id" id="">
                                    <?php echo showDanhmucs($danhmucs) ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Mô Tả</label>
                                <textarea class="form-control" name="moTa"  require>{{ old('moTa') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Trạng Thái</label>
                                <select class="form-control" name="trangThai" id="">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiện</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                            <a href="{{ Route('admin.danhmucsanpham') }}"><input type="button" class="btn btn-secondary" value="Trở về"></a>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card -->

@endsection('content')