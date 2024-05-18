<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/taikhoan.php');
    function getTenNhomQuyen($TenDangNhap){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM `taikhoan` INNER JOIN `quyen` ON taikhoan.MaQuyen = quyen.MaQuyen WHERE taikhoan.TenDangNhap='$TenDangNhap'");
        $row=mysqli_fetch_array($kq);
        return $row['TenQuyen'];
    }
    function getTaiKhoan($TenDangNhap){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM `taikhoan` WHERE TenDangNhap = '$TenDangNhap' ");
        $row=mysqli_fetch_array($kq);
        $taikhoan = new TaiKhoan(
            $row['TenDangNhap'],
            $row['MatKhau'],
            $row['NgayTaoTK'],
            $row['MaQuyen'],
            $row['Avt']
        );
        $db->disconnect();
        return $taikhoan;
    }
    function isValidUsername($username) {
        return preg_match('/^[a-zA-Z0-9_]{5,15}$/', $username);
    }
    function tenDangNhapTonTai($TenDangNhap){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM `taikhoan` WHERE TenDangNhap = '$TenDangNhap' ");
        $row=mysqli_fetch_array($kq);
        $db->disconnect();
        if($row) {
            return 1; // Tên đăng nhập tồn tại
        } else {
            return 0; // Tên đăng nhập không tồn tại
        }
    }
    function checkHoTen($name) {
        // Loại bỏ khoảng trắng thừa
        $name = trim($name);
        $flag = 0;
        if ( preg_match('/\s/', $name) ) {      // Kiểm tra xem họ và tên có được phân cách bằng dấu cách hay không
            if ( preg_match('/\d/', $name) ) { // Kiểm tra xem có chứa ký tự số hay không
                $flag=0;
            }
            else if ( preg_match('/[!@#$%^&*()_+-=\[\];:\'\"]/', $name) ) { // Kiểm tra xem có kí tự đặc biệt không
                $flag=0;
            }
            else {
                $flag=1;
            }
        }
        return $flag;
    }
    function checkSDT($sdt){
        $flag =0;
        if ( preg_match('/^0\d{9}$/',$sdt) ){
            $flag =1;
        }
        return $flag;
    }
    function checkSDTtontai($sdt){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM `user` WHERE SDT = '$sdt' ");
        $row= mysqli_num_rows($kq);
        $db->disconnect();
        if($row ==0) {
            return 1; // sdt chưa tồn tại trong hệ thống
        } else {
            return 0; // sdt đã tồn tại trong hệ thống
        }
    }
    function checkEmail($email){
        $flag =0;
        if ( preg_match('/.*@gmail\.com$/',$email) ){
            $flag =1;
        }
        return $flag;
    }
    function checkNgaysinh($day){
        $flag =0;
        $ngayhomnay = strtotime('now');
        if ( $day<=$ngayhomnay ){
            $flag =1;
        }
        return $flag;
    }
    function checkmk($mk){
        $flag =0;
        if(preg_match('/[a-z0-99]{8}/', $mk)){
            if ( preg_match('/[!@#$%^&*()_+-=\[\];:\'\"\s]/', $mk) ) { // Kiểm tra xem có kí tự đặc biệt không
                $flag=0;
            }
            if (preg_match('/\d/',$mk) ){
                $flag=1;
            }
            else {
                $flag=1;
            }
        }
        return $flag;
    }
    function checkmk02($mk,$mk02){
        $flag =0;
        if ( $mk==$mk02) {
            $flag=1;
        }
        return $flag;
    }
    function dangki($tenDangNhap,$hoTen,$sdt,$email,$day,$mk02,$diachi,$gioitinh){
        $ngayhientai = date('Y/m/d');
        $db = new DTB();
        mysqli_query($db->getConnection(),"INSERT INTO `taikhoan`(`TenDangNhap`, `MatKhau`, `NgayTaoTK`, `MaQuyen`, `Avt`, `TrangThai`) VALUES ('$tenDangNhap','$mk02','$ngayhientai',4,'avt-default.jpg',0)");
        mysqli_query($db->getConnection(), "INSERT INTO user(`TenDangNhap`, `HoTen`, `NgaySinh`, `SDT`, `Email`, `DiaChi`, `GioiTinh`) VALUES ('$tenDangNhap','$hoTen','$day','$sdt','$email','$diachi',$gioitinh)");
    }
    // echo dangki("b","a","a","a",'2023-03-02',"a","a",1);
    // echo getTaiKhoan("user2");
?>