<?php
    session_start();
    if(isset($_SESSION['taikhoan'])){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/logins/login-6/assets/css/login-6.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body{
            margin-top:20px;
            background: #f6f9fc;
        }
        .account-block {
            padding: 0;
            background-image: url(assets/img/background-login.png);
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            position: relative;
        }
        .account-block .overlay {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .account-block .account-testimonial {
            text-align: center;
            color: #fff;
            position: absolute;
            margin: 0 auto;
            padding: 0 1.75rem;
            bottom: 3rem;
            left: 0;
            right: 0;
        }

        .text-theme {
            color: #1788F4 !important;
        }

        .btn-theme {
            background-color: #1788F4;
            border-color: #1788F4;
            color: #fff;
        }
        .card{
            border-radius: 10px;
            overflow: hidden;
        }
        .link{
            text-decoration: none;
        }
        .form-group{
            margin: 10px 0;
        }

    </style>
</head>
<body>
        <!-- Login 6 - Bootstrap Brain Component -->
        <div id="main-wrapper" class="container">
            <div class="row justify-content-center" style="border-radius: 10px;">
                <div class="col-xl-10">
                    <div class="card border-0">
                        <div class="card-body p-0">
                            <div class="row no-gutters">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="mb-5">
                                            <h3 class="h4 font-weight-bold text-theme">Đăng ký</h3>
                                        </div>
                                            <div class="form-group">
                                                <label>Tên đăng nhập</label>
                                                <input type="text" id="txttenDangNhap" class="form-control">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                
                                                    <label>Họ và tên</label>
                                                    <input type="text" id="txtHoTen" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Ngày sinh</label>
                                                    <input type="date" id="txtngaysinh" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label>Số điện thoại</label>
                                                    <input type="text" id ="txtSDT" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Email</label>
                                                    <input type="email" id="txtEmail" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-4" >
                                                    <label>Giới tính</label>
                                                    <div style="display: flex; gap: 30px;">
                                                        <div class="form-check" style="margin-top: 10px;" >
                                                            <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                                            <label class="form-check-label" for="1">
                                                                Nam
                                                            </label>
                                                        </div>
                                                        <div class="form-check" style="margin-top: 10px;">
                                                            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                                            <label class="form-check-label" for="0">
                                                                Nữ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row"></div>
                                            
                                            <div class="form-group">
                                                <label>Địa chỉ</label>
                                                <input type="text" id="txtdiachi" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Mật khẩu</label>
                                                <input type="password" id="txtMK" class="form-control">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label>Nhập lại mật khẩu</label>
                                                <input type="password" id="txtMK02" class="form-control">
                                            </div>
                                            <p id="thongbao" style="color: red"></p>
                                            <button id="btnSubmit" class="btn btn-theme">Đăng ký</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <p class="text-muted text-center mt-3 mb-0">Trở về <a href="login.php" class="link text-primary ml-1">Đăng nhập</a></p>

                    <!-- end row -->

                </div>
                <!-- end col -->
            </div>
            <!-- Row -->
        </div>
</body>
</html>
<script>
    $(document).ready(function(){
        var btnSubmit=document.getElementById("btnSubmit");
        btnSubmit.addEventListener('click', function(){
            $.ajax({
                url: './control/ajax_register.php',
                type: 'POST',
                data: {
                    tenDangNhap: getTenDangNhap(),
                    hoTen: getHoTen(),
                    sdt: getSDT(),
                    email: getEmail(),
                    day: getNgaysinh(),
                    mk: getMK(),
                    mk02: getMK02(),
                    diachi: getDiachi(),
                    gioitinh: getGioitinh(),
                },
                success: function(data){
                    var thongbao=document.getElementById("thongbao");
                    if(data== 'botrongthongtin'){
                        thongbao.innerHTML = 'Vui lòng điền đầy đủ thông tin';
                    }
                    else if (data == 'khongchongioitinh'){
                        thongbao.innerHTML='Vui lòng chọn giới tính';
                    }
                    else if (data == 'khongchonngaysinh'){
                        thongbao.innerHTML='Vui lòng chọn ngày sinh';
                    }
                    else if(data=='tendangnhapdatontai'){
                        thongbao.innerHTML ='Tên Đăng nhập đã tồn tại trong hệ thống!';
                    }
                    else if(data=='tendangnhapkhongdung'){
                        thongbao.innerHTML ='Tên Đăng nhập phải từ 5-15 kí tự và chỉ chứ chữ cái, chữ số, dấu gạch dưới';
                    }
                    else if (data=='saihoten'){
                        thongbao.innerHTML ='Phải có họ và tên, không bao gồm kí tự số và kí tự đặc biệt(ví dụ: Nguyễn Văn Thọt)!';
                    }
                    else if (data=='saisdt'){
                        thongbao.innerHTML ='Số điện thoại phải bắt đầu bằng số 0 và phải có 10 số (ví dụ: 0338873461)';
                    }
                    else if (data== 'sdtdatontai'){
                        thongbao.innerHTML ='Số điện thoại đã tồn tại trong hệ thống!';
                    }
                    else if (data=='saiemail'){
                        thongbao.innerHTML ='Email phải có dạng @gmail.com';
                    }
                    else if (data=='saingaysinh') {
                        thongbao.innerHTML ='Ngày sinh không hợp lệ!';
                    }
                    else if (data=='saimk') {
                        thongbao.innerHTML ='Mật khẩu không hợp lệ, mật khẩu là chữ cái hoặc chữ số, có độ dài hơn 8 và không chứa kí tự đặc biệt(ví dụ: Password123)!';
                    }
                    else if (data=='saimk02') {
                        thongbao.innerHTML ='Xác nhận mật khẩu sai!';
                    }
                    else{
                        thongbao.innerHTML ='Đăng kí thành công';
                    }
                }
            });
        });
    });
    function getTenDangNhap(){
        var tenDangNhap = document.getElementById('txttenDangNhap').value;
        return tenDangNhap;
    }
    function getHoTen(){
        var hoTen = document.getElementById('txtHoTen').value;
        return hoTen;
    }
    function getSDT(){
        var sdt = document.getElementById('txtSDT').value;
        return sdt;
    }
    function getEmail(){
        var email = document.getElementById('txtEmail').value;
        return email;
    }
    function getNgaysinh(){
        var day = document.getElementById('txtngaysinh').value;
        return day;
    }
    function getMK(){
        var mk = document.getElementById('txtMK').value;
        return mk;
    }
    function getMK02(){
        var mk02 = document.getElementById('txtMK02').value;
        return mk02;
    }
    function getDiachi(){
        var diachi = document.getElementById('txtdiachi').value;
        return diachi;
    }
    function getGioitinh(){
        var gioitinh = document.querySelector('input[name="gender"]:checked');
        var selectedGender;
        if (gioitinh) {
            selectedGender = gioitinh.value;
        } else {
            selectedGender="";
        }
        return selectedGender;
    }
</script>