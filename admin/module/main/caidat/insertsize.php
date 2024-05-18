<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['size'])) {
    $size = $_POST['size'];

    // Kiểm tra nếu size đã tồn tại trong cơ sở dữ liệu
    $sql = "SELECT * FROM sizesp WHERE SizeSP = '$size'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['hide'] == 0) {
            // Cập nhật hide = 1 nếu size đã bị ẩn
            $updateSql = "UPDATE sizesp SET hide = 1 WHERE SizeSP = '$size'";
            $conn->query($updateSql);
            echo "<tr data-size='" . $size . "'>
                    <td>" . $size . "</td>
                    <td>
                        <button class='btn btn-secondary btn-delete' type='button' aria-expanded='false'>Xóa</button>
                    </td>
                  </tr>";
        } else {
            // Size đã tồn tại và đang được hiển thị
            echo "exists";
        }
    } else {
        // Size chưa tồn tại, thêm mới
        $insertSql = "INSERT INTO sizesp (SizeSP, hide) VALUES ('$size', 1)";
        if ($conn->query($insertSql) === TRUE) {
            echo "<tr data-size='" . $size . "'>
                    <td>" . $size . "</td>
                    <td>
                        <button class='btn btn-secondary btn-delete' type='button' aria-expanded='false'>Xóa</button>
                    </td>
                  </tr>";
        }
        $insertSqlKho = "INSERT INTO ctsizesp (MaSP, SizeSP, SoLuong)
        SELECT DISTINCT MaSP, $size as SizeSP, 0 as SoLuong
        FROM ctsizesp;";
        $conn->query($insertSqlKho);

    }
    $conn->close();
}
?>