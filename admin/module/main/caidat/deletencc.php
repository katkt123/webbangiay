<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";

$conn = new mysqli($servername, $username, $password, $dbname);
?>
<?php
if(isset($_POST['ncc'])) {
    $ncc = $_POST['ncc'];

    // Sử dụng câu lệnh chuẩn SQL Prepared Statements để ngăn chặn SQL Injection
    $sql = "UPDATE nhacungcap SET hide = 0 WHERE MaNCC = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ncc); // 'i' cho biến integer

    if ($stmt->execute()) {
        // Trả về thông báo thành công cho JavaScript
        echo "success";
    } else {
        // Trả về thông báo lỗi cho JavaScript
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Đóng câu lệnh và kết nối
    $stmt->close();
    $conn->close();
}
?>



