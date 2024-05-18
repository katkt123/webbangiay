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
                <a href="index.php?danhmuc=shell" style="color: #807e7e;">
                    Vỏ hàng
                </a>
            </div>
        </div>
    </section>
    <section class="shell">
        <div class="container">
            <div class="shell-main">
                <div class="shell-show" style="overflow: auto;">
                    <table style="width: 100%; font-size: 16px;" class="table-shell">
                        <thead>
                            <tr>
                                <th style="min-width: 300px;" >Sản phẩm</th>
                                <th style="min-width: 80px;">Size</th>
                                <th style="min-width: 100px;">Số lượng</th>
                                <th style="min-width: 150px;">Giá</th>
                                <th style="min-width: 70px;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="cartProduct">
                            <!-- <tr>
                                <td>
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
                                <td>43</td>
                                <td >1
                                </td>
                                <td>500.000 đ</td>
                                <td><input style="width: 20px; height: 20px;" type="checkbox"></td>
                            </tr> -->
                        </tbody>
                    </table>
                    <!-- <div class="shell-header">
                        <div class="shell-header_item">
                            Item
                        </div>
                        <div class="shell-header_size">
                            Size
                        </div>
                        <div class="shell-header_quanlity">
                            Quanlity
                        </div>
                        <div class="shell-header_price">
                            Price
                        </div>
                    </div>
                    <ul class="shell-list">
                        <li class="shell-item">
                            <div class="shell-check">
                                <div class="shell-check_box">
                                    <i class="fa-sharp fa-solid fa-check"></i>
                                </div>
                            </div>
                            <div class="shell-detail">
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
                                        <div class="shell-sale">
                                            <div class="shell-sale-delivery">
                                                <i class="fa-light fa-truck"></i>
                                                30% Shipping
                                            </div>
                                            <div class="shell-sale-discount">
                                                <i class="fa-regular fa-badge-percent"></i>
                                                25% Discount
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="shell-size">
                                    Size: 43
                                </div>
                                <div class="shell_quantity-main">
                                    <div class="shell-quantity">
                                        <div class="shell-quantity-minus shell-quantity-btn">
                                            -
                                        </div>
                                        <div class="shell-quantity-number">
                                            1
                                        </div>
                                        <div class="shell-quantity-plus shell-quantity-btn">
                                            +
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="shell-price">
                                    <span>16,000,000đ</span>
                                </div>
                            </div>
                        </li>
                    </ul> -->
                </div>
                <div class="shell-total">
                    <div class="shell-total-main">
                        <ul class="shell-total-product">
                             <li class="shell-total-item">
                                <div class="shell-total-item-detail">
                                    <div class="shell-total-img-quanlity">
                                        <div class="shell-total-img">
                                            <img src="./assets/img/shoesDefault.png" alt="" class="">
                                        </div>
                                    </div>
                                    <div class="shell-total-title_size">
                                        <div class="shell-total-title" style="border-radius: 5px; background-color:#F5F5F5 ; width: 100px; height: 35px;">
                                            
                                        </div>
                                        <div class="shell-total-size " style="border-radius: 5px; background-color:#F5F5F5 ; width: 50px; height: 35px; margin-top: 10px;">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="shell-total-item-price">
                                    <span></span>
                                </div>  
                            </li>
                            <!--<li class="shell-total-item">
                                <div class="shell-total-item-detail">
                                    <div class="shell-total-img-quanlity">
                                        <div class="shell-total-img">
                                            <img src="./assets/img/pd-1.png" alt="" class="">
                                        </div>
                                        <div class="shell-total-item_quanlity">
                                            1
                                        </div>
                                    </div>
                                    <div class="shell-total-title_size">
                                        <div class="shell-total-title">
                                            Lorem ipsum dolor
                                        </div>
                                        <div class="shell-total-size">
                                            Size: 43
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="shell-total-item-price">
                                    <span>16,000,000đ</span>
                                </div>  

                            </li>
                            <li class="shell-total-item">
                                <div class="shell-total-item-detail">
                                    <div class="shell-total-img-quanlity">
                                        <div class="shell-total-img">
                                            <img src="./assets/img/pd-1.png" alt="" class="">
                                        </div>
                                        <div class="shell-total-item_quanlity">
                                            1
                                        </div>
                                    </div>
                                    <div class="shell-total-title_size">
                                        <div class="shell-total-title">
                                            Lorem ipsum dolor
                                        </div>
                                        <div class="shell-total-size">
                                            Size: 43
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="shell-total-item-price">
                                    <span>16,000,000đ</span>
                                </div>  

                            </li> -->
                            
                        </ul>
                        <div class="shell-total-div shell-total-total">
                            <span>Tổng cộng:</span>
                            <span class="shell-priceTotal" style="text-align: end;">0đ</span>
                        </div>

                        <button class="shell-total-btn" style="width: 100%; display: block;">
                            Thanh toán
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    $(document).ready(function(){
        var cardQuanlity=document.querySelector('.header__action-cart-count').innerHTML=getCardUser().length;
        function getCardUser(){
            var cartAll = JSON.parse(localStorage.getItem('cart')) || [];
            var cartUser=[];
            cartAll.forEach(item => {
                <?php if(isset($_SESSION['taikhoan'])){ ?>
                    if(item['TaiKhoan']=="<?php echo $_SESSION['taikhoan']; ?>"){
                        cartUser.push(item);
                    }
                <?php } ?>
            });
            return cartUser;
        }
        function getCart(MaSP,Size,SoLuong){
            var cartAll = JSON.parse(localStorage.getItem('cart')) || [];
            var cart;
            cartAll.forEach(item => {
                if(item['MaSP']==MaSP && item['Size']==Size && item['SoLuong']==SoLuong){
                    cart=item;
                }
            });
            return cart;
        }
        function getProductSelect(){
            var product = [];
            document.querySelectorAll('.inputCart:checked').forEach(input => {
                // viêt hàm truyền vào mã và lấy ra cart lưu vào mảng product
                var size=input.parentElement.parentElement.children[1].innerText;
                var soluong =input.parentElement.parentElement.children[2].innerText;
                cart=getCart(input.value,size,soluong);
                product.push(cart);
            });
            return product;
        }
        $.ajax({
            url: 'control/ajax_action.php',
            type: 'POST',
            data: {
                action: 'showCart',
                cart: JSON.stringify(getCardUser()),
            },
            success: function(data){
                $('#cartProduct').html(data);
                var inputCheck=document.querySelectorAll('.inputCart');
                deleteCart();
                inputCheck.forEach(item => {
                    item.addEventListener('click',function(){
                        addProductToTotal();
                        showPriceTotal()
                        
                        //tính tổng tiền
                    });
                });
            }
        });
        function getPriceTotal(){
            var priceTotal = 0;
            document.querySelectorAll('.inputCart:checked').forEach(input => {
                // viêt hàm truyền vào mã và lấy ra cart lưu vào mảng product
                var gia=input.parentElement.parentElement.children[3].innerText;
                var price=(vndToInteger(gia));
                priceTotal+=price;
            });
            console.log(priceTotal);
            return priceTotal;
            // return product;
        }
        function showPriceTotal(){
            var PriceTotal=document.querySelector(".shell-priceTotal");
            PriceTotal.innerHTML=integerToVND(getPriceTotal());
        }
        function addProductToTotal(){
            $.ajax({
                url: 'control/ajax_action.php',
                type: 'POST',
                data: {
                    action: 'addProductToTotal',
                    products: JSON.stringify(getProductSelect()),
                },
                success: function(data){
                    console.log(data);
                    if(data==""){
                        $('.shell-total-product').html(
                            `
                            <li class="shell-total-item">
                                <div class="shell-total-item-detail">
                                    <div class="shell-total-img-quanlity">
                                        <div class="shell-total-img">
                                            <img src="./assets/img/shoesDefault.png" alt="" class="">
                                        </div>
                                    </div>
                                    <div class="shell-total-title_size">
                                        <div class="shell-total-title" style="border-radius: 5px; background-color:#F5F5F5 ; width: 100px; height: 35px;">
                                            
                                        </div>
                                        <div class="shell-total-size " style="border-radius: 5px; background-color:#F5F5F5 ; width: 50px; height: 35px; margin-top: 10px;">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="shell-total-item-price">
                                    <span></span>
                                </div>  
                            </li>
                            `
                        );
                    }
                    else{
                        $('.shell-total-product').html(data);
                    }
                }
            });
        }
        function vndToInteger(amount) {
            // Loại bỏ ký tự phân tách hàng nghìn và ký tự đơn vị tiền tệ
            amount = amount.replace(/,/g, '');
            amount = amount.replace('₫', '');
            
            // Chuyển chuỗi thành số nguyên
            var integerAmount = parseInt(amount, 10);
            
            return integerAmount;
        }
        function integerToVND(amount) {
            // Chuyển số nguyên thành chuỗi
            var amountStr = amount.toString();
            
            // Thêm dấu phân tách hàng nghìn vào chuỗi
            var formattedAmount = '';
            for (var i = amountStr.length - 1, count = 0; i >= 0; i--, count++) {
                formattedAmount = amountStr.charAt(i) + formattedAmount;
                if (count % 3 == 2 && i > 0) {
                    formattedAmount = ',' + formattedAmount;
                }
            }
            
            // Thêm ký tự đơn vị tiền tệ vào cuối chuỗi
            formattedAmount += '₫';
            
            return formattedAmount;
        }
        function deleteCart(){
            var buttonDeleteCart=document.querySelectorAll(".buttonDeleteCart");
            buttonDeleteCart.forEach( button =>{
                button.addEventListener("click", function(){
                    var checked=button.parentElement.children[0].checked;
                    if(checked){ // nếu input có checked nhưng nhấn xóa thì kh cho xóa
                        creatToast("item-error","Không thế xóa khi sản phẩm đã được chọn","fa-solid fa-triangle-exclamation","item-end-error");
                    }
                    else{
                        button.parentElement.parentElement.remove();//Xóa trên giao diện
                        var MaSP=parseInt(button.getAttribute('id'));
                        var Size= parseInt(button.parentElement.parentElement.children[1].innerText);
                        <?php if(isset($_SESSION['taikhoan'])){ ?>
                            var TaiKhoan="<?php echo $_SESSION['taikhoan']?>";
                        <?php } ?>
                        console.log(MaSP+" "+Size+" "+TaiKhoan);
                        removeFromCart(MaSP,Size,TaiKhoan);
                        setQuantityCard();
                        creatToast("item-success","Xóa khỏi vỏ hàng thành công","fa-solid fa-circle-check","item-end-success");
                    }
                })
            });
        }
        function removeFromCart(MaSP,Size,TaiKhoan) {
            var cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Tìm chỉ mục của sản phẩm trong mảng cart
            var index = cart.findIndex(function(item) {
                return item['MaSP'] === MaSP && item['Size'] === Size && item['TaiKhoan'] === TaiKhoan;
            });
            if (index !== -1) {
                // Nếu tìm thấy sản phẩm trong giỏ hàng, xóa sản phẩm đó khỏi mảng
                cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                console.log("Sản phẩm đã được xóa khỏi giỏ hàng.");
            } else {
                console.log("Không tìm thấy sản phẩm trong giỏ hàng.");
            }
        }
        function setQuantityCard(){
            var cardQuanlity=document.querySelector('.header__action-cart-count').innerHTML=getCardUser().length;
        }
        function getCardUser(){
            var cartAll = JSON.parse(localStorage.getItem('cart')) || [];
            var cartUser=[];
            cartAll.forEach(item => {
                <?php if(isset($_SESSION['taikhoan'])){ ?>
                    if(item['TaiKhoan']=="<?php echo $_SESSION['taikhoan']; ?>"){
                        cartUser.push(item);
                    }
                <?php } ?>
            });
            return cartUser;
        }
        function checkPriceTotalNull(){
            var priceTotal=document.querySelector(".shell-priceTotal").textContent;
            if(priceTotal[0]=="0"){
                return true;
            }
            return false;
        }
        var btnCheckOut=document.querySelector(".shell-total-btn")
        btnCheckOut.addEventListener("click", function(){
            if(checkPriceTotalNull()){
                creatToast("item-error","Vui lòng chọn sản phẩm để thanh toán!","fa-solid fa-triangle-exclamation","item-end-error");
            }
            else{
                <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/ctsizesp-act.php');?>
                $.ajax({
                        url: 'control/ajax_action.php',
                        type: 'POST',
                        data: {
                            action: 'checkSoLuongTonKho',
                            products: JSON.stringify(getProductSelect()),                        
                        },
                        success: function(data){
                            if(data==0){// Sai
                                console.log(data);
                                creatToast("item-error","Số lượng sản phẩm trong kho không đủ!","fa-solid fa-triangle-exclamation","item-end-error");                                
                            }
                            else{
                                console.log(data);
                                window.location.href="index.php?danhmuc=checkout&checkout="+data;
                            }
                        }
                    });
                // var output="";
                // getProductSelect().forEach(cart =>{
                //     output+=cart.TaiKhoan +","+ cart.MaSP +"," + cart.Size +","+ cart.SoLuong + "/" ;
                //     $.ajax({
                //         url: 'control/ajax_action.php',
                //         type: 'POST',
                //         data: {
                //             action: 'checkSoLuongTonKho',
                //             listCart:getProductSelect()
                //         },
                //         success: function(data){
                //             if(cart.SoLuong > parseInt(data)){
                //                 creatToast("item-error","Số lượng sản phẩm trong kho không đủ!","fa-solid fa-triangle-exclamation","item-end-error");
                //                 flag = false;
                                
                //             }
                //         }
                //     });
                // });
                // console.log(output);
                // if(flag===true){
                //     console.log(flag);
                //     // window.location.href="index.php?danhmuc=checkout&checkout="+output;
                // }
            }
        });
    });
</script>
