<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/danhgia.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/user-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/taikhoan-act.php');

    function getDanhGia($MaSP){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM danhgia where `hide`=1 AND MaSP=$MaSP ORDER BY MaDanhGia DESC");
        $danhGiaArr = array();
        while ($row = mysqli_fetch_assoc($kq)) {
            $danhGia = new DanhGia(
                $row['MaDanhGia'],
                $row['MaSP'],
                $row['MaKH'],
                $row['NoiDungDanhGia'],
                $row['ThoiGianDanhGia'],
                $row['SoTimDanhGia']
            );
            $danhGiaArr[] = $danhGia;
        }
        $db->disconnect();
        return $danhGiaArr;
    }
    function showAllReview($MaSP){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM danhgia where `hide`=1 AND MaSP=$MaSP ORDER BY MaDanhGia DESC");
        while($row=mysqli_fetch_array($kq)){?>
        <?php 
         $numberStar='';
         for ($i=1; $i <=$row['SoTimDanhGia'] ; $i++) { 
             $numberStar.='<i class="fa-solid fa-star" style="margin-right:3px;" ></i>';
         }
         for ($i=1; $i <=5-$row['SoTimDanhGia'] ; $i++) { 
             $numberStar.='<i class="fa-light fa-star" style="margin-right:3px;" ></i>';
         }
        ?>
            <div class="describe-reviews_detail-item">
                <div class="describe-reviews_detail-info">
                    <div class="describe-reviews_detail-avt">
                        <img src="./assets//img/<?php echo getTaiKhoan(getUserFromMa($row['MaKH'])->getTenDangNhap())->getAvt() ?>" alt="" class="">
                        <div class="describe-reviews_detail-name_type">
                            <div class="describe-reviews_detail-name"><?php echo getUserFromMa($row['MaKH'])->getHoTen() ?> </div>
                            <div class="describe-reviews_detail-star">
                                <?php echo $numberStar?>

                            </div>
                        </div>
                    </div>
                    <div class="describe-reviews_detail-time">
                        <?php echo $row['ThoiGianDanhGia'] ?> 
                    </div>
                </div>
                <div class="describe-reviews_detail-rating">
                    <div class="describe-reviews_detail-cmt">
                        <?php echo $row['NoiDungDanhGia'] ?>                                          
                    </div>
                </div>
            </div>  
        <?php }
        $db->disconnect();
    }
    function insertDanhGia($MaSP, $MaKH, $NoiDungDanhGia,$ThoiGianDanhGia ,$SoTimDanhGia) {
        $db = new DTB();
        $query = "INSERT INTO danhgia (MaSP, MaKH, NoiDungDanhGia, ThoiGianDanhGia, SoTimDanhGia,hide) VALUES ($MaSP, $MaKH, '$NoiDungDanhGia', '$ThoiGianDanhGia', $SoTimDanhGia,1)";
        $result = mysqli_query($db->getConnection(), $query);
        $db->disconnect();
    }
    function checkDanhGiaExists($MaSP, $MaKH) {
        $db = new DTB();
        $query = "SELECT COUNT(*) as count FROM danhgia WHERE MaSP = $MaSP AND MaKH = $MaKH";
        $result = mysqli_query($db->getConnection(), $query);
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        $db->disconnect();
        return $count > 0;
    }
    function showListDanhGiaAdmin() {
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM danhgia where `hide`=1");
        while($row=mysqli_fetch_array($kq)){?>
            <tr>
                <td><?php echo $row['MaDanhGia']?></td>
                <td><?php echo $row['MaSP']?></td>
                <td><?php echo $row['MaKH']?></td>
                <td><?php echo $row['NoiDungDanhGia']?></td>
                <td><?php echo $row['ThoiGianDanhGia']?></td>
                <td>
                    <?php echo $row['SoTimDanhGia']?>
                </td>
                <td>
                <button type="button" class="btnDanhGia btn btn-danger">
                    Ẩn
                </button>
                </td>
            </tr>
        <?php }
        $db->disconnect();
    }
?>