<?php
$id = $_POST['MaPX'];
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "shoestore");
// Lấy tình trạng đơn
$sql = "SELECT TinhTrangDH FROM phieuxuat WHERE MaPX=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$tinhTrangDH = $row["TinhTrangDH"];

//Kiểm tra điều kiện hủy đơn
if ($tinhTrangDH === "Đang xử lý") {
  echo "Bạn không thể hủy đơn hàng đang xử lý!";
  exit;
}
if ($tinhTrangDH === "Đã hoàn thành") {
  echo "Bạn không thể hủy đơn hàng đã hoàn thành!";
  exit;
}

//Thay đổi trạng thái trong sql
$sql = "UPDATE phieuxuat SET TinhTrangDH = 'Đã hủy' WHERE MaPX = $id";
$conn->query($sql);

//lấy sô lượng của sản phẩm bị hủy
$sql = "SELECT MaSP,SoLuong,SizeSP FROM ctpx WHERE MaPX=$id";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
  $ma = $row["MaSP"];
  $sl = $row["SoLuong"];
  $size = $row["SizeSP"];

  //hoàn trả lại số lượng vô kho
  $sql = "UPDATE ctsizesp SET SoLuong = SoLuong + $sl WHERE MaSP = $ma AND SizeSP = $size";
  $conn->query($sql);

  // trừ số lượng đã bán
  $sql = "UPDATE sanpham SET SoLuongDaBan = SoLuongDaBan - $sl WHERE MaSP = $ma";
  $conn->query($sql);
}
// Đóng kết nối
$conn->close();
//phản hồi cho javascript đã hủy thành công
echo "success";
?>
