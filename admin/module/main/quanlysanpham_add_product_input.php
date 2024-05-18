<?php
require '../config/config.php'; 
 ?>

<link type="text/css" href="assets/css/ckedittor.css" rel="stylesheet"/>

<div id="divTong" class="container mt-4 mb-4">
    <div>
        <p id="responsepp"></p>
        <div style="display: flex; width: 100%;"> 
            <div class="input-group">
                <input id="tensp" type="text" required>
                <label for="">Tên Sản Phẩm</label>
            </div>
            <div class="input-group">
                <input id="giasp" type="number" name="GiaMoi" required>
                <label for="">Giá </label>
            </div>
        </div>
            
        <div style="display: flex; width: 100%;">    
            <div class="dropdown">
                <div class="select">
                    <span class="selected" id="TenNhanHieu">Chọn Nhãn Hiệu</span>
                    <div class="caret"></div>
                </div>
                <ul class="menu">
                    <?php
                    // Chuẩn bị câu truy vấn SQL
                    $sql = "SELECT MaNhanHieu, TenNhanHieu FROM nhanhieu where hide=1";
                    $result = $connect->query($sql);

                    // Kiểm tra số dòng trả về từ câu truy vấn
                    if ($result->num_rows > 0) {
                        // Đổ dữ liệu vào dropdown menu
                        while ($row = $result->fetch_assoc()) {
                            echo '<li>' . $row["TenNhanHieu"] . '</li>';
                        }
                    } else {
                        echo "<option value=''>Không có dữ liệu</option>";
                    }
                    ?>
                </ul>
            </div>
            <div class="dropdown">
                <div class="select">
                    <span class="selected" id="MaLoai">Chọn Loại</span>
                    <div class="caret"></div>
                </div>
                <ul class="menu" >
                    <?php 
                    $sql = "SELECT MaLoai, TenLoai FROM loaisp where hide=1";
                    $result = $connect->query($sql);

                    // Kiểm tra số dòng trả về từ câu truy vấn
                    if ($result->num_rows > 0) {
                        // Đổ dữ liệu vào dropdown menu
                        while ($row = $result->fetch_assoc()) {
                            echo '<li>' . $row["TenLoai"] . '</li>';
                        }
                    } else {
                        echo "<option value=''>Không có dữ liệu</option>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="drop-zone" id="dropZoneAvata">
            <span class="drop-zone__prompt">Kéo và thả ảnh vào đây hoặc nhấn để chọn ảnh Đại diện</span>
            <input type="file" class="drop-zone__input" id="avataSP">
            <div class="image-preview" id="imagePreviewAvata"></div>
        </div> <br><br>
        <div class="drop-zone" id="dropZone">
            <span class="drop-zone__prompt">Kéo và thả ảnh vào đây hoặc nhấn để chọn ảnh</span>
            <input type="file" class="drop-zone__input" id="hinhanh" multiple>
            <div class="image-preview" id="imagePreview"></div>
        </div> <br><br>
        
        <div id="editor">
              
        </div><br><br>
        <a class="btn btn-secondary" href="index.php?danhmuc=quanlysanpham">Đóng</a>
        <button type="submit" class="btn btn-primary" id="submitForm">Lưu</button>
        <a class="btn btn-primary" href="index.php?danhmuc=themsanpham">Clear</a>
    </div>
</div>

<script src="js/ckeditor.js"></script>

<script>
    let editor;
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]

        } )
        .then( newEditor  => {
            editor = newEditor ;
        } )
        .catch( err => {
            console.error( err.stack );
        } );
</script>

<script type="text/javascript">
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
<script>
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('hinhanh');

    dropZone.addEventListener('click', () => {
        fileInput.click();
    });

    function previewImages() {
        var preview = document.getElementById('imagePreview');
        var files   = document.getElementById('hinhanh').files;

        preview.innerHTML = '';

        if (files) {
            [].forEach.call(files, function(file) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.height = '400px'; // set kích thước tối đa của ảnh
                    preview.appendChild(img);
                }

                reader.readAsDataURL(file);
            });
        }
    }

    document.getElementById('hinhanh').addEventListener('change', previewImages);
</script>
<script>
    const dropZoneAvata = document.getElementById('dropZoneAvata');
    const avataInput = document.getElementById('avataSP');


    dropZoneAvata.addEventListener('click', () => {
        avataInput.click();
    });

    avataInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    dropZoneAvata.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZoneAvata.classList.add('drop-zone--over');
    });

    dropZoneAvata.addEventListener('dragleave', () => {
        dropZoneAvata.classList.remove('drop-zone--over');
    });

    dropZoneAvata.addEventListener('drop', (e) => {
        e.preventDefault();
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            avataInput.files = files;
            handleFiles(files);
        }
        dropZoneAvata.classList.remove('drop-zone--over');
    });

    function handleFiles(files) {
        const imageFile = files[0];
        const imageUrl = URL.createObjectURL(imageFile);
        const imageElement = document.createElement('img');
        imageElement.onload = function() {
            const aspectRatio = this.width / this.height;
            const newWidth = 800;
            imageElement.style.width = `${newWidth}px`;
        };
        imageElement.src = imageUrl;
        imageElement.classList.add('image-preview__image');
        imagePreviewAvata.innerHTML = '';
        imagePreviewAvata.appendChild(imageElement);
    }




    var submitButton = document.getElementById('submitForm');

    // Thêm sự kiện click cho nút Lưu
    submitButton.addEventListener('click', function() {
        // Lấy dữ liệu từ các phần tử HTML
        var tenSP = document.getElementById('tensp').value;
        var giaSP = document.getElementById('giasp').value;
        var tenNhanHieu = document.getElementById('TenNhanHieu').textContent;
        var maLoai = document.getElementById('MaLoai').textContent;
        var hinhanh = document.getElementById('hinhanh').files; // Lấy file ảnh
        var hinhAvata = avataInput.files[0];
        var editorContent = editor.getData();

        // Kiểm tra và thay đổi màu sắc của các trường không có dữ liệu
        var d = 0;
        if (tenSP === '') {
            document.getElementById('tensp').style.border = '1px solid red'; // Đổi màu viền thành đỏ
            d = 1;
        } else {
            document.getElementById('tensp').style.border = ''; // Reset màu viền nếu có dữ liệu
        }

        if (giaSP === '') {
            document.getElementById('giasp').style.border = '1px solid red';
            d = 1;
        } else {
            document.getElementById('giasp').style.border = '';
        }

        if (tenNhanHieu === 'Chọn Nhãn Hiệu') {
            document.getElementById('TenNhanHieu').style.color = 'red';
            d = 1;
        } else {
            document.getElementById('TenNhanHieu').style.color = '';
        }

        if (maLoai === 'Chọn Loại') {
            document.getElementById('MaLoai').style.color = 'red';
            d = 1;
        } else {
            document.getElementById('MaLoai').style.color = '';
        }

        if (hinhanh[0] == null) {
            document.getElementById('dropZone').style.color = 'red';
            document.getElementById('dropZone').style.border = '2px dashed red';
            d = 1;
        } else {
            document.getElementById('dropZone').style.border = '2px dashed black';
            document.getElementById('dropZone').style.color = '';
        } 
        if (hinhAvata == null){
            document.getElementById('dropZoneAvata').style.color = 'red';
            document.getElementById('dropZoneAvata').style.border = '2px dashed red';
            d = 1;
        } else {
            document.getElementById('dropZoneAvata').style.border = '2px dashed black';
            document.getElementById('dropZoneAvata').style.color = '';
        } 

        if (d === 1){
            alert('Vui lòng nhập đầy đủ');
        } else {
            // Tạo đối tượng FormData để chứa dữ liệu
            var formData = new FormData();
            formData.append('tenSP', tenSP);
            formData.append('giaSP', giaSP);
            formData.append('tenNhanHieu', tenNhanHieu);
            formData.append('maLoai', maLoai);
            formData.append('editorContent', editorContent);
            
            formData.append('hinhanh[]', hinhAvata);
            for (var i = 0; i < hinhanh.length; i++) {
                formData.append('hinhanh[]', hinhanh[i]);
            }

            // Tạo đối tượng XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Mở kết nối
            xhr.open('POST', 'module/main/quanlysanpham_add_product.php', true);

            // Gửi dữ liệu
            xhr.send(formData);

            // Xử lý kết quả trả về
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        // Xử lý phản hồi từ server (nếu cần)
                        var response = xhr.responseText;
                        alert(response);
                    } else {
                        // Xử lý lỗi (nếu có)
                        console.error('Đã xảy ra lỗi:', xhr.status);
                    }
                }
            };
        }

        // In dữ liệu lấy được ra console để kiểm tra
        // console.log('Tên Sản Phẩm:', tenSP);
        // console.log('Giá:', giaSP);
        // console.log('Nhãn Hiệu:', tenNhanHieu);
        // console.log('Loại:', maLoai);
        // console.log('Hình ảnh:', hinhanh);
        // console.log('Nội dung:', editorContent);

        
    });
</script>

