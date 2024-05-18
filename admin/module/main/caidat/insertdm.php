<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['tenLoai'])) {
   $tenLoai = $_POST['tenLoai'];

    // Kiểm tra nếu loại sản phẩm đã tồn tại trong cơ sở dữ liệu
    $sql = "SELECT * FROM loaisp WHERE TenLoai = '$tenLoai'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loại sản phẩm đã tồn tại
        $row = $result->fetch_assoc();
        if ($row['hide'] == 0) {
            // Cập nhật hide = 1 nếu loại sản phẩm đã bị ẩn
            $updateSql = "UPDATE loaisp SET hide = 1 WHERE TenLoai = '$tenLoai'";
            $conn->query($updateSql);
            echo "<tr data-loai='" . $row["MaLoai"] . "'>
                    <td>" . $row["MaLoai"] . "</td>
                    <td>" . $row["TenLoai"] . "</td>
                    <td>
                <button class='btn btn-secondary btn-delete' type='button' aria-expanded='false'>Xóa</button>
            </td>
                  </tr>";
        } else {
            // Loại sản phẩm đã tồn tại và đang được hiển thị
            echo "exists";
        }
    } else {
        // Loại sản phẩm chưa tồn tại, thêm mới
        $insertSql = "INSERT INTO loaisp (TenLoai, hide) VALUES ('$tenLoai', 1)";
        if ($conn->query($insertSql) === TRUE) {
            $result = $conn->query("SELECT * FROM loaisp WHERE TenLoai='$tenLoai'");
            $row = $result->fetch_assoc();
            echo "<tr data-loai='" . $row["MaLoai"] . "'>
                    <td>" . $row["MaLoai"] . "</td>
                    <td>" . $row["TenLoai"] . "</td>
                    <td>
                        <button class='btn btn-secondary btn-delete' type='button' aria-expanded='false'>Xóa</button>
                    </td>
                  </tr>";
        }
    }

    $conn->close();
}
?>