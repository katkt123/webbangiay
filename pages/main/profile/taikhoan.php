
<?php
    //dtb taikhoan nhanvien khachhang
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/taikhoan-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/taikhoan-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/user-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/user.php');
    $tenDangNhap=$_SESSION["taikhoan"];
    $Ma=getUser($tenDangNhap)->getMa();
    $hoTen=getUser($tenDangNhap)->getHoTen();
    $ngaySinh=getUser($tenDangNhap)->getNgaySinh();
    $sdt=getUser($tenDangNhap)->getSDT();
    $email=getUser($tenDangNhap)->getEmail();
    $diaChi=getUser($tenDangNhap)->getDiaChi();
    $gioiTinh=getUser($tenDangNhap)->getGioiTinh();
    $matKhau=getTaiKhoan($tenDangNhap)->getMatKhau();
    $avt=getTaiKhoan($tenDangNhap)->getAvt();
    $slipt = explode(" ", $hoTen);
    // Lấy từ cuối cùng trong mảng
    $Ten = end($slipt);
    $Ho = $slipt[0];
?>
<main class="profile-item">
    <div class="woocommerce-MyAccount-content">
        <div class="form-changeProfile" >
            <p class="">
                <label for="account_display_name">Tên hiển thị&nbsp;<span class="required"></span></label>
                <br>
                <input type="text" class="hoTen"  name="account_display_name" id="account_display_name" value="<?php echo $hoTen ?>"> <span><em>Tên này sẽ hiển thị trong trang Tài khoản và phần Đánh giá sản phẩm</em></span>
            </p>
            <p class="">
                <label for="account_display_name">Ngày sinh&nbsp; (MM/DD/YYYY)<span class="required"></span></label>
                <br>
                <input type="date" id="dateInput" class="ngaySinh" value="<?php echo $ngaySinh ?>" />            
            </p>
            <div class="form-email-sdt">
                <p class="">
                    <label for="account_display_name">Số điện thoại&nbsp;<span class="required"></span></label>
                    <span class="warning warning-sdt">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        SDT phải có 10 hoặc 11 số
                    </span>
                    <br>
                    <input type="text" class="soDienThoai"  name="account_display_name" id="account_display_name" value="<?php echo $sdt ?>">
                </p>

                <p class="">
                    <label for="account_email">Địa chỉ email&nbsp;<span class="required"></span></label>
                    <span class="warning warning-email">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Email phải có đuôi @gmail.com
                    </span>
                    <br>
                    <input type="email" class="inputEmail" name="account_email" id="account_email" autocomplete="email" value="<?php echo $email ?>">
                </p>
            </div>
            <p class="">
                <label for="account_email">Địa chỉ&nbsp;<span class="required"></span></label>
                    <span class="warning warning-diachi">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Địa chỉ không đúng định dạng
                </span>
                <br>
                <input type="text" class="diaChi" name="account_email" id="account_email" autocomplete="email" value="<?php echo $diaChi ?>">
            </p>
            <p class="">
                <label for="password_1">Mật khẩu cũ</label>
                <span class="password-input">
                    <input type="password" class="passwordOld" name="" id="" autocomplete="off">
                    <span class="show-password-input"></span>
                </span>
            </p>
            <p class="">
                <label for="password_1">Mật khẩu mới</label>
                <span class="password-input">
                    <input type="password" class="passwordNew" name="" value="" id="" autocomplete="off">
                    <span class="show-password-input"></span>
                </span>
            </p>
            <p class="">
                <label for="password_2">Xác nhận mật khẩu mới</label>
                <span class="warning warning-passath">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Mật khẩu xác thực không đúng
                </span>
                <span class="password-input">
                    <input type="password" class="passwordNewAth" name="" id="" autocomplete="off">
                    <span class="show-password-input"></span>
                </span>
            </p>
            <p>
                <button class="btnSave">Lưu thay đổi</button>
            </p>

        </div>
    </div>
    <div class="notification">
    </div>
</main>
<script>
    $(document).ready(function(){
        console.log(getNgaySinh());
        function getHoTen(){
            var hoTen=document.querySelector(".hoTen");
            return hoTen.value;
        }
        function getSDT(){
            var sdt=document.querySelector(".soDienThoai");
            return sdt.value;
        }
        function getEmail(){
            var email=document.querySelector(".inputEmail");
            return email.value;
        }
        function getNgaySinh(){
            var ngaySinh=document.querySelector(".ngaySinh");
            return ngaySinh.value;
        }
        function getDiaChi(){
            var diaChi=document.querySelector(".diaChi");
            return diaChi.value;
        }
        var maUser=<?php echo $Ma ?>;
        function getPassOld(){
            var passOld= document.querySelector(".passwordOld");
            return passOld.value;
        }
        function getPassNew(){
            var passNew= document.querySelector(".passwordNew");
            return passNew.value;
        }
        function getPassNewAth(){
            var passNewAth= document.querySelector(".passwordNewAth");
            return passNewAth.value;
        }
        function isValidPhoneNumber(phoneNumber) {
            var phonePattern = /^\d{10,11}$/; 
            return phonePattern.test(phoneNumber);
        }
        function isValidEmail(email) {
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
            return emailPattern.test(email);
        }
        var soDienThoai=document.querySelector(".soDienThoai");
        soDienThoai.addEventListener("blur", function(){
            var warningSdt=document.querySelector(".warning-sdt");
            if(isValidPhoneNumber(soDienThoai.value)){
                warningSdt.style.opacity=0;
            }
            else{
                warningSdt.style.opacity=1;
            }
        });
        var email=document.querySelector(".inputEmail");
        email.addEventListener("blur", function(){
            var warningEmail=document.querySelector(".warning-email");
            if(isValidEmail(email.value)){
                warningEmail.style.opacity=0;
            }
            else{
                warningEmail.style.opacity=1;
            }
        });
        var passNewAth= document.querySelector(".passwordNewAth");
        passNewAth.addEventListener('input', function(){
            var warningPass=document.querySelector(".warning-passath");
            if(getPassNew()==getPassNewAth()){
                warningPass.style.opacity=0;
            }
            else{
                warningPass.style.opacity=1;
            }
        });
        var btnSave=document.querySelector(".btnSave");
        btnSave.addEventListener('click', function(){
            var passNewAth= document.querySelector(".passwordNewAth");
            var passNew= document.querySelector(".passwordNew");
            var warningEmail=document.querySelector(".warning-email");
            var warningPass=document.querySelector(".warning-passath");
            var warningSdt=document.querySelector(".warning-sdt");
            if(getPassOld()=="<?php echo $matKhau ?>"){
                if(passNew.value==passNewAth.value){
                    if(isValidPhoneNumber(soDienThoai.value)){
                        if(isValidEmail(email.value)){
                            $.ajax({
                                url: "./control/ajax_action.php",
                                method: "POST",
                                data: {
                                    tenDangNhap: "<?php echo $_SESSION['taikhoan'] ?>",
                                    hoTen:getHoTen(),
                                    ngaySinh:getNgaySinh(),
                                    sdt:getSDT(),
                                    email:getEmail(),
                                    diaChi:getDiaChi(),
                                    passNew: getPassNew(),
                                    action: "updateProfile"
                                },
                                success: function(data){
                                    if(data==1){// Cập nhật thành công
                                        var tenUser=document.querySelector(".profile-user-name");
                                        tenUser.innerHTML=getHoTen();
                                        var headerInfo=document.querySelector(".header__action-login-name");
                                        var slipt = getHoTen().split(" ");
                                        // Lấy từ cuối cùng trong mảng
                                        var Ten = slipt[slipt.length - 1] + " " + getHoTen();
                                        headerInfo.innerHTML=Ten;
                                        async function showAlert() {
                                            await Swal.fire({
                                                icon: 'success',
                                                title: 'Thành công',
                                                text: 'Thay đổi thông tin cá nhân thành công!',
                                                timer: 2000
                                            });
                                        }
                                        showAlert();
                                        // creatToast("item-success","Thay đổi thành công !","fa-solid fa-circle-check","item-end-success");
                                    }
                                    else{// Không có hàng nào được cập nhật
                                        creatToast("item-warning","Không có bất kì thay đổi nào!","fa-solid fa-circle-exclamation","item-end-warning");
                                    }
                                }
                            });
                        }
                        else{
                            warningEmail.style.opacity=1;
                            creatToast("item-error","Vui lòng nhập đúng định dạng Email","fa-solid fa-triangle-exclamation","item-end-error");
                        }
                    }
                    else{
                        warningSdt.style.opacity=1;
                        creatToast("item-error","Vui lòng nhập đúng định dạng SDT","fa-solid fa-triangle-exclamation","item-end-error");
                    }
                }
                else{
                    warningPass.style.opacity=1;
                    creatToast("item-error","Mật khẩu xác thực không chính xác","fa-solid fa-triangle-exclamation","item-end-error");
                }
            }
            else{
                creatToast("item-error","Mật khẩu cũ không chính xác","fa-solid fa-triangle-exclamation","item-end-error");
            }
        });
    });
</script>