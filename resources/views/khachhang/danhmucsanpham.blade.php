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
<section>
    <div class="container mx-auto">
        <div class="row">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <div class="col-12">
                    <ul class="breadcrumb mt-2">
                        <li class="breadcrumb-item">
                            <a href="{{ Route('khachhang.trangchu') }}" class="text-dark home_page">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item">{{ $tenDM }}</li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</section>
<!-- CONTENT -->
<?php
function showDanhmucs($danhmucs, $parent_id = 0, $char = '')
{
    foreach ($danhmucs as $key => $item) {

        // Nếu là chuyên mục con thì hiển thị

        if ($item['parent_id'] == $parent_id) {

            echo '<a  href="' . Route('khachhang.danhmuc', ['' . $item['tenDM'] . '', '' . $item['id'] . '', '' . $item['parent_id'] . '']) . '" class="list-group-item list-group-item-action"> ';

            echo $char . $item['tenDM'];

            echo '</a>';

            // Xóa chuyên mục đã lặp

            unset($danhmucs[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showDanhmucs($danhmucs, $item['id'], $char . '&emsp;');
        }
    }
}
?>
<div class="container my-3">
    <div class="row">
        <div class="col-3">
            <ul class="list-group">
                <li class="list-group-item disabled" aria-disabled="true">DANH MỤC SẢN PHẨM</li>
                <?php ShowDanhmucs($danhmucs); ?>
            </ul>
            <hr>
            <ul class="list-group">
                <li class="list-group-item disabled" aria-disabled="true">Giá</li>
                <li class="list-group-item list-group-item-action">
                    <form action="{{ Route('khachhang.danhmucprice',[$tenDM,$id,$parent_id]) }}">
                        <input type="hidden" name="start" value="0">
                        <input type="hidden" name="end" value="100000">
                        <button class="btn" type="submit"><i class="far fa-circle"></i> &ensp; 0đ - 100,000đ</button>
                    </form>
                </li>
                <li class="list-group-item list-group-item-action">
                    <form action=" {{ Route('khachhang.danhmucprice',[$tenDM,$id,$parent_id]) }}">
                        <input type="hidden" name="start" value="100000">
                        <input type="hidden" name="end" value="200000">
                        <button class="btn" type="submit"><i class="far fa-circle"></i> &ensp; 100,000đ - 200,000đ</button>
                    </form>
                </li>
                <li class="list-group-item list-group-item-action">
                    <form action=" {{ Route('khachhang.danhmucprice',[$tenDM,$id,$parent_id]) }}">
                        <input type="hidden" name="start" value="200000">
                        <input type="hidden" name="end" value="300000">
                        <button class="btn" type="submit"><i class="far fa-circle"></i> &ensp; 200,00đ - 300,000đ</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="col-9">
            <div class="card text-dark bg-light">
                <div class="card-header d-flex" style="background: linear-gradient(to right, #fff9c4, #ffeb3b);">

                    <h2>{{ $tenDM }}</h2>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">

                            <hr>
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
                <div class="card-footer">
                    <div class="row">
                        {{ $sachs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection