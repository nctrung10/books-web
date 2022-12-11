@extends('master')
@section('title')
<title>Thanh toán | TTD</title>
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
                            <a href="{{ Route('khachhang.giohang') }}" class="back-cart">Quay lại giỏ hàng</a>
                        </li>
                        <li class="breadcrumb-item">Thanh toán</li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</section>
<!-- Main Content -->

<div class="container mb-5 bg-white">
    <h5 class="text-uppercase pt-3">Thông tin giao hàng</h5>
    <hr>
    <form method="POST" action="{{ Route('giohang.savedonhang')}}">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="form-floating mb-3">
                    <input type="hidden" name="id_KH" value="{{ $user->id }}">
                    <input type="text" class="form-control" name="hoTenKH" id="hotenKH-TT" value="{{ $user->hoTenKH }}" placeholder="Họ tên người nhận">
                    <label class="d-flex align-items-center">Họ tên người nhận</label>
                    <small style="color: red;">
                        @error('hotenKH')
                        {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="sdtKH" id="sdtKH-TT" value="{{ $user->sdtKH }}" placeholder="Số điện thoại">
                    <label class="d-flex align-items-center">Số điện thoại</label>
                    <small style="color: red;">
                        @error('sdtKH')
                        {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="emailKH-TT" name="email" value="{{ $user->email }}" placeholder="Email">
                    <label class="d-flex align-items-center">Email</label>
                    <small style="color: red;">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="dcKH-TT" name="diaChiKH" value="{{ $user->diaChiKH }}" placeholder="Địa chỉ nhận hàng">
                    <label class="d-flex align-items-center">Địa chỉ nhận hàng</label>
                    <small style="color: red;">
                        @error('diaChiKH')
                        {{ $message }}
                        @enderror
                    </small>
                </div>
                <!--  <div class="shipping-method mb-3">
                    <hr class="line">
                    <h5 class="text-uppercase">Phương thức vận chuyển</h5>
                    <div class="mb-2">Miễn phí cho đơn hàng từ 160K.</div>
                    <div class="transport">
                        <i class="fas fa-check-square"></i>
                        <label class="describe-transport">
                            Giao hàng tiêu chuẩn: 0đ
                        </label>
                    </div>
                </div> -->

                <div class="checkout-method mb-3">
                    <hr class="line">
                    <h5 class="text-uppercase">Phương thức thanh toán</h5>
                    @foreach($httts as $httt)
                    <div class="ship_cod mb-3">
                        <div class="form-check">
                            <input class="form-check-input mt-2" type="radio" value="{{ $httt->id }}" name="httt" id="flexRadioDefault1">
                            <label class="form-check-label d-flex align-items-center" for="flexRadioDefault1">
                                <i class="fas fa-money-bill-wave me-1" style="font-size: 30px;"></i>
                                {{ $httt->tenHTTT }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                    <span style="color:red;">
                        @error('httt')
                        {{ $message }}
                        @enderror
                    </span>
                    <!--<div class="ship_paypal mb-3">
                        <div class="form-check">
                            <input class="form-check-input mt-2" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label d-flex align-items-center" for="flexRadioDefault2">
                                <i class="fas fa-credit-card me-2" style="font-size: 30px;"></i>
                                Thanh toán PayPal
                            </label>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                <div class="card mb-3 border-dark">
                    <div class="card-body">
                        <h5>Thông tin đơn hàng</h5>
                        <table class="table checkout-product-info">
                            <tbody class="text-start">
                                @php
                                $total = 0;
                                @endphp
                                @foreach(Cart::content() as $row)
                                @php
                                $subtotal = ($row->qty) * ($row->price);
                                $total += $subtotal;
                                @endphp
                                <tr>
                                    <td class="product-img-pay">
                                        <img src="/storage/product/{{ $row->options->image }}">
                                    </td>
                                    <td class="checkout-product-info-name">
                                        <span>
                                            {{ $row->name }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($row->price). 'đ'  }}</td>
                                    <td>
                                        <p class="quantity mx-2">{{ $row->qty }}</p>
                                    </td>
                                    <td>
                                        <span class="float-end" style="color: #f39c12; font-weight: 600;">
                                            {{ number_format(($row->qty) * ($row->price)). 'đ'  }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-2 border-dark">
                    <div class="card-body">Tạm tính
                        <span class="float-end">
                           {{  Cart::subtotal(0) }}đ
                        </span>
                    </div>
                    @if(Session::get('khuyenmai'))
                    @foreach(Session::get('khuyenmai') as $key => $cou)
                    @if($cou['khuyenmai_condition']==0)
                    <div class="card-body pb-0">
                        <span>Mã giảm</span>
                        <p class="result-total">{{$cou['khuyenmai_code']}}</p>
                        <input type="hidden" name="magiam" value="{{ $cou['khuyenmai_code'] }}">
                    </div>
                    @php
                    $khuyenmai_number = ($total*$cou['khuyenmai_number'])/100;
                    $total_khuyenmai = $total - $khuyenmai_number;
                    @endphp
                    <div class="card-body pb-0">
                        <span>Giá giảm</span>
                        <p class="result-total">{{ number_format($khuyenmai_number)}}đ</p>
                        <input type="hidden" name="khuyenmai" value="{{ $khuyenmai_number }}">
                    </div>
                    @elseif($cou['khuyenmai_condition']==1)
                    <div class="card-body pb-0">
                        <span>Mã giảm</span>
                        <p class="result-total">{{$cou['khuyenmai_code']}}</p>
                        <input type="hidden" name="magiam" value="{{ $cou['khuyenmai_code'] }}">
                    </div>
                    <div class="card-body pb-0">
                        <span>Giá giảm</span>
                        <p class="result-total">{{ number_format($cou['khuyenmai_number'])}}đ</p>
                        <input type="hidden" name="khuyenmai" value="{{ $cou['khuyenmai_number'] }}">
                    </div>
                    @php
                    $total_khuyenmai = $total - $cou['khuyenmai_number'];
                    @endphp
                    @endif
                    @endforeach
                    @else
                    <div class="card-body pb-0">
                        <span> Mã giảm</span>
                        <p class="result-total"></p>
                    </div>
                    <div class="card-body pb-0">
                        <span> Giá giảm</span>
                        <p class="result-total">0đ</p>
                        <input type="hidden" name="khuyenmai" value="0">
                    </div>
                    @endif
                    <div class="card-footer bg-white">
                        <div class="card-text">
                            <span class="price-total-title">Tổng Tiền</span>
                            <span class="price-total-value">
                                @if(Session::get('khuyenmai'))
                                {{ number_format($total_khuyenmai). 'đ' }}
                                <input type="hidden" name="tongTien" value="{{ $total_khuyenmai }}">
                                @else
                                {{ number_format($total).'đ' }}
                                <input type="hidden" name="tongTien" value="{{ $total }}">
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <input type="submit" class="form-control btn-warning" id="ttoan" name="thanhtoan" onclick="dathang()" value="Hoàn tất đơn hàng">
                </div>
            </div>
        </div>
    </form>
</div>
@endsection