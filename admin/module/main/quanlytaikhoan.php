<style
>
    .img-pr{
        width: 50px;
        height: 50px;
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
</style>
<div class="tableBox ">
    <div class="tableTitle">
        <p>Danh sách tài khoản</p>
        <div class="table-func">
            <div class="filter-container">
                <select id="filterSelect1">
                    <option value="">Trạng thái</option>
                    <option value="Hoạt Động">Hoạt Động</option>
                    <option value="Bị khóa">Bị khóa</option>
                </select>
            </div>
            <div class="filter-container">
                <select id="filterSelect2">
                    <option value="0">Loại tài khoản</option>
                    <?php
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php'); //Kết nối mysql                     
                        $sql = "SELECT *
                                FROM quyen";
                        $result = mysqli_query($connect,$sql);
                        while ( $row=mysqli_fetch_array($result) ) {
                            ?>
                            <option value="<?php echo $row['MaQuyen'] ?>" 
                            <?php 
                            if (isset($_GET['MaQuyen'])) {
                                if($_GET['MaQuyen']==$row['MaQuyen']){ echo 'selected';}
                            }?>> <?php echo $row['TenQuyen'] ?> </option>
                            <?php
                        }
                    ?> 
                </select>
            </div>
            
        </div>
    </div>
    <table id="myTable" class="table table-striped " style="width: 100%;">
        <thead>
            <tr>
                <th>Thông tin</th>
                <th>Tài khoản</th>
                <th>Quyền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            
            $sql = "SELECT * FROM taikhoan tk JOIN user u on tk.TenDangNhap=u.TenDangNhap WHERE tk.TenDangNhap != '0'";
            $result = mysqli_query($connect,$sql);
            while ($row=mysqli_fetch_array($result)) { 
                if (isset($_GET['MaQuyen'])) {
                    if ($_GET['MaQuyen']==0){
                        ?>
                        <tr>
                        
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px">
                                <div class="img-pr">
                                    <img src="assets/img/<?php echo $row['Avt']?>" alt="" class="">
                                </div>
                                <ul class="ml-2">
                                    <li> <?php echo $row['HoTen'] ?> </li>
                                    <li> <?php echo $row['Email'] ?> </li>
                                    <li> <?php echo $row['SDT'] ?> </li>
                                </ul>
                            </div>
                            
                        </td>
                        <td>
                            <ul>
                                <li>
                                    <strong>Tài khoản: </strong> <?php echo $row['TenDangNhap'] ?>
                                </li>
                                <li>
                                    <strong>Mật khẩu: </strong> <?php echo $row['MatKhau'] ?>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <div class="filter-container">
        
                                    <select  name="selectquyen" style="width: 100%;" class="getselect" id="<?php echo $row['TenDangNhap']?>">
                                    <?php
                                        $sql ="SELECT * From quyen";
                                        $result1 = mysqli_query($connect,$sql);
                                        while ($row1=mysqli_fetch_array($result1)) { ?>
                                                <option class="valueMaQuyen" value="<?php echo $row1['MaQuyen']?>" <?php if($row['MaQuyen']==$row1['MaQuyen']){ echo "selected";} ?> ><?php echo $row1['TenQuyen'] ?></option>
                                        <?php
                                            
        
                                        }
                                    ?>
        
                                </select>
                            </div>
                        </td>
                        <td> <?php if($row['TrangThai']==0){echo "Hoạt động";}else{echo "Bị Khóa";}?> </td>
                        <td>
                            <div class="dropdown" >
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="z-index: 2;">
                                    <li><a class="dropdown-item" href="module/main/quanlytaikhoan_xoataikhoan.php?id=<?php echo $row['TenDangNhap'];?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?Suy nghĩ kĩ nha^^'); ">Xóa</a></li>
                                    <li><a class="dropdown-item" href="module/main/quanlytaikhoan_kichhoattaikhoan.php?id=<?php echo $row['TenDangNhap'];?>">Kích hoạt</a></li>
                                    <li><a class="dropdown-item" href="module/main/quanlytaikhoan_khoataikhoan.php?id=<?php echo $row['TenDangNhap'];?>" onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này?'); ">Khóa</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                        <?php
                    }else
                    if ($_GET['MaQuyen']==$row['MaQuyen']) {
                        ?>
                    
                        <tr>
                        
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px">
                                <div class="img-pr">
                                    <img src="assets/img/<?php echo $row['Avt']?>" alt="" class="">
                                </div>
                                <ul class="ml-2">
                                    <li> <?php echo $row['HoTen'] ?> </li>
                                    <li> <?php echo $row['Email'] ?> </li>
                                    <li> <?php echo $row['SDT'] ?> </li>
                                </ul>
                            </div>
                            
                        </td>
                        <td>
                            <ul>
                                <li>
                                    <strong>Tài khoản: </strong> <?php echo $row['TenDangNhap'] ?>
                                </li>
                                <li>
                                    <strong>Mật khẩu: </strong> <?php echo $row['MatKhau'] ?>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <div class="filter-container">
        
                                    <select  name="selectquyen" style="width: 100%;" class="getselect" id="<?php echo $row['TenDangNhap']?>">
                                    <?php
                                        $sql ="SELECT * From quyen";
                                        $result1 = mysqli_query($connect,$sql);
                                        while ($row1=mysqli_fetch_array($result1)) { ?>
                                                <option class="valueMaQuyen" value="<?php echo $row1['MaQuyen']?>" <?php if($row['MaQuyen']==$row1['MaQuyen']){ echo "selected";} ?> ><?php echo $row1['TenQuyen'] ?></option>
                                        <?php
                                            
        
                                        }
                                    ?>
        
                                </select>
                            </div>
                        </td>
                        <td> <?php if($row['TrangThai']==0){echo "Hoạt động";}else{echo "Bị Khóa";}?> </td>
                        <td>
                            <div class="dropdown" >
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="z-index: 2;">
                                    <li><a class="dropdown-item" href="module/main/quanlytaikhoan_xoataikhoan.php?id=<?php echo $row['TenDangNhap'];?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?Suy nghĩ kĩ nha^^'); ">Xóa</a></li>
                                    <li><a class="dropdown-item" href="module/main/quanlytaikhoan_kichhoattaikhoan.php?id=<?php echo $row['TenDangNhap'];?>">Kích hoạt</a></li>
                                    <li><a class="dropdown-item" href="module/main/quanlytaikhoan_khoataikhoan.php?id=<?php echo $row['TenDangNhap'];?>" onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này?'); ">Khóa</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                }else {
                    ?>
                    <tr>
                
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px">
                                <div class="img-pr">
                                    <img src="assets/img/<?php echo $row['Avt']?>" alt="" class="">
                                </div>
                                <ul class="ml-2">
                                    <li> <?php echo $row['HoTen'] ?> </li>
                                    <li> <?php echo $row['Email'] ?> </li>
                                    <li> <?php echo $row['SDT'] ?> </li>
                                </ul>
                            </div>
                            
                        </td>
                        <td>
                            <ul>
                                <li>
                                    <strong>Tài khoản: </strong> <?php echo $row['TenDangNhap'] ?>
                                </li>
                                <li>
                                    <strong>Mật khẩu: </strong> <?php echo $row['MatKhau'] ?>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <div class="filter-container">

                                    <select  name="selectquyen" style="width: 100%;" class="getselect" id="<?php echo $row['TenDangNhap']?>">
                                    <?php
                                        $sql ="SELECT * From quyen";
                                        $result1 = mysqli_query($connect,$sql);
                                        while ($row1=mysqli_fetch_array($result1)) { ?>
                                                <option class="valueMaQuyen" value="<?php echo $row1['MaQuyen']?>" <?php if($row['MaQuyen']==$row1['MaQuyen']){ echo "selected";} ?> ><?php echo $row1['TenQuyen'] ?></option>
                                        <?php
                                            

                                        }
                                    ?>

                                </select>
                            </div>
                        </td>
                        <td> <?php if($row['TrangThai']==0){echo "Hoạt động";}else{echo "Bị Khóa";}?> </td>
                        <td>
                            <div class="dropdown" >
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="z-index: 2;">
                                    <!-- <li><a class="dropdown-item" href="module/main/quanlytaikhoan_xoataikhoan.php?id=<?php echo $row['TenDangNhap'];?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?Suy nghĩ kĩ nha^^'); ">Xóa</a></li> -->
                                    <li><a class="dropdown-item" href="module/main/quanlytaikhoan_kichhoattaikhoan.php?id=<?php echo $row['TenDangNhap'];?>">Kích hoạt</a></li>
                                    <li><a class="dropdown-item" href="module/main/quanlytaikhoan_khoataikhoan.php?id=<?php echo $row['TenDangNhap'];?>&id2=<?php echo $_SESSION['taikhoan']?>" onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này?'); ">Khóa</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                
            }
            mysqli_close($connect);
            ?>
        </tbody>
    </table>
</div>
<script src="./js/jquery.js"></script>

<!-- Form thông báo -->
<div class="modal fade" id="thongbao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width: 500px;">
  <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header">
                <h2 class="modal-title" id="ModalLabelThemsanpham">Thông báo </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="responsepp"></p> 
                <?php
                    if (isset($_GET['note'])) {
                        switch ($_GET['note']) {
                            case 'khoataikhoantrue':
                                echo "<h4>Đã khóa tài khoản "; echo $_GET['TenDangNhap']; echo "</h4>";
                                break;
                            case 'khoataikhoanfalse':
                                echo "<h4>Tài khoản này đã bị khóa trước đó rồi!</h4>";
                                break;
                            case 'kichhoattaikhoantrue':
                                echo "<h4>Kích hoạt tài khoản "; echo $_GET['TenDangNhap']; echo " thành công!</h4>";
                                break;
                            case 'kichhoattaikhoanfalse':
                                echo "<h4>Tài khoản này đang hoạt động mà, kích hoạt gì nữa cha nội!</h4>";
                                break;
                            case 'khoataikhoanfalse':
                                echo "<h4>Tài khoản này đang hoạt động, không thể khóa!</h4>";
                                break;
                            case 'xoataikhoantrue':
                                echo "<h4>Đã xóa tài khoản "; echo $_GET['TenDangNhap']; echo " ra khỏi hệ thống</h4>";
                                break;
                            case 'khoataikhoanfalse2':
                                echo "<h4>Tài khoản này hiện đang hoạt động, không thể khóa!</h4>";
                                break;    
                        }
                    }
                ?>
            </div>    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
  </div>
</div>

<!-- form thông báo sửa quyền cho tài khoản -->
<!-- Form Sửa tên quyền -->
<div class="modal fade" id="suaquyenchotaikhoan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width: 500px;">
  <div class="modal-dialog">
  <form action="module/main/quanlytaikhoan_suaquyen.php" method="post" >
    <div class="modal-content" style="">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabelSuaquyenchotk">Sửa Tên Quyền </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="responsepp"></p>
                    <h4>Bạn có chắc chắn muốn thay đổi nhóm quyền cho tài khoản này không?</h4>
      </div>    
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="buttonUpdateQuyen" id="UpdateQuyen">Xác nhận</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
    </form>
  </div>
</div>

<?php
    if (isset($_GET['success']) && $_GET['success']==true) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById("thongbao"));
        myModal.show();
    });
    </script>';
    }
?>

<!-- xữ lý thay đổi nhóm quyền cho tài khoản -->
<script>
  const selects = document.querySelectorAll('.getselect');
  for (const select of selects) {
    select.addEventListener('change', function() {
        
      const MaQuyen = this.value;
      const TenDangNhap = this.id;
      // Hiện confirm box trước khi gửi
      const confirmation = confirm(`Bạn có thực sự muốn thay đổi quyền cho tài khoản ${TenDangNhap} này không?`);

      if (confirmation) {
        console.error(`Ma quyen: ${MaQuyen}`);
        console.error(`Ten dang nhap ${TenDangNhap}`);
        // Gửi dữ liệu đến tệp PHP
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'module/main/quanlytaikhoan_suaquyen.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (xhr.status === 200) {
            
            alert(`Đã cập nhật quyền cho tài khoản ${TenDangNhap}!`);
          } else {
            console.error('Lỗi khi gửi dữ liệu:', xhr.statusText);
          }
        };
        xhr.send(`TenDangNhap=${TenDangNhap}&MaQuyen=${MaQuyen}`);
      }
    });
  }
</script>

<!-- Lọc theo trạng thái -->
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $('#filterSelect1').on('change', function() {
            $('#myTable').DataTable().column(3).search($(this).val()).draw();  
        });
        $('#filterSelect2').on('change', function() {
            $('#myTable').DataTable().column(2).search($(this).val()).draw();

        });
    });
</script>
<!-- Lọc theo loại tài khoản -->
<script>
        $(document).ready(function() {
            var selected=document.getElementById('filterSelect2');
            selected.addEventListener('change',function(){
                var selectedValue = this.value;
                window.location.href =`index.php?danhmuc=quanlytaikhoan&MaQuyen=${selectedValue}`;
            });
        });
    </script>

