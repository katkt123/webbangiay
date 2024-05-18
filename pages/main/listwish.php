<main>
    <div class="notification">
    </div>
    <section class="breadcrumb">
        <div class="container" style="margin-bottom: 10px;">
            <div class="breadcrumb-main">
                <a  href="index.php?danhmuc=home" style="color: #807e7e;">
                    Trang chủ
                </a>
                <i class="breadcrumb-icon fa-solid fa-chevron-right"></i>
                <a href="index.php?danhmuc=listwish" style="color: #807e7e;">
                    Yêu thích
                </a>
            </div>
        </div>
</section>
    <section class="shell">
        <div class="container">
            <div class="wish-main">
                <div class="shell-show" style="overflow-x: auto;">
                    <table style="width: 100%; font-size: 16px; " class="table-shell">
                        <thead>
                            <tr>
                                <th style="min-width: 300px;" >Sản phẩm</th>
                                <th style="min-width: 150px;">Giá</th>
                                <th style="min-width: 150px;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="wishProduct">
                            <!-- <tr>
                                <td style="min-width: 200px;">
                                    <div class="shell-product">
                                        <div class="shell-img">
                                            <img src="./assets/img/pd-1.png" alt="" class="">
                                        </div>
                                        <div class="shell-title-repository">
                                            <div class="shell-title">
                                                Lorem ipsum dolor
                                            </div>
                                            <div class="shell-repository">
                                                23 stocks remaining
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="min-width: 200px;">500.000 đ</td>
                                <td style="min-width: 200px;">
                                <button class="buttonDeleteCart" id="" style="width: 20px; height: 20px;"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>   
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
         </div>
    </section>
</main>
<script>
    $(document).ready(function(){
        function getWishUser(){
            var wishAll = JSON.parse(localStorage.getItem('wish')) || [];
            var wishUser=[];
            wishAll.forEach(item => {
                <?php if(isset($_SESSION['taikhoan'])){ ?>
                    if(item['taikhoan']=="<?php echo $_SESSION['taikhoan']; ?>"){
                        wishUser.push(item);
                    }    
                <?php } ?>

            });
            return wishUser;
        }
        $.ajax({
            url: 'control/ajax_action.php',
            type: 'POST',
            data: {
                action: 'showWish',
                wish: JSON.stringify(getWishUser()),
            },
            success: function(data){
                $('#wishProduct').html(data);
                deleteWish();
            }
        });
        function deleteWish(){
            var buttonDeleteWish=document.querySelectorAll(".buttonDeleteWish");
            buttonDeleteWish.forEach( button =>{
                button.addEventListener("click", function(){
                    button.parentElement.parentElement.remove();//Xóa trên giao diện
                    var MaSP=parseInt(button.getAttribute('id'));
                    <?php if(isset($_SESSION['taikhoan'])){ ?>
                        var TaiKhoan="<?php echo $_SESSION['taikhoan']?>";
                    <?php } ?>
                    console.log(MaSP+" "+TaiKhoan);
                    removeFromWish(MaSP,TaiKhoan);
                    creatToast("item-success","Xóa khỏi danh sách yêu thích thàng công","fa-solid fa-circle-check","item-end-success");
                })
            });
        }
        function removeFromWish(MaSP, TaiKhoan) {
            var wish = JSON.parse(localStorage.getItem('wish')) || [];
            var index = wish.findIndex(function(item) {
                return item['maSP'] === MaSP && item['taikhoan'] === TaiKhoan;
            });
            if (index !== -1) {
                // Nếu tìm thấy sản phẩm trong giỏ hàng, xóa sản phẩm đó khỏi mảng
                wish.splice(index, 1);
                localStorage.setItem('wish', JSON.stringify(wish));
                console.log("Sản phẩm đã được xóa khỏi giỏ hàng.");
            } else {
                console.log("Không tìm thấy sản phẩm trong giỏ hàng.");
            }
        }
        function setQuantityCard(){
            var cardQuanlity=document.querySelector('.header__action-cart-count').innerHTML=getCardUser().length;
        }
    });
</script>
