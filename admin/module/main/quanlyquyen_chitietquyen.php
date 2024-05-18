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
    <a href="index.php?danhmuc=quanlyquyen" class="header_banhang">
                <i class="fa-solid fa-circle-right icon-banhang"></i><span>Trở về</span>
        </a>
    <?php
         require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php'); //Kết nối mysql
         $sql = "SELECT * FROM quyen";
         $result = mysqli_query($connect,$sql);
         while ($row = mysqli_fetch_array($result)) {
            if($row['MaQuyen']==$_GET['id']) {
    ?>
    <div class="tableTitle">Chi tiết quyền <?php echo $row['TenQuyen']?></p>
    <?php }}?>
    </div>
    <table id="myTable" class="table table-striped " style="width: 100%;">
        <thead>
          <tr>
              <th>Tên các chức năng</th>
              <th>Hành động</th>
              <th>Được phép sử dụng <g/th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sqlChucNang = "SELECT * FROM ChucNang ORDER BY MaCN ASC";
            $resultChucNang = mysqli_query($connect, $sqlChucNang);

            $allHanhDong = [];
            $sqlHanhDong = "SELECT * FROM `chitietquyenchucnang` ctqcn join chucnang cn on cn.MaCN=ctqcn.MaCN group by HanhDong ORDER BY cn.MaCN ASC";
            $resultHanhDong = mysqli_query($connect, $sqlHanhDong);
            while ($rowHanhDong = mysqli_fetch_array($resultHanhDong)) {
                $allHanhDong[] = $rowHanhDong;
            }

            while ($rowChucNang = mysqli_fetch_array($resultChucNang)) {
                ?>
                <tr>
                    <td><?php echo $rowChucNang['TenCN'] ?></td>
                    <td>
                        <ul>
                            <?php
                            foreach ($allHanhDong as $rowHanhDong) {
                                if ($rowChucNang['TenCN'] == $rowHanhDong['TenCN']) {
                                    ?>
                                    <li><?php echo $rowHanhDong['HanhDong'] ?></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <?php
                            foreach ($allHanhDong as $rowHanhDong) {
                                if ($rowChucNang['TenCN'] == $rowHanhDong['TenCN']) {
                                    ?>
                                      <li>                                         
                                          <input  type="checkbox"  class="myCheckbox" id="<?php echo $rowHanhDong['MaCN']?>" name="<?php echo $rowHanhDong['HanhDong']?>"
                                          
                                                  <?php 
                                                    $sql="SELECT * FROM chitietquyenchucnang";
                                                    $result=mysqli_query($connect,$sql);
                                                      while($row=mysqli_fetch_array($result)){
                                                          if ( $row['MaQuyen']==$_GET['id'] ) {
                                                            if ($row['HanhDong']==$rowHanhDong['HanhDong']) {
                                                              if ( $row['TrangThai']==1 ){
                                                                echo 'checked'; 
                                                              }
                                                            }
                                                          }
                                                      }
                                                  ?>
                                          >
                                      </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
          <?php
            }
          ?>

            
        </tbody>
    </table>
</div>


<script src="./js/jquery.js"></script>
<script>
  var checkeds = document.querySelectorAll('.myCheckbox');
  for (var check of checkeds) {
    check.addEventListener('click', function() {
        
      var MaQuyen = <?php echo $_GET['id']?>;
      var MaCN = this.id;
      var HanhDong = this.name;
      // Hiện confirm box trước khi gửi
      var confirmation = confirm(`Bạn có muốn thay đổi hành động cho nhóm quyền này?`);
      console.log(MaQuyen);
      console.log(MaCN);
      console.log(HanhDong);
      if (this.checked == true) {
        if (confirmation) {
          // Gửi dữ liệu đến tệp PHP
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'module/main/quanlyquyen_chitietquyen_checked.php');
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onload = function() {
            if (xhr.status === 200) {
              alert(`Đã cập nhật hành động cho nhóm quyền này!`);
            } else {
              console.error('Lỗi khi gửi dữ liệu:', xhr.statusText);
            }
          };
          xhr.send(`MaQuyen=${MaQuyen}&MaCN=${MaCN}&HanhDong=${HanhDong}`);
          this.checked = true;
        }
        else {
          this.checked = false;
        }
      }
      else {
        if (confirmation) {
          // Gửi dữ liệu đến tệp PHP
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'module/main/quanlyquyen_chitietquyen_checked.php');
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onload = function() {
            if (xhr.status === 200) {
              alert(`Đã cập nhật hành động cho nhóm quyền này!`);
            } else {
              console.error('Lỗi khi gửi dữ liệu:', xhr.statusText);
            }
          };
          xhr.send(`MaQuyen=${MaQuyen}&MaCN=${MaCN}&HanhDong=${HanhDong}`);
          this.checked = false;
        }
        else {
          this.checked = true;
        }
      }
        
      
    });
  }
</script>

