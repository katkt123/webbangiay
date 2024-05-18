<main style="position: relative;">
    <div class="notification">
    </div>
    <section class="hero">
        <div class="container">
            <div class="hero-main">
                <div class="hero__text">
                    <div class="hero__text-title">SPORT SHOES</div>
                    <div class="hero__text-content">
                        Vượt qua mọi giới hạn cùng bạn, đồng hành trên mọi hành trình, chinh phục mọi mục tiêu và đạt đến thành công.
                        Đẳng cấp từ từng bước chân, biểu tượng của sự thành công, nâng tầm đẳng cấp và tạo nên sự khác biệt.
                    </div>
                    <a href="index.php?danhmuc=products" class="button-hero">
                        <span>Cửa hàng</span>
                        <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                            <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                        </svg>
                    </a>
                </div>
                <div class="hero__image">
                    <?php 
                    $conn = new mysqli("localhost", "root", "", "shoestore");
                    $sql="SELECT *
                    FROM website";
                    $result = $conn->query($sql);
                      $data = mysqli_fetch_assoc($result);
                      $image = $data["imghome"];
                      $thuonghieu = $data["thuonghieu"];
                    ?>
                    <img src="./assets/img/<?php echo $image; ?>" alt="" class="hero__image-img">
                    <!-- <a href="" class="hero__image-btn-sale button">
                        <i class="hero__image-btn-sale-icon fa-regular fa-badge-percent"></i>
                        <div>
                            <p>50%</p>
                            <span>Discount</span>
                        </div>
                    </a> -->
                    <div class="hero__image-text">
                    <?php echo $thuonghieu; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about">
        <div class="container">
            <div class="about-main">
                <a href="index.php?danhmuc=products&loai=Running" class="about__box">
                    <div class="about__box-text">
                        <div class="about__box-title">
                            Running<br> Shoes
                        </div>
                        <span class="about__box-link">
                            SHOP NOW
                            <i class="fa-solid fa-angles-right"></i>
                        </span>
                    </div>
                    <div class="about__box-img">
                        <img src="./assets/img/man.png" alt="" class="">
                    </div>
                </a>
                <a href="index.php?danhmuc=products&loai=Basketball" class="about__box">
                    <div class="about__box-text">
                        <div class="about__box-title">
                            Basketball <br> Shoes
                        </div>
                        <span class="about__box-link">
                            SHOP NOW
                            <i class="fa-solid fa-angles-right"></i>
                        </span>
                    </div>
                    <div class="about__box-img">
                        <img src="./assets/img/women.png" alt="" class="">
                    </div>
                </a>
                <a href="index.php?danhmuc=products&loai=Gym" class="about__box">
                    <div class="about__box-text">
                        <div class="about__box-title">
                            Gym <br> Shoes
                        </div>
                        <span class="about__box-link">
                            SHOP NOW
                            <i class="fa-solid fa-angles-right"></i>
                        </span>
                    </div>
                    <div class="about__box-img">
                        <img src="./assets/img/kids.png" alt="" class="">
                    </div>
                </a>
                <a href="index.php?danhmuc=products" class="about__box">
                    <div class="about__box-text">
                        <div class="about__box-title">
                            All <br>
                            Shoes
                        </div>
                        <span class="about__box-link">
                            SHOP NOW
                            <i class="fa-solid fa-angles-right"></i>
                        </span>
                    </div>
                    <div class="about__box-img">
                        <img src="./assets/img/family.png" alt="" class="">
                    </div>
                </a>
            </div>
        </div>
    </section>
    <section class="video">
        <div class="container">
            <div class="video-main">

                <video loop width="67%" height="100%" autoplay muted>
                    <source src="assets/img/video.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="video__content">
                    <h2 class="video__content-title">AT LEAST</h2>
                    <div class="video__content-offer">50% OFF</div>
                    <h2 class="video__content-break">ALL NEXT SALE ITEMS</h2>
                    <div class="video__content-btn">
                        <i class="video__content-btn-icon fa-solid fa-right"></i>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <section class="brand">
        <div class="container">
            <div class="brand-main">
                <div class="brand__title">BRAND</div>
                <div class="brand__list">
                    <a href='index.php?danhmuc=products&nhanhieu=Nike' class="brand__box">
                        <img src="./assets/img/brand-nike.png" alt="">
                    </a>
                    <a href='index.php?danhmuc=products&nhanhieu=Adidas' class="brand__box">
                        <img src="./assets/img/brand-adidas.png" alt="">
                    </a>
                    <a href='index.php?danhmuc=products&nhanhieu=Vans' class="brand__box">
                        <img src="./assets/img/brand-vans.png" alt="">
                    </a>
                    <a href='index.php?danhmuc=products&nhanhieu=Jordan' class="brand__box">
                        <img src="./assets/img/brand-jordan.png" alt="">
                    </a>
                    <a href='index.php?danhmuc=products&nhanhieu=Puma' class="brand__box">
                        <img src="./assets/img/brand-puma.png" alt="">
                    </a>
                    <a href='index.php?danhmuc=products&nhanhieu=New Balance' class="brand__box">
                        <img src="./assets/img/brand-balance.png" alt="">
                    </a>
                </div>
                
            </div>
        </div>
    </section>
    <section class="product-new">
        <div class="container">
            <div class="product-new-main">
                <div class="product-new__title-slick">
                    <span class="product-new__title title">
                        PRODUCT
                        <a href="">SẢN PHẨM MỚI</a>
                    </span>
                    <a class="btn-more"  href="index.php?danhmuc=products&new=1">
                        <span class="btn-more-title">More</span>
                        <i class="fa-solid fa-chevron-right"></i>
                        <div class="btn-more--hover">

                        </div>
                    </a>
                </div>
                <div class="product-new__list card__list">
                    <?php
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/sanpham-act.php');
                        echo showListProductString(getProductNew());
                        ?>
                </div>
            </div>
        </div>
    </section>
    <section class="product-hot">
        <div class="container">
            <div class="product-hot-main">
                <div class="product-hot__title-slick">
                    <span class="product-hot__title title">
                        HOT
                        <a href="">SẢN PHẨM HOT</a>
                    </span>
                    <a class="btn-more" href="index.php?danhmuc=products&hot=1">
                        <span class="btn-more-title">More</span>
                        <i class="fa-solid fa-chevron-right"></i>
                        <div class="btn-more--hover">

                        </div>
                    </a>
                </div>
                <div class="product-hot__list card__list">
                    <?php
                       require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/sanpham-act.php');
                       echo showListProductString(getProductHot());
                    ?>
                </div>
            </div>
        </div>
    </section>
    <section class="feedback">
        <div class="container">
            <div class="feedback-main">
                <span class="feedback__title title">
                    FeedBack
                    <a href="">PHẢN HỒI</a>
                </span>
                <div class="feedback__list">
                    <?php
                        $sql_feedback= "SELECT * FROM `feedback`";
                        $result=mysqli_query($connect,$sql_feedback);
                        while($row=mysqli_fetch_array($result)){?>
                            <div class="feedback__item">
                        <div class="feedback__star">
                            <?php
                                for($i=0;$i<$row['SoSao'];$i++){ ?>
                                    <i class="fa-solid fa-star"></i>
                            <?php } ?>
                        </div>
                        <div class="feedback__text">
                            <?php echo $row['NoiDung']; ?>
                        </div>
                        <div class="feedback__person">
                            <img class="feedback__person-img" src="./assets/img/<?php echo $row['Image']; ?>" alt="">
                            <div class="feedback__person-name_work">
                                <span class="feedback__person-name"><?php echo $row['TenNgFb']; ?></span>
                                <div class="feedback__person-work">CUSTOMER @SHOES</div>
                            </div>
                        </div>
                        </div>
                    <?php } ?>
                    
                    
                    <!-- <i class="feedback__slick-left btn-slick__left fa-solid fa-angle-left"></i>
                    <i class="feedback__slick-right btn-slick__right fa-solid fa-angle-right"></i>    
                    -->
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {

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
    });
    

</script>

