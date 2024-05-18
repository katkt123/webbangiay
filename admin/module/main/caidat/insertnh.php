<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['tenNhanHieu'])) {
    $tenNhanHieu = $_POST['tenNhanHieu'];

    // Kiểm tra nếu nhãn hiệu đã tồn tại trong cơ sở dữ liệu
    $sql = "SELECT * FROM nhanhieu WHERE TenNhanHieu = '$tenNhanHieu'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Nhãn hiệu đã tồn tại
        $row = $result->fetch_assoc();
        if ($row['hide'] == 0) {
            // Cập nhật hide = 1 nếu nhãn hiệu đã bị ẩn
            $updateSql = "UPDATE nhanhieu SET hide = 1 WHERE TenNhanHieu = '$tenNhanHieu'";
            $conn->query($updateSql);
            echo "<tr data-nh='" . $row["MaNhanHieu"] . "'>
            <td>" . $row["MaNhanHieu"] . "</td>
            <td>" . $row["TenNhanHieu"] . "</td>
            <td>
                <button class='btn btn-secondary btn-delete' type='button' aria-expanded='false'>Xóa</button>
            </td>
          </tr>";
        } else {
            // Nhãn hiệu đã tồn tại và đang được hiển thị
            echo "exists";
        }
    } else {
        // Nhãn hiệu chưa tồn tại, thêm mới
        $insertSql = "INSERT INTO nhanhieu (TenNhanHieu, hide) VALUES ('$tenNhanHieu', 1)";
        if ($conn->query($insertSql) === TRUE) {
            $result = $conn->query("SELECT * FROM nhanhieu WHERE TenNhanHieu='$tenNhanHieu'");
            $row = $result->fetch_assoc();
            echo "<tr data-nh='" . $row["MaNhanHieu"] . "'>
                    <td>" . $row["MaNhanHieu"] . "</td>
                    <td>" . $row["TenNhanHieu"] . "</td>
                    <td>
                        <button class='btn btn-secondary btn-delete' type='button' aria-expanded='false'>Xóa</button>
                    </td>
                  </tr>";
        }
    }

    $conn->close();
}
?>