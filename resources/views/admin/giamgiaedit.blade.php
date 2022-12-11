@extends('adminmaster')
@section('title')
<title>SỬA THÔNG TIN</title>

@endsection('title')


@section('content')
<?php
/*  foreach($giamgias as $giamgia){
        dd($giamgias->tenLoai); exit; 
    } */
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> SỬA THÔNG TIN CHƯƠNG TRÌNH GIẢM GIÁ</h3>
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
                        <form action="{{ Route('admin.editgiamgia',$giamgias->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên giảm giá</label>
                                <input name="tenGiamGia" type="text" class="form-control" value="{{$giamgias->tenGiamGia}}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nhóm giảm giá</label>
                                <input type="hidden" name="id_DM_GG" value="{{ $giamgias->id_DM_GG }}">
                                <select class="form-control" disabled="disabled">
                                    @foreach($danhmucs as $danhmuc)
                                    @if($danhmuc->id==$giamgias->id_DM_GG)
                                    <option selected value="{{ $danhmuc->id }}">{{ $danhmuc->tenDM }}</option>
                                    @else
                                    <option value="{{ $danhmuc->id }}"> {{ $danhmuc->tenDM }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Giá Trị</label>
                                <input name="giaTri" type="number" min='1' max='100' class="form-control" value="{{$giamgias->giaTri}}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Ngày Bắt Đầu</label>
                                <input name="ngayBatDau" type="date" class="form-control" value="{{ date('Y-m-d',strtotime($giamgias->ngayBatDau)) }}"  min="{{ $now }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Ngày Kết Thúc</label>
                                <input name="ngayKetThuc" type="date" class="form-control" value="{{ date('Y-m-d',strtotime($giamgias->ngayKetThuc)) }}"  min="{{ $now }}"  required>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ Route('admin.giamgia') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </a>
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