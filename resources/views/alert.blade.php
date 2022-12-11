<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-5">
            @if (session('error'))
            <div class="card text-center my-card-alert">
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
            <div class="card text-center my-card-alert ">
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
            <div class="card text-center my-card-alert ">
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
            <div class="card text-center my-card-alert ">
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