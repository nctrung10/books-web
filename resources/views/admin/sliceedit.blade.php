@extends('adminmaster')
@section('title')
<title>Slide</title>

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
                        <h3 class="card-title">SỬA THÔNG TIN SLIDE</h3>
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
                        <form action="{{ Route('admin.editslice',$slices->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">ID</label>
                                <input name="id" type="text" value="{{ $slices->id }}" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Tên Slide</label>
                                <input name="tenSlice" type="text" value="{{ $slices->tenSlice }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Mô tả</label>
                                <textarea class="form-control" name="moTa" id="" required>{{ $slices->moTa }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Hình</label>
                                <input class="form-control" type="file" name="hinh">
                                <img class="my-2" src="/storage/slice/{{ $slices->hinh }}" alt="slice" style="max-height: 200px;">
                            </div>
                            <div class="form-group">
                                <label for="name">Vị trí</label>
                                <select name="viTri" class="form-control">
                                    @if($slices->viTri == 1)
                                    <option selected value="1"> Trái </option>
                                    <option value="2"> Phải </option>
                                    @else
                                    <option value="1"> Trái </option>
                                    <option selected value="2"> Phải </option>
                                    @endif
                                </select>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ Route('admin.slice') }}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về</button></a>
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