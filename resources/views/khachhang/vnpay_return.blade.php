<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thông tin thanh toán</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
        .my-form {
            border: solid 1px black;
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
    </style>
</head>

<body>
@include('sweetalert::alert')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 offset-md-3">
                <div class="my-form">
                    <div class="header clearfix">
                        <h3 class="text-muted text-center my-5">THÔNG TIN ĐƠN HÀNG</h3>
                    </div>
                    <div class="table-responsive">
                        <table class=" mx-3 my-3">
                            <tr>
                                <th>Mã giao dịch:</th>
                                <td>
                                    <?php echo $_GET['vnp_TxnRef'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Số tiền:</th>
                                <td>
                                    <?= number_format($_GET['vnp_Amount'] / 100) ?> VNĐ
                                </td>
                            </tr>
                            <tr>
                                <th>Nội dung thanh toán:</th>
                                <td>
                                    <?php echo $_GET['vnp_OrderInfo'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Mã GD Tại VNPAY:</th>
                                <td>
                                    <?php echo $_GET['vnp_TransactionNo'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Mã Ngân hàng:</th>
                                <td>
                                    <?php echo $_GET['vnp_BankCode'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Thời gian thanh toán:</th>
                                <td>
                                    <?php echo date('d-m-Y', strtotime($_GET['vnp_PayDate']))  ?>
                                </td>
                            </tr>
                        </table>
                        <a href="{{ Route('khachhang.trangchu') }}" class="btn btn-primary mx-3" style="float: right;" >KẾT THÚC</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
</body>

</html>