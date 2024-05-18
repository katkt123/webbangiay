<?php
require '../config/config.php';

// Lấy MaPN từ yêu cầu HTTP GET
$MaPN = $_GET['mapn'];

// Truy vấn để lấy thông tin từ bảng phieunhap
$sql_phieunhap = "SELECT * FROM phieunhap WHERE MaPN = $MaPN";
$result_phieunhap = $connect->query($sql_phieunhap);

// Truy vấn để lấy thông tin từ bảng ctpn
$sql_ctpn = "SELECT * FROM ctpn WHERE MaPN = $MaPN";
$result_ctpn = $connect->query($sql_ctpn);

// Kiểm tra nếu có dữ liệu trong bảng phieunhap
if ($result_phieunhap->num_rows > 0) {
    // Hiển thị thông tin từ bảng phieunhap
    $row_phieunhap = $result_phieunhap->fetch_assoc();
    echo "<strong>Mã phiếu nhập: </strong>" . $row_phieunhap['MaPN'] . "<br>";
    echo "<strong>Mã nhân viên: </strong>" . $row_phieunhap['MaNV'] . "<br>";
    echo "<strong>Ngày nhập: </strong>" . $row_phieunhap['NgayNhap'] . "<br>";
    echo "<strong>Mã nhà cung cấp: </strong>" . $row_phieunhap['MaNCC'] . "<br>";
    echo "<strong>Tổng tiền: </strong>" . $row_phieunhap['TongTien'] . "<br>";
    echo "<strong>Tổng số lượng: </strong>" . $row_phieunhap['TongSoLuong'] . "<br>";
    echo "<strong>Tình trạng đơn hàng: </strong>" . $row_phieunhap['TinhTrangDH'] . "<br>";

    // Hiển thị thông tin từ bảng ctpn nếu có
    if ($result_ctpn->num_rows > 0) {
        echo "<h2>Chi tiết phiếu nhập</h2>";
        echo '<table border="1" class="table table-striped " >';
        echo "<tr><th>Mã sản phẩm</th><th>Size sản phẩm</th><th>Số lượng</th><th>Giá nhập</th></tr>";
        // Khởi tạo một mảng để lưu trữ số lượng của mỗi MaSP
        $MaSP_counts = array();

        // Lặp qua kết quả từ bảng ctpn để đếm số lượng của mỗi MaSP
        while ($row_ctpn = $result_ctpn->fetch_assoc()) {
            $MaSP = $row_ctpn['MaSP'];
            // Nếu MaSP đã tồn tại trong mảng, tăng số lượng lên 1
            if (array_key_exists($MaSP, $MaSP_counts)) {
                $MaSP_counts[$MaSP]++;
            } else {
                // Nếu MaSP chưa tồn tại trong mảng, khởi tạo số lượng là 1
                $MaSP_counts[$MaSP] = 1;
            }
        }

        // Đặt rowspan và hiển thị thông tin từ bảng ctpn
        foreach ($MaSP_counts as $MaSP => $count) {
            echo "<tr>";
            echo "<td rowspan='$count'><strong>$MaSP</strong></td>";
            $result_ctpn->data_seek(0); // Đặt con trỏ kết quả trở lại đầu để lặp lại từ đầu
            $first_row = true;
            while ($row_ctpn = $result_ctpn->fetch_assoc()) {
                if ($row_ctpn['MaSP'] == $MaSP) {
                    if (!$first_row) {
                        echo "<tr>";
                    }
                    echo "<td>" . $row_ctpn['SizeSP'] . "</td>";
                    echo "<td>" . $row_ctpn['SoLuong'] . "</td>";
                    echo "<td>" . number_format($row_ctpn['GiaNhap'], 0, ',', '.') . " VND</td>";
                    echo "</tr>";
                    $first_row = false;
                }
            }
        }
        echo "</table>";
    } else {
        echo "Không có chi tiết phiếu nhập.";
    }
} else {
    echo "Không tìm thấy phiếu nhập.";
}

// Đóng kết nối
$connect->close();
?>
