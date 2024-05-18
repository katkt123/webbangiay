<?php
$id = $_POST['MaPX'];
 // Kết nối cơ sở dữ liệu
 $conn = mysqli_connect("localhost", "root", "", "shoestore");
// Lấy trạng thái hiện tại
$sql = "SELECT TinhTrangDH FROM phieuxuat WHERE MaPX=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$trangThaiHienTai = $row['TinhTrangDH'];
  //kiểm tra trạng thái
  if ($trangThaiHienTai === "Đã hoàn thành") {
    echo "Bạn không thể chuyển trạng thái đơn hàng đã hoàn thành!";
    exit;
  }
  //chuyển sang trạng thái tiếp theo
  $trangThaiTiepTheo = getTrangThaiTiepTheo($trangThaiHienTai);

  //lấy mã nhân viên đang xử lý đơn hàng
  session_start();
  $ten = $_SESSION['taikhoan'];
  $sql = "SELECT Ma FROM user WHERE TenDangNhap = '$ten'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $maNV = $row['Ma'];

  //Cập nhật trạng thái mới và nhân viên xử lý đơn hàng này
  $sql = "UPDATE phieuxuat 
        SET TinhTrangDH = '$trangThaiTiepTheo', MaNV = '$maNV' 
        WHERE MaPX = $id";
  $conn->query($sql);

  // Đóng kết nối
  $conn->close();
  echo 'success';
function getTrangThaiTiepTheo($trangThaiHienTai) {
  switch ($trangThaiHienTai) {
    case 'Tạm giữ':
      return 'Đang xử lý';
    case 'Đang xử lý':
      return 'Đã hoàn thành';
    default:
      return null;
  }
}
?>