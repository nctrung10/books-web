@extends('adminmaster')
@section('title')
<title>SỬA THÔNG TIN</title>

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
                        <h3 class="card-title">SỬA THÔNG TIN NHÂN VIÊN</h3>
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
                        <form action="{{ Route('admin.editnhanvien',$nhanviens->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">ID</label>
                                <input name="hoTenNV" type="text" class="form-control" value="{{ $nhanviens->id }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Tên Nhân Viên</label>
                                <input name="hoTenNV" type="text" class="form-control" value="{{ $nhanviens->hoTenNV }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input name="email" type="email" class="form-control" value="{{ $nhanviens->email }}"  required>
                            </div>
                            <div class="form-group">
                                <label for="name">Địa Chỉ</label>
                                <input name="diaChiNV" type="text" class="form-control" value="{{ $nhanviens->diaChiNV }}"  required>
                            </div>
                            <div class="form-group">
                                <label for="name">Số Điện Thoại</label>
                                <input name="sdtNV" type="number" class="form-control" value="{{ $nhanviens->sdtNV }}"  required>
                            </div>
                            <div class="form-group">
                                <label for="name">Lương</label>
                                <input name="luongNV" type="number" class="form-control" value="{{ $nhanviens->luongNV }}"  required>
                            </div>
                            <div class="form-group">
                                <label for="name">Hình</label>
                                <input name="hinhNV" type="file" class="form-control">
                                <img class="my-2" src="/storage/nhanvien/{{ $nhanviens->hinhNV }}" alt="avt" style="max-width: 200px;">
                            </div>
                            <div class="modal-footer">
                            <a href="{{ Route('admin.nhanvien') }}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về</button></a>
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