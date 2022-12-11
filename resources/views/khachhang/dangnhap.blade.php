<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style=" box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);">
            <div class="modal-body pb-2">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 bg-white describe-login">
                            <h4>Đăng nhập</h4>
                            <p>
                                Đăng nhập để theo dõi đơn hàng, nhận nhiều ưu đãi
                                hấp dẫn và thanh toán dễ dàng hơn.
                            </p>
                            <div class="img pe-2">
                                <img src="{{ asset('/login-go.png') }}" alt="ảnh" style="width: 238px;">
                            </div>
                        </div>
                        <div class="col-md-8 form-login">
                            <div class="form-login-content bg-white p-2 my-3 mx-1">
                                <h5 class="form-login-title">
                                    Đăng nhập
                                </h5>
                                <form method="POST" action="{{ Route('khachhang.khlogin') }}">
                                    @csrf
                                    <div class="form-floating form-floating-dn">
                                        <input type="email" class="form-control" name="email" id="email_dn" placeholder="Email" required>
                                        <label class="d-flex align-items-center">Email</label>
                                    </div>
                                    <div class="form-floating form-floating-dn">
                                        <input type="password" class="form-control" name="password" id="mk_dn" placeholder="Mật khẩu" required>
                                        <label class="d-flex align-items-center">Mật khẩu</label>
                                    </div>
                                    <div class="form-group text-start m-4">
                                        Quên mật khẩu? Nhấn vào
                                        <a href="{{ Route('khachhang.quenmatkhau') }}" style="text-decoration: none;">đây</a>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="submit" class="form-control btn-warning" id="dnhap" name="dnhap" value="Đăng nhập">
                                    </div>
                                    <div class="form-group mb-3">
                                        <a href="" class="btn" id="dnhapfb" name="dnhapfb">
                                            <i class="fab fa-facebook icon-login-social"></i>
                                            Đăng nhập bằng Facebook
                                        </a>
                                    </div>
                                    <div class="form-group mb-4">
                                        <a href="" class="btn" id="dnhapgg" name="dnhapgg">
                                            <i class="fab fa-google-plus icon-login-social"></i>
                                            Đăng nhập bằng Google
                                        </a>
                                    </div>
                                    <hr>
                                    <div class="sign-up m-4">
                                        Bạn chưa có tài khoản? Vui lòng
                                        <a href="{{ Route('khachhang.dangky') }}" target="_blank" class="badge bg-danger">Đăng ký</a>
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