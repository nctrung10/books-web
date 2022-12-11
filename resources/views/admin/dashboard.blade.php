@extends('adminmaster')
@section('title')
<title>Trang Chủ</title>

@endsection('title')


@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Bảng điều khiển</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Bảng điều khiển</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<!-- /.content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $donhangcho }}</h3>

            <p>Đơn Hàng Chờ</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ Route('donhang.getdonhangcho') }}" class="small-box-footer">Thêm thông tin <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $donhangthanhcong }}</h3>

            <p>Đơn Hàng Thành Công</p>
          </div>
          <div class="icon">
            <i class="fas fa-check"></i>
          </div>
          <a href="{{ Route('donhang.getdonhangthanhcong') }}" class="small-box-footer">Thêm thông tin <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ number_format($doanhthuthang->total)}}</h3>

            <p>Doanh Thu Tháng</p>
          </div>
          <div class="icon">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <a href="" class="small-box-footer" data-toggle="modal" data-target=".bd-example-modal-lg">
            Thêm thông tin
            <i class="fas fa-arrow-circle-right"></i>
        </div>
        </a>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">DOANH THU THEO THÁNG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="card">
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Tháng</th>
                        <th scope="col">Doanh Thu</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($doanhthuthangs as $row)
                      <tr>
                        <th scope="row">{{ $row->month }}</th>
                        <td>{{ number_format($row->total)  }}đ</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $sachhet }}</h3>

            <p>Sản phẩm gần hết</p>
          </div>
          <div class="icon">
            <i class="fas fa-warehouse"></i>
          </div>
          <a href="{{ Route('admin.sachhet') }}" class="small-box-footer">Thêm thông tin<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <hr>
    <div class="row my-2">
      <div class=" col-12 " s>
        <div class="card"  style=" border: solid skyblue ; background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);">
          <div class="card-header">
            <h3>Doanh Thu Ngày</h3>
            <form class="mx-2" action="{{ Route('admin.dashboard') }}">
              <div class="row">
                <div class="col-auto">
                  <label for="ngay">Chọn ngày:</label>
                </div>
                <div class="col-auto">
                  <input type="date" class="form-control" name="from" required>
                </div>
                <div class="col-auto">
                  <input type="date" class="form-control" name="to" required>
                </div>
                <div class="col-auto">
                  <button class="form-control btn btn-primary">Thống kê</button>
                </div>
              </div>
            </form>
          </div>
          
          <div class="card-body">
            {!! $revenueChart->container() !!}
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class=" col-12">
        <div class="card" style="border: solid #FFC3B3 ; background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);">
          <div class="card-header">
            <h3>Thống Kê Trạng Thái Đơn Hàng</h3>
          </div>
          <div class="card-body">
            {!! $orderChart->container() !!}
          </div>
        </div>
      </div>
    </div>
</section>


{{-- ChartScript --}}
@if($revenueChart)
{!! $revenueChart->script() !!}
@endif

@if($orderChart)
{!! $orderChart->script() !!}
@endif
@endsection('content')