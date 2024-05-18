<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/sanpham-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/sanpham.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/nhanhieu-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/loaisp-act.php');


    $product= new SanPham(null,null,null,null,null,null,null,null,null,null,null,null,null);
    $product=getProduct($_GET['id']);
    $MaSP=$product->getMaSP();
    $TenSP=$product->getTenSP();        
    $SoSaoDanhGia=$product->getSoSaoDanhGia();
    $SoLuotDanhGia=$product->getSoLuotDanhGia();
    $MoTa=$product->getMoTa();
    $HinhAnh=$product->getHinhAnh();
    $SanPhamMoi=$product->getSanPhamMoi();
    $SanPhamHot=$product->getSanPhamHot();
    $GiaCu=$product->getGiaCu();
    $GiaMoi=$product->getGiaMoi();
    $SoLuongDaBan=$product->getSoLuongDaBan();
    $MaNhanHieu=$product->getMaNhanHieu();
    $MaLoai=$product->getMaLoai();

    //Kiểm tra hàng có còn tromg kho không, còn thì trả về trua, hết thì false
    function kiemTraKho($MaSP,$SizeSP){
        global $connect;
        $sql_kiemTraKho= "SELECT sanpham.MaSP, ctsizesp.SizeSP,ctsizesp.SoLuong FROM sanpham INNER JOIN ctsizesp ON ctsizesp.MaSP = sanpham.MaSP WHERE sanpham.MaSP = '" . $MaSP . "' AND ctsizesp.SizeSP ='" . $SizeSP . "' ";
        $result_kiemTraKho=mysqli_query($connect,$sql_kiemTraKho);
        $product_kiemTraKho=mysqli_fetch_array($result_kiemTraKho);
        if($product_kiemTraKho && $product_kiemTraKho['SoLuong']>0){
            return True;
        }
        else{
            return False;
        }
    }
?>
<main style="position: relative;">
    <div class="notification">
    </div>
    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-main">
                <span>
                    Home
                </span>
                <i class="breadcrumb-icon fa-solid fa-chevron-right"></i>
                <a href="index.php?danhmuc=products" style="color: #807e7e;">
                    Products
                </a>
                <i class="breadcrumb-icon fa-solid fa-chevron-right"></i>
                <span class="breadcrumb-detail">
                    <a style="color: #807e7e;" href="index.php?danhmuc=products&nhanhieu=<?php echo getTenNhanHieu($MaNhanHieu)?>">
                    <?php echo getTenNhanHieu($MaNhanHieu)?>
                    </a>
                </span>
                <i class="breadcrumb-icon fa-solid fa-chevron-right"></i>

                <span class="breadcrumb-detail">
                    <?php echo $TenSP ?>
                </span>
            </div>
        </div>
    </section>
    <section class="detail">
        <div class="container">
            <div class="detail-main">
                <div class="detail-show">
                    <ul class="detail-show__slick">
                        <li class="detail-show__item">
                            <img src="./assets/img/<?php echo $HinhAnh ?>" alt="" class="">
                        </li>
                       <?php
                            require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/hinhanh-act.php');
                            echo showListAnh($MaSP);
                            // echo $HinhAnh;
                        ?>
                        <!-- <li class="detail-show__item ">
                            <img src="./assets/img/pd-21,2.webp" alt="" class="">
                        </li> -->
                    </ul>
                    <div class="detail-show__image">
                        <img src="./assets/img/<?php echo $HinhAnh ?>" alt="" class="">
                        <div class="detail-show__image-slick">
                            <i class="detail-show__image-slick-btn fa-solid fa-angle-left"></i>
                            <i class="detail-show__image-slick-btn fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                </div>
                <div class="detail-content">
                    <div class="detail-content-product">
                        <h3 class="detail-content__title" style="font-size: 25px; margin-bottom: 10px;">
                            <?php echo $TenSP ?>
                        </h3>
                        <div class="detail-content__tag">
                            <ul class="detail-content__tag-list">
                                <?php 
                                    showNhanHieuProductDetail($_GET['id']);
                                    showLoaiProductDetail($_GET['id']);
                                ?>
                            </ul>
                        </div>
                        <div class="detail-content__rate-review-sold">
                            <div class="detail-content__rate">
                                <span>
                                    <i class="detail-content__rate-icon fa-solid fa-star"></i>
                                </span>
                                <span>
                                    <i class="detail-content__rate-icon fa-solid fa-star"></i>
                                </span>
                                <span>
                                    <i class="detail-content__rate-icon fa-solid fa-star"></i>
                                </span>
                                <span>
                                    <i class="detail-content__rate-icon fa-solid fa-star"></i>
                                </span>
                                <span>
                                    <i class="detail-content__rate-icon fa-solid fa-star"></i>
                                </span>

                        
                            </div>
                            <div class="detail-content__review">
                                <span>
                                    <?php echo $SoLuotDanhGia ?>
                                </span> 
                                Đánh giá
                            </div>
                            <div class="detail-content__sold">
                                <span>
                                    <?php echo $SoLuongDaBan ?>
                                </span> 
                                Đã bán
                            </div>
                        </div>
                        <div class="detail-content__price">
                            <div class="detail-content__price-sale">
                                <i  class="detail-content__price-icon fa-sharp fa-regular fa-badge-percent"></i>
                                <i>
                                    20%
                                </i>
                            </div>
                            <span><del>
                                <?php echo formatCurrency($GiaCu) ?>
                            </del></span>  
                            <span>
                                <?php echo formatCurrency($GiaMoi) ?>
                            </span>
                        </div>
                        <div class="detail-content__size">
                            <div class="titleSize">
                                <h4>Size</h4>
                                <div class="size-warning">
                                    <i class="fa-solid fa-exclamation-circle"></i>
                                    <p>Vui lòng chọn size</p>
                                </div>
                            </div>
                            <ul class="detail-content__size-list">
                                <!-- Hiển thị size sản phẩm -->
                                <?php 
                                    $sql_sizeSp= "SELECT * FROM `sizesp` where `hide`=1 ";
                                    $result_sizeSp=mysqli_query($connect,$sql_sizeSp);
                                    // $product_sizeSp=mysqli_fetch_array($result_sizeSp);
                                    while($product_sizeSp=mysqli_fetch_array($result_sizeSp)){
                                        if(kiemTraKho($MaSP,$product_sizeSp['SizeSP'])){?>
                                            <li class="detail-content__size-item"><?php echo $product_sizeSp['SizeSP'] ?></li>
                                        <?php }
                                        else{ ?>
                                            <li class="detail-content__size-item detail-content__size-item--disable"><?php echo $product_sizeSp['SizeSP'] ?></li>
                                        <?php } 
                                } ?>                                
                            </ul>
                        </div>
                        <div class="detail-content__quanlity">
                            <div class="detail-content__title" style="padding-bottom: 10px; margin: 0;">
                                <h4 style="font-size: 20px;">Số lượng</h4>
                                <div class="detail-content__instock">
                                    Còn lại: <span class="detail-content__instock-value">1000</span>
                                </div>
                                <div class="stock-warning">
                                    <i class="fa-solid fa-exclamation-circle"></i>
                                    <p>Số lượng trong kho không đủ</p>
                                </div>
                            </div>
                            <div class="detail-content__count">
                                <input type="number" id="quantity" value="1">
                                <div class="detail-content__count--quanlity">
                                    <button onclick="increaseQuantity()">
                                        <i class="fa-solid fa-caret-up"></i>
                                    </button>
                                    <button onclick="decreaseQuantity()">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-button">
                            <!-- <div  class="detail-btn__buy card-btn">Thêm vào vỏ hàng 
                            <i  style="margin-left: 10px;" class="fa-regular fa-bag-shopping"></i>
                            </div> -->
                            <button class="detail-btn__cart card-btn ">
                            Thêm vào vỏ hàng 
                                <i class=" fa-regular fa-basket-shopping-simple"></i>
                            </button>
                            <button class="detail-btn__like card-btn">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="detail-content-shop">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="describe">
        <div class="container">
            <div class="describe-main">
                <div class="describe-title">
                    <img class="describe-title_bg" src="./assets/img/higtline.png" alt="">
                    <h3>Mô tả</h3>
                </div>
                <div class="describe-detail">
                    <!-- <h4>
                        LEGENDARY STYLE REFINED.
                    </h4>
                    <p>
                        The radiance lives on in the Nike Air Force 1 '07, the b-ball icon that puts a fresh spin on what you know best: crisp leather, bold colours and the perfect amount of flash to make you shine.
                    </p>
                    <h5>
                        Benefits
                    </h5>
                    <ul>
                        <li>
                            The stitched leather overlays on the upper add heritage style, durability and support.
                        </li>
                        <li>
                            The  leather overlays on the upper add heritage style, durability and support.
                        </li>
                        <li>
                            The stitched leather overlays on the upper add heritage style, durability and support.

                        </li>
                        <li>
                            The stitched leather overlays on the upper add heritage style, durability and support.
                        </li>
                    </ul>
                    <h5>
                        Product Details
                    </h5>
                    <ul>
                        <li>
                            Foam midsole
                        </li>
                        <li>
                            Perforations on the toe
                        </li>
                        <li>
                            Colour Shown: White/Jade Ice
                        </li>
                        <li>
                            Style: DD8959-113
                        </li>
                        <li>
                            Country/Region of Origin: Vietnam
                        </li>
                    </ul>
                    <h5>
                        Air Force 1 Origins
                    </h5>
                    <p>
                        Debuting in 1982, the AF-1 was the first basketball shoe to house Nike Air, revolutionising the game while rapidly gaining traction around the world. Today, the Air Force 1 stays true to its roots with the same soft and springy cushioning that changed sneaker history.
                    </p>
         -->    
                    <?php
                        echo $MoTa;
                    ?>
                </div>
                <ul class="describe__menu">
                    <li class="describe__menu-sub describe__menu-sub_reviews describe--primary">
                        Đánh giá
                    </li>
                    <li class="describe__menu-sub describe__menu-sub_size">
                        Size & Fit
                    </li>
                </ul>
                <div class="describe-reviews describe-select ">
                    <div class="describe-reviews_total-detail">
                        <div class="reviews_total-average">
                            <div class="reviews_total-number">
                                <div class="reviews_total-number-number">4.9</div>
                                <div class="reviews_total-star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <span class="reviews_total-turn">
                                    999 rating
                                </span>
                            </div>
                            <div class="reviews_total-rate">
                                <div class="reviews_total-rate-item">
                                    <span class="reviews_total-rate-number">5</span>
                                    <div class="reviews_total-rate-full">
                                        <div class="reviews_total-rate-box"></div>
                                    </div>
                                </div>
                                <div class="reviews_total-rate-item">
                                    <span class="reviews_total-rate-number">4</span>
                                    <div class="reviews_total-rate-full">
                                        <div class="reviews_total-rate-box"></div>
                                    </div>
                                </div>
                                <div class="reviews_total-rate-item">
                                    <span class="reviews_total-rate-number">3</span>
                                    <div class="reviews_total-rate-full">
                                        <div class="reviews_total-rate-box"></div>
                                    </div>
                                </div>
                                <div class="reviews_total-rate-item">
                                    <span class="reviews_total-rate-number">2</span>
                                    <div class="reviews_total-rate-full">
                                        <div class="reviews_total-rate-box"></div>
                                    </div>
                                </div>
                                <div class="reviews_total-rate-item">
                                    <span class="reviews_total-rate-number">1</span>
                                    <div class="reviews_total-rate-full">
                                        <div class="reviews_total-rate-box"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="describe-reviews_detail">
                            <!-- <div class="describe-reviews_detail-filter">
                                <div class="reviews_detail-filter_item reviews_detail-filter_item--select">
                                    All
                                </div>
                                <div class="reviews_detail-filter_item">
                                    <i class="fa-solid fa-star"></i>
                                    Pictrure
                                </div>
                                <div class="reviews_detail-filter_item">
                                    <i class="fa-solid fa-star"></i>
                                    1
                                </div>
                                <div class="reviews_detail-filter_item">
                                    <i class="fa-solid fa-star"></i>
                                    2
                                </div>
                                <div class="reviews_detail-filter_item">
                                    <i class="fa-solid fa-star"></i>
                                    3
                                </div>
                                <div class="reviews_detail-filter_item">
                                    <i class="fa-solid fa-star"></i>
                                    4
                                </div>
                                <div class="reviews_detail-filter_item">
                                    <i class="fa-solid fa-star"></i>
                                    5
                                </div>
                            </div> -->
                            <?php
                            if(isset($_SESSION['taikhoan'])){
                                require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/ctpx-act.php');
                                require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/user-act.php');
                                require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/danhgia-act.php');
                                $MaKH=intval(getUserId($_SESSION['taikhoan']));
                                $MaSP=$_GET['id'];
                                if(checkSanPhamInPhieuXuat(implode(',', getMaPhieuXuatListFromMaKH($MaKH)),$MaSP) && checkDanhGiaExists($MaSP,$MaKH)==false){?>
                                    <div class="review">
                                        <h2 style="font-size: 20px;" >Đánh giá</h2>
                                        <div class="stars">
                                            <input class="star star-5" id="star-5" type="radio" name="star"/>
                                            <label class="star star-5" for="star-5"></label>
                                            <input class="star star-4" id="star-4" type="radio" name="star"/>
                                            <label class="star star-4" for="star-4"></label>
                                            <input class="star star-3" id="star-3" type="radio" name="star"/>
                                            <label class="star star-3" for="star-3"></label>
                                            <input class="star star-2" id="star-2" type="radio" name="star"/>
                                            <label class="star star-2" for="star-2"></label>
                                            <input class="star star-1" id="star-1" type="radio" name="star"/>
                                            <label class="star star-1" for="star-1"></label>
                                        </div>
                                        <div class="review-content">
                                            <textarea name="review" id="review" placeholder="Viết đánh giá của bạn..."></textarea>
                                        </div>
                                        <button class="btn-review">Gửi</button>
                                    </div>
                                <?php } 
                            }?>  
                            <div class="describe-reviews_detail-list">
                                <!-- <div class="describe-reviews_detail-item">
                                    <div class="describe-reviews_detail-info">
                                        <div class="describe-reviews_detail-avt">
                                            <img src="./assets//img/rating.jpg" alt="" class="">
                                            <div class="describe-reviews_detail-name_type">
                                                <div class="describe-reviews_detail-name">Elonmusk</div>
                                                <div class="describe-reviews_detail-star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="describe-reviews_detail-time">
                                            20 hours ago
                                        </div>
                                    </div>
                                    <div class="describe-reviews_detail-rating">
                                        <div class="describe-reviews_detail-cmt">
                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis culpa ipsum repudiandae magni labore perspiciatis ex consectetur cumque mollitia. Temporibus perspiciatis ratione ad a, nobis nisi obcaecati autem minus facere.
                                        </div>
                                    </div>
                                </div>   -->
                                <?php
                                    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/danhgia-act.php');
                                    showAllReview($_GET['id']);

                                ?>
                                <!-- <div class="describe-reviews_detail-item">
                                    <div class="describe-reviews_detail-info">
                                        <div class="describe-reviews_detail-avt">
                                            <img src="./assets//img/rating.jpg" alt="" class="">
                                            <div class="describe-reviews_detail-name_type">
                                                <div class="describe-reviews_detail-name">Elonmusk</div>
                                                <div class="describe-reviews_detail-type">
                                                    <div class="describe-reviews_detail-size">Size: 40</div>
                                                    <div class="describe-reviews_detail-color">Color: Red</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="describe-reviews_detail-time">
                                            20 hours ago
                                        </div>
                                    </div>
                                    <div class="describe-reviews_detail-rating">
                                        <div class="describe-reviews_detail-star">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="describe-reviews_detail-title">
                                            Sản phẩm rất tốt
                                        </div>
                                        <div class="describe-reviews_detail-cmt">
                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis culpa ipsum repudiandae magni labore perspiciatis ex consectetur cumque mollitia. Temporibus perspiciatis ratione ad a, nobis nisi obcaecati autem minus facere.
                                        </div>
                                    </div>
                                    <div class="describe-reviews_detail-like">
                                        <i class="fa-solid fa-thumbs-up"></i>
                                        <span>Hữu ích</span>
                                    </div>
                                </div>   -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="describe-size describe-select none">
                    <img src="./assets/img/size_fit.png" alt="">
                </div>

            </div>
        </div>
    </section>
    <section class="relate">
        <div class="container">
            <div class="relate-main">
                <div class="relate__title-slick">
                    <span class="relate__title title">
                        SAME
                        <a href="">SẢN PHẨM TƯƠNG TỰ</a>
                    </span>

                </div>
                <div class="relate__list">
                    <?php
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/sanpham-act.php');
                        echo showListProductStringTuongTu(getListProductFromNhanHieu($_GET['id']));
                    ?>
                </div>
            </div>
        </div>
    </section>
    <section class=" none recent">
        <div class="container">
            <div class="recent-main">
                <div class="recent__title-slick">
                    <span class="recent__title title">
                        VIEW
                        <a href="">XEM GẦN ĐÂY</a>
                    </span>
                    <!-- <div class="recent__slick btn-slick">
                        <i class="btn-slick__left fa-solid fa-angle-left"></i>
                        <i class="btn-slick__right fa-solid fa-angle-right"></i>
                    </div> -->
                </div>
                <div class="recent__list">
                    <?php
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/sanpham-act.php');
                        $productIds = array(1, 2, 3, 4, 5,6);
                        echo showListProductString(getListProductFromArr($productIds));
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- <script src="index.js">
    
</script> -->
<script>
    $(document).ready(function(){
        var btnAddWish=document.querySelector(".detail-btn__like");
        btnAddWish.addEventListener('click',function(){
            console.log("aaaaaa")
            <?php if(isset($_SESSION['taikhoan'])){ ?>
                $.ajax({
                    url: "./control/ajax_action.php",
                    method: "POST",
                    data: {
                        action: "themvaoyeuthich"
                    },
                    success: function(data){
                        creatToast("item-success","Thêm vào yêu thích thành công !","fa-solid fa-circle-check","item-end-success");
                        var maSP=parseInt(<?php echo $_GET['id'] ?>);
                        var taikhoan="<?php echo $_SESSION['taikhoan'] ?>";
                        var object={
                            maSP: maSP,
                            taikhoan:taikhoan
                        }
                        console.log(object);
                        addToWish(object);
                    }
                });
            <?php } 
            else{ ?>
                creatToast("item-warning","Vui lòng đăng nhập!","fa-solid fa-circle-exclamation","item-end-warning");
            <?php } ?>
        })
        var btnAddCart=document.querySelector(".detail-btn__cart");
        btnAddCart.addEventListener('click',function(){
            <?php if(isset($_SESSION['taikhoan'])){ ?>
                if(getSize()==0){// chưa chọn size
                    var sizeWarning=document.querySelector(".size-warning");
                    sizeWarning.style.opacity=1;
                }
                else{   //đã chọn size
                    $.ajax({
                        url: "./control/ajax_action.php",
                        method: "POST",
                        data: {
                            MaSP: parseInt(<?php echo $MaSP ?>),
                            SizeSP: getSize(),
                            SoLuong: getQuantity(),
                            action: "themVaoGioHang"
                        },
                        success: function(data){//Nếu = 0 thì số luog trong kho không đủ
                            if(data==0){
                                var stock=document.querySelector(".stock-warning");
                                stock.style.opacity=1;
                            }
                            else{ //Nếu = 1 thì thêm vào giỏ hàng thành công
                                // creatToast("item-success","Thêm vào vỏ hàng thành công !","fa-solid fa-circle-check","item-end-success");
                                async function showAlert() {
                                    await Swal.fire({
                                        icon: 'success',
                                        title: 'Thành công',
                                        text: 'Thêm sản phẩm vào vỏ hàng thành công!',
                                        timer: 2000
                                    });

                                }
                                showAlert();
                                if(data>0){
                                    var product = { TaiKhoan: "<?php echo $_SESSION['taikhoan'] ?>",MaSP: <?php echo $MaSP ?>, Size: getSize(), SoLuong: getQuantity()};
                                    // Thêm sản phẩm vào giỏ hàng
                                    addToCart(product);
                                    setQuantityCard();
                                    // showCartUser();
                                }
                            }
                        }
                    });
                }
            <?php } 
            else{ ?>
                creatToast("item-warning","Vui lòng đăng nhập!","fa-solid fa-circle-exclamation","item-end-warning");
            <?php } ?>
        })
        function addToCart(product) {
            var cart = JSON.parse(localStorage.getItem('cart')) || [];
            var found = false;

            cart.forEach(element => {
                if (element['MaSP'] == product['MaSP'] && element['Size'] == product['Size'] && element['TaiKhoan'] == product['TaiKhoan']) {
                    element['SoLuong'] += product['SoLuong'];
                    found = true;
                    return;
                }
            });

            if (!found) {
                cart.push(product);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
        }
        function addToWish(object) {
            var wish = JSON.parse(localStorage.getItem('wish')) || [];
            var found = false;

            wish.forEach(element => {
                if (element['taikhoan'] == object['taikhoan'] && element['maSP'] == object['maSP']) {
                    found = true;
                    return;
                }
            });

            if (!found) {
                wish.push(object);
            }

            localStorage.setItem('wish', JSON.stringify(wish));
        }

        function getSize(){
            var valueSize=0;
            var size=document.querySelectorAll(".detail-content__size-item");
            size.forEach(element => {
                if(element.classList.contains("detail-content__size-item--select")){
                    valueSize=element.textContent;
                }
            });
            return parseInt(valueSize);
        }
        function getQuantity(){
            return parseInt(document.querySelector("#quantity").value);
        }
        var selectSize=document.querySelectorAll(".detail-content__size-item");
        selectSize.forEach(element=>{
            element.addEventListener('click',function(){
                var sizeWarning=document.querySelector(".size-warning");
                sizeWarning.style.opacity=0;
                var stock=document.querySelector(".detail-content__instock");
                stock.style.display="block";
                $.ajax({
                    url: "./control/ajax_action.php",
                    method: "POST",
                    data: {
                        MaSP: parseInt(<?php echo $MaSP ?>),
                        SizeSP: parseInt(element.textContent),
                        action: "kiemTraKho"
                    },
                    success: function(data){
                        var valueStock=document.querySelector(".detail-content__instock-value");
                        valueStock.textContent=data;
                    }
                });
            });
        });
        var inputQuantity=document.querySelector("#quantity");
        inputQuantity.addEventListener('change',function(){
            var stock=document.querySelector(".stock-warning");
            stock.style.opacity=0;
            if(inputQuantity.value<0) inputQuantity.value=1;
        });
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
        function showCartUser(){
            var cartUser=reverseCartUser();
            var cartUserSlice=cartUser.slice(0,5);
            var list = document.querySelector(".header__action-cart-list");
            var listProduct=[];
            $.ajax({
                url:"./control/ajax_action.php",
                method: "POST",
                data:{
                    action: "getListProductFromCart",
                    cart: JSON.stringify(cartUserSlice)
                },
                success: function(data){
                    listProduct=JSON.parse(data);
                    showCardVuaThem(listProduct);
                }
            })
            function showCardVuaThem(listProduct){
                listProduct.forEach(product => {
                    console.log(product);
                    var li = document.createElement("li");
                    li.classList.add("header__action-cart-item");
                    li.innerHTML = `
                        <div class="header__action-img">
                            <img src="./assets/img/`+product.HinhAnh+`" alt="">
                        </div>
                        <div class="header__action-cart-detail">
                            <div class="header__action-cart-name">
                                <span>`+product.TenSP+`</span>
                                <div>`+product.GiaMoi+`</div>
                            </div>
                            <div class="header__action-cart-amount">
                                <div class="header__action-cart-number">SL: `+product.SoLuong+`</div>
                                <div class="header__action-cart-size_color">
                                    <div class="header__action-cart-size">Size: `+product.Size+` </div>
                                    <div class="header__action-cart-color"></div>
                                </div>
                            </div>
                        </div>
                    `;
                    list.appendChild(li);
                });
            }

        
        }
        function getIdFromUrl(url) {
            // Tách chuỗi URL bằng dấu "&"
            var params = url.split('&');
            // Lặp qua từng phần tử của mảng params
            for (var i = 0; i < params.length; i++) {
                // Tách từng cặp key=value bằng dấu "="
                var keyValue = params[i].split('=');
                // Kiểm tra nếu key là "id"
                if (keyValue[0] === 'id') {
                    // Trả về giá trị của key "id"
                    return keyValue[1];
                }
            }
            // Nếu không tìm thấy key "id", trả về null
            return null;
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
        var likes = document.querySelectorAll(".card-btn__like");
        likes.forEach(like => {
            like.addEventListener('click', function(event) {
                var parentLink = like.closest('a');
                var href = parentLink.getAttribute('href'); 
                event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
                event.stopPropagation(); // Ngăn chặn sự lan truyền của sự kiện
                <?php if(isset($_SESSION['taikhoan'])){ ?>
                    if (like.classList.contains("fa-regular")) {
                        like.classList.remove("fa-regular");
                        like.classList.add("fa-solid");
                        like.style.color = "#F02757";
                        console.log(getIdFromUrl(href));
                        $.ajax({
                            url: "./control/ajax_action.php",
                            method: "POST",
                            data: {
                                action: "themvaoyeuthich"
                            },
                            success: function(data){
                                var maSP=parseInt(getIdFromUrl(href));
                                var taikhoan="<?php echo $_SESSION['taikhoan'] ?>";
                                var object={
                                    maSP: maSP,
                                    taikhoan:taikhoan
                                }
                                console.log(object);
                                addToWish(object);
                            }
                        });
                    } else {
                        // Xóa trái tim trên giao diện
                        like.classList.remove("fa-solid");
                        like.classList.add("fa-regular");
                        like.style.color = "";
                        //Xóa khỏi danh sách
                        var MaSP=parseInt(getIdFromUrl(href));
                        var TaiKhoan="<?php echo $_SESSION['taikhoan']?>";
                        console.log(MaSP+" "+TaiKhoan);
                        removeFromWish(MaSP,TaiKhoan);
                    }
                <?php } 
                else{ ?>
                    creatToast("item-warning","Vui lòng đăng nhập!","fa-solid fa-circle-exclamation","item-end-warning");
                <?php } ?>
            }); 
        });
        function showLikes(){
            $.ajax({
                url: "./control/ajax_action.php",
                method: "POST",
                data: {
                    action: "themvaoyeuthich"
                },
                success: function(data){
                    var cards=document.querySelectorAll(".card");
                    cards.forEach(card => {
                        href=card.closest('a').getAttribute('href');
                        var MaSP=parseInt(getIdFromUrl(href));
                        var wish = JSON.parse(localStorage.getItem('wish')) || [];
                        wish.forEach(element => {
                            <?php if(isset($_SESSION['taikhoan'])){ ?>
                                if (element['taikhoan'] == "<?php echo $_SESSION['taikhoan']?>" && element['maSP'] == MaSP) {
                                    var like = card.querySelector(".card-btn__like");
                                    like.classList.remove("fa-regular");
                                    like.classList.add("fa-solid");
                                    like.style.color = "#F02757";
                                }
                            <?php } ?>
                        });
                    });
                }
            });
        }
        showLikes();

        function convertStringToImageArray(imageString) {
            if (typeof imageString !== 'string' || imageString.trim().length === 0) {
                return []; 
            }
            const newStr = imageString.slice(0, -1); // Loại bỏ phần tử cuối cùng ("!")
            const imageNames = newStr.split('|');
            const trimmedImageNames = imageNames.map(imageName => imageName.trim());
            return trimmedImageNames;
        }

        //slick product-detial
        var next=document.querySelector(".detail-show__image-slick i:nth-child(2)");
        var back=document.querySelector(".detail-show__image-slick i:nth-child(1)");

        var hero=document.querySelector(".detail-show__image img");
        var list_img=document.querySelectorAll(".detail-show__item");

        // var arr_img=["pd-21.png","pd-21,6.webp","pd-21,5.webp","pd-21,4.webp","pd-21,3.webp","pd-21,2.webp","pd-21,1.jpg"]
        var imageArray="<?php echo $HinhAnh."|".getListAnh($MaSP) ?>";
        var arr_img = convertStringToImageArray(imageArray);
        console.log(arr_img);
        function removeBorder(){
            list_img.forEach(element => {
                element.classList.remove("select-product-detail");
            });
        }
        var curentIndex=0;
        list_img[0].classList.add("select-product-detail")
        list_img.forEach((element,index) => {
            element.addEventListener('click',function(){
                removeBorder();
                // console.log(curentIndex);
                console.log(index);
                hero.src="./assets/img/"+arr_img[index]; // trong 1 lớp có nhiều lớp con nên phải lấy ra phần tử đầu tiên
                curentIndex=index;
                element.classList.add("select-product-detail");
            })
        });
        
        next.addEventListener('click',function(){
            removeBorder();
            console.log(curentIndex);
            if(curentIndex===arr_img.length-1){
                curentIndex=0;
                hero.src=list_img[0].children[0].src;
                list_img[curentIndex].classList.add("select-product-detail");
            }
            else{
                hero.src=list_img[curentIndex+1].children[0].src;
                list_img[curentIndex+1].classList.add("select-product-detail");
                curentIndex++;
            }
        });

        back.addEventListener('click',function(){
            removeBorder();
            if(curentIndex===0){
                curentIndex=arr_img.length-1;
                hero.src=list_img[arr_img.length-1].children[0].src;
                list_img[arr_img.length-1].classList.add("select-product-detail");
            }
            else{
                hero.src=list_img[curentIndex-1].children[0].src;
                list_img[curentIndex-1].classList.add("select-product-detail");
                curentIndex--;
            }
        });
                        

        <?php if(isset($_SESSION['taikhoan']) && checkSanPhamInPhieuXuat(implode(',', getMaPhieuXuatListFromMaKH($MaKH)),$MaSP) && checkDanhGiaExists($MaSP,$MaKH)==false){ ?>
            var btnReview=document.querySelector(".btn-review");
            btnReview.addEventListener('click',function(){
                if(getNumberStar()!=null){
                    if(getReviewContent()!=''){
                        $.ajax({
                            url: "./control/ajax_action.php",
                            method: "POST",
                            data: {
                                reviewContent:getReviewContent(),
                                star: getNumberStar(),
                                size: 40,
                                tenDangNhap: "<?php echo $_SESSION['taikhoan']?>",
                                maSP: <?php echo $_GET['id']?>,
                                action: "review"
                            },
                            success: function(data){
                                var newDiv = document.createElement("div");
                                newDiv.innerHTML = data;
                                document.querySelector(".describe-reviews_detail-list").insertAdjacentElement("afterbegin",newDiv);
                                async function showAlert() {
                                    await Swal.fire({
                                        icon: 'success',
                                        title: 'Thành công',
                                        text: 'Đánh giá sản phẩm thành công!',
                                        timer: 2000
                                    });

                                }
                                showAlert();
                                var formReview=document.querySelector('.review').style.display='none';
                            }
                        });
                    }
                    else{
                        creatToast("item-warning","Vui lòng nhập nội dung để đánh giá!","fa-solid fa-circle-exclamation","item-end-warning");
                    }
                }
                else{
                    creatToast("item-warning","Vui chọn sao để đánh giá!","fa-solid fa-circle-exclamation","item-end-warning");
                }
            });
        <?php } ?>

        function getReviewContent(){
            var reviewContent=document.getElementById('review');
            return reviewContent.value;
        }
        function getNumberStar(){
            const stars = document.querySelectorAll('.stars input');
            let selectedRating = null;
            for (let i = 0; i < stars.length; i++) {
                if (stars[i].checked) {
                    selectedRating = stars[i].id.split('-')[1];
                    break;
                }
            }
            return selectedRating;
        }
    });
    
</script>
<!-- <script>
    function priceNew(priceOld,sale){
        var priceAfterSale = priceOld - (priceOld * sale / 100);
        return priceAfterSale.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    }
    function insertSize(size){
        var listSize=document.querySelector(".detail-content__size-list");
        var newLi=document.createElement("li");
        newLi.classList.add("detail-content__size-item");
        newLi.textContent=size;
        listSize.appendChild(newLi);
    }
    function addSize(listSize){
        var arrSize=listSize.split(",");
        arrSize.forEach(element =>{
            insertSize(element);
        });
    }
    function insertColor(color){
        var listColor=document.querySelector(".detail-content__color-list");
        var newLi=document.createElement("li");
        newLi.classList.add("detail-content__color-item");
        switch(color){
            case "black":
                newLi.classList.add("bg-black");
                break;
            case "white":
                newLi.classList.add("bg-white");
                break;
            case "blue":
                newLi.classList.add("bg-blue");
                break;
            case "yellow":
                newLi.classList.add("bg-yellow");
                break;
            case "green":
                newLi.classList.add("bg-green");
                break;
            case "red":
                newLi.classList.add("bg-red");
                break;
        }
        listColor.appendChild(newLi);
    }
    function addColor(listColor){
        var arrColor=listColor.split(",");
        arrColor.forEach(element =>{
            insertColor(element);
        });
    }
    function rate(rate){
        var rateNumber=document.querySelector(".detail-content__rate span");
        rateNumber.textContent=rate;
        var rateStar=document.querySelectorAll(".detail-content__rate-icon");
        switch(rate){
            case 1:
                rateStar[0].classList.add("cl-orange");
                break;
            case 2:
                rateStar[0].classList.add("cl-orange");
                rateStar[1].classList.add("cl-orange");
                break;
            case 3:
                rateStar[0].classList.add("cl-orange");
                rateStar[1].classList.add("cl-orange");
                rateStar[2].classList.add("cl-orange");
                break;
            case 4:
                rateStar[0].classList.add("cl-orange");
                rateStar[1].classList.add("cl-orange");
                rateStar[2].classList.add("cl-orange");
                rateStar[3].classList.add("cl-orange");
                break;
            case 5:
                rateStar[0].classList.add("cl-orange");
                rateStar[1].classList.add("cl-orange");
                rateStar[2].classList.add("cl-orange");
                rateStar[3].classList.add("cl-orange");
                rateStar[4].classList.add("cl-orange");
                break;
        }

    }
    function imgList(imgList){
        var listSlick=imgList.split(";");
        listSlick.forEach(element => {
            var newLi=document.createElement("li");
            newLi.classList.add("detail-show__item");
            var html=`
                <img src="./assets/img/`+element+`" alt="" class="">
            `
            newLi.innerHTML=html;
            document.querySelector(".detail-show__slick").appendChild(newLi);
        });
    }
    window.onload = function() {
        // Lấy thông tin sản phẩm từ query parameters
        const urlParams = new URLSearchParams(window.location.search);
        const ob = urlParams.get("ob");
        var object=JSON.parse(ob);
        document.querySelector(".detail-content__title").textContent=object.title;
        document.querySelector(".detail-show__image img").src="./assets/img/"+object.img;
        document.querySelector(".detail-content__review span").textContent=object.reviews;
        document.querySelector(".detail-content__sold span").textContent=object.sold;
        document.querySelector(".detail-content__price-sale i:last-child").textContent=object.sale+"%";
        document.querySelector(".detail-content__price span:nth-child(2) del").textContent=object.price_old.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })
        document.querySelector(".detail-content__price span:nth-child(3)").textContent=priceNew(object.price_old,object.sale);
        addSize(object.size);
        addColor(object.color)
        rate(object.rate);
        imgList(object.list_img);



        //slick product-detial
        var next=document.querySelector(".detail-show__image-slick i:nth-child(2)");
        var back=document.querySelector(".detail-show__image-slick i:nth-child(1)");

        var hero=document.querySelector(".detail-show__image img");
        var list_img=document.querySelectorAll(".detail-show__item");

        var arr_img=object.list_img.split(";");

        function removeBorder(){
            list_img.forEach(element => {
                element.classList.remove("select-product-detail");
            });
        }


        var curentIndex=0;
        list_img[0].classList.add("select-product-detail")
        list_img.forEach((element,index) => {
            element.addEventListener('click',function(){
                removeBorder();
                hero.src="./assets/img/"+arr_img[index]; // trong 1 lớp có nhiều lớp con nên phải lấy ra phần tử đầu tiên
                curentIndex=index;
                element.classList.add("select-product-detail");
            })
        });
        
        next.addEventListener('click',function(){
            removeBorder();
            console.log(curentIndex);
            if(curentIndex===arr_img.length-1){
                curentIndex=0;
                hero.src=list_img[0].children[0].src;
                list_img[curentIndex].classList.add("select-product-detail");
            }
            else{
                hero.src=list_img[curentIndex+1].children[0].src;
                list_img[curentIndex+1].classList.add("select-product-detail");
                curentIndex++;
            }
        });

        back.addEventListener('click',function(){
            removeBorder();
            if(curentIndex===0){
                curentIndex=arr_img.length-1;
                hero.src=list_img[arr_img.length-1].children[0].src;
                list_img[arr_img.length-1].classList.add("select-product-detail");
            }
            else{
                hero.src=list_img[curentIndex-1].children[0].src;
                list_img[curentIndex-1].classList.add("select-product-detail");
                curentIndex--;
            }
        });
        function removeSelectSize(){
            var selectSize=document.querySelectorAll(".detail-content__size-item");
            selectSize.forEach(element=>{
                element.classList.remove("detail-content__size-item--select");

            });
        }
        var selectSize=document.querySelectorAll(".detail-content__size-item");
        selectSize.forEach(element=>{
            element.addEventListener('click',function(){
                if(element.classList.contains("detail-content__size-item--disable")==false){
                    removeSelectSize();
                    element.classList.add("detail-content__size-item--select");   
                }
            });
        });

        //breadcrumb-detail
        document.querySelector(".breadcrumb-detail").textContent=object.title;


    };
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

console.log($$(".page-item"));
$$(".page-item").forEach(element => {
    element.addEventListener('click', function() {
        removeClasslist($$(".page-item"), "page-item--select");
        element.classList.add("page-item--select");
    });
});

$$(".reviews_detail-filter_item").forEach(element => {
    element.addEventListener('click', function() {
        removeClasslist($$(".reviews_detail-filter_item"), "reviews_detail-filter_item--select");
        element.classList.add("reviews_detail-filter_item--select");
    });
});

// $(".detail-content__count-minus").addEventListener('click', function(){
//   console.log($(".detail-content__count-number").innerHTML);
// });



//-------------------------------------SHELL
//check box
function selectShell() {
    console.log("?")
    $$(".shell-check_box").forEach(element => {
        element.addEventListener('click', function() {
            console.log("vppafs")
            element.classList.toggle("shell-check_box--select");
            element.children[0].classList.toggle("block")
        });
    });
}
selectShell();
$(".header__action-cart").addEventListener('click', function() {
    window.location.href = "./shell.html";
});

</script> -->
