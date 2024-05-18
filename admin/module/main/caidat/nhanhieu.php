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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng sản phẩm và bảng size sản phẩm
$sql = "SELECT nhanhieu.MaNhanHieu, nhanhieu.TenNhanHieu FROM nhanhieu ";
$sql = "SELECT MaNhanHieu, TenNhanHieu FROM nhanhieu WHERE hide = 1"; // Chỉ lấy những dòng có hide = 1
$result = $conn->query($sql);

?>

<div class="content">
  <div class="tableBox ">
  
</div>
    <div class="tableTitle">
        <p>CÀI ĐẶT NHÃN HIỆU</p>
        <button type="button" class="btn btn-primary Add-SP-button" data-bs-toggle="modal" data-bs-target="#myModal">Thêm</button>

            <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm Nhãn Hiệu</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                    <label for="exampleFormControlInput" class="form-label">Tên Nhãn Hiệu</label>
                    <input type="email" class="form-control" id="exampleFormControlInput" placeholder="">
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
                <th >Mã</th>
                <th>Tên Nhãn Hiệu</th>
                <th>Hành động</th>

            </tr>
        </thead>
        <tbody>
        <?php
            if ($result->num_rows > 0) {
                // Duyệt qua các hàng dữ liệu từ kết quả truy vấn
                while($row = $result->fetch_assoc()) {
                    // In dữ liệu vào từng dòng của bảng
                    echo "<tr data-nh='" . $row["MaNhanHieu"] . "'>";
                    echo "<td>" . $row["MaNhanHieu"] . "</td>";
                    echo "<td>" . $row["TenNhanHieu"] . "</td>";
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
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('.btn-primary-1').click(function(e) {
    e.preventDefault();
    var tenNhanHieu = $('#exampleFormControlInput').val().trim();

    if (tenNhanHieu === '') {
      alert('Vui lòng nhập Tên Nhãn Hiệu');
      return;
    }

    $.ajax({
      url: 'module/main/caidat/insertnh.php',
      method: 'POST',
      data: { tenNhanHieu: tenNhanHieu },
      success: function(response) {
        if (response.trim() === 'exists') {
          alert('Nhãn hiệu đã tồn tại');
        } else if (response.trim() === 'updated') {
          // Cập nhật giao diện nếu nhãn hiệu đã được kích hoạt
          var lastRow = $('#myTable tbody tr:last');
          if (lastRow.length) {
            lastRow.after(response);
          } else {
            $('#myTable tbody').append(response);
          }
          alert('Nhãn hiệu đã được cập nhật thành công');
        } else {
          // Thêm nhãn hiệu mới vào bảng
          var lastRow = $('#myTable tbody tr:last');
          if (lastRow.length) {
            lastRow.after(response);
          } else {
            $('#myTable tbody').append(response);
          }
          alert('Thêm nhãn hiệu thành công');
        }
        $('#myModal').modal('hide');
        $('.btn-delete').click(function(e){
      e.preventDefault(); // Ngăn chặn hành động mặc định của nút
      var supplierId = $(this).closest('tr').data('nh'); // 
      if(confirm("Bạn có chắc chắn muốn xóa nhãn hiệu này không?")) {
          $.ajax({
              url: 'module/main/caidat/deletenh.php', // Đường dẫn đến file xử lý xóa
              method: 'POST',
              data: {nh: supplierId}, // Dữ liệu gửi đi 
              success: function(response){
            
                      $('[data-nh="' + supplierId + '"]').remove();
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
      var supplierId = $(this).closest('tr').data('nh'); // 
      if(confirm("Bạn có chắc chắn muốn xóa nhãn hiệu này không?")) {
          $.ajax({
              url: 'module/main/caidat/deletenh.php', // Đường dẫn đến file xử lý xóa
              method: 'POST',
              data: {nh: supplierId}, // Dữ liệu gửi đi 
              success: function(response){
            
                      $('[data-nh="' + supplierId + '"]').remove();
                      console.log(response) 
                  
              }
          });
      }
   });
});
</script>
