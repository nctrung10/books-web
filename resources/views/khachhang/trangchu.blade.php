@extends('master')
@section('title')
<title>TTD Home</title>
@endsection
@section('content')
<!-- Slide Bar -->
<div class="sidebar">
    <div class="container mt-4">
        <div class="row">
            <div class="col-4">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                        $i = 0;
                        @endphp
                        @foreach($slices as $slice)
                        @if($slice->viTri == 1)
                        <div @if($i=='0' ) class="carousel-item active" @else class="carousel-item" @endif>
                            @php
                            $i++;
                            @endphp
                            <img src="/storage/slice/{{ $slice->hinh }}" class="d-block w-100" alt="...">
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner ">
                        @php
                        $i = 0;
                        @endphp
                        @foreach($slices as $slice)
                        @if($slice->viTri == 2)
                        <div @if($i=='0' ) class="carousel-item active" @else class="carousel-item" @endif>
                            @php
                            $i++;
                            @endphp
                            <img src="/storage/slice/{{ $slice->hinh }}" class="d-block w-100" alt="...">
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTENT -->
<div class="container">
    <div class="card text-dark bg-light mt-5">
        <div class="card-header d-flex" style="background: linear-gradient(to right, #fff9c4, #ffeb3b);">
            <h2>Bán Chạy</h2>
        </div>
        <div class="card-body">
            <div class="container mt-2">
                <div class="row">
                    <div class="owl-carousel owl-theme">
                        @foreach($banchays as $banchay)
                        <div class="card h-100">
                            <a href="{{ Route('khachhang.chitietsanpham',$banchay->id) }}" class="text-center">
                                <span class="badge rounded-pill bg-danger" style=" position: absolute; z-index: 2;">Số Lượt Mua:{{ $banchay->soLuongTong }}</span>
                                <img class="img-trangchu" src="/storage/product/{{ $banchay->hinh }}">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title book-name">{{ $banchay->tenSach }} </h6>
                                <div class="card-title price">
                                    @if($banchay->ngayBatDau != NULL && $banchay->ngayBatDau <= $now && $banchay->ngayKetThuc >= $now )
                                        {{ number_format(($banchay->giaBan) - ($banchay->giaBan * $banchay->giaTri )/100 )  }} vnđ
                                        <span class="old-price">{{ number_format($banchay->giaBan). ' '. 'vnđ'   }}</span>
                                        <span class="badge bg-warning text-dark">-{{ $banchay->giaTri }}%</span>
                                        @else
                                        {{ number_format($banchay->giaBan) }} vnđ
                                        @endif
                                </div>
                                <div class="buttons">
                                    <form action="{{ Route('khachhang.savegiohang') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="idSach" value="{{ $banchay->id }}">
                                        @if($banchay->soLuong == 0)
                                        <h5 style="color: red;">Sản phẩm đã hết vui lòng quay lại sau.</h5>
                                        @else
                                        <button class="add" type="submit">Thêm vào giỏ hàng</button><br>
                                        @endif
                                    </form>
                                    <form action="{{ Route('khachhang.savegiohangindex') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="idSach" value="{{ $banchay->id }}">
                                        @if($banchay->soLuong == 0)
                                        @else
                                        <button class="buy" type="submit">Mua ngay</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card text-dark bg-light mt-5">
        <div class="card-header d-flex" style="background: linear-gradient(to right, #fff9c4, #ffeb3b);">
            <h2>Sách Mới</h2>
        </div>
        <div class="card-body">
            <div class="container mt-2">
                <div class="row">
                    <div class="owl-carousel owl-theme">
                        @foreach($sachmois as $sachmoi)
                        <div class="card h-100">
                            <a href="{{ Route('khachhang.chitietsanpham',$sachmoi->id) }}" class="text-center">
                                <span class="badge rounded-pill bg-danger" style=" position: absolute; z-index: 2;">NEW</span>
                                <img class="img-trangchu" src="/storage/product/{{ $sachmoi->hinh }}">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title book-name">{{ $sachmoi->tenSach }} </h6>
                                <div class="card-title price">
                                    @if($sachmoi->ngayBatDau != NULL && $sachmoi->ngayBatDau <= $now && $sachmoi->ngayKetThuc >= $now )
                                        {{ number_format(($sachmoi->giaBan) - ($sachmoi->giaBan * $sachmoi->giaTri )/100 )  }} vnđ
                                        <span class="old-price">{{ number_format($sachmoi->giaBan). ' '. 'vnđ'   }}</span>
                                        <span class="badge bg-warning text-dark">-{{ $sachmoi->giaTri }}%</span>
                                        @else
                                        {{ number_format($sachmoi->giaBan) }} vnđ
                                        @endif
                                </div>
                                <div class="buttons">
                                    <form action="{{ Route('khachhang.savegiohang') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="idSach" value="{{ $sachmoi->id }}">
                                        @if($sachmoi->soLuong == 0)
                                        <h5 style="color: red;">Sản phẩm đã hết vui lòng quay lại sau.</h5>
                                        @else
                                        <button class="add" type="submit">Thêm vào giỏ hàng</button><br>
                                        @endif
                                    </form>
                                    <form action="{{ Route('khachhang.savegiohangindex') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="idSach" value="{{ $sachmoi->id }}">
                                        @if($sachmoi->soLuong == 0)
                                        @else
                                        <button class="buy" type="submit">Mua ngay</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($danhmuccontents as $danhmuccontent)
    <div class="card text-dark bg-light mt-5">
        <div class="card-header d-flex" style="background: linear-gradient(to right, #fff9c4, #ffeb3b);">
            <h2>{{ $danhmuccontent->tenDM }}</h2>
        </div>
        <div class="card-body">
            <div class="container mt-2">
                <div class="row">
                    <div class="owl-carousel owl-theme">
                        @foreach($vanhocs as $vanhoc)
                        @if($vanhoc->parent_id == $danhmuccontent->id)

                        <div class="card h-100">
                            <a href="{{ Route('khachhang.chitietsanpham',$vanhoc->id) }}" class="text-center">
                                <img class="img-trangchu" src="/storage/product/{{ $vanhoc->hinh }}">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title book-name">{{ $vanhoc->tenSach }}</h6>
                                <div class="card-title price">
                                    @if($vanhoc->ngayBatDau != NULL && $vanhoc->ngayBatDau <= $now && $vanhoc->ngayKetThuc >= $now )
                                        {{ number_format(($vanhoc->giaBan) - ($vanhoc->giaBan * $vanhoc->giaTri )/100 )  }} vnđ
                                        <span class="old-price">{{ number_format($vanhoc->giaBan). ' '. 'vnđ'   }}</span>
                                        <span class="badge bg-warning text-dark">-{{ $vanhoc->giaTri }}%</span>
                                        @else
                                        {{ number_format($vanhoc->giaBan) }} vnđ
                                        @endif
                                </div>
                                <div class="buttons">
                                    <form action="{{ Route('khachhang.savegiohang') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="idSach" value="{{ $vanhoc->id }}">
                                        @if($vanhoc->soLuong == 0)
                                        <h5 style="color: red;">Sản phẩm đã hết vui lòng quay lại sau.</h5>
                                        @else
                                        <button class="add" type="submit">Thêm vào giỏ hàng</button><br>
                                        @endif
                                    </form>
                                    <form action="{{ Route('khachhang.savegiohangindex') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="idSach" value="{{ $vanhoc->id }}">
                                        @if($vanhoc->soLuong == 0)
                                        @else
                                        <button class="buy" type="submit">Mua ngay</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<a href="#" class="arrow-btn">
    <span class="fas fa-angle-double-up"></span>
</a>

<div class="zalo-chat-widget" data-oaid="1600114472450251565" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="350" data-height="420"></div>

<script>
    const toTop = document.querySelector(".arrow-btn");

    window.addEventListener("scroll", () => {
        if (window.pageYOffset > 200) {
            toTop.classList.add("active");
        } else {
            toTop.classList.remove("active");
        }
    })
</script>

@endsection