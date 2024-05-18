<div class="container">
<ul class="row">
<?php
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php'); //Kết nối mysql                     
        $TenDangNhap=$_SESSION['taikhoan'];
        //Size
        $sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Quản lí size' and ctqcn.TrangThai=1";
        $result=mysqli_query($connect,$sql);
        $row=mysqli_num_rows($result);
          if($row==1){
            echo '<li class="col-sm-3 index-danhmuc">
            <a class="nav-link" href="index.php?danhmuc=caidat&id=size">Size</a>
          </li>';
          }
          //Nhà cung cấp
        $sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Quản lí nhà cung cấp' and ctqcn.TrangThai=1";
        $result=mysqli_query($connect,$sql);
        $row=mysqli_num_rows($result);
          if($row==1){
            echo '<li class="col-sm-3 index-danhmuc">
            <a class="nav-link" href="index.php?danhmuc=caidat&id=nhacungcap">Nhà Cung Cấp</a>
          </li>';
          }
          //Nhãn hiệu
        $sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Quản lí nhãn hiệu' and ctqcn.TrangThai=1";
        $result=mysqli_query($connect,$sql);
        $row=mysqli_num_rows($result);
          if($row==1){
            echo '<li class="col-sm-3 index-danhmuc">
            <a class="nav-link" href="index.php?danhmuc=caidat&id=nhanhieu">Nhãn hiệu</a>
          </li>';
          }
          //Danh mục
        $sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Quản lí danh mục' and ctqcn.TrangThai=1";
        $result=mysqli_query($connect,$sql);
        $row=mysqli_num_rows($result);
          if($row==1){
            echo ' <li class="col-sm-3 index-danhmuc">
            <a class="nav-link" href="index.php?danhmuc=caidat&id=danhmuc">Danh Mục</a>
          </li>';
          }
        ?>
    </ul>
</div>
<style>
    .img-pr {
        width: 40px;
        height: 40px;
        border-radius: 1000px;
        overflow: hidden;
    }

    .img-pr img {
        width: 100%;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }   
</style>
<?php
// Kết nối đến cơ sở dữ liệu
require '../config/config.php';

// Truy vấn dữ liệu từ bảng sản phẩm và bảng size sản phẩm
$sql = "SELECT nhacungcap.MaNCC, nhacungcap.TenNCC, nhacungcap.DiaChiNCC, nhacungcap.SdtNCC, nhacungcap.EmailNCC FROM nhacungcap";
$sql = "SELECT MaNCC, TenNCC, DiaChiNCC, SdtNCC, EmailNCC FROM nhacungcap WHERE hide = 1"; // Chỉ lấy những dòng có hide = 1
$result = $connect->query($sql);
?>
<div class="content">
    <div class="tableBox ">
        <div class="tableTitle">
            <p>CÀI ĐẶT NHÀ CUNG CẤP</p>
            <button type="button" class="btn btn-primary Add-SP-button" data-bs-toggle="modal" data-bs-target="#myModal">Thêm</button>

            <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm NHÀ CUNG CẤP</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                    <label for="exampleFormControlInput2" class="form-label">Tên Nhà Cung Cấp</label>
                    <input type="email" class="form-control" id="exampleFormControlInput" placeholder="">
                    <label for="exampleFormControlInput2" class="form-label">Địa chỉ</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                    <label for="exampleFormControlInput2" class="form-label">Số Điện Thoại</label>
                    <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="012345678">
                    <label for="exampleFormControlInput2" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput3" placeholder="hello@gmail.com">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary-1">Thêm</button>
                </div>
                
                </div>
            </div>
            </div>
        </div>
        <table id="myTable" class="table table-striped " style="width: 100%;">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Nhà Cung Cấp</th>
                    <th>Địa chỉ</th>
                    <th>Sđt</th>
                    <th>Email</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr data-ncc='" . $row["MaNCC"] . "'>";
                        echo "<td>" . $row["MaNCC"] . "</td>";
                        echo "<td>" . $row["TenNCC"] . "</td>";
                        echo "<td>" . $row["DiaChiNCC"] . "</td>";
                        echo "<td>" . $row["SdtNCC"] . "</td>";
                        echo "<td>" . $row["EmailNCC"] . "</td>";
                        echo "<td>
                        <button class='btn btn-secondary btn-delete' type='button' aria-expanded='false'>
                            Xóa
                        </button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $connect->close();
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('.btn-primary-1').click(function(e) {
    e.preventDefault();
    var tenNCC = $('#exampleFormControlInput').val().trim();
    var diaChiNCC = $('#exampleFormControlInput1').val().trim();
    var sdtNCC = $('#exampleFormControlInput2').val().trim();
    var emailNCC = $('#exampleFormControlInput3').val().trim();

    if (tenNCC === '') {
      alert('Vui lòng nhập Tên Nhà Cung Cấp');
      return;
    }
    if (diaChiNCC === '') {
      alert('Vui lòng nhập Địa chỉ');
      return;
    }
    if (sdtNCC === '') {
      alert('Vui lòng nhập Số Điện Thoại');
      return;
    }
    if (emailNCC === '') {
      alert('Vui lòng nhập Email');
      return;
    }

    $.ajax({
      url: 'module/main/caidat/insertncc.php',
      method: 'POST',
      data: { tenNCC: tenNCC, diaChiNCC: diaChiNCC, sdtNCC: sdtNCC, emailNCC: emailNCC },
      success: function(response) {
        if (response.trim() === 'exists') {
          alert('Nhà cung cấp đã tồn tại');
        } else if (response.trim() === 'updated') {
          // Cập nhật giao diện nếu nhà cung cấp đã được kích hoạt
          var lastRow = $('#myTable tbody tr:last');
          if (lastRow.length) {
            lastRow.after(response);
          } else {
            $('#myTable tbody').append(response);
          }
          alert('Nhà cung cấp đã được cập nhật thành công');
        } else {
          // Thêm nhà cung cấp mới vào bảng
          var lastRow = $('#myTable tbody tr:last');
          if (lastRow.length) {
            lastRow.after(response);
          } else {
            $('#myTable tbody').append(response);
          }
          alert('Thêm nhà cung cấp mới thành công');
        }
        $('#myModal').modal('hide');
        $('.btn-delete').click(function(e){
          e.preventDefault(); // Ngăn chặn hành động mặc định của nút
          var supplierId = $(this).closest('tr').data('ncc'); // Lấy mã nhà cung cấp từ data-id của hàng
          if(confirm("Bạn có chắc chắn muốn xóa nhà cung cấp này không?")) {
              $.ajax({
                  url: 'module/main/caidat/deletencc.php', // Đường dẫn đến file xử lý xóa
                  method: 'POST',
                  data: {ncc: supplierId}, // Dữ liệu gửi đi (mã nhà cung cấp)
                  success: function(response){
                
                          $('[data-ncc="' + supplierId + '"]').remove();
                          console.log(response)
                      
                  }
              });
          }
      });
      }
    });
  });
});
</script>
<script>
$(document).ready(function(){
   // Gắn sự kiện click cho nút "Xóa"
   $('.btn-delete').click(function(e){
      e.preventDefault(); // Ngăn chặn hành động mặc định của nút
      var supplierId = $(this).closest('tr').data('ncc'); // Lấy mã nhà cung cấp từ data-id của hàng
      if(confirm("Bạn có chắc chắn muốn xóa nhà cung cấp này không?")) {
          $.ajax({
              url: 'module/main/caidat/deletencc.php', // Đường dẫn đến file xử lý xóa
              method: 'POST',
              data: {ncc: supplierId}, // Dữ liệu gửi đi (mã nhà cung cấp)
              success: function(response){
            
                      $('[data-ncc="' + supplierId + '"]').remove();
                      console.log(response)
                  
              }
          });
      }
   });
});
</script>

            
