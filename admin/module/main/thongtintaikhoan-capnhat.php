<?php
session_start();
$ten = "$_SESSION[taikhoan]";
echo $ten;
// Lấy dữ liệu từ form
$avatarName = $_FILES["avatar"]["name"];
$avatarTmpName = $_FILES["avatar"]["tmp_name"];
$hoTenNV = $_POST["name"];
$ngaySinh = $_POST["dob"];
$gioiTinh = $_POST["gender"];
$sdt = $_POST["phone"];
$email = $_POST["email"];
$diaChi = $_POST["address"];
$matKhauCu = $_POST["password"];
$matKhauMoi = $_POST["new_password"];
// Kiểm tra dữ liệu
if (empty($hoTenNV) || empty($email) || empty($sdt) || empty($diaChi)) {
  echo "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
  echo "<script>window.location.href = '../../index.php?danhmuc=thongtintaikhoan';</script>";
    exit();
  }

  //Lấy dữ liệu
  $conn = mysqli_connect("localhost", "root", "", "shoestore");
  $sql ="SELECT MatKhau,Avt
        FROM taikhoan
        WHERE TenDangNhap = '$ten';";
  $result = $conn->query($sql);
  $data = mysqli_fetch_assoc($result);
  $mkCu = $data["MatKhau"];
  $avtCu = $data["Avt"];

  if($matKhauMoi != '' || $matKhauCu != ''){
    //Kiểm tra mật khẩu hiện tại
    if ($matKhauCu != $mkCu) {
      echo "<script>alert('Mật khẩu hiện tại không đúng. Vui lòng nhập mật khẩu lại!');</script>";
      echo "<script>window.location.href = '../../index.php?danhmuc=thongtintaikhoan';</script>";
      exit;
    }
    //Kiểm tra mật khẩu trùng
    if ($matKhauCu == $matKhauMoi) {
      echo "<script>alert('Mật khẩu mới trùng với mật khẩu hiện tại. Vui lòng nhập mật khẩu khác!');</script>";
      echo "<script>window.location.href = '../../index.php?danhmuc=thongtintaikhoan';</script>";
      exit;
    if ($matKhauMoi == '') {
      echo "<script>alert('Vui lòng nhập mật khẩu mới!');</script>";
      echo "<script>window.location.href = '../../index.php?danhmuc=thongtintaikhoan';</script>";
      exit;
      }
    }}

// Xử lý upload file
if (isset($avatarName) && !empty($avatarName)) {
  // Kiểm tra kích thước file
  if ($_FILES["avatar"]["size"] > 2097152) {
    echo "Lỗi: Kích thước file quá lớn!";
    exit();
  }

  // Kiểm tra định dạng file
  $allowedTypes = array("image/jpeg", "image/png", "image/gif");
  if (!in_array($_FILES["avatar"]["type"], $allowedTypes)) {
    echo "Lỗi: Định dạng file không hợp lệ!";
    exit();
  }

  // Di chuyển file từ đường dẫn tạm thời sang thư mục lưu trữ
  $avatarPath = "C:/xampp/htdocs/webbangiay/admin/assets/img/" . $avatarName;
  if (move_uploaded_file($avatarTmpName, $avatarPath)) {
    echo "Upload file thành công!";
  } else {
    echo "Lỗi: Upload file thất bại!";
    exit();
  }

}

if($avatarName == ''){
  $avatarName = $avtCu;}
if($matKhauMoi == ''){
  $matKhauMoi = $mkCu;}
try {
    // Chuẩn bị câu lệnh SQL
    $sql = "UPDATE user nv
    INNER JOIN taikhoan tk ON nv.TenDangNhap = tk.TenDangNhap
    SET nv.HoTen = ?, nv.NgaySinh = ?, nv.GioiTinh = ?, nv.SDT = ?, nv.Email = ?, nv.Diachi = ?, tk.Avt = ?, tk.MatKhau = ?
    WHERE nv.TenDangNhap = '$ten'";
  
    // Gán giá trị cho các tham số
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $hoTenNV, $ngaySinh, $gioiTinh, $sdt, $email, $diaChi, $avatarName, $matKhauMoi);
    // Thực thi câu lệnh SQL
    $stmt->execute();
  
    //Xử lý kết quả
    if ($stmt->affected_rows > 0) {
      echo "<script>alert('Cập nhật thông tin tài khoản thành công');</script>";
      echo "<script>window.location.href = '../../index.php?danhmuc=thongtintaikhoan';</script>";
    } else {
      echo "<script>alert('Cập nhật thông tin tài khoản thất bại');</script>";
      echo "<script>window.location.href = '../../index.php?danhmuc=thongtintaikhoan';</script>";
    }
  } catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
  } finally {
    // Đóng kết nối database
    $conn->close();
  }
  