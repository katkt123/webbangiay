<?php
$productId = $_POST['productId'];
$dir =  __DIR__;
$targetDir = str_replace("admin\\module\\main", "config\\config.php", $dir);
require $targetDir;

$html = '';
$sql = "SELECT SizeSP,SoLuong FROM `ctsizesp` WHERE MaSP =" . $productId;
$result = $connect->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$size = $row['SizeSP'];
	    $number = $row['SoLuong'];
	    $html .= '<tr><td>' . $size . '</td><td>' . $number . '</td></tr>';
	}
}


echo $html;
?>