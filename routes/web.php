<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/abc', function () {
    return view('welcome');
});
//KHÁCH HÀNG
Route::get('/trangchu', 'IndexController@getIndex')->name('khachhang.trangchu');
Route::get('/trangchu/dangky', 'KhachHangController@getPageDangKy')->name('khachhang.dangky');
Route::post('/trangchu/dangky/addtk', 'KhachHangController@dangKyKH')->name('khachhang.dangkytk');
Route::get('/trangchu/thongtincanhan', 'KhachHangController@getTTCaNhan')->name('khachhang.ttcanhan')->middleware('khachhang');
Route::get('/trangchu/thongtincanhan/thaydoimatkhau', 'KhachHangController@getPageChangePW')->name('khachhang.doimatkhau')->middleware('khachhang');
Route::get('/trangchu/thongtincanhan/lichsudonhang', 'KhachHangController@getPageLichSuDH')->name('khachhang.lichsudonhang')->middleware('khachhang');
Route::post('/trangchu/thongtincanhan/capnhattt', 'KhachHangController@updateTTCaNhan')->name('khachhang.updatettcanhan');
Route::post('/trangchu/thongtincanhan/thaydoimatkhau/changepw', 'KhachHangController@updatePW')->name('khachhang.updatepw');
//MAIL
Route::get('trangchu/quenmatkhau','MailController@getPageQuenPW')->name('khachhang.quenmatkhau');
Route::post('trangchu/quenmatkhau','MailController@quenPW')->name('khachhang.postquenmatkhau');
Route::get('trangchu/new-pass','MailController@getPageNewPass')->name('khachhang.getnewpass');
Route::post('trangchu/new-pass','MailController@updateNewPass')->name('khachhang.newpass');
//LOGIN
Route::post('/trangchu/login', 'KhachHangController@postLogin')->name('khachhang.khlogin');
Route::get('/trangchu/logout', 'KhachHangController@logOut')->name('khachhang.khlogout');
//CHI TIẾT SẢN PHẨM
Route::get('/chitietsanpham/{id}', 'DetailController@getPageChiTietSanPham')->name('khachhang.chitietsanpham');
//GIỎ HÀNG
Route::get('/giohang', 'GioHangController@getPageGioHang')->name('khachhang.giohang');
Route::post('/savegiohang', 'GioHangController@saveGioHang')->name('khachhang.savegiohang');
Route::post('/savegiohangindex', 'GioHangController@saveGioHangIndex')->name('khachhang.savegiohangindex');
Route::post('/chitietsanpham/savegiohang', 'GioHangController@saveGioHangDetail')->name('khachhang.savegiohangdetail');
Route::get('/giohang/deleteitem/{id}', 'GioHangController@deleteItem')->name('giohang.deteleitem');
Route::post('/giohang/updateitem', 'GioHangController@updateItem')->name('giohang.updateitem');
Route::post('/giohang/khuyenmai', 'GioHangController@check_khuyenmai')->name('giohang.check_khuyenmai');
//THANH TOÁN
Route::get('/thanhtoan', 'ThanhToanController@getPageThanhToan')->name('khachhang.thanhtoan')->middleware('khachhang');
Route::post('/thanhtoan/savethanhtoan', 'ThanhToanController@saveDonHang')->name('giohang.savedonhang');
//VNPAY
Route::post('/thanhtoan/vnpay', 'VNPayController@createPayment')->name('thanhtoan.createpayment');
Route::get('/vnpay/return', 'VNPayController@vnpayReturn')->name('vnpay.return');

//ĐÁNH GIÁ
Route::post('/chitietsanpham/danhgia', 'DetailController@danhGia')->name('khachhang.danhgia');
//DANH MỤC SẢN PHẨM
Route::get('/danhmucsanpham/{tenDM}/{id}/{parent_id}', 'DanhMucSanPhamKHController@getPageDanhMuc')->name('khachhang.danhmuc');
Route::get('/danhmucsanpham/{tenDM}/{id}/{parent_id}/locgia', 'DanhMucSanPhamKHController@getPageDanhMucPrice')->name('khachhang.danhmucprice');
//Route::get('/danhmucsanpham/{tenDM}/{id}/{parent_id}/sapxep', 'DanhMucSanPhamKHController@getPageDanhMucPriceSort')->name('khachhang.danhmucpricesort');
//TÌM KIẾM
Route::get('/trangchu/timkiem', 'TimKiemController@getPageTimKiem')->name('khachhang.timkiem');
Route::get('/trangchu/autocomplete,', 'TimKiemController@autocomplete')->name('timkiem.auto');

//PAYPAL
/* Route::get('paypal/checkout/{idDH}', 'PayPalController@getExpressCheckout')->name('paypal.checkout');
Route::get('paypal/checkout-success/{idDH}', 'PayPalController@getExpressCheckoutSuccess')->name('paypal.success');
Route::get('paypal/checkout-cancel', 'PayPalController@cancelPage')->name('paypal.cancel');
//Route::get('/thanhtoan/savethanhtoanviewpayment', 'PayPalController@getpayment'); */







//ADMIN 
Route::get('/login', function () {
    return view('admin.login');
});
Route::post('/login', 'AdminController@postLogin')->name('admin.login');
Route::get('/logout', 'AdminController@logOut')->name('admin.logout');
Route::middleware('Admin')->group(function () {
    Route::get('/dashboard', 'AdminController@getDashBoard')->name('admin.dashboard');
    //LOẠI SÁCH
    Route::get('/loaisach', 'LoaiSachController@getPageLoaiSach')->name('admin.loaisach');
    Route::get('/loaisach/editloaisach/{id}', 'LoaiSachController@getPageEditLoaiSach')->name('loaisach.getedit');
    //DANH MỤC SẢN PHẨM
    Route::get('/danhmuc', 'DanhMucSanPhamController@getPageDanhMuc')->name('admin.danhmucsanpham');
    Route::get('/danhmucadd', 'DanhMucSanPhamController@getPageDanhMucAdd')->name('admin.danhmucsanphamadd');
    Route::get('/danhmucedit/{id}', 'DanhMucSanPhamController@getPageDanhMucEdit')->name('admin.danhmucsanphamedit');
    // NGÔN NGỮ
    Route::get('/ngonngu', 'NgonNguController@getPageNgonNgu')->name('admin.ngonngu');
    Route::get('/ngonngu/editngonngu/{id}', 'NgonNguController@getPageEditNgonNgu')->name('ngonngu.getedit');
    // NHÀ XUẤT BẢN
    Route::get('/nhaxuatban', 'NhaXuatBanController@getPageNhaXuatBan')->name('admin.nhaxuatban');
    Route::get('/nhaxuatban/editnhaxuatban/{id}', 'NhaXuatBanController@getPageEditNhaXuatBan')->name('nhaxuatban.getedit');
    // SÁCH
    Route::get('/sach', 'SachController@getPageSach')->name('admin.sach');
    Route::get('/sach/sachhet', 'SachController@getPageSachHet')->name('admin.sachhet');
    Route::get('/sach/editsach/{id}', 'SachController@getPageEditSach')->name('sach.getedit');
    Route::get('/sach/detailsach/{id}', 'SachController@getPageDetailSach')->name('sach.getdetail');
    Route::get('/sach/hinhsach/{id}', 'SachController@getPageHinhSach')->name('sach.gethinhsach');
    //GIẢM GIÁ
    Route::get('/giamgia', 'GiamGiaController@getPageGiamGia')->name('admin.giamgia');
    // PHIẾU NHẬP
    Route::get('/phieunhap', 'PhieuNhapController@getPagePhieuNhap')->name('admin.phieunhap');
    Route::get('/phieunhap/editphieunhap/{id}', 'PhieuNhapController@getPageEditPhieuNhap')->name('phieunhap.getedit');
    Route::get('/phieunhap/detailphieunhap/{id}', 'PhieuNhapController@getPageDetailPhieuNhap')->name('phieunhap.getdetail');
    // Slide
    Route::get('/slide', 'SliceController@getPageSlice')->name('admin.slice');
    Route::get('/slide/editslide/{id}', 'SliceController@getPageEditSlice')->name('slice.getedit');
    // NHÂN VIÊN
    Route::get('/nhanvien', 'NhanVienController@getPageNhanVien')->name('admin.nhanvien');
    Route::get('/nhanvien/editnhanvien/{id}', 'NhanVienController@getPageEditNhanVien')->name('nhanvien.getedit');
    Route::get('/nhanvien/addtknhanvien/{id}', 'NhanVienController@getPageAddTKNhanVien')->name('nhanvien.getaddtk');
    // KHÁCH HÀNG
    Route::get('/khachhang', 'KhachHangController@getPageKhachHang')->name('admin.khachhang');
    Route::get('/khachhang/chitietkhachhang/{id}', 'KhachHangController@getPageDetailKhachHang')->name('admin.khachhangdetail');
    // KHUYẾN MÃI
    Route::get('/khuyemai', 'KhuyenMaiController@getPageKhuyenMai')->name('admin.khuyenmai');
    // QUẢN LÝ ĐƠN HÀNG
    Route::get('/donhang', 'DonHangController@getPageDonHang')->name('admin.donhang');
    Route::get('/donhang/chitietdonhang/{id}', 'DonHangController@getPageChiTietDonHang')->name('donhang.getchitietdh');
    Route::get('/donhang/inhoadon/{id}', 'DonHangController@inHoaDon')->name('donhang.gethoadon');
    Route::get('/donhang/donhangcho', 'DonHangController@getPageDonHangCho')->name('donhang.getdonhangcho');
    Route::get('/donhang/donhangthanhcong', 'DonHangController@getPageDonHangThanhCong')->name('donhang.getdonhangthanhcong');
});

//DOASHBOARD

//DANH MỤC SẢN PHẨM
Route::post('/danhmucadd', 'DanhMucSanPhamController@storeDanhMuc')->name('admin.storedanhmuc');
Route::post('/danhmuc/editan/{id}', 'DanhMucSanPhamController@editAn')->name('admin.editan');
Route::post('/danhmuc/edithien/{id}', 'DanhMucSanPhamController@editHien')->name('admin.edithien');
Route::post('/danhmuc/editdanhmuc/{id}', 'DanhMucSanPhamController@editDanhMuc')->name('admin.editdanhmuc');
Route::get('/danhmuc/deletedanhmuc/{id}', 'DanhMucSanPhamController@deleteDanhMuc')->name('admin.deletedanhmuc');
//LOẠI SÁCH
Route::post('/loaisach/addsach', 'LoaiSachController@storeLoaiSach')->name('admin.storeloaisach');
Route::post('/loaisach/editloaisach/{id}', 'LoaiSachController@editLoaiSach')->name('admin.editloaisach');
Route::get('/loaisach/deleteloaisach/{id}', 'LoaiSachController@deleteLoaiSach')->name('admin.deleteloaisach');
//NGÔN NGỮ
Route::post('/ngonngu/addngonngu', 'NgonNguController@storeNgonNgu')->name('admin.storengonngu');
Route::post('/ngonngu/editngonngu/{id}', 'NgonNguController@editNgonNgu')->name('admin.editngonngu');
Route::get('/ngonngu/deletengonngu/{id}', 'NgonNguController@deleteNgonNgu')->name('admin.deletengonngu');
//NHÀ XUẤT BẢN
Route::post('/nhaxuatban/addnhaxuatban', 'NhaXuatBanController@storeNhaXuatBan')->name('admin.storenhaxuatban');
Route::post('/nhaxuatban/editnhaxuatban/{id}', 'NhaXuatBanController@editNhaXuatBan')->name('admin.editnhaxuatban');
Route::get('/nhaxuatban/deletenhaxuatban/{id}', 'NhaXuatBanController@deleteNhaXuatBan')->name('admin.deletenhaxuatban');
//SÁCH
Route::post('/sach/addsach', 'SachController@storeSach')->name('admin.storesach');
Route::post('/sach/editsach/{id}', 'SachController@editSach')->name('admin.editsach');
Route::get('/sach/deletesach/{id}', 'SachController@deleteSach')->name('admin.deletesach');
Route::post('/sach/addhinhsach', 'HinhSachController@storeHinhSach')->name('admin.storehinhsach');
//GIẢM GIÁ
Route::post('/giamgia/addgiamgia', 'GiamGiaController@storeGiamGia')->name('admin.storegiamgia');
Route::get('/giamgia/editgiamgia/{id}', 'GiamGiaController@getPageEditGiamGia')->name('admin.geteditgiamgia');
Route::post('/giamgia/editgiamgia/{id}', 'GiamGiaController@editGiamGia')->name('admin.editgiamgia');
Route::get('/giamgia/deletegiamgia/{id}', 'GiamGiaController@deleteGiamGia')->name('admin.deletegiamgia');
Route::get('/giamgia/sanphamgiamgia/{id}', 'GiamGiaController@getPageSPGiamGia')->name('admin.spgiamgia');
//Slide
Route::post('/slide/addslide', 'SliceController@storeSlice')->name('admin.storeslice');
Route::post('/slide/editan/{id}', 'SliceController@editAn')->name('slice.editan');
Route::post('/slide/edithien/{id}', 'SliceController@editHien')->name('slice.edithien');
Route::post('/slide/editslide/{id}', 'SliceController@editSlice')->name('admin.editslice');
Route::get('/slide/deleteslide/{id}', 'sliceController@deleteSlice')->name('admin.deleteslice');
//NHÂN VIÊN
Route::post('/nhanvien/addnhanvien', 'NhanVienController@storeNhanVien')->name('admin.storenhanvien');
Route::post('/nhanvien/editnhanvien/{id}', 'NhanVienController@editNhanVien')->name('admin.editnhanvien');
Route::post('/nhanvien/addtknhanvien/{id}', 'NhanVienController@addTKNhanVien')->name('admin.addtknhanvien');
Route::get('/nhanvien/deletenhanvien/{id}', 'NhanVienController@deleteNhanVien')->name('admin.deletenhanvien');
//KHÁCH HÀNG
Route::get('/khachhang/deletekhachhang/{id}', 'KhachHangController@deleteKhachHang')->name('admin.deletekhachhang');

//KHUYẾN MÃI
Route::post('/khuyenmai/addkhuyenmai', 'KhuyenMaiController@storeKhuyenMai')->name('admin.storekhuyenmai');
/* Route::post('/nhanvien/editnhanvien/{id}', 'NhanVienController@editNhanVien')->name('admin.editnhanvien');
Route::post('/nhanvien/addtknhanvien/{id}', 'NhanVienController@addTKNhanVien')->name('admin.addtknhanvien');
Route::get('/nhanvien/deletenhanvien/{id}', 'NhanVienController@deleteNhanVien')->name('admin.deletenhanvien'); */
// QUẢN LÝ ĐƠN HÀNG
Route::get('/donhang/deletedonhang/{id}', 'DonHangController@deleteDonHang')->name('admin.deletedonhang');
Route::post('/donhang/trangthaidonhang/{id}', 'DonHangController@statusDonHang')->name('admin.statusdonhang');
// PHIẾU NHẬP
Route::post('/phieunhap/addphieunhap', 'PhieuNhapController@storePhieuNhap')->name('admin.storephieunhap');
