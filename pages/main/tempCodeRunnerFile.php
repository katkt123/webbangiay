<?php
var listCart="<?php echo $_GET["checkout"]?>";
        var parts = listCart.split("/");
        parts.pop();

        $.ajax({
            url: "./control/ajax_action.php",
            method: "POST",
            data: {
                listCart: JSON.stringify(getCart(parts)),
                action: "showCheckout"
            },
            success: function(data){
                var shellTotal=document.querySelector(".shell-total-product").innerHTML=data;
                showPriceTotal("30,000₫");
            }
        });
        function getCardUser(){
            var cartAll = JSON.parse(localStorage.getItem('cart')) || [];
            var cartUser=[];
            cartAll.forEach(item => {
                if(item['TaiKhoan']=="<?php echo $_SESSION['taikhoan']; ?>"){
                    cartUser.push(item);
                }
            });
            return cartUser;
        }
        function getCart(listCart){
            var cartAll =getCardUser();
            var cart=[];
            cartAll.forEach(item => {
                listCart.forEach(elements => {
                    element=elements.split(",");
                    // console.log(element[1]+" "+element[2]+" "+element[3]);
                    if(item['MaSP']==element[1] && item['Size']==element[2] && item['SoLuong']==element[3]){
                    cart.push(item);
                }
                });
            });
            return cart;
        }
        function getPrice(){
            var getPrice=document.querySelectorAll(".shell-total-item-price");
            var total=0;
            getPrice.forEach(element =>{
                total+=vndToInteger(element.children[0].textContent);
            });
            return total;
        }
        function showPriceTotal(priceDelivery){
            var PriceTotal=document.querySelector(".shell-priceTotal");
            var Total=document.querySelector(".shell-priceTotal-total");
            PriceTotal.innerHTML=integerToVND(getPrice());
            console.log(priceDelivery);
            Total.innerHTML=integerToVND(vndToInteger(priceDelivery)+vndToInteger(PriceTotal.textContent));
        }
        console.log(getPrice());
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
        function vndToInteger(amount) {
            // Loại bỏ ký tự phân tách hàng nghìn và ký tự đơn vị tiền tệ
            amount = amount.replace(/,/g, '');
            amount = amount.replace('₫', '');
            
            // Chuyển chuỗi thành số nguyên
            var integerAmount = parseInt(amount, 10);
            
            return integerAmount;
        }
        var btnEdit=document.querySelector(".edit-address");
        btnEdit.addEventListener('click', function(){
            btnEdit.classList.toggle('edit-address--checked');
            var divEditAddress= document.querySelector(".div-pay-address");
            divEditAddress.classList.toggle("block");
        });

        
        var btnDelivery=document.querySelectorAll(".delivery_checkout");
        btnDelivery.forEach(element => {
            element.addEventListener('click', function(){   
                var price=element.querySelector("#delivery_checkout-price").textContent;
                var showPriceDelivery=document.querySelector(".shell-priceTotal-delivery");
                showPriceDelivery.textContent=price;
                showPriceTotal(price);
            });
        });
        // Đặt hàng
        var btnDatHang=document.querySelector(".shell-total-btn");
        btnDatHang.addEventListener('click', function(){
            var tongTienHang=vndToInteger(document.querySelector(".shell-priceTotal").textContent);
            var phiVanChuyen=vndToInteger(document.querySelector(".shell-priceTotal-delivery").textContent);
            var tongThanhToan=vndToInteger(document.querySelector(".shell-priceTotal-total").textContent);
            console.log(tongTienHang+" "+phiVanChuyen+" "+tongThanhToan);
            $.ajax({
                method:"POST",
                url:"./control/ajax_action.php",
                data:{
                    listCart: JSON.stringify(getCart(parts)),
                    tongTienHang: tongTienHang,
                    phiVanChuyen:phiVanChuyen,
                    tongThanhToan:tongThanhToan,
                    tenDangNhap: "<?php echo $_SESSION['taikhoan'] ?>",
                    action:"checkout"
                },
                success: function(data){
                    window.location.href = `index.php?danhmuc=paysucess`;
                }
            });
        });
        console.log(parts);