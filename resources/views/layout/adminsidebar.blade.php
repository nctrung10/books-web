<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ Route('admin.dashboard') }}" class="brand-link">
    <span class="brand-text font-weight-light">
      <div class="row">
        <img src="  {{asset('logo.png')}}" alt="logo" style="max-width: 70px;">
        <h4 style="margin-top: 20px; margin-left:5px; color:black;">TTD_BookStore</h4>
      </div>
    </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info text-center" style="width: 100%; ">
        <img src="/storage/nhanvien/{{$user->hinhNV}}" alt="hinhNV" style="max-width: 50px;">
        <a href="#" class="">{{$user->hoTenNV}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="{{ Route('admin.dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              BẢNG ĐIỀU KHIỂN
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <span class="ml-2 mr-1">
              <i class="fas fa-align-justify"></i>
            </span>
            <p>
              DANH MỤC SẢN PHẨM
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ Route('admin.danhmucsanphamadd') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm danh mục sản phẩm</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ Route('admin.danhmucsanpham') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Liệt kê danh mục sản phẩm</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <span class="mx-1">
              <i class="fas fa-warehouse"></i>
            </span>
            <p>
              DỮ LIỆU SẢN PHẨM
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ Route('admin.loaisach') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Loại Sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ Route('admin.sach') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ Route('admin.nhaxuatban') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Nhà Xuất Bản
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ Route('admin.ngonngu') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Ngôn Ngữ
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              DỮ LIỆU NHẬP
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ Route('admin.phieunhap') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dữ Liệu Nhập Hàng</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sản Phẩm Đã Nhập</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <span class="icon mx-2">
              <i class="fas fa-percent"></i>
            </span>
            <p>
              QUẢN LÝ KHUYẾN MÃI
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ Route('admin.khuyenmai') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm Mã Khuyến Mãi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ Route('admin.giamgia') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm Chương Trình Khuyến Mãi</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ Route('admin.nhanvien') }}" class="nav-link">
            <span class="icon ml-2 mr-1">
              <i class="fas fa-users-cog"></i>
            </span>
            <p>
              QUẢN LÝ NHÂN VIÊN
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ Route('admin.khachhang') }}" class="nav-link">
            <span class="icon ml-2 mr-1">
              <i class="fas fa-users"></i>
            </span>
            <p>
              QUẢN LÝ KHÁCH HÀNG
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ Route('admin.donhang') }}" class="nav-link">
            <span class="icon mx-2">
              <i class="fas fa-book"></i>
            </span>
            <p>
              QUẢN LÝ ĐƠN HÀNG
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ Route('admin.slice') }}" class="nav-link">
            <span class="icon mx-2">
              <i class="fas fa-images"></i>
            </span>
            <p>
              QUẢN LÝ SLIDE
            </p>
          </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>