<?php
require '../config/config.php'; 
 ?>

<link type="text/css" href="assets/css/ckedittor.css" rel="stylesheet"/>

<div id="divTong" class="container mt-4 mb-4">
    <div>
        <h2 style="padding: 10px;">Nhập Phiếu Nhập</h2>
        <div style="display: flex; width: 100%; pointer-events: none;"> 
            <div class="input-group">
                <input id="MaNV" type="text" value="<?php 
                $sql = "SELECT Ma FROM `user` WHERE TenDangNhap = ?";
                // Chuẩn bị và thực thi câu truy vấn sử dụng prepared statement
                if ($stmt = $connect->prepare($sql)) {
                    $stmt->bind_param("s", $_SESSION['taikhoan']); // "s" đại diện cho kiểu dữ liệu string
                    $stmt->execute();
                    $stmt->bind_result($MaNV);
                    $stmt->fetch();
                    $stmt->close();
                }
                echo $MaNV;
                ?>" >
                <label for="">MaNV</label>
            </div>
            <div class="input-group">
                <input id="NgayNhap" type="text" name="NgayNhap" required>
                <label for="">Ngày Nhập </label>
            </div>
            <script type="text/javascript">
                var inputElement = document.getElementById('NgayNhap');
                var currentDate = new Date();

                var currentDay = currentDate.getDate();
                var currentMonth = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0 nên cần cộng thêm 1
                var currentYear = currentDate.getFullYear();

                var formattedDate = currentYear + "-" + (currentMonth < 10 ? '0' : '') + currentMonth + "-" + (currentDay < 10 ? '0' : '') + currentDay;

                inputElement.value = formattedDate;
            </script>
        </div>
            
        <div style="display: flex; width: 100%;">    
            <div class="dropdown">
                <div class="select">
                    <span class="selected" id="nhacungcap">Chọn Nhà Cung Cấp</span>
                    <div class="caret"></div>
                </div>
                <ul class="menu">
                    <?php
                    // Chuẩn bị câu truy vấn SQL
                    $sql = "SELECT MaNCC, TenNCC FROM nhacungcap where hide=1";
                    $result = $connect->query($sql);

                    // Kiểm tra số dòng trả về từ câu truy vấn
                    if ($result->num_rows > 0) {
                        // Đổ dữ liệu vào dropdown menu
                        while ($row = $result->fetch_assoc()) {
                            echo '<li>' . $row["TenNCC"] . '</li>';
                        }
                    } else {
                        echo "<option value=''>Không có dữ liệu</option>";
                    }
                    ?>
                </ul>
            </div>
            <div class="dropdown">
                <div class="select" style="display: none;">
                    <span class="selected" id="tinhTrang">Chưa nhận</span>
                    <div class="caret"></div>
                </div>
                <ul class="menu" >
                    <li class="active">Chưa nhận</li>
                    <li>Đã nhận</li>
                </ul>
            </div>
        </div>
        <div style=" border: 1px solid black;">
            <h2 style="padding: 10px;">Nhập Chi Tiết Phiếu</h2>
            <div style="display: flex; width: 100%;"> 
                <div class="input-group">
                    <input id="MaSP" type="text" value="1" required>
                    <label for="">Mã Sản Phẩm</label>
                </div>
                <div class="input-group">
                    <input id="SoLuong" type="number" required>
                    <label for="">Số Lượng</label>
                </div>
            </div>
            
            <div style="display: flex; width: 100%;"> 
                <div class="dropdown">
                    <div class="select">
                        <span class="selected" id="SizeSP">Chọn Size</span>
                        <div class="caret"></div>
                    </div>
                    <ul class="menu">
                        <?php
                        // Chuẩn bị câu truy vấn SQL
                        $sql = "SELECT * FROM sizesp";
                        $result = $connect->query($sql);

                        // Kiểm tra số dòng trả về từ câu truy vấn
                        if ($result->num_rows > 0) {
                            // Đổ dữ liệu vào dropdown menu
                            while ($row = $result->fetch_assoc()) {
                                echo '<li>' . $row["SizeSP"] . '</li>';
                            }
                        } else {
                            echo "<option value=''>Không có dữ liệu</option>";
                        }
                        ?>
                    </ul>
                </div>

                <div class="input-group">
                    <input id="GiaNhap" type="number"  required>
                    <label for="">Giá Nhập</label>
                </div>
            </div>
            <div style="padding: 10px;">
                <button type="submit" class="btn btn-secondary" onclick="deleteRow()">Xóa chi tiết</button>
                <button type="submit" class="btn btn-primary" onclick="addRow()">Lưu chi tiết</button>
            </div>
        </div><br><br>
        <div>
            <h2>Chi tiết phiếu nhập</h2>
            <table border="1" class="table table-striped" id="mTable">
                <tr><th>Mã sản phẩm</th><th>Size sản phẩm</th><th>Số lượng</th><th>Giá nhập</th></tr>

            </table>
        </div>

        <br><br>
        <a class="btn btn-secondary" href="index.php?danhmuc=quanlynhaphang">Đóng</a>
        <button type="submit" class="btn btn-primary" id="submitForm">Lưu</button>
        <a class="btn btn-primary" href="index.php?danhmuc=themphieunhap">Clear</a>
    </div>
</div>

<script type="text/javascript">
    var submitButton = document.getElementById('submitForm');

    // Thêm sự kiện click cho nút Lưu
    submitButton.addEventListener('click', function() {
        var table = document.getElementById('mTable');
        var MaNV = document.getElementById('MaNV').value;
        var NgayNhap = document.getElementById('NgayNhap').value;
        var nhacungcap = document.getElementById('nhacungcap').textContent;
        var tinhTrang = document.getElementById('tinhTrang').textContent;

        var d = 0;
        if (MaNV === '') {
            document.getElementById('MaNV').style.border = '1px solid red'; d = 1;
        } else { document.getElementById('MaNV').style.border = ''; } 
        if (nhacungcap === 'Chọn Nhà Cung Cấp') {
            document.getElementById('nhacungcap').style.color = 'red'; d = 1;
        } else { document.getElementById('nhacungcap').style.color = ''; }
        if (tinhTrang === 'Tình Trạng Đơn Hàng') {
            document.getElementById('tinhTrang').style.color = 'red'; d = 1;
        } else { document.getElementById('tinhTrang').style.color = ''; }

        if (d === 1){
            alert("Vui lòng nhập đầy đủ thông tin phiếu!"); 
        } else if (table.rows.length === 1) {
            alert("Không có thông tin trong chi tiết phiếu!"); 
        } 
        else {

            // Mảng để lưu trữ dữ liệu
            var data = [];
            // Duyệt qua tất cả các hàng của bảng, bắt đầu từ hàng thứ 1 (vì hàng thứ 0 là header)
            for (var i = 1; i < table.rows.length; i++) {
                var row = table.rows[i];
                var rowData = [];
                // Duyệt qua tất cả các ô (cột) của hàng hiện tại
                for (var j = 0; j < row.cells.length; j++) {
                    // Lấy dữ liệu từ ô và thêm vào mảng
                    rowData.push(row.cells[j].innerHTML);
                }
                // Thêm mảng dữ liệu của hàng vào mảng chứa toàn bộ dữ liệu
                data.push(rowData);
            }


            var formData = new FormData();
            formData.append('MaNV', MaNV);
            formData.append('NgayNhap', NgayNhap);
            formData.append('nhacungcap', nhacungcap);
            formData.append('tinhTrang', tinhTrang);
            formData.append('data', JSON.stringify(data)); // Chuyển mảng data thành chuỗi JSON

            // Gửi dữ liệu bằng fetch API
            fetch('module/main/quanlynhaphang_them_phieu_nhap_xuly.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                alert(data);
                console.log(data);
            })
            .catch(error => {
                // Xử lý lỗi nếu có
                console.error('There was an error!', error);
            });
        }
    });

    function deleteRow() {
        // Lấy giá trị của cột 1 và cột 2
        var code = document.getElementById('MaSP').value;
        var size = document.getElementById('SizeSP').textContent;

        var d = 0;
        if (code === '') {
            document.getElementById('MaSP').style.border = '1px solid red'; d = 1;
        } else { document.getElementById('MaSP').style.border = ''; } 
        if (size === 'Chọn Size') {
            document.getElementById('SizeSP').style.color = 'red'; d = 1;
        } else { document.getElementById('SizeSP').style.color = ''; }

        if (d === 1) {
            alert('Yêu cầu nhập Mã Sản Phẩm và Size để tìm hàng cần xóa!');
        } else {
            // Lặp qua tất cả các hàng và xóa hàng nếu điều kiện được đáp ứng
            var table = document.getElementById('mTable');
            var rows = table.getElementsByTagName('tr');
            for (var i = 1; i < rows.length; i++) { // Bắt đầu từ 1 để bỏ qua hàng tiêu đề
                var cells = rows[i].getElementsByTagName('td');
                if (cells[0].innerHTML === code && cells[1].innerHTML === size) {
                    table.deleteRow(i);
                    break; // Sau khi xóa hàng, thoát khỏi vòng lặp
                }
            }
        }

        
    }


    function addRow() {
        // Lấy dữ liệu mới từ các ô input
        var newCode = document.getElementById('MaSP').value;
        var newSize = document.getElementById('SizeSP').textContent;
        var newQuantity = document.getElementById('SoLuong').value;
        var newPrice = document.getElementById('GiaNhap').value;

        var d = 0;

        var productCode = newCode;
        $.ajax({
            type: 'POST',
            url: 'module/main/quanlynhaphang_is_MaSP_exist.php',
            data: {productCode: productCode},
            success: function(response){
                if (response === "khong_ton_tai"){
                    document.getElementById('MaSP').style.border = '1px solid red'; d = 1;
                    alert("Mã Không tồn tại!");

                }  else {
                    if (newCode === '') {
                        document.getElementById('MaSP').style.border = '1px solid red'; d = 1;
                    } else { document.getElementById('MaSP').style.border = ''; } 
                    if (newSize === 'Chọn Size') {
                        document.getElementById('SizeSP').style.color = 'red'; d = 1;
                    } else { document.getElementById('SizeSP').style.color = ''; }
                    if (newQuantity === '') {
                        document.getElementById('SoLuong').style.border = '1px solid red'; d = 1;
                    } else { document.getElementById('SoLuong').style.border = ''; } 
                    if (newPrice === '') {
                        document.getElementById('GiaNhap').style.border = '1px solid red'; d = 1;
                    } else { document.getElementById('GiaNhap').style.border = ''; } 

                    if (d === 1) {
                        alert('Vui lòng nhập đầy đủ chi tiết');
                    } else {
                        // Lấy đối tượng bảng
                        var table = document.getElementById('mTable');
                        var dachinh = false;
                        // Kiểm tra xem có hàng nào trong bảng chứa dữ liệu giống với dữ liệu mới không
                        var rows = table.getElementsByTagName('tr');
                        for (var i = 0; i < rows.length; i++) {
                            var cells = rows[i].getElementsByTagName('td');
                            if (cells.length >= 2) {
                                var code = cells[0].innerHTML;
                                var size = cells[1].innerHTML;
                                if (code === newCode) {
                                    cells[3].innerHTML = newPrice;
                                    if (size === newSize) {
                                        cells[2].innerHTML = newQuantity;
                                        dachinh = true;
                                    }
                                }
                                
                            }
                        }
                        if (dachinh) return;

                        // Nếu không tìm thấy hàng có dữ liệu giống, thêm một hàng mới
                        var newRow = table.insertRow(-1); // Thêm vào cuối bảng
                        var cell1 = newRow.insertCell(0);
                        var cell2 = newRow.insertCell(1);
                        var cell3 = newRow.insertCell(2);
                        var cell4 = newRow.insertCell(3);

                        // Gán dữ liệu cho các ô của hàng mới
                        cell1.innerHTML = newCode;
                        cell2.innerHTML = newSize;
                        cell3.innerHTML = newQuantity;
                        cell4.innerHTML = newPrice;       
                    }
                }
            }
        });

        
        
        
    }


    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        const select = dropdown.querySelector('.select');
        const caret = dropdown.querySelector('.caret');
        const menu = dropdown.querySelector('.menu');
        const options = dropdown.querySelectorAll('.menu li');
        const selected = dropdown.querySelector('.selected');

        select.addEventListener('click', () => {
            select.classList.toggle('select-clicked');
            caret.classList.toggle('caret-rotate');
            menu.classList.toggle('menu-open');
        });

        options.forEach(option => {
            option.addEventListener('click', () => {
                selected.innerText = option.innerText;
                select.classList.remove('select-clicked');
                caret.classList.remove('caret-rotate');
                menu.classList.remove('menu-open');

                // Remove 'active' class from all options
                options.forEach(opt => {
                    opt.classList.remove('active');
                });

                // Add 'active' class to the clicked option
                option.classList.add('active');
            });
        });
    });
</script>