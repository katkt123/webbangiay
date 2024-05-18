<?php
// Kết nối với cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "shoestore");
//lấy số lượng chung
$sql = "SELECT
    (SELECT COUNT(*) FROM user AS u INNER JOIN taikhoan AS tk ON u.TenDangNhap = tk.TenDangNhap WHERE tk.MaQuyen = 4) AS so_luong_khach_hang,
    (SELECT COUNT(*) FROM user AS u INNER JOIN taikhoan AS tk ON u.TenDangNhap = tk.TenDangNhap WHERE tk.MaQuyen != 4) AS so_luong_nhan_vien,
    (SELECT COUNT(*) FROM sanpham) AS so_luong_san_pham,
    (SELECT COUNT(*) FROM phieuxuat) AS so_luong_phieuxuat;
";
$result = $conn->query($sql);
    // Lưu kết quả vào biến
    $data = $result->fetch_assoc();
    $kh = $data["so_luong_khach_hang"];
    $nv = $data["so_luong_nhan_vien"];
    $sp= $data["so_luong_san_pham"];
    $dh = $data["so_luong_phieuxuat"];

    //Lấy dữ liệu loại
    $sql = "SELECT l.TenLoai, COUNT(sp.MaSP) AS sll
    FROM sanpham sp
    INNER JOIN loaisp l ON sp.MaLoai = l.MaLoai
    GROUP BY l.TenLoai;";
    $result = mysqli_query($conn, $sql);
    $data1 = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data1[] = array(
    "loai" => $row["TenLoai"],
    "sll" => $row["sll"],
  );
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biểu đồ thống kê sản phẩm</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
  <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css"> 
</head>
<body>
  
     <style>
        .container {
            display: flex;
        }
        .item {          
            width: 100%;
            padding: 20px;
            text-align: center;
            border: 3px solid #ddd;
            border-radius: 20px;
            margin: 10px;
        }
        .item:hover {
            transform: scale(1.2); 
            box-shadow: 5px 15px 15px rgba(0, 0, 0, 0.9);
        }
        canvas{     
            max-width: 500px;
            max-height: 500px;
        }
    </style>
    
</head>
<body>
    <h1>Dashboard</h1>
    <div class="container">
        <div class="item" style="background: rgb(34,193,195);background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(242,73,92,1) 100%);">
            <h3>Số lượng khách hàng</h3>
            <h2><?php echo $kh ?></h2>
            <!-- <i class="fa-light fa-clipboard-user"></i> -->
        </div>
        <div class="item" style="background: rgb(34,193,195);background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(45,51,253,1) 100%);">
            <h2>Số lượng nhân viên</h2>
            <h3><?php echo $nv ?></h3>
        </div>
        <div class="item" style="background: rgb(34,193,195);background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(166,249,162,1) 100%);">
            <h2>Số lượng sản phẩm</h2>
            <h3><?php echo $sp ?></h3>
        </div>
        <div class="item" style="background: rgb(34,193,195);background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(242,162,249,1) 100%);">
            <h2>Số lượng đơn hàng</h2>
            <h3><?php echo $dh ?></h3>
        </div>
    </div>
    <br>
    <div style="display: flex;">
      <!-- biểu đồ loại sản phẩm -->
      <div style="margin-right: 30px;width: 50%;">
        <h2>Thống kê theo loại sản phẩm</h2>
        <canvas id="myChart1"></canvas>
      </div>

      <!-- biểu đồ nhãn hiệu sản phẩm -->
      <div style="margin-left: 30px;width: 50%;">
        <h2>Thống kê theo nhãn hiệu sản phẩm</h2>
        <canvas id="myChart2"></canvas>
      </div>
    </div>

    <script>
    var ctx1 = document.getElementById("myChart1").getContext("2d");
    var myChart1 = new Chart(ctx1, {
    type: "pie",
    data: {
      labels: [
        <?php
          foreach ($data1 as $item) {
            echo "'" . $item["loai"] . "', ";
          }
        ?>
      ],
      datasets: [
        {
          data: [
            <?php
              foreach ($data1 as $item) {
                echo $item["sll"] . ", ";
              }
            ?>
          ],
          backgroundColor: [
            "red",
            "green",
            "blue",
            "yellow",
            "purple",
            "white",
            "black",
          ],
        },
      ],
    },
    options: {
      responsive: true,
      legend: {
        display: true,
        position: "bottom",
      },
    },
    });

      <?php
      $sql = "SELECT n.TenNhanHieu, COUNT(sp.MaNhanHieu) AS slnh
          FROM sanpham sp
          INNER JOIN nhanhieu n ON sp.MaNhanHieu = n.MaNhanHieu
          GROUP BY n.TenNhanHieu;";
      // Thực thi truy vấn
      $result = mysqli_query($conn, $sql);
      $data1 = array();
      while ($row = mysqli_fetch_assoc($result)) {
        $data2[] = array(
          "label" => $row["TenNhanHieu"],
          "value" => $row["slnh"],
        );
      }
      $conn->close();
      ?>
      
      var ctx2 = document.getElementById("myChart2").getContext("2d");
      var myChart2 = new Chart(ctx2, {
        type: "pie",
        data: {
          labels: [
            <?php
            foreach ($data2 as $item) {
              echo "'" . $item["label"] . "', ";
            }
            ?>
          ],
          datasets: [
            {
              data: [
                <?php
                foreach ($data2 as $item) {
                  echo $item["value"] . ", ";
                }
                ?>
              ],
              backgroundColor: [
                "red",
                "green",
                "blue",
                "yellow",
                "purple",
                "white",
                "black",  
              ],
            },
          ],
        },
        options: {
          responsive: true,
          legend: {
        display: true,
        position: "bottom",
      },
        },
      });
  </script>
</body>
</html>