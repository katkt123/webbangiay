<?php
$phieunhapId = $_POST['phieunhapId'];
$dir =  __DIR__;
$targetDir = str_replace("admin\\module\\main", "config\\config.php", $dir);
require $targetDir;

$html = '';
$sql = "SELECT MaSP,SoLuong,GiaNhap,SizeSP FROM `ctpn` WHERE MaPN =" . $phieunhapId;
$result = $connect->query($sql);
$masp = -1;
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		if ($masp != $row['MaSP'] && $masp != -1){
			$html .= '</tbody>
					</table>';
		}
		if ($masp != $row['MaSP']) {
			$html .= '<h3>Mã Sản phẩm: '.$row['MaSP'].'</h3>';
			$html .= '<table>
					<thead>
						<tr>
			                <th>Size</th>
			                <th>Số lượng</th>
			                <th>Giá nhập</th>
			            </tr>
					</thead>
					<tbody>
		                <tr>';
		}
		
		$html .= '<td>'.$row['SizeSP'].'</td>';
		$html .= '<td>'.$row['SoLuong'].'</td>';
		$html .= '<td>'.number_format($row['GiaNhap'], 0, ',', '.').' VND</td>';
		$html .= '</tr>';

		$masp = $row['MaSP'];
	}
}
$connect->close();
echo $html;
?>
				
		                	