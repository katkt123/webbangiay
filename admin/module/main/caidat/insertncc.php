<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['tenNCC']) && isset($_POST['diaChiNCC']) && isset($_POST['sdtNCC']) && isset($_POST['emailNCC'])) {
   $tenNCC = $_POST['tenNCC'];
   $diaChiNCC = $_POST['diaChiNCC'];
   $sdtNCC = $_POST['sdtNCC'];
   $emailNCC = $_POST['emailNCC'];

    // Kiểm tra nếu nhà cung cấp đã tồn tại trong cơ sở dữ liệu
    $sql = "SELECT * FROM nhacungcap WHERE TenNCC = '$tenNCC'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Nhà cung cấp đã tồn tại
        $row = $result->fetch_assoc();
        if ($row['hide'] == 0) {
            // Cập nhật hide = 1 nếu nhà cung cấp đã bị ẩn
            $updateSql = "UPDATE nhacungcap SET hide = 1 WHERE TenNCC = '$tenNCC'";
            $conn->query($updateSql);
            echo "<tr data-ncc='" . $row["MaNCC"] . "'>
                    <td>" . $row["MaNCC"] . "</td>
                    <td>" . $row["TenNCC"] . "</td>
                    <td>" . $row["DiaChiNCC"] . "</td>
                    <td>" . $row["SdtNCC"] . "</td>
                    <td>" . $row["EmailNCC"] . "</td>
                    <td>
                        <button class='btn btn-secondary btn-delete' type='button' aria-expanded='false'>Xóa</button>
                    </td>
                  </tr>";
        } else {
            // Nhà cung cấp đã tồn tại và đang được hiển thị
            echo "exists";
        }
    } else {
        // Nhà cung cấp chưa tồn tại, thêm mới
        $insertSql = "INSERT INTO nhacungcap (TenNCC, DiaChiNCC, SdtNCC, EmailNCC, hide) VALUES ('$tenNCC', '$diaChiNCC', '$sdtNCC', '$emailNCC', 1)";
        if ($conn->query($insertSql) === TRUE) {
            $result = $conn->query("SELECT * FROM nhacungcap WHERE TenNCC='$tenNCC'");
            $row = $result->fetch_assoc();
            echo "<tr data-ncc='" . $row["MaNCC"] . "'>
                    <td>" . $row["MaNCC"] . "</td>
                    <td>" . $row["TenNCC"] . "</td>
                    <td>" . $row["DiaChiNCC"] . "</td>
                    <td>" . $row["SdtNCC"] . "</td>
                    <td>" . $row["EmailNCC"] . "</td>
                    <td>
                        <button class='btn btn-secondary btn-delete' type='button' aria-expanded='false'>Xóa</button>
                    </td>
                  </tr>";
        }
    }

    $conn->close();
}
?>