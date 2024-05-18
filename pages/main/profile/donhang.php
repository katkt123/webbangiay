<style>
    .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    position: fixed;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    z-index: 9999;
    border-radius: 7px;
    
}

.close {
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
table tr:nth-child(even) {
    background-color: #f2f2f2; /* Màu cho các hàng chẵn */
}

table tr:nth-child(odd) {
    background-color: #ffffff; /* Màu cho các hàng lẻ */
}

</style>
<main class="profile-item">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->
    <div class="donhang-main" style="overflow-x: auto; width: 100%;">
        <table class="table-order" style="width: 100%;">
            <thead>
                <tr>
                    <th style="min-width: 100px;">ĐƠN HÀNG</th>
                    <th style="min-width: 150px;">NGÀY</th>
                    <th style="min-width: 150px;">TÌNH TRẠNG</th>
                    <th style="min-width: 150px;">TỔNG</th>
                    <th style="min-width: 150px;">THAO TÁC</th>
                </tr>
            </thead>
            <tbody id="donhang">
                <?php 
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/px-act.php');
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/user-act.php');
                    echo showPhieuXuat(intval(getUser($_SESSION['taikhoan'])->getMa()));
                ?>
            </tbody>
        </table>
    </div>
    <div id="myModal" class="modal" >
        <div class="modal-content" style="width: 500px;">
            <!-- <div style="display: flex; align-items: center; justify-content: end;">
                <span class="close">&times;</span>
            </div>
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Size</th>
                        <th scope="col" class="text-right">Số lượng</th>
                        <th scope="col" class="text-right">Giá</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td> Creative Design</td>
                        <td>42</td>
                        <td class="text-right">2</td>
                        <td class="text-right">$30.00</td>
                    </tr>
                </tbody>
            </table>
            <div class="row mt-5" style="display: flex; justify-content: end; margin-top: 20px; padding: 10px;">
                <div class="col-md-12">
                    <div class="text-right mr-2" style="text-align: end;">
                        <p class="mb-2 h6">
                            <span class="text-muted">Thành tiền : </span>
                            <strong>$285.00</strong>
                        </p>
                        <p class="mb-2 h6">
                            <span class="text-muted">Vận chuyển : </span>
                            <strong>$28.50</strong>
                        </p>
                        <p class="mb-2 h6">
                            <span class="text-muted">Tiền cần trả : </span>
                            <span>$313.50</span>
                        </p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <div class="notification">
    </div>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var openModalBtns = document.querySelectorAll(".openModalBtn");
        openModalBtns.forEach(openModalBtn => {
            openModalBtn.addEventListener("click", function() {
                modal.style.display = "block";
                $maPX=openModalBtn.parentElement.parentElement.parentElement.children[0].textContent.substring(1);
                $.ajax({
                    url: 'control/ajax_action.php',
                    type: 'POST',
                    data: {
                        MaPX: $maPX,
                        action:"showChiTietPhieuXuat",
                    },
                    success: function(data){
                        var modalContent=document.querySelector(".modal-content");
                        modalContent.innerHTML=data;
                        var closeBtn = document.querySelector(".close");
                        closeBtn.addEventListener("click", function() {
                            modal.style.display = "none";
                        });
                    }
                });
            });
        })
        var modal = document.getElementById("myModal");

        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
        var btnHuyDon= document.querySelectorAll(".btnHuyDon");
        btnHuyDon.forEach(btn => {
            btn.addEventListener('click', function(){
                $maPX=btn.parentElement.parentElement.parentElement.children[0].textContent.substring(1);
                // $MaSP=
                // $SoLuong=
                // $Size=
                Swal.fire({
                    title: 'Xác nhận hủy',
                    text: "Bạn có chắc chắn muốn hủy đơn hàng này không?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hủy',
                    cancelButtonText: 'Không'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'control/ajax_action.php',
                            type: 'POST',
                            data: {
                                MaPX: $maPX,
                                // MaSP: $MaSP,
                                // SoLuong: $SoLuong,
                                // Size: $Size,
                                action:"deleteDonHang",
                            },
                            success: function(data){
                                console.log(data);
                                if(data==1){
                                    btn.parentElement.parentElement.parentElement.children[2].innerHTML="Đã hủy";
                                    btn.remove();
                                    creatToast("item-success","Hủy đơn hàng thành công","fa-solid fa-circle-check","item-end-success");
                                }
                                else{
                                    creatToast("item-error","Đơn hàng đã được gửi cho đơn vị vận chuyển, không thể hủy đơn hàng này","fa-solid fa-triangle-exclamation","item-end-error");                        
                                }
                            }
                        });
                    }
                });
            });
        });
    });
</script>