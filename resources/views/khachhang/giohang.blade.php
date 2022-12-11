@extends('master')
@section('title')
<title>Giỏ Hàng</title>
@endsection
@section('content')

@if(Cart::content()->count() <= 0) @php if(Session::get('khuyenmai')){ Session::forget('khuyenmai'); } @endphp <!-- Empty Cart -->
    <div class="empty-cart">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="empty-cart-content m-5 text-center">
                        <img src="{{ asset('empty-cart.png')}}" alt="Giỏ hàng trống" style="width: 40%;">
                        <p class="text-center mt-3">Chưa có sản phẩm nào trong giỏ hàng của bạn.</p>
                        <a class="btn mb-4 btn-empty" href="{{ Route('khachhang.trangchu') }}">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Cart with products -->
    <div class="cart">
        <div class="container">
            <h2 class="title-cart pt-3">Giỏ hàng</h2>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="content my-auto">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <table class="table product-cart">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Sách</th>
                                            <th scope="col">Số Lượng</th>
                                            <th scope="col">Đơn giá</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-start">
                                        @php
                                        $total = 0;
                                        @endphp
                                        @foreach(Cart::content() as $content)
                                        @php
                                        $subtotal = ($content->qty) * ($content->price);
                                        $total += $subtotal;

                                        @endphp
                                        <tr>
                                            <td class="product-img-cart">
                                                <img src="/storage/product/{{ $content->options->image }}" style="width: 130px; height: 130px;">
                                            </td>
                                            <td class="product-name">
                                                <p>
                                                    {{ $content->name}}
                                                </p>
                                                <a href="{{ Route('giohang.deteleitem',$content->rowId) }}" class="del-product">Xóa</a>
                                            </td>
                                            <td>
                                                <form action="{{ Route('giohang.updateitem') }}" method="POST">
                                                    @csrf
                                                    <input name="idSach" type="hidden" value="{{ $content->rowId }}">
                                                    <input class="form-control" name="qty" type="number" value="{{ $content->qty }}" min="1" max="10" class="input-quantity">
                                                    <button class="form-control mt-1 btn btn-primary" type="submit">Cập nhật</button>
                                                </form>
                                            </td>
                                            <td>{{ number_format($content->price). 'đ'  }}</td>
                                            <td>{{ number_format(($content->qty) * ($content->price)). 'đ'  }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-4">
                                <div class="card cart-khuyenmai mb-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <span class="text-uppercase text-primary">Khuyến Mãi</span>
                                            <!-- Button trigger modal -->
                                            <span type="button" class="badge bg-warning text-dark mx-2 my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="max-width: 100px;">Xem thêm</span>
                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Mã khuyến mãi</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table-primary" style="width:100%">
                                                                <tr>
                                                                    <th>Nhập mã</th>
                                                                    <th></th>
                                                                </tr>
                                                                @foreach($khuyenmai as $row)
                                                                <tr>
                                                                    <td>{{ $row->code }}</td>
                                                                    <td>
                                                                        @if($row->hinhThuc == 0)
                                                                        Giảm {{ $row->giaTri }} % cho đơn hàng
                                                                        @else
                                                                        Giảm {{ number_format($row->giaTri) }} vnđ cho đơn hàng
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <form action="{{ Route('giohang.check_khuyenmai') }}" method="POST">
                                                @csrf
                                                <input type="text" class="form-control my-2" placeholder="Nhập mã giảm" name="code" required>
                                                <button type="submit" class="form-control btn btn-primary my-2">Đồng ý</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card total-cart">
                                    <div class="card-body pb-0">
                                        <span>Tạm Tính</span>
                                        <p class="result-total">{{ Cart::subtotal(0)}}đ</p>
                                    </div>
                                    @if(Session::get('khuyenmai'))
                                    @foreach(Session::get('khuyenmai') as $key => $cou)
                                    @if($cou['khuyenmai_condition']==0)
                                    <div class="card-body pb-0">
                                        <span> Mã giảm</span>
                                        <p class="result-total">{{$cou['khuyenmai_code']}}</p>
                                    </div>
                                    @php
                                    $khuyenmai_number = ($total*$cou['khuyenmai_number'])/100;
                                    $total_khuyenmai = $total - $khuyenmai_number;
                                    @endphp
                                    <div class="card-body pb-0">
                                        <span> Giá giảm</span>
                                        <p class="result-total">{{ number_format($khuyenmai_number)}}đ</p>
                                    </div>
                                    @elseif($cou['khuyenmai_condition']==1)
                                    <div class="card-body pb-0">
                                        <span> Mã giảm</span>
                                        <p class="result-total">{{$cou['khuyenmai_code']}}</p>
                                    </div>
                                    <div class="card-body pb-0">
                                        <span> Giá giảm</span>
                                        <p class="result-total">{{ number_format($cou['khuyenmai_number'])}}đ</p>
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
                                    </div>
                                    @endif
                                    <div class="card-footer" style="background-color: white;">
                                        <p class="card-text">
                                            <span class="total-name">Thành Tiền</span>
                                            <span class="total">
                                                @if(Session::get('khuyenmai'))
                                                {{ number_format($total_khuyenmai). 'đ' }}
                                                @else
                                                {{ number_format($total).'đ' }}
                                                @endif
                                            </span>
                                        </p>
                                        <a href="{{ Route('khachhang.thanhtoan') }}" class="btn btn-checkout" type="button">Thanh Toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endsection