<?php
// Kết nối với cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "shoestore");  
  //lấy thông tin sản phẩm,khách hàng,nhân viên
  $sql="SELECT
  px.MaPX,
  px.NgayDatHang,
  px.TinhTrangDH,
  px.TongTien,
  px.TongSoLuong,
  px.trangThai,
  khachhang.Ma as MaKH,
  khachhang.HoTen as HoTenKH,
  khachhang.SDT as SDTKH,
  nhanvien.Ma as MaNV,
  nhanvien.HoTen as HoTenNV,
  nhanvien.SDT as SDTNV
FROM phieuxuat px
INNER JOIN user khachhang ON px.MaKH = khachhang.Ma
INNER JOIN user nhanvien ON px.MaNV = nhanvien.Ma;";
$result = $conn->query($sql);
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí đơn hàng</title>
  
</head>
<body>
<style
>
    .img-pr{
        width: 40px;
        height: 40px;
        border-radius: 1000px;
        overflow: hidden;
    }
    .img-pr img{
        width: 100%;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    ul{
       padding: 0;
    }
    #tinhtrang{
        display: inline-block;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 110px;
        text-align: center;
    }
    .hoan-thanh {
        background-color: blue;
        color: aliceblue;
    }
    .dang-xu-ly {
        background-color: cadetblue;
        color: aliceblue;
    }
    .tam-giu {
        background-color: red;
        color: aliceblue;
    }
    .da-huy {
        background-color: darkgrey;
        color: aliceble;
    }
</style>
<div id="noi-dung-chi-tiet" ></div>
<div class="tableBox ">
    <div class="tableTitle">
        <p>Danh sách đơn hàng</p>
        <div class="table-func">
            <div class="filter-container">
                <form action="index.php?danhmuc=quanlydonhang-timkiem" method="post">
                    Ngày bắt đầu: <input type="date" name="ngay_bat_dau">
                    Ngày kết thúc: <input type="date" name="ngay_ket_thuc">
                    <label>Tình trạng:</label> 
                    <select name="tinh_trang">
                        <option value="">Tất cả</option>
                        <option value="Tạm giữ">Tạm giữ</option>
                        <option value="Đang xử lý">Đang xử lý</option>
                        <option value="Đã hoàn thành">Đã hoàn thành</option>
                        <option value="Đã hủy">Đã hủy</option>
                    </select>
                    <input type="submit" value="Lọc">
                </form>
            </div>
        </div>
    </div>
    <table id="myTable" class="table table-striped " style="width: 100%;">
        <thead>
            <tr>
                <th >Mã</th>
                <th>Khách hàng</th>
                <th>Nhân viên</th>
                <th>Ngày đặt</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Tình trạng đơn hàng</th>
                <th>Hàng động</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            if($row['trangThai'] == 1){
        ?>
      <tr>
        <td><?php echo $row['MaPX']; ?></td>
        <td>
                    <ul>
                        <li>ID: <?php echo $row['MaKH']; ?></li></li>
                        <li>Tên: <?php echo $row['HoTenKH']; ?> </li>
                        <li>SĐT:<?php echo $row['SDTKH']; ?></li> 
                        <li></li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li><?php if($row['MaNV']==0){echo "";}else{ echo "ID: ".$row['MaNV'];} ?></li>
                        <li><?php if($row['HoTenNV']==0){echo "";}else{ echo "Tên: ".$row['HoTenNV'];} ?></li>
                        <li><?php if($row['SDTNV']==0){echo "";}else{ echo "SDT: ".$row['SDTNV'];} ?></li>
                        <li></li>
                    </ul>
                </td>
                <td><?php echo $row['NgayDatHang']; ?></td>
                <td><?php echo $row['TongSoLuong']; ?></td>
                <td><?php echo $row['TongTien']; ?></td>
                <td><span id="tinhtrang" class="<?php echo ($row['TinhTrangDH'] == 'Đã hoàn thành') ? 'hoan-thanh' : (($row['TinhTrangDH'] == 'Đang xử lý') ? 'dang-xu-ly' : (($row['TinhTrangDH'] == 'Đã hủy') ? 'da-huy' : 'tam-giu')) ?>"><?php echo $row['TinhTrangDH']; ?></span></td>
                <td>
                    <div class="dropdown" >
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="z-index: 2;">
                            <?php //chi tiết quyền nếu được thực hiện thì mới được hiện ra
                            $TenDangNhap=$_SESSION['taikhoan'];
                            require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php'); //Kết nối mysql                     
                            $sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Chi tiết đơn hàng' and ctqcn.TrangThai=1";
                            $resultq=mysqli_query($connect,$sqlq);
                            $rowq=mysqli_num_rows($resultq);
                            if($rowq==1){ ?>                                  
                                    <li><a class="dropdown-item" href="index.php?danhmuc=quanlydonhang-chitiet&id=<?php echo $row['MaPX']; ?>">Xem chi tiết</a></li>                                               
                            <?php
                                }
                            ?>
                                               
                            <?php if ($row['TinhTrangDH'] != "Đã hủy") { 
                                $sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Thay đổi trạng thái đơn hàng' and ctqcn.TrangThai=1";
                                $resultq=mysqli_query($connect,$sqlq);
                                $rowq=mysqli_num_rows($resultq);
                                if ($rowq==1){?>
                                <li><button class="chuyen-trang-thai dropdown-item">Chuyển trạng thái</button></li>
                                <?php }
                                $sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Hủy đơn hàng' and ctqcn.TrangThai=1";
                                $resultq=mysqli_query($connect,$sqlq);
                                $rowq=mysqli_num_rows($resultq);
                                if ($rowq==1){?>
                                        <li><button class="huy-don dropdown-item">Hủy đơn hàng</button></li>
                                <?php }
                                ?>
                            <?php } ?>
                        </ul>
                    </div>
                </td>
      </tr>
    <?php } } ?>
        </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    //lọc đơn hàng

    //Hủy đơn hàng
    $(document).on('click', '.huy-don', function() {
        var MaPX = $(this).closest('tr').find('td:first-child').text();
        if(confirm("Bạn có chắc chắn muốn hủy đơn hàng này không?")) {
        $.ajax({
        url: 'module/main/quanlydonhang-huy.php',
        method: 'POST',
        data: {
            MaPX: MaPX
        },
        success: function(response) {
            console.log("MaPX:", response);
            if (response === 'success') {
                alert('Đơn hàng đã được hủy!');
            location.reload();
            } else {
                //hiển thị thông báo khi không hủy được
            alert(response);
            }
        }
        });
    }});
    //Chuyển trạng thái
    $(document).on('click', '.chuyen-trang-thai', function() {
        var MaPX = $(this).closest('tr').find('td:first-child').text();
        if(confirm("Bạn có chắc chắn muốn chuyển trạng thái đơn hàng này không?")) {
        $.ajax({
        url: 'module/main/quanlydonhang-trangthai.php',
        method: 'POST',
        data: {
            MaPX: MaPX
        },
        success: function(response) {
            console.log("MaPX:", response);
            if (response === 'success') {
                alert('Đã chuyển trạng thái đơn hàng!');
            location.reload();
            } else {
                //hiển thị thông báo khi không chuyển được
            alert(response);
            }
        }
        });
    }});
});
</script>
<?php
  // Đóng kết nối
  $conn->close();
  ?>
<!-- Modal -->
<div class="modal fade" id="chitietsoluong" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chi tiết số lượng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table >
            <thead>
                <tr>
                    <th >Size</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>30</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>31</td>
                    <td>7</td>
                </tr>
                <tr>
                    <td>41</td>
                    <td>4</td>
                </tr>
                <tr>
                    <td>40</td>
                    <td>6</td>
                </tr>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
