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
    <div class="tableTitle">Danh sách các nhóm quyền</p>
        <div class="table-func">
        <?php //chi tiết quyền nếu được thực hiện thì mới được hiện ra
                            $TenDangNhap=$_SESSION['taikhoan'];
                            require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php'); //Kết nối mysql                     
                            $sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Thêm nhóm quyền' and ctqcn.TrangThai=1";
                            $resultq=mysqli_query($connect,$sqlq);
                            $rowq=mysqli_num_rows($resultq);
                            if($rowq==1){  ?>                                 
                                    <button type="button" class="btn btn-primary Add-SP-button" data-bs-toggle="modal" data-bs-target="#themquyen">
                                        Thêm
                                    </button>
                            <?php
                                }
                            ?>
        </div>
    </div>
    <table id="myTable" class="table table-striped " style="width: 100%;">
        <thead>
            <tr>
                <th >Mã quyền</th>
                <th>Tên quyền</th>
                <th>Hành động<g/th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php'); //Kết nối mysql
                $sql = "SELECT * FROM quyen";
                $result = mysqli_query($connect,$sql);
                while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['MaQuyen'] ?></td>
                    <td><?php echo $row['TenQuyen'] ?></td>
                    <td>
                        <div class="dropdown" >
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="z-index: 2;">
                            <?php //chi tiết quyền nếu được thực hiện thì mới được hiện ra
            
                            $sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Chi tiết chức năng cho nhóm quyền' and ctqcn.TrangThai=1";
                            $resultq=mysqli_query($connect,$sqlq);
                            $rowq=mysqli_num_rows($resultq);
                            if($rowq==1 && $row['MaQuyen']!=4){ ?>                                  
                                    <li><a class="dropdown-item" href="index.php?danhmuc=quanlyquyen_chitietquyen&id=<?php echo $row['MaQuyen']?>">Chi tiết</a></li>
                            <?php
                                }
                                 //chi tiết quyền nếu được thực hiện thì mới được hiện ra
                              $sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Sửa nhóm quyền' and ctqcn.TrangThai=1";
                              $resultq=mysqli_query($connect,$sqlq);
                              $rowq=mysqli_num_rows($resultq);
                              if($rowq==1){ ?>                                  
                                      <li><a class="dropdown-item edit-btn"  href="module/main/quanlyquyen_gettenquyen.php?id=<?php echo $row['MaQuyen']?>&ten=<?php echo $row['TenQuyen']?>" >Sửa</a></li>
                              <?php
                                  }
                                  //Xóa quyền
                            $sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Xóa nhóm quyền' and ctqcn.TrangThai=1";
                            $resultq=mysqli_query($connect,$sqlq);
                            $rowq=mysqli_num_rows($resultq);
                            if($rowq==1){ ?>                                  
                                    <li><a class="dropdown-item" href="module/main/quanlyquyen_xoaquyen.php?id=<?php echo $row['MaQuyen']?>">Xóa</a></li>
                            <?php
                                }
                            ?>
                                
                            </ul>
                        </div>
                    </td>
                </tr>
                
            <?php
                }
                mysqli_close($connect);
            ?> 
            
        </tbody>
    </table>
</div>

<!-- form thêm quyền mới -->
<div class="modal fade" id="themquyen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width: 500px;">
  <div class="modal-dialog">
  <form action="module/main/quanlyquyen_themquyen.php" method="post" >

    <div class="modal-content" style="">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabelThemquyen">Thêm Quyền mới</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="responsepp"></p>
        
          <table>
            <tr>
              <td>Tên Quyền:</td>
              <td><input type="text" name="txtTenQuyen"></td>
            </tr>
            </table>
        
      </div>    
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="buttonAddQuyen" id="submitForm">Thêm</button>
      </div>
    </div>
    </form>
  </div>
</div>

<!-- Form Sửa tên quyền -->
<div class="modal fade" id="suaquyen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width: 500px;">
  <div class="modal-dialog">
  <form action="module/main/quanlyquyen_suaquyen.php?id=<?php echo $_GET['MaQuyen'] ?>" method="post" >
    <div class="modal-content" style="">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabelSuaquyen">Sửa Tên Quyền </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="responsepp"></p>
        
          <table>
            <tr>
                <td>Tên Hiện tại:</td>
                <td>
                    <?php 
                        if (isset($_GET['TenQuyen'])) {
                          echo $_GET['TenQuyen'];
                        }
                    ?>
                </td>
            </tr>
            <tr>
              <td>Nhập Tên Mới:</td>
              <td><input type="text" name="txtTenQuyenCanSua"></td>
            </tr>
            </table>
        
      </div>    
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="buttonUpdateQuyen" id="UpdateQuyen">Lưu</button>
      </div>
    </div>
    </form>
  </div>
</div>

<!-- Form thông báo -->
<div class="modal fade" id="suaquyenthanhcong" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width: 500px;">
  <div class="modal-dialog">
    <div class="modal-content" style="">
      <div class="modal-header">
        <h2 class="modal-title" id="ModalLabelthongbao">Thông báo </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="responsepp"></p> 
          <?php
            if ( isset($_GET['note']) ) {   
              switch ($_GET['note']) {
                case 'detrongtenquyen':
                  echo "<h4>Vui lòng nhập tên quyền!</h4>";
                  break;
                case 'themquyentrue':
                  echo "<h4>Thêm quyền thành công!</h4>";
                  break;
                case 'themquyenfail':
                  echo "<h4>Tên quyền này đã tồn tại trong hệ thống.Vui lòng nhập tên khác!</h4>";
                  break;
                case 'suaquyentrue':
                  echo "<h4>Đã sửa tên quyền thành công!</h4>";
                  break;
                case 'suaquyenfalse':
                  echo "<h4>Tên quyền này đã tồn tại trong hệ thống.Vui lòng nhập tên khác!</h4>";
                  break;
                case 'xoaquyentrue':
                  echo "<h4>Đã xóa quyền này ra khỏi hệ thống!</h4>";
                  break;
                case 'xoaquyenfalse':
                  echo "<h4>Quyền này đã có tài khoản sử dụng, không thể xóa nhé!</h4>";
                  break;
              }
            }
          ?>
      </div>    
    </div>
  </div>
</div>

<?php 
  if (isset($_GET['Getsuccess']) && $_GET['Getsuccess']==true) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
      var myModal = new bootstrap.Modal(document.getElementById("suaquyen"));
      myModal.show();
    });
  </script>';
  }
  if (isset($_GET['success']) && $_GET['success']==true) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
      var myModal = new bootstrap.Modal(document.getElementById("suaquyenthanhcong"));
      myModal.show();
    });
  </script>';
  }
?>