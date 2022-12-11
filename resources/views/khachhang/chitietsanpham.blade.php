@extends('master')
@section('title')
<title>Sản Phẩm | TTD</title>
@endsection

@section('content')
<!-- Breadcrumb -->
<section>
    <div class="container mx-auto">
        <div class="row">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <div class="col-12">
                    <ul class="breadcrumb mt-2">
                        <li class="breadcrumb-item">
                            <a href="{{ Route('khachhang.trangchu') }}" class="text-dark home_page">Trang chủ</a>
                        </li>
                        @foreach($sach as $row)
                        <li class="breadcrumb-item">{{ $row->tenDM }}</li>
                        <li class="breadcrumb-item">{{ $row->tenSach }}</li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</section>
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
                        <BUTTON type="submit" class="btn btn-info" onclick="return  location.reload();">OK</BUTTON>
                    </form>
                </div>
                <div class="card-footer text-muted bg-success">
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@foreach($sach as $row)
<!-- Main Content -->
<div class="container-sm bg-white mb-3">
    <form action="{{ Route('khachhang.savegiohangdetail') }}" method="POST">
        @csrf
        <div class="row">
            <input name="idSach" type="hidden" value="{{ $row->id }}">
            <div class="col-md-4 pe-0">
                <div class="product-img">
                    <img id="myimage" class="image-main" src="/storage/product/{{ $row->hinh }}" alt="">
                    <div id="myresult" class="img-zoom-result"></div>
                </div>
                <div class="docthu my-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#docthu">
                        ĐỌC THỬ <i class="far fa-eye"></i><i class="far fa-eye"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="docthu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ $row->tenSach }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example" tabindex="0">
                                        <div class="row">
                                            <div class="col-md-8 offset-2">
                                                <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example" tabindex="0" style="height:500px;overflow-y: scroll;padding:5px; border: 1px solid #ccc;">
                                                    @foreach($hinhsachs as $hinhsach)
                                                    <div class="row">
                                                        <div class="col-md-8 offset-md-2">
                                                            <div class="content_zoom_1">
                                                                <a data-fancybox="gallery" href="/storage/product/{{ $hinhsach->hinh }}" data-caption="Trang {{ $hinhsach->id }}"><img src="/storage/product/{{ $hinhsach->hinh }}" alt="hinhsach" style="max-width: 500px;"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 ps-4">
                <div class="detail-product-infor">
                    <div class="book-title">{{ $row->tenSach }}</div>
                    <div class="star-review">
                        <span>
                            @if($average == "Chưa có đánh giá")
                            @elseif($average >= 4.5 )
                            ★★★★★
                            @elseif($average < 4.5 && $average>= 3.5 )
                                ★★★★
                                @elseif($average < 3.5 && $average>= 2.5)
                                    ★★★
                                    @elseif($average < 2.5 && $average>= 1.5 )
                                        ★★
                                        @elseif($average < 1.5 && $average> 0 )
                                            ★
                                            @endif</span>
                        <span style="font-size: 15px;">( {{$sumcmt}} đánh giá)</span>
                    </div>
                    <div class="some-book-infor">
                        <div class="publisher">Nhà xuất bản:
                            <span class="publisher-name">
                                {{ $row->tenNXB }}
                            </span>
                        </div>
                        <div class="author">Tác giả:
                            <span class="author-name">
                                {{ $row->tacGia }}
                            </span>
                        </div>
                    </div>
                    <div class="price-book">
                        @if($row->ngayBatDau != NULL && $row->ngayBatDau <= $now && $row->ngayKetThuc >= $now )
                            {{ number_format(($row->giaBan) - ($row->giaBan * $row->giaTri )/100 )  }} vnđ
                            <span class="old-price">{{ number_format($row->giaBan). ' '. 'vnđ'   }}</span>
                            <span class="badge bg-warning text-dark">-{{ $row->giaTri }}%</span>
                            @else
                            {{ number_format($row->giaBan) }} vnđ
                            @endif
                    </div>
                    <div class="advice  border-top border-bottom w-75 py-3">
                        Hãy nhập địa chỉ nhận hàng để được dự báo thời gian & chi phí giao hàng một cách chính xác nhất.
                    </div>
                    <div class="quantity-book">
                        <p class="mb-2">Số lượng</p>
                        @if($row->soLuong <= 10 && $row->soLuong > 0 )
                            <input class="form-control" id="quantity-input" type="number" name="qty" value="1" min="1" max="{{ $row->soLuong }}" style="width:100px;">
                            <span style="color:red;">Chỉ còn {{ $row->soLuong }} sản phẩm</span>
                            @elseif($row->soLuong == 0)
                            <input class="form-control" id="quantity-input" type="number" name="qty" min="1" style="width:100px;" disabled>
                            <span style="color:red;"> Sản phẩm đã hết</span>
                            @else
                            <input class="form-control" id="quantity-input" type="number" name="qty" value="1" min="1" max="{{ $row->soLuong }}" style="width:100px;">
                            @endif
                    </div>
                    <div class="order-btn">
                        @if($row->soLuong == 0 )
                        @else
                        <button class="add ms-0" type="submit">Thêm vào giỏ hàng</button><br>
                        <button class="buy ms-0">Mua ngay</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container-sm bg-white mb-3">
    <form action="" method="POST">
        <div class="row detail-form">
            <div class="col-md-12">
                <div id="product-detail">
                    <h5 class="text-uppercase pb-2">thông tin chi tiết</h5>
                    <table class="table table-striped table-borderless">
                        <tbody>
                            <tr>
                                <td class="detail">Mã sách</td>
                                <td>{{ $row->id }}</td>
                            </tr>
                            <tr>
                                <td class="detail">Tên loại</td>
                                <td>{{ $row->tenLoai }}</td>
                            </tr>
                            <tr>
                                <td class="detail">Tác giả</td>
                                <td>{{ $row->tacGia }}</td>
                            </tr>
                            <tr>
                                <td class="detail">NXB</td>
                                <td>{{ $row->tenNXB }}</td>
                            </tr>
                            <tr>
                                <td class="detail">Năm xuất bản</td>
                                <td>{{ date('d/m/Y',strtotime($row->ngaySanXuat )) }}</td>
                            </tr>
                            <tr>
                                <td class="detail">Ngôn ngữ</td>
                                <td>{{ $row->tenNN }}</td>
                            </tr>
                            <tr>
                                <td class="detail">Kích thước</td>
                                <td>{{ $row->kichThuoc }} </td>
                            </tr>
                            <tr>
                                <td class="detail">Số trang</td>
                                <td>{{ $row->soTrang }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr class="line">
        <div class="row describe-product">
            <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                <div class="card mb-3">
                    <div class="card-header text-uppercase">
                        Mô tả sản phẩm
                    </div>
                    <div class="card-body">
                        <div class="card-text book-content">
                            <pre>
                            {{ $row->moTa }}
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container-sm bg-white mb-3">
    <div class="row">
        <div class="col">
            <div class="card my-3">
                <h5 class="card-header">ĐÁNH GIÁ SẢN PHẨM</h5>
                <div class="card-body">
                    <form action="{{ Route('khachhang.danhgia') }}" method="POST">
                        @csrf
                        <input name="id_Sach" type="hidden" value="{{ $row->id }}">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="" class="col-form-label">SỐ SAO</label>
                            </div>
                            <div class="col-auto">
                                <div id="rate mb-3">
                                    <div class="rating-star">
                                        <input type="radio" id="star5" name="rate" value="5">
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4">
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3">
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2">
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1">
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    <span style="color:red;">
                                        @error('rate')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </span>
                            </div>
                            <div class="row g-2 align-items-center">
                                <div class="mb-2">
                                    <label for="exampleFormControlInput1" class="form-label">BÌNH LUẬN</label>
                                    <textarea class="form-control" name="binhLuan" style="max-width: 500px;"></textarea>
                                    <span style="color:red;">
                                        @error('binhLuan')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <button class="form-control btn btn-primary " type="submit" style="max-width: 100px;">Gửi</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container bg-white mb-3">
    <div class="row">
        <div class="col">
            <div class="card my-3">
                <h5 class="card-header">DANH SÁCH ĐÁNH GIÁ</h5>
                <div class="card-body">
                    @foreach($danhgias as $danhgia)
                    <div class="card mt-2" style="max-width: 1250px;">
                        <div class="row g-0">
                            <div class="col-2">
                                <h5 class="mx-2">Số Sao</h5>
                                <div class="rating-star text-warning" style="font-size: 20px;">
                                    @if($danhgia->soSao == 5 )
                                    ★★★★★<h6 class="text-dark">Rất hài lòng</h6>
                                    @elseif($danhgia->soSao == 4 )
                                    ★★★★<h6 class="text-dark">Hài lòng</h6>
                                    @elseif($danhgia->soSao == 3 )
                                    ★★★<h6 class="text-dark">Bình thường</h6>
                                    @elseif($danhgia->soSao == 2 )
                                    ★★<h6 class="text-dark">Không hài lòng</h6>
                                    @elseif($danhgia->soSao == 1 )
                                    ★<h6 class="text-dark">Rất không hài lòng</h6>
                                    @endif
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $danhgia->hoTenKH }}</h5>
                                    <p class="card-text">
                                    <pre>{{ $danhgia->binhLuan }}</pre>
                                    </p>
                                    <p class="card-text"><small class="text-muted">{{ date('d-m-Y',strtotime($danhgia->created_at )) }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="paginate mt-2">
                        {{ $danhgias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach
<script type="text/javascript">
    $(document).ready(function() {
        $('.content_zoom a').fancybox();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.content_zoom_1 a').fancybox();
    });
</script>
@endsection
<!-- NOTE -->
<!--  Tinh % giam gia: x = [(gia goc - gia hien tai) / gia goc] * 100 -->