
<?php
	require '../config/config.php';
	//lấy thông tin sản phẩm,khách hàng,nhân viên
	$sql="SELECT
	pn.MaPN,
	pn.NgayNhap,
	pn.TongTien,
	pn.TongSoLuong,
	pn.TinhTrangDH,
	pn.trangThai,
	user.Ma,
	user.HoTen,
	user.SDT,
	nhacungcap.MaNCC,
	nhacungcap.SdtNCC,
	nhacungcap.TenNCC

FROM phieunhap pn
INNER JOIN nhacungcap ON pn.MaNCC = nhacungcap.MaNCC
INNER JOIN user ON pn.MaNV = user.Ma;";


$result = $connect->query($sql);
if ($result->num_rows === 0) {
	echo "<p>Không có dữ liệu phiếu xuất.</p>";
	die();
	}


	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quản lí Nhập hàng</title>
</head>
<body>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="../admin/js/jquery.js"></script>
<script src="../admin/js/dataTables.js"></script>
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
	.contentdivselect {
		display: none; /* Ẩn tất cả các div */
	}
	/* Hiển thị div content1 mặc định */
	#contentdivselect1 {
		display: block;
	}
	#mTable {

	}
</style>
<div id="noi-dung-chi-tiet" ></div>
<div class="tableBox ">
	<div class="tableTitle">
		<p>Danh sách nhập hàng</p>
		<div class="table-func" style="width: 60%">

            <div class="filter-container">
				<select id="selectBox" onchange="changeContent()">
					<option value="option1">Theo Ngày</option>
					<option value="option2">Theo Tiền</option>
					<option value="option3">Theo Số lượng</option>
				</select>
			</div>
			<div id="contentdivselect1" class="contentdivselect filter-container" style="width: 60%">
				<label>Bắt đầu:</label>
				<input type="date" id="startdate">
				<label>Kết thúc:</label>
				<input type="date" id="enddate">
				<button class="btn btn-primary" id="filterBtnDate">Filter</button>
				<button class="btn btn-secondary" id="clearBtnDate">Clear</button>
			</div>
			<div id="contentdivselect2" class="contentdivselect filter-container" style="width: 60%">
				<label>Bắt đầu:</label>
				<input type="number" id="startmoney">
				<label>Kết thúc:</label>
				<input type="number" id="endmoney">
				<button class="btn btn-primary" id="filterBtnMoney">Filter</button>
				<button class="btn btn-secondary" id="clearBtnMoney">Clear</button>
			</div>
			<div id="contentdivselect3" class="contentdivselect filter-container" style="width: 60%">
				<label>Bắt đầu:</label>
				<input type="number" id="startSL">
				<label>Kết thúc:</label>
				<input type="number" id="endSL">
				<button class="btn btn-primary" id="filterBtnNumber">Filter</button>
				<button class="btn btn-secondary" id="clearBtnNumber">Clear</button>
			</div>
			<div>
				<label>Trạng thái:</label>
				<select id="selectTrangThai">
					<option value=" ">All</option>
					<option value="Đã Nhận">Đã Nhận</option>
					<option value="Chưa Nhận">Chưa Nhận</option>
				</select>
				<script type="text/javascript">
					$('#selectTrangThai').on('change', function() {
						$('#mTable').DataTable().column(6).search($(this).val()).draw();
					  });
				</script>
			</div>

			
			&nbsp&nbsp&nbsp
			&nbsp&nbsp&nbsp
			&nbsp&nbsp&nbsp
			<?php //chi tiết quyền nếu được thực hiện thì mới được hiện ra
				$TenDangNhap=$_SESSION['taikhoan'];      
				$sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Thêm nhập hàng' and ctqcn.TrangThai=1";
				$resultq=mysqli_query($connect,$sqlq);
				$rowq=mysqli_num_rows($resultq);
				if($rowq==1){ ?>                                  
						<a class="btn btn-primary" href="index.php?danhmuc=themphieunhap">Thêm</a>
				<?php
					}
				?>
		</div>
	</div>
	
	<table id="mTable" class="table table-striped " style="width: 100%;">
		<thead>
			<tr>
				<th>Mã</th>
				<th>Nhân viên</th>
				<th>Nhà cung cấp</th>
				<th>Ngày nhập</th>
				<th>Tổng tiền</th>
				<th>Số lượng</th>
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
			<td><?php echo $row['MaPN']; ?></td>
			<td>
				<ul>
					<li>ID: <?php echo $row['Ma']; ?></li></li>
					<li>Tên: <?php echo $row['HoTen']; ?> </li>
					<li>SĐT: <?php echo $row['SDT']; ?></li>
				</ul>
			</td>
			<td>
				<ul>
					<li>ID: <?php echo $row['MaNCC']; ?></li></li>
					<li>Tên: <?php echo $row['TenNCC']; ?> </li>
					<li>SĐT: <?php echo $row['SdtNCC']; ?> </li>
				</ul>
			</td>
			
			<td><?php echo $row['NgayNhap']; ?></td>
			<td><?php echo $row['TongTien']; ?></td>
			<td>
				<button type="button" class="btn btn-primary view-size-button" data-bs-toggle="modal" data-bs-target="#chitietsoluongPhieunhap" id="<?php echo $row['MaPN']; ?>"> <?php echo $row['TongSoLuong']; ?> </button>
			</td>
			<td>
				<input class="form-check-input" type="checkbox" value="" id="<?php echo $row['MaPN']; ?>"
					<?php 
						if ($row['TinhTrangDH'] == 'Đã nhận') 
							echo ' checked disabled ';
					?> 
				onchange="disableCheckbox(this)" >
				<label class="form-check-label" id="p<?php echo $row['MaPN']; ?>">
					<?php echo $row['TinhTrangDH']; ?>
				</label>
			</td>
			<td>
				<a class="btn btn-primary fix-sp-button" href="index.php?danhmuc=chitietphieunhap&mapn=<?php echo $row['MaPN']; ?>">Chi tiết</a>

				<?php 
				$sqlq="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Chi tiết đơn hàng' and ctqcn.TrangThai=1";
				$resultq=mysqli_query($connect,$sqlq);
				$rowq=mysqli_num_rows($resultq);
				if($rowq==1){ ?>                                  
						<button type="button" class="btn btn-primary xoa-sp-button" data-bs-toggle="modal" data-bs-target="#xoaphieunhap" id="<?php echo $row['MaPN'] ?>">Xóa</button>
				<?php
					}
				?>
			</td>
		</tr>
	<?php } } ?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	function disableCheckbox(checkbox) {
	  checkbox.disabled = checkbox.checked;
	}

	$(document).ready(function(){
		$('table').on('click', 'td' , function (event) {
			var checkbox = $('input', this); 
			var maPhieuNhap = checkbox.attr('id');
			if (checkbox.is(':checked') && !checkbox.is(':disabled')){
				var confirmation = confirm("Xác nhận đã nhận được đơn hàng có mã = " + maPhieuNhap + " ?");
				if (confirmation) {
					$.ajax({
						url: 'module/main/quanlynhaphang_xac_nhan_nhan_hang.php',
						type: 'POST',
						data: { maPhieuNhap: maPhieuNhap },
						success: function(response){
							// console.log(response);
							document.getElementById("p" + maPhieuNhap).innerHTML = "Đã nhận";
						}
					});
				} else {
					checkbox.prop('checked', false);
				}
			}
		});
	});
	// $(document).ready(function(){
	// 	$('table').on('change', 'input[type="checkbox"]' , function (event) {
	// 		var checkbox = $(this);
	// 		var maPhieuNhap = checkbox.attr('id');
			
	// 		if (!checkbox.is(':checked')) {
	// 			$.ajax({
	// 				url: 'module/main/quanlynhaphang_huy_nhan_hang.php',
	// 				type: 'POST',
	// 				data: { maPhieuNhap: maPhieuNhap },
	// 				success: function(response){
	// 					console.log(response);
	// 					document.getElementById("p" + maPhieuNhap).innerHTML = "Chưa nhận";
	// 				}
	// 			});
	// 		}
	// 	});
	// });
</script>
<?php $connect->close(); ?>
<!-- Modal -->
<div class="modal fade" id="chitietsoluongPhieunhap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content"  style="">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Chi tiết số lượng</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	  </div>
	  <div class="modal-body">
		<table >
			<tbody id="list_size_and_number">
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
			var phieunhapId = $('button', this).attr('id');
			if (phieunhapId != null) {
				console.log(phieunhapId)
				$.ajax({
					url: 'module/main/quanlynhaphang_get_ctpn_info.php',
					type: 'POST',
					data: { phieunhapId: phieunhapId },
					success: function(response){
						$('#list_size_and_number').html(response);
					}
				});
			}
		});

	});
</script>
</body>
</html>

<div class="modal fade" id="xoaphieunhap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="ModalLabelXoasanpham">Xóa Phiếu Nhập</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	  </div>
	  <div class="modal-body" id="contendelete">
			<style>
				.inline-p {
					display: inline-block;
				}
			</style>
			<p class="inline-p">Mã phiếu nhập: </p><p id="idpn" class="inline-p"></p>
			<h2>Bạn có chắc muốn xóa phiếu nhập này?</h2>
			<button type="submit" class="btn btn-primary" id="submitXoaPN">Xóa</button>
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
			var pElement = document.getElementById("idpn");
			// Thay đổi nội dung bằng thuộc tính textContent
			pElement.textContent = productId;
		}
	});
</script>
<script>
$(document).ready(function(){
  $('#xoaphieunhap').on('hidden.bs.modal', function () {
	// Ví dụ: Reset form
	$('#contendelete').html(`
	  <style>
			.inline-p {
				display: inline-block;
			}
		</style>
		<p class="inline-p">Mã phiếu nhập: </p><p id="idpn" class="inline-p"></p>
		<h2>Bạn có chắc muốn xóa phiếu nhập này?</h2>
		<button type="submit" class="btn btn-primary" id="submitXoaPN">Xóa</button>
	`);
  });
});
</script>
<script>
	document.getElementById('submitXoaPN').addEventListener('click', function() {
		var productId = document.getElementById('idpn').innerText;
		console.log('Xoa: ' + productId);
		$.ajax({
			type: 'POST',
			url: 'module/main/quanlynhaphang_xoa_phieu_nhap.php', // Đường dẫn đến tệp PHP xử lý
			data: { productId: productId },
			success: function(response) {
				// Xử lý kết quả từ tệp PHP nếu cần
				$('#contendelete').html(response);
				var searchValue = productId;
				$("#mTable tbody tr").each(function() {
					var rowData = $(this).find("td:eq(0)").text(); // Lấy dữ liệu của cột 0 trong hàng
					if (rowData === searchValue) {
						$(this).remove(); // Xóa hàng nếu dữ liệu cột 0 trùng khớp với giá trị tìm kiếm
						return false; // Dừng vòng lặp sau khi xóa hàng
					}
				});
			},
			error: function(xhr, status, error) {
				console.error(xhr.responseText);
			}
		});
	});
</script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
		// Hàm để thay đổi nội dung của div
		function changeContent() {
			var selectBox = document.getElementById("selectBox");
			var selectedOption = selectBox.options[selectBox.selectedIndex].value;

			// Ẩn tất cả các div
			var allContents = document.getElementsByClassName("contentdivselect");
			for (var i = 0; i < allContents.length; i++) {
				allContents[i].style.display = "none";
			}

			// Hiển thị div tương ứng với option đã chọn
			var contentDiv = document.getElementById("contentdivselect" + selectedOption.substr(-1));
			contentDiv.style.display = "block";
		}
	</script>
	<script>

	    var table = $('#mTable').DataTable({
		  "order": []
		});
	    var Ngay = 0;
	    var Tien = 0;
	    var Sl = 0;

	    savedTable = table.rows().data().toArray();


		$('#filterBtnDate').click(function() {
			var startDate = $('#startdate').val();
			var endDate = $('#enddate').val();

			if (startDate != '' && endDate != '') {
		        // Tạo một mảng mới để lưu các dòng thỏa mãn điều kiện
		        var filteredData = [];

		        // Duyệt qua tất cả các hàng trong dữ liệu
		        for (var i = 0; i < savedTable.length; i++) {
		            // Lấy giá trị của cột thứ 4 (index 3) trong hàng hiện tại
		            var dateValue = savedTable[i][3]; // Giả sử cột thứ 4 là cột chứa ngày

		            // Kiểm tra xem giá trị của cột này có nằm trong khoảng startDate và endDate không
		            if (dateValue >= startDate && dateValue <= endDate) {
		                // Nếu nằm trong khoảng thì thêm hàng vào mảng filteredData
		                filteredData.push(savedTable[i]);
		            }
		        }
		        // Thêm các hàng thỏa mãn điều kiện vào bảng
		        table.clear().rows.add(filteredData).draw();
		    }
		});
		$('#clearBtnDate').click(function() {
	        table.clear().rows.add(savedTable).draw();
	        console.log('xoa loc ngay');
		});


		$('#filterBtnMoney').click(function() {
			var startmoney = $('#startmoney').val();
			var endmoney = $('#endmoney').val();
	        var filteredData1 = [];

			if (startmoney != '' && endmoney != '') {
		        for (var i = 0; i < savedTable.length; i++) {
		            var dateValue = savedTable[i][4]; // Giả sử cột thứ 4 là cột chứa ngày
		            var moneyformat = dateValue.replace(/\D/g, '');
		            moneyformat = parseFloat(moneyformat);
		            if (moneyformat >= startmoney && moneyformat <= endmoney) {
		                filteredData1.push(savedTable[i]);
		            }
		        }
		        // thực hiện sắp xếp theo thứ tự tăng của cột 5
		        filteredData1.sort(function(a, b) {
		            var moneyA = parseFloat(a[4].replace(/\D/g, ''));
		            var moneyB = parseFloat(b[4].replace(/\D/g, ''));
		            return moneyA - moneyB;
		        });
		        table.clear().rows.add(filteredData1).draw();
			}
		});
		$('#clearBtnMoney').click(function() {
	        table.clear().rows.add(savedTable).draw();
	        console.log('xoa loc tien');
		});

		$('#filterBtnNumber').click(function() {
			var startSL = $('#startSL').val();
			var endSL = $('#endSL').val();
	        var filteredData1 = [];

			if (startSL != '' && endSL != '') {
		        for (var i = 0; i < savedTable.length; i++) {
		            var dateValue = savedTable[i][5]; // Giả sử cột thứ 4 là cột chứa ngày
		            var number = $(dateValue).text().trim();
		            number = parseFloat(number);
		            if (number >= startSL && number <= endSL) {
		                filteredData1.push(savedTable[i]);
		            }
		        }
		        filteredData1.sort(function(a, b) {
		        	var numberA = $(a[5]).text().trim();
		        	var numberB = $(b[5]).text().trim();
		            return numberA - numberB;
		        });
		        // Thêm các hàng thỏa mãn điều kiện vào bảng
		        table.clear().rows.add(filteredData1).draw();
			}
		});
		$('#clearBtnNumber').click(function() {
	        table.clear().rows.add(savedTable).draw();
	        console.log('xoa loc SL');
		});
	</script>