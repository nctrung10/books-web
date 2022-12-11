<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
        .my-row {
            border: solid 1px none;
            border-radius: 5px;
            height: 500px;
            background: white;
            box-shadow:
                0 2.8px 2.2px rgba(0, 0, 0, 0.034),
                0 6.7px 5.3px rgba(0, 0, 0, 0.048),
                0 12.5px 10px rgba(0, 0, 0, 0.06),
                0 22.3px 17.9px rgba(0, 0, 0, 0.072),
                0 41.8px 33.4px rgba(0, 0, 0, 0.086),
                0 100px 80px rgba(0, 0, 0, 0.12)
        }

        .login-form {
            margin-left: 65px;
            width: 400px;
        }

        .my-label {
            font-size: 15px;
            font-family: auto;
            color: darkgrey;
        }
    </style>
</head>

<body>
    <div class="container justify-content-center">
        <div class="row" style="margin-top: 100px;">
            <div class="col-md-10 offset-md-1">
                <div class="row my-row">
                    <div class="col-md-6">
                        <div class="img">
                            <img src="{{ asset('vnpay.png') }}" alt="" style="max-width: 500px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-form">
                            <h3 class="text-center" style="font-family: fangsong;">THÔNG TIN THANH TOÁN</h3>
                            <form action="{{ Route('thanhtoan.createpayment')}}" id="create_form" method="post">
                                @csrf
                                <div class="form-group my-2">
                                    <label for="language" class="">Loại hàng hóa </label>
                                    <select name="order_type" id="order_type" class="form-control">
                                        <option value="billpayment">Thanh toán hóa đơn</option>
                                    </select>
                                </div>
                                <div class="form-group  my-2">
                                    <label for="amount">Số tiền</label>
                                    <input type="hidden" id="amount" name="amount" type="text" value="{{ $tongtien }}">
                                    <input class="form-control" id="amount" name="amount1" type="text" value="{{ number_format($tongtien)}}đ" disabled>
                                </div>
                                <div class="form-group  my-2">
                                    <label for="order_desc">Nội dung thanh toán</label>
                                    <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2"></textarea>
                                </div>
                                <div class="form-group  my-2">
                                    <label for="bank_code">Ngân hàng</label>
                                    <select name="bank_code" id="bank_code" class="form-control">
                                        <option value="">Không chọn</option>
                                        <option value="NCB"> Ngan hang NCB</option>
                                        <option value="AGRIBANK"> Ngan hang Agribank</option>
                                        <option value="SCB"> Ngan hang SCB</option>
                                        <option value="SACOMBANK">Ngan hang SacomBank</option>
                                        <option value="EXIMBANK"> Ngan hang EximBank</option>
                                        <option value="MSBANK"> Ngan hang MSBANK</option>
                                        <option value="NAMABANK"> Ngan hang NamABank</option>
                                        <option value="VNMART"> Vi dien tu VnMart</option>
                                        <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                        <option value="VIETCOMBANK"> Ngan hang VCB</option>
                                        <option value="HDBANK">Ngan hang HDBank</option>
                                        <option value="DONGABANK"> Ngan hang Dong A</option>
                                        <option value="TPBANK"> Ngân hàng TPBank</option>
                                        <option value="OJB"> Ngân hàng OceanBank</option>
                                        <option value="BIDV"> Ngân hàng BIDV</option>
                                        <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                                        <option value="VPBANK"> Ngan hang VPBank</option>
                                        <option value="MBBANK"> Ngan hang MBBank</option>
                                        <option value="ACB"> Ngan hang ACB</option>
                                        <option value="OCB"> Ngan hang OCB</option>
                                        <option value="IVB"> Ngan hang IVB</option>
                                        <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                                    </select>
                                </div>
                                <div class="form-group  my-2">
                                    <label for="language">Ngôn ngữ</label>
                                    <select name="language" id="language" class="form-control">
                                        <option value="vn">Tiếng Việt</option>
                                        <option value="en">English</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" id="btnPopup">Tiếp tục</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet" />
    <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
    <script type="text/javascript">
        $("#btnPopup").click(function() {
            var postData = $("#create_form").serialize();
            var submitUrl = $("#create_form").attr("action");
            $.ajax({
                type: "POST",
                url: submitUrl,
                data: postData,
                dataType: 'JSON',
                success: function(x) {
                    if (x.code === '00') {
                        if (window.vnpay) {
                            vnpay.open({
                                width: 768,
                                height: 600,
                                url: x.data
                            });
                        } else {
                            location.href = x.data;
                        }
                        return false;
                    } else {
                        alert(x.Message);
                    }
                }
            });
            return false;
        });
    </script>
</body>

</html>