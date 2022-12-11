<?php
function showCategories($danhmucss, $parent_id = 0, $char = '', $stt = 0)
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($danhmucss as $key => $item) {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id) {
            $cate_child[] = $item;
            unset($danhmucss[$key]);
        }
    }

    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($cate_child) {
        if ($stt == 0) {
            $classul = "dropdown-menu";
        } else if ($stt == 1) {
            $classul = "dropdown-menu-1";
        } else if ($stt == 2) {
            $classul = "dropdown-menu-2";
        }
        echo '<ul class="' . $classul . '">';
        foreach ($cate_child as $key => $item) {
            // Hiển thị tiêu đề chuyên mục
            echo '<li class="dropdown-item"> <a href="' . Route('khachhang.danhmuc', ['' . $item['tenDM'] . '', '' . $item['id'] . '', '' . $item['parent_id'] . '']) . '">' . $item['tenDM'];
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($danhmucss, $item['id'], $char . '|---', ++$stt);
            echo '</a> </li>';
        }
        echo '</ul>';
    }
}
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark text-dark " style="background-color: #f5ea31;">
        <div class="container">
            <a class="navbar-brand m-0" href="{{ Route('khachhang.trangchu') }}"><img src="{{ asset('logo.png') }}" alt="" style="max-width:80px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-align-justify"></i> Danh mục sản phẩm
                        </a>
                        <?php echo showCategories($danhmucs)
                        ?>
                    </li>
                </ul>

                <form class="d-flex nav-form" action="{{ Route('khachhang.timkiem') }}" method="GET">
                    <input id="typeahead" class="form-control me-2 typeahead " type="text" name="timkiem" placeholder="Nhập tên sách" aria-label="Tìm kiếm" required>
                    <button class="btn btn-outline-dark" type="submit">Tìm Kiếm</button>
                </form>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <button type="button" class="btn ps-3 pe-0 header-cart">
                            <a class="nav-link text-center" aria-current="page" href="{{ Route('khachhang.giohang') }}">
                                <span style="font-size: 1.5rem; color: black;">
                                    <i class="fas fa-cart-plus ps-3"></i>

                                    @if(Cart::content()->count() > 0)
                                    <span class="badge rounded-pill cart-quantity">
                                        {{ Cart::content()->count() }}
                                    </span>
                                    @else
                                    <span class="badge rounded-pill cart-quantity">
                                        0
                                    </span>
                                    @endif

                                    <h6>Giỏ Hàng</h6>
                                </span>
                            </a>
                            <!-- Cart List-->
                            <div class="header-cart-list">
                                <!-- Having Cart -->
                                @if(Cart::content()->count() <= 0) <img src="{{ asset('/empty-cart.png') }}" class="header-cart-empty-img">
                                    @else <ul class="header-cart-list-item">
                                        @foreach(Cart::content() as $content)
                                        <li class="header-cart-item">
                                            <img src="/storage/product/{{ $content->options->image }}" class="header-cart-img">
                                            <div class="header-cart-item-info">
                                                <div class="header-cart-item-above">
                                                    <h5 class="header-cart-item-name">
                                                        {{ $content->name}}
                                                    </h5>
                                                </div>
                                                <div class="header-cart-item-below">
                                                    <span class="header-cart-item-price">{{ number_format($content->price). 'đ'  }}</span>
                                                    <span class="header-cart-item-price-multiply">x</span>
                                                    <span class="header-cart-item-quantity">{{ $content->qty }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="header-cart-list-footer">
                                        <div>
                                            <span class="header-cart-list-footer-tt">Thành tiền:</span>
                                            <span class="header-cart-list-footer-total">{{ Cart::subtotal(0)}}đ</span>
                                        </div>
                                        <a href="{{ route('khachhang.giohang') }}" class="btn btn-warning btn-sm m-2">Xem Chi Tiết</a>
                                    </div>
                                    @endif
                            </div>
                        </button>
                    </li>
                    @if(Auth::guard('khachhang')->check())
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="btn dropdown-toggle header-user-info" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <span style="font-size: 1.5rem; color: black; margin-top: 1.5px">
                                    <i class="fas fa-user"></i>
                                    <h6>{{ $user->hoTenKH }}</h6>
                                </span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ Route('khachhang.ttcanhan') }}">Thông tin cá nhân</a></li>
                                <li><a class="dropdown-item" href="{{ Route('khachhang.khlogout') }}">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </li>
                    @else
                    <li class="nav-item mt-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <span style="font-size: 25px; color: black;">
                                <i class="fas fa-user"></i>
                                <h6>Đăng Nhập</h6>
                            </span>
                        </button>
                        <!-- Modal -->
                        @include('khachhang.dangnhap')
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="position: absolute; margin-top: -21px;">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <marquee behavior="" direction="" scrollamount="14">
                    <strong>
                        <i class="fas fa-store"></i>
                        TTD Book Store nhận đặt hàng trực tuyến và giao hàng tận nơi với đầy đủ mọi loại sách để phục vụ nhu cầu tìm mua và đọc của các bạn.
                        <i class="fas fa-shipping-fast"></i>
                    </strong>
                </marquee>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</header>