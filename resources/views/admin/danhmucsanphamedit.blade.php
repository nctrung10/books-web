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
                        <h3 class="card-title">SỬA DANH MỤC SẢN PHẨM</h3>
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
                        <form action="{{ Route('admin.editdanhmuc',$danhmucs->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">ID</label>
                                <input name="tenDM" type="text" class="form-control" value="{{ $danhmucs->id }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Tên Danh Mục</label>
                                <input name="tenDM" type="text" class="form-control" value="{{ $danhmucs->tenDM }}" required>
                            </div>
                            <?php
                            function showDanhmucs($danhmucdacap, $parent_id = 0, $char = '')
                            {
                                foreach ($danhmucdacap as $key => $item) {

                                    // Nếu là chuyên mục con thì hiển thị

                                    if ($item['parent_id'] == $parent_id) {

                                        echo '<option value="' . $item['id'] . '">';

                                        echo $char . $item['tenDM'];

                                        echo '</option>';

                                        // Xóa chuyên mục đã lặp

                                        unset($danhmucdacap[$key]);
                                        // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                                        showDanhmucs($danhmucdacap, $item['id'], $char . '|---');
                                    }
                                }
                            }
                            ?>
                            <div class="form-group">
                                <label for="name">Danh Mục Cha</label>
                                <select class="form-control" name="parent_id" id="">
                                    <?php echo showDanhmucs($danhmucdacap) ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Mô Tả</label>
                                <textarea class="form-control" name="moTa"> {{ $danhmucs->moTa }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ Route('admin.danhmucsanpham') }}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về</button></a>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </form>
                    </div>
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