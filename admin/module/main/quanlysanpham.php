<style>
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
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<div class="tableBox ">
    <div class="tableTitle">
        <p>Danh sách sản phẩm</p>
        <div class="table-func">
            <div class="filter-container">
                <select id="filterSelect1">
                    <option value=''>All</option>
                    <?php
                    require '../config/config.php';
                    // Lấy dữ liệu từ bảng nhanhieu
                    $sql = "SELECT MaNhanHieu, TenNhanHieu FROM nhanhieu";
                    $result = $connect->query($sql);
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          echo '<option value="' . $row["TenNhanHieu"] . '">' . $row["TenNhanHieu"] . '</option>';
                      }
                    } else {
                      echo "<option value=''>Không có dữ liệu</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="filter-container">
                <select id="filterSelect2">
                    <option value=''>All</option>
                    <?php 
                    // Lấy dữ liệu từ bảng loaisp
                    $sql = "SELECT MaLoai, TenLoai FROM loaisp";
                    $result = $connect->query($sql);
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          echo '<option value="' . $row["MaLoai"] . '">' . $row["TenLoai"] . '</option>';
                      }
                    } else {
                      echo "<option value=''>Không có dữ liệu</option>";
                    }
                    ?>
                </select>
            </div>
            <?php
            require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php'); //Kết nối mysql                     
            $TenDangNhap=$_SESSION['taikhoan'];
            $sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Thêm sản phẩm' and ctqcn.TrangThai=1";
            $resultq=mysqli_query($connect,$sqlq);
            $rowq=mysqli_num_rows($resultq);
            if($rowq==1){
                ?>
                    <a class="btn btn-primary" href="index.php?danhmuc=themsanpham">Thêm</a><!-- quanlysanpham_add_product_input.php-->
                <?php
            }
            ?>
            
            
        </div>
    </div>
    <table id="myTable" class="table table-striped " style="width: 100%;">
        <thead>
            <tr>
                <th >Mã</th>
                <th>Hình ảnh</th>
                <th>Tên SP</th>
                <th>Nhãn hiệu</th>
                <th>giá bán</th>
                <th>Số lượng</th>
                <th>Hành động</th>
                <th data-visible="false">ẨN</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql_shoes = "SELECT * FROM `sanpham`";
                $result_shoes = $connect->query($sql_shoes);
                if ($result_shoes->num_rows > 0) {
                    while ($row = $result_shoes->fetch_assoc()) {
                        if ($row['hide'] == 0)
                            continue; 
                        // Câu truy vấn SQL
                        $sql = "SELECT TenNhanHieu FROM `nhanhieu` WHERE MaNhanHieu = " . $row["MaNhanHieu"];
                        // Thực thi truy vấn
                        $result = $connect->query($sql);
                        $tennhanhieu = 'kotimthay';
                        if ($result->num_rows > 0) {
                            $rowd = $result->fetch_assoc();
                            $tennhanhieu = $rowd["TenNhanHieu"];
                        }

                        $tongSL = 0;
                        // Câu truy vấn SQL
                        $sql = "SELECT *, SUM(SoLuong) AS TongSoLuong FROM ctsizesp WHERE MaSP = " . $row["MaSP"];
                        // Thực thi truy vấn
                        $result = $connect->query($sql);
                        if ($result->num_rows > 0) {
                            $rowd = $result->fetch_assoc();
                            $tongSL = $rowd["TongSoLuong"];
                        }

                        echo '
                            <tr>
                                <td>' . $row["MaSP"] . '</td>
                                <td>
                                    <div style="background-color:rgba(255,255,255,0.3); width: 80px; border-radius:5px;">
                                        <img src="../assets/img/' .$row["HinhAnh"]. '" alt="" class="" width="80">
                                    </div>
                                </td>
                                <td>' . $row["TenSP"] . '</td>
                                <td>' . $tennhanhieu . '</td>
                                <td>' . $row["GiaMoi"].'</td>
                                <td>
                                    <button type="button" class="btn btn-primary view-size-button" data-bs-toggle="modal" data-bs-target="#chitietsoluong" id="' .$row["MaSP"] . '">
                                    ' . $tongSL . '
                                    </button>
                                </td>
                                <td>
                                    <div style="display:flex; gap:10px;">
                                        <button type="button" class="btn btn-primary view-SP-button" data-bs-toggle="modal" data-bs-target="#chitietsanpham" id="' .$row["MaSP"] . '">
                                            Chi tiết
                                            </button>';
                                            
                                            $sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Sửa sản phẩm' and ctqcn.TrangThai=1";
                                            $resultq=mysqli_query($connect,$sqlq);
                                            $rowq=mysqli_num_rows($resultq);
                                            if($rowq==1){                                   
                                                    echo '<a class="btn btn-primary" href="index.php?danhmuc=suasanpham&idsp=' . $row["MaSP"] . '">Sửa</a>';                                               
                                            }
                                            
                                            $sqlq2="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Xóa sản phẩm' and ctqcn.TrangThai=1";
                                            $resultq2=mysqli_query($connect,$sqlq2);
                                            $rowq2=mysqli_num_rows($resultq2);
                                            if($rowq2==1){                                   
                                                echo '<button type="button" class="btn btn-primary xoa-sp-button" data-bs-toggle="modal" data-bs-target="#xoasanpham"  id="' .$row["MaSP"] . '">Xóa</button>';                                         
                                                } 
                                        
                                        
                                    echo '</div>
                                </td>
                                <td style="display:none;visibility:hidden;">' .$row["MaLoai"]. '</td>
                            </tr>'
                            ;
                    }
                } else {
                    echo "<tr><td colspan='2'>Không có dữ liệu</td></tr>";
                }
            ?>
            <!-- <button type="button" class="btn btn-primary fix-sp-button" data-bs-toggle="modal" data-bs-target="#suasanpham"  id="' .$row["MaSP"] . '">Sửa</button> -->
        </tbody>
    </table>
</div>
<script>
$(document).ready(function() {
  $('#myTable').DataTable();
  $('#filterSelect1').on('change', function() {
    $('#myTable').DataTable().column(3).search($(this).val()).draw();
  });
  $('#filterSelect2').on('change', function() {
    $('#myTable').DataTable().column(7).search($(this).val()).draw();
    console.log($(this).val())
  });
});
</script>

<!-- Modal chi tiết sản phẩm -->
<div class="modal fade" id="chitietsanpham" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content"  style="">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabelCTsanpham">Chi tiết Sản Phẩm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table>
            <thead>
                <tr>
                    <th>Column</th>
                    <th>data</th>
                </tr>
            </thead>
            <tbody id="list_data_product">
                <!-- Dữ liệu sẽ được thêm vào đây từ mã JavaScript -->
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    $('table').on('click', 'td' , function (event) {
        var productId = $('button', this).attr('id');
        if (productId != null) {
            $.ajax({
                url: 'module/main/quanlysanpham_get_product_info.php',
                type: 'POST',
                data: { productId: productId },
                success: function(response){
                    $('#list_data_product').html(response);
                }
            });
        }
        // console.log(productId);
       
    });
});
</script>

<!-- Modal -->
<div class="modal fade" id="chitietsoluong" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content"  style="">
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
            <tbody id="list_size_and_number">
                <!-- Dữ liệu sẽ được thêm vào đây từ mã JavaScript -->
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    $('table').on('click', 'td' , function (event) {
        var productId = $('button', this).attr('id');
        if (productId != null) {
            $.ajax({
                url: 'module/main/quanlysanpham_get_list_size_and_number.php',
                type: 'POST',
                data: { productId: productId },
                success: function(response){
                    $('#list_size_and_number').html(response);
                }
            });
        }
    });
});
</script>
<div class="modal fade" id="xoasanpham" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabelXoasanpham">Sửa Sản Phẩm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="contendelete">
            <style>
                .inline-p {
                    display: inline-block;
                }
            </style>
            <p class="inline-p">Mã sản phẩm: </p><p id="idsp" class="inline-p"></p>
            <h2>Bạn có chắc muốn xóa sản phẩm này?</h2>
            <button type="submit" class="btn btn-primary" id="submitXoa">Xóa</button>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<script>
    $('table').on('click', 'td' , function (event) {
        var productId = $('button', this).attr('id');
        if (productId != null) {
            var pElement = document.getElementById("idsp");
            // Thay đổi nội dung bằng thuộc tính textContent
            pElement.textContent = productId;
        }
    });
</script>
<script>
$(document).ready(function(){
  $('#xoasanpham').on('hidden.bs.modal', function () {
    // Ví dụ: Reset form
    $('#contendelete').html(`
      <style>
        .inline-p {
          display: inline-block;
        }
      </style>
      <p class="inline-p">Mã sản phẩm: </p><p id="idsp" class="inline-p"></p>
      <h2>Bạn có chắc muốn xóa sản phẩm này?</h2>
      <button type="submit" class="btn btn-primary" id="submitXoa">Xóa</button>
    `);
  });
});
</script>
<script>
    document.getElementById('submitXoa').addEventListener('click', function() {
        // Lấy giá trị của idsp
        var idSanPham = document.getElementById('idsp').innerText;

        // Gửi yêu cầu xóa sản phẩm
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $('#contendelete').html(this.responseText);
                // xóa hàng theo idSanPham
                var searchValue = idSanPham;
                $("#myTable tbody tr").each(function() {
                    var rowData = $(this).find("td:eq(0)").text(); // Lấy dữ liệu của cột 0 trong hàng
                    if (rowData === searchValue) {
                        $(this).remove(); // Xóa hàng nếu dữ liệu cột 0 trùng khớp với giá trị tìm kiếm
                        return false; // Dừng vòng lặp sau khi xóa hàng
                    }
                });
            }
        };
        xhttp.open("POST", "module/main/quanlysanpham_delete_sanpham.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("idSanPham=" + idSanPham);
    });
</script>