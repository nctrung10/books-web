@extends('adminmaster')
@section('title')
<title>Loại Sách</title>

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
                        <h3 class="card-title">SỬA THÔNG TIN NGÔN NGỮ</h3>
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
                        <form action="{{ Route('admin.editngonngu',$ngonngus->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">ID</label>
                                <input name="id" type="text" value="{{ $ngonngus->id }}" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Tên Ngôn Ngữ</label>
                                <input name="tenNN" type="text" value="{{ $ngonngus->tenNN }}" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ Route('admin.ngonngu') }}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về</button></a>
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