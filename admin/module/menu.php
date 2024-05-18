<style>
    ul{
        list-style: none;
    }
</style>
<nav class="sidebar-navigation">
	<ul>
		<a href="index.php?danhmuc=dashboard">
			<li>
				<i class="fa-solid fa-gauge-high"></i>
				<span class="tooltip">Dashboard</span>
			</li>
		</a>
		<?php
		require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php'); //Kết nối mysql                     
		$TenDangNhap=$_SESSION['taikhoan'];
		//Thống kê kinh doanh
		$sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Thống kê kinh doanh' and ctqcn.TrangThai=1";
		$result=mysqli_query($connect,$sql);
		$row=mysqli_num_rows($result);
			if($row==1){
				echo '<a href="index.php?danhmuc=thongkekinhdoanh">
				<li>
					<i class="fa-solid fa-chart-simple"></i>
					<span class="tooltip">Thống kê kinh doanh</span>
				</li>
			</a>';
			}
		// quản lý sản phẩm
		$sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and (ctqcn.HanhDong='Thêm sản phẩm' or ctqcn.HanhDong='Xóa sản phẩm' or ctqcn.HanhDong='Sửa sản phẩm') and ctqcn.TrangThai=1";
		$result=mysqli_query($connect,$sql);
		$row=mysqli_num_rows($result);
			if($row!=0){
				echo '<a href="index.php?danhmuc=quanlysanpham">
				<li>
					<i class="fa-brands fa-shopify"></i>
					<span class="tooltip">Quản lý sản phẩm</span>
				</li>
			</a>';
			}
		// quản lí đánh giá
		$sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Đánh giá' and ctqcn.TrangThai=1";
		$result=mysqli_query($connect,$sql);
		$row=mysqli_num_rows($result);
			if($row==1){
				echo '<a href="index.php?danhmuc=quanlydanhgia">
				<li>
					<i class="fa-solid fa-star"></i>
					<span class="tooltip">Quản lý đánh giá</span>
				</li>
			</a>';
			}
		//Quản lí đơn hàng
		$sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and (ctqcn.HanhDong='Chi tiết đơn hàng' or ctqcn.HanhDong='Thay đổi trạng thái đơn hàng' or ctqcn.HanhDong='Hủy đơn hàng') and ctqcn.TrangThai=1";
		$result=mysqli_query($connect,$sql);
		$row=mysqli_num_rows($result);
			if($row!=0){
				echo '<a href="index.php?danhmuc=quanlydonhang">
				<li>
					<i class="fa-solid fa-cube"></i>
					<span class="tooltip">Quản lý đơn hàng</span>
				</li>
			</a>';
			}
		// quản lí nhập hàng
		$sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and (ctqcn.HanhDong='Thêm nhập hàng' or ctqcn.HanhDong='Xóa nhập hàng') and ctqcn.TrangThai=1";
		$result=mysqli_query($connect,$sql);
		$row=mysqli_num_rows($result);
			if($row!=0){
				echo '<a href="index.php?danhmuc=quanlynhaphang">
				<li>
					<i class="fa-solid fa-file-import"></i>			
					<span class="tooltip">Quản lý nhập hàng</span>
				</li>
			</a>';
			}
		$sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and (ctqcn.HanhDong='Thêm nhóm quyền' or ctqcn.HanhDong='Xóa nhóm quyền' or ctqcn.HanhDong='Sửa nhóm quyền' or ctqcn.HanhDong='Chi tiết chức năng cho nhóm quyền') and ctqcn.TrangThai=1";
		$result=mysqli_query($connect,$sql);
		$row=mysqli_num_rows($result);
			if($row!=0){
				echo '<a href="index.php?danhmuc=quanlyquyen">
				<li>
					<i class="fa-solid fa-user-shield"></i>
					<span class="tooltip">Quản lý quyền</span>
				</li>
			</a>';
			}	
		//quản lí tài khoản
		$sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and  ctqcn.HanhDong='Quản lí tài khoản'  and ctqcn.TrangThai=1";
		$result=mysqli_query($connect,$sql);
		$row=mysqli_num_rows($result);
		if($row!=0){
			echo '<a href="index.php?danhmuc=quanlytaikhoan">
			<li>
				<i class="fa-solid fa-user-gear"></i>
				<span class="tooltip">Quản lý tài khoản</span>
			</li>	
		</a>';
		}
		//Cài đặt
		$sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and (ctqcn.HanhDong='Quản lí size' or ctqcn.HanhDong='Quản lí nhà cung cấp' or ctqcn.HanhDong='Quản lí nhãn hiệu' or ctqcn.HanhDong='Quản lí danh mục' ) and ctqcn.TrangThai=1";
		$result=mysqli_query($connect,$sql);
		$row=mysqli_num_rows($result);
		if($row!=0){
			echo '<a href="index.php?danhmuc=caidat">
			<li>
				<i class="fa-solid fa-gear"></i>
				<span class="tooltip">Cài đặt</span>
			</li>
		</a>';
		}
		//Cài đặt website
		$sql="SELECT * FROM `taikhoan` tk join quyen q on q.MaQuyen=tk.MaQuyen join chitietquyenchucnang ctqcn on ctqcn.MaQuyen=q.MaQuyen WHERE TenDangNhap='$TenDangNhap' and ctqcn.HanhDong='Cài đặt website' and ctqcn.TrangThai=1";
		$result=mysqli_query($connect,$sql);
		$row=mysqli_num_rows($result);
			if($row==1){
				echo '<a href="index.php?danhmuc=caidatwebsite">
				<li>
					<i class="fa-solid fa-screwdriver-wrench"></i>	
					<span class="tooltip">Cài đặt website</span>
				</li>
			</a>';
			}
		?>
		
		
		
		
		
		
		
		
		
		
		

		
		


	</ul>
</nav>
<script>
   // Lấy tất cả các phần tử <li> trong các phần tử <ul> và gán sự kiện 'click' cho từng phần tử
    document.querySelectorAll('ul li').forEach(function(li) {
    li.addEventListener('click', function() {
        // Loại bỏ lớp 'active' từ tất cả các phần tử <li>
        document.querySelectorAll('li').forEach(function(item) {
            item.classList.remove('active');
        });
        // Thêm lớp 'active' cho phần tử <li> đang được click
        this.classList.add('active');
    });
});

</script>