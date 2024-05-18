<?php
session_start();
//lấy thông tin logo
$logoName = $_FILES["logo"]["name"];
$logoTmpName = $_FILES["logo"]["tmp_name"];
//lấy thông tin hình trang home
$imgName = $_FILES["img"]["name"];
$imgTmpName = $_FILES["img"]["tmp_name"];
$name = $_POST["name"];
//lấy dữ liệu feedback
$ids = [];
$tenNgFbs = []; 
$images = []; 
$noiDungs = []; 
$soSaos = [];
$avtName = [];
$avtTmpName = [];
// Truy xuất dữ liệu từ $_POST
  $ids = $_POST['id'];
  $tenNgFbs = $_POST['ten'];
  $noiDungs = $_POST['NoiDung'];
  $soSaos = $_POST['SoSao'];
  $avtName = $_FILES["avt"]["name"];
  $avtTmpName = $_FILES["avt"]["tmp_name"];
// Xử lý logo
if (isset($logoName) && !empty($logoName)) {
  // Di chuyển file từ đường dẫn tạm thời sang thư mục lưu trữ
  $logoPath = "C:/xampp/htdocs/webbangiay/assets/img/" . $logoName;
  move_uploaded_file($logoTmpName, $logoPath);
}

// Xử lý img
if (isset($imgName) && !empty($imgName)) {
  // Di chuyển file từ đường dẫn tạm thời sang thư mục lưu trữ
  $imgPath = "C:/xampp/htdocs/webbangiay/assets/img/" . $imgName;
  move_uploaded_file($imgTmpName, $imgPath);
}
//Xử lý avt
for ($i = 0; $i < 5; $i++) {
  if (isset($avtName[$i]) && !empty($avtName[$i])) {
    // Di chuyển file từ đường dẫn tạm thời sang thư mục lưu trữ
    $avtPath = "C:/xampp/htdocs/webbangiay/assets/img/" . $avtName[$i];
    move_uploaded_file($avtTmpName[$i], $avtPath);
  }
}
//lưu dữ liệu
$conn = new mysqli("localhost", "root", "", "shoestore");
$sql="SELECT *
FROM website";
$result = $conn->query($sql);
  $data = mysqli_fetch_assoc($result);
  $logo = $data["logo"];
  $image = $data["imghome"];
  $thuonghieu = $data["thuonghieu"];

if($logoName=='')
  $logoName=$logo;
if($imgName=='')
  $imgName=$image;
if($name=='')
  $name=$thuonghieu;

//cập nhật logo và thương hiệu
$sql = "UPDATE website 
SET logo = IFNULL(?, logo), 
imghome = IFNULL(?, imghome), 
thuonghieu = IFNULL(?, thuonghieu) 
WHERE id = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $logoName, $imgName, $name);
$stmt->execute();

$result = $conn->query("SELECT Image FROM feedback");
  $i = 0;
  while ($row = $result->fetch_assoc()) {
    $images[$i] = $row["Image"];
    $i++;
  }
  for ($i = 0; $i < 5; $i++) {
    if (empty($avtName[$i])) {
      $avtName[$i] = $images[$i];
    }
  }
//cập nhật feedback
$stmt = $conn->prepare("UPDATE feedback SET TenNgFb=?, Image=?, NoiDung=?, SoSao=? WHERE Mafb=?");
  // Cập nhật dữ liệu cho từng hàng
  $success = true;
  for ($i = 0; $i < 5; $i++) {
    $stmt->bind_param("sssii", $tenNgFbs[$i], $avtName[$i], $noiDungs[$i], $soSaos[$i], $ids[$i]);
    if (!$stmt->execute()) {
      echo "Error updating row " . ($i + 1) . ": " . $stmt->error;
      $success = false;
      break;
    }
  }
$conn->close();
  echo "<script>alert('Cập nhật thông tin thành công');</script>";
  echo "<script>window.location.href = '../../index.php?danhmuc=caidatwebsite';</script>";
