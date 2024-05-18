    <div class="header-main">
        <p class="header-title">
        <a href="../index.php" class="header_banhang">
                <i class="fa-solid fa-circle-right icon-banhang"></i><span>Cửa hàng</span>
            </a>
        </p>
        <div class="header-notifi_user">
            <!-- <div class="notifi">
                <i class="fa-regular fa-bell"></i>
                <div class="notifi-state">
                </div>
            </div> -->
            <div class="user">
                <p class="user-name">
                    <?php
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');
                        $TenDangNhap=$_SESSION['taikhoan'];
                        $sql="SELECT u.HoTen,tk.Avt FROM user u join taikhoan tk on u.TenDangNhap=tk.TenDangNhap WHERE tk.TenDangNhap='$TenDangNhap'";
                        $result=mysqli_query($connect,$sql);
                        $row=mysqli_fetch_array($result);
                        echo $row['HoTen'];
                    ?>             
                </p>
                <div class="user-img">
                    <img src="./assets/img/<?php echo $row['Avt']?>" alt="">
                    <div class="user-state">

                    </div>
                    <div class="user-more">
                        <ul>
                            <!-- <li>
                                <i class="fa-solid fa-user"></i>
                                <a class="dropdown-item" href="index.php?danhmuc=thongtintaikhoan">Thông tin</a>
                            </li> -->
                            <li>
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <a style="text-decoration: none;" href="../logout.php">Log out</a>
                            </li>
                        </ul>   
                    </div>
                </div>
            </div>
        </div>
    </div>
