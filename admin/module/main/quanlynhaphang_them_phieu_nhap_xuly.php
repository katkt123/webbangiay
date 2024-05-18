<?php
$Dir_nm = __DIR__;
$targetDir = str_replace("admin\\module\\main", "config\\config.php", $Dir_nm);
require $targetDir;
// Kiểm tra xem có dữ liệu được gửi từ phía client không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biến POST
    $MaNV = $_POST['MaNV'];
    $NgayNhap = $_POST['NgayNhap'];
    $nhacungcap = $_POST['nhacungcap'];
    $tinhTrang = $_POST['tinhTrang'];
    $data = json_decode($_POST['data'], true); // Giải mã dữ liệu JSON thành mảng PHP

    $TongTien = 0;
    $TongSoLuong = 0;
    foreach ($data as $row) {
        $TongTien += $row[2] * $row[3];
        $TongSoLuong += $row[2];
    }

    $sql = "SELECT MaNCC FROM nhacungcap WHERE TenNCC = ?";
    // Chuẩn bị và thực thi câu truy vấn sử dụng prepared statement
    if ($stmt = $connect->prepare($sql)) {
        $stmt->bind_param("s", $nhacungcap); // "s" đại diện cho kiểu dữ liệu string
        $stmt->execute();
        $stmt->bind_result($maNCC);
        $stmt->fetch();
        $stmt->close();
    }

        // Thêm dữ liệu vào bảng phieunhap
    $sql_phieunhap = "INSERT INTO phieunhap (MaNV, NgayNhap, MaNCC, TongTien, TongSoLuong, TinhTrangDH, Trangthai) 
                      VALUES ('$MaNV', '$NgayNhap', '$maNCC', '$TongTien', '$TongSoLuong', '$tinhTrang', 1)";

    if ($connect->query($sql_phieunhap) === TRUE) {

        $MaPN = $connect->insert_id;
        // Thêm dữ liệu vào bảng ctpn cho mỗi hàng trong $data
        foreach ($data as $row) {
            $MaSP = $row[0];
            $SizeSP = $row[1];
            $SoLuong = $row[2];
            $GiaNhap = $row[3];

            $sql_ctpn = "INSERT INTO ctpn (MaPN, MaSP, SoLuong, GiaNhap, SizeSP) 
                         VALUES ('$MaPN', '$MaSP', '$SoLuong', '$GiaNhap', '$SizeSP')";

            // Thực thi truy vấn
            if ($connect->query($sql_ctpn) !== TRUE) {
                echo "Lỗi: " . $sql_ctpn . "<br>" . $connect->error;
            }
            if ($tinhTrang != "Chưa nhận") {
                $sql_sua_gia = "UPDATE sanpham SET GiaCu = GiaMoi, GiaMoi = $GiaNhap WHERE MaSP = " . $MaSP;
                if ($connect->query($sql_sua_gia) !== TRUE) {
                    echo "Lỗi: " . $sql_sua_gia . "<br>" . $connect->error;
                }
                $sql_sua_ctsize = "UPDATE `ctsizesp` SET `SoLuong`= $SoLuong WHERE MaSP = $MaSP and SizeSP = $SizeSP";
                if ($connect->query($sql_sua_ctsize) !== TRUE) {
                    echo "Lỗi: " . $sql_sua_ctsize . "<br>" . $connect->error;
                }
            }
        }
        echo "Dữ liệu đã được thêm vào cơ sở dữ liệu thành công!";
    } else {
        echo "Lỗi: " . $sql_phieunhap . "<br>" . $connect->error;
    }

    // Đóng kết nối
    $connect->close();
} else {
    // Nếu không có dữ liệu được gửi, trả về thông báo lỗi
    echo "Lỗi: Không có dữ liệu được gửi!";
}
?>
