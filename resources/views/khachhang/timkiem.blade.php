@extends('master')
@section('title')
<title>TTD Home</title>
@endsection
@section('content')
<!-- Slide Bar -->
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-5">
            @if (session('error'))
            <div class=" card text-center" style=" z-index: 2; position:absolute; top:300px; left:500px;">
                <div class="card-header bg-danger">
                    <h3>THÔNG BÁO</h3>
                </div>
                <div class="card-body">
                    <h3 class="icon-alert">
                        <i class="far fa-times-circle" style="color: red; font-size: 50px;"></i>
                    </h3>
                    <h5 class="card-title">{{ session('error') }}</h5>
                    <form>
                        <BUTTON type="submit" class="btn btn-info" onclick="return  location.reload();">OK</BUTTON>
                    </form>
                </div>
                <div class="card-footer text-muted bg-danger">
                </div>
            </div>
            @endif
            @if (session('message'))
            <div class="card text-center " style="z-index: 2; position:absolute; top:300px; left:500px;">
                <div class="card-header bg-success">
                    <h3>THÔNG BÁO</h3>
                </div>
                <div class="card-body">
                    <h3 class="icon-alert">
                        <i class="far fa-check-circle" style="color: green; font-size: 50px;"></i>
                    </h3>
                    <h5 class="card-title">{{ session('message') }}</h5>
                    <form action="{{Route('khachhang.giohang')}}">
                        @csrf
                        <BUTTON type="button" class="btn btn-info" onclick="return  location.reload();">XEM TIẾP</BUTTON>
                        <BUTTON type="submit" class="btn btn-info" onclick="return  location.reload();">ĐI TỚI GIỎ HÀNG</BUTTON>
                    </form>
                </div>
                <div class="card-footer text-muted bg-success">
                </div>
            </div>
            @endif
            @if (session('message-thanhtoan'))
            <div class="card text-center " style="z-index: 2; position:absolute; top:300px; left:500px;">
                <div class="card-header bg-success">
                    <h3>THÔNG BÁO</h3>
                </div>
                <div class="card-body">
                    <h3 class="icon-alert">
                        <i class="far fa-check-circle" style="color: green; font-size: 50px;"></i>
                    </h3>
                    <h5 class="card-title">{{ session('message-thanhtoan') }}</h5>
                    <form action="">
                        @csrf
                        <BUTTON type="button" class="btn btn-info" onclick="return  location.reload();">OK</BUTTON>
                    </form>
                </div>
                <div class="card-footer text-muted bg-success">
                </div>
            </div>
            @endif
            @if (session('message-login'))
            <div class="card text-center " style="z-index: 2; position:absolute; top:300px; left:500px;">
                <div class="card-header bg-success">
                    <h3>THÔNG BÁO</h3>
                </div>
                <div class="card-body">
                    <h3 class="icon-alert">
                        <i class="far fa-check-circle" style="color: green; font-size: 50px;"></i>
                    </h3>
                    <h5 class="card-title">{{ session('message-login') }}</h5>
                    <form action="">
                        @csrf
                        <BUTTON type="button" class="btn btn-info" onclick="return  location.reload();">OK</BUTTON>
                    </form>
                </div>
                <div class="card-footer text-muted bg-success">
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- CONTENT -->
<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <div class="card text-dark bg-light">
                <div class="card-header d-flex" style="background: linear-gradient(to right, #fff9c4, #ffeb3b);">
                    <h2>Kết quả tìm kiếm</h2>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            @if(count($sachs) == 0)
                            <div class="mt-2">
                                <h5>KHÔNG CÓ KẾT QUẢ TÌM KIẾM</h5>
                            </div>
                            @else
                            @foreach($sachs as $sach)
                            <div class="col-md-4 col-sm-4 col-xs-4 mt-2">
                                <div class="card h-100" style="width: 18rem;">
                                    <a href="{{ Route('khachhang.chitietsanpham',$sach->id) }}" class="text-center">
                                        <img class="img-trangchu" src="/storage/product/{{ $sach->hinh }}">
                                    </a>
                                    <div class="card-body">
                                        <h6 class="card-title book-name">{{ $sach->tenSach }}</h6>
                                        <div class="card-title price">
                                            @if($sach->ngayBatDau != NULL && $sach->ngayBatDau <= $now && $sach->ngayKetThuc >= $now )
                                                {{ number_format(($sach->giaBan) - ($sach->giaBan * $sach->giaTri )/100 )  }} vnđ
                                                <span class="old-price">{{ number_format($sach->giaBan). ' '. 'vnđ'   }}</span>
                                                <span class="badge bg-warning text-dark">-{{ $sach->giaTri }}%</span>
                                                @else
                                                {{ number_format($sach->giaBan) }} vnđ
                                                @endif
                                        </div>
                                        <div class="buttons">
                                            <form action="{{ Route('khachhang.savegiohang') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="idSach" value="{{ $sach->id }}">
                                                @if($sach->soLuong == 0)
                                                <h5 style="color: red;">Sản phẩm đã hết vui lòng quay lại sau.</h5>
                                                @else
                                                <button class="add" type="submit">Thêm vào giỏ hàng</button><br>
                                                @endif
                                            </form>
                                            <form action="{{ Route('khachhang.savegiohangindex') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="idSach" value="{{ $sach->id }}">
                                                @if($sach->soLuong == 0)
                                                @else
                                                <button class="buy" type="submit">Mua ngay</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection