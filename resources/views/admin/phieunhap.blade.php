<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>QUẢN LÝ PHIẾU NHẬP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layout.adminheader');
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layout.adminsidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">QUẢN LÝ NHẬP HÀNG</h3>
                                </div>
                                <div class="row  m-2">
                                    <div class="col">
                                        <!-- HIỂN THỊ THÔNG BÁO -->
                                        <div class="thong-bao">
                                            @if ( Session::has('success') )
                                            <div class="alert alert-success alert-dismissible text-center" role="alert">
                                                <strong>{{ Session::get('success') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    <span class="sr-only">Close</span>
                                                </button>
                                            </div>
                                            @endif
                                            <?php //Hiển thị thông báo lỗi
                                            ?>
                                            @if ( Session::has('error') )
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <strong>{{ Session::get('error') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    <span class="sr-only">Close</span>
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row justify-content-end">
                                            <div class="add-phieunhap">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-success mr-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm Phiếu Nhập" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Thêm Phiếu Nhập</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <form action="{{ Route('admin.storephieunhap') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="idNV" value="{{ $user->id }}">
                                                                    <div class="form-group">
                                                                        <label for="name">Nhân Viên</label>

                                                                        <input name="nhanVien" value="{{ $user->hoTenNV }}" type="text" class="form-control" disabled>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="name">Chủ Đề</label>
                                                                        <input name="chuDe" type="text" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="name">Mô Tả</label>
                                                                        <textarea name="moTa" class="form-control" require></textarea>
                                                                    </div>
                                                                    <div class="container">

                                                                        <div class="table-repsonsive">
                                                                            <span id="error"></span>
                                                                            <table class="table table-bordered" id="item_table">
                                                                                <tr>
                                                                                    <th>Tên sản phẩm</th>
                                                                                    <th>Giá</th>
                                                                                    <th>Số lượng</th>
                                                                                    <th>
                                                                                        <button type="button" name="add" class="btn btn-success btn-sm add">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </th>
                                                                                </tr>
                                                                            </table>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>CHỦ ĐỀ</th>
                                            <th>MÔ TẢ</th>
                                            <th>NGÀY TẠO</th>
                                            <th>XEM CHI TIẾT</th>
                                            <th>SỬA</th>
                                            <th>XÓA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $phieunhaps as $phieunhap)
                                        <tr>
                                            <td>{{ $phieunhap->id }}</td>
                                            <td>{{ $phieunhap->chuDe }}</td>
                                            <td>{{ $phieunhap->moTa }}</td>
                                            <td>{{ date('d/m/Y',strtotime($phieunhap->created_at))  }}</td>
                                            <td>
                                                <a href="{{ Route('phieunhap.getdetail',$phieunhap->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xem chi tiết">
                                                        <i class="fas fa-info"></i></button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href=""><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa thông tin">
                                                        <i class="fas fa-edit"></i></button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="" onclick="return confirm('Bạn có chắc là muốn xóa đơn nhập hàng này không?')"> <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
    <!-- FOOTER -->
    @include('layout.adminfooter')
    <!-- FOOTER -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('Admin/plugins/jquery/jquery.min.js')}} "></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('Admin/plugins/jquery-ui/jquery-ui.min.js')}} "></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src=" {{ asset('Admin/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src=" {{ asset('Admin/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src=" {{ asset('Admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src=" {{ asset('Admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('Admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('Admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('Admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('Admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('Admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Admin/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('Admin/dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('Admin/dist/js/demo.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"> </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.add', function() {
                var html = '';
                html += '<tr>';
                html += '<td><select <input type="text" name="id_Sach[]" class="form-control item_name"> @foreach($sachs as $sach) <option value="{{ $sach->id }}">{{ $sach->tenSach }}</option> @endforeach </select></td>';
                html += '<td><input type="text" name="giaBia[]" class="form-control item_price" /></td>';
                html += '<td><input type="text" name="soLuong[]" class="form-control item_quantity" /></td>';
                html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg></button></td></tr>';
                $('#item_table').append(html);
            });

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });

            $('#insert_form').on('submit', function(event) {
                event.preventDefault();
                var error = '';
                $('.item_name').each(function() {
                    var count = 1;
                    if ($(this).val() == '') {
                        error += "<p>Nhập tên sản phẩm " + count + " hàng</p>";
                        return false;
                    }
                    count = count + 1;
                });

                $('.item_price').each(function() {
                    var count = 1;
                    if ($(this).val() == '') {
                        error += "<p>Nhập giá sản phẩm " + count + " hàng</p>";
                        return false;
                    }
                    count = count + 1;
                });

                $('.item_type').each(function() {
                    var count = 1;
                    if ($(this).val() == '') {
                        error += "<p>Chọn loại sản phẩm " + count + " hàng</p>";
                        return false;
                    }
                    count = count + 1;
                });

                $('.item_quantity').each(function() {
                    var count = 1;
                    if ($(this).val() == '') {
                        error += "<p>Nhập số lượng sản phẩm " + count + " hàng</p>";
                        return false;
                    }
                    count = count + 1;
                });

                var form_data = $(this).serialize();
                if (error == '') {
                    $.ajax({
                        url: "vidu.php",
                        method: "POST",
                        data: form_data,
                        success: function(data) {
                            if (data == 'ok') {
                                $('#item_table').find("tr:gt(0)").remove();
                                $('#error').html('<div class="alert alert-success">Đã lưu</div>');
                            }
                        }
                    });
                } else {
                    $('#error').html('<div class="alert alert-danger">' + error + '</div>');
                }
            });

        });
    </script>
</body>

</html>