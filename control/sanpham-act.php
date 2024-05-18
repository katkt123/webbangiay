<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/sanpham.php');
    function getAllProduct(){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM sanpham where `hide`=1 ORDER BY RAND()");
        $productArr = array();
        while ($row = mysqli_fetch_assoc($kq)) {
            $sanPham = new SanPham(
                $row['MaSP'],
                $row['TenSP'],
                $row['SoSaoDanhGia'],
                $row['SoLuotDanhGia'],
                $row['MoTa'],
                $row['HinhAnh'],
                $row['SanPhamMoi'],
                $row['SanPhamHot'],
                $row['GiaCu'],
                $row['GiaMoi'],
                $row['SoLuongDaBan'],
                $row['MaNhanHieu'],
                $row['MaLoai']
            );
            $productArr[] = $sanPham;
        }
        $db->disconnect();
        return $productArr;
    }
    function formatCurrency($amount) {
        // Chuyển đổi số tiền thành chuỗi
        $amount = strval($amount);
        
        // Chia chuỗi thành các phần nguyên và phần thập phân
        $parts = explode('.', $amount);
        
        // Định dạng phần nguyên
        $integerPart = number_format($parts[0]);
        
        // Định dạng phần thập phân (nếu có)
        $decimalPart = isset($parts[1]) ? ',' . $parts[1] : '';
        
        // Kết hợp phần nguyên và phần thập phân vào chuỗi tiền tệ hoàn chỉnh
        $formattedAmount = $integerPart . $decimalPart . ' ₫';
        
        return $formattedAmount;
    }
    function getProductHot(){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM `sanpham` WHERE `SanPhamHot` = 1 AND `hide`=1 ORDER BY RAND() LIMIT 12");
        $productArr = array();
        while ($row = mysqli_fetch_assoc($kq)) {
            $sanPham = new SanPham(
                $row['MaSP'],
                $row['TenSP'],
                $row['SoSaoDanhGia'],
                $row['SoLuotDanhGia'],
                $row['MoTa'],
                $row['HinhAnh'],
                $row['SanPhamMoi'],
                $row['SanPhamHot'],
                $row['GiaCu'],
                $row['GiaMoi'],
                $row['SoLuongDaBan'],
                $row['MaNhanHieu'],
                $row['MaLoai']
            );
            $productArr[] = $sanPham;
        }
        $db->disconnect();
        return $productArr;
    }
    function getProduct($id){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM `sanpham` WHERE MaSP = $id");
        $row=mysqli_fetch_array($kq);
        $product = new SanPham(
            $row['MaSP'],
            $row['TenSP'],
            $row['SoSaoDanhGia'],
            $row['SoLuotDanhGia'],
            $row['MoTa'],
            $row['HinhAnh'],
            $row['SanPhamMoi'],
            $row['SanPhamHot'],
            $row['GiaCu'],
            $row['GiaMoi'],
            $row['SoLuongDaBan'],
            $row['MaNhanHieu'],
            $row['MaLoai']
        );
        $db->disconnect();
        return $product;
    }
    function showAllListProduct(){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM `sanpham` ORDER BY RAND()");
        while($row=mysqli_fetch_array($kq)){?>
            <a href="index.php?danhmuc=product-detail&id=<?php echo $row['MaSP'] ?>">
                <div class="card">
                    <div class="card-img">
                        <img src="./assets/img/<?php echo $row['HinhAnh']?>" alt="">
                    </div>
                    <p class="card-title"><?php echo $row['TenSP']?></p>
                    <div class="card-price-rate">
                        <div class="card-price">
                            <span><?php echo formatCurrency($row['GiaMoi'])?></span>
                            <span><del><?php echo formatCurrency($row['GiaCu']) ?></del></span>  
                        </div>
                        <div class="card-rate">
                            <i class="fa-solid fa-star"></i>
                            <?php echo $row['SoSaoDanhGia']?>
                        </div>
                    </div>   
                    <i class=" card-btn__like fa-regular fa-heart"></i>
                    <div class="card-new-hot">
                    <?php
                        if($row['SanPhamMoi']==1){ ?>
                            <div class="card-special card-hot">
                            Mới
                            </div>
                        <?php }
                        if($row['SanPhamHot']==1){?>
                            <div class="card-special card-new">
                                Hot
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </a>
        <?php }
        $db->disconnect();
    }
    function getProductNew(){
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM `sanpham` WHERE `SanPhamMoi` = 1  AND `hide`=1 ORDER BY RAND() LIMIT 12");
        $productArr = array();
        while ($row = mysqli_fetch_assoc($kq)) {
            $sanPham = new SanPham(
                $row['MaSP'],
                $row['TenSP'],
                $row['SoSaoDanhGia'],
                $row['SoLuotDanhGia'],
                $row['MoTa'],
                $row['HinhAnh'],
                $row['SanPhamMoi'],
                $row['SanPhamHot'],
                $row['GiaCu'],
                $row['GiaMoi'],
                $row['SoLuongDaBan'],
                $row['MaNhanHieu'],
                $row['MaLoai']
            );
            $productArr[] = $sanPham;
        }
        $db->disconnect();
        return $productArr;
    }
    

    function showListProductString($arrProduct){
        $output = '';
        foreach ($arrProduct as $row) {
            $output .= '
            <a href="index.php?danhmuc=product-detail&id=' . $row->getMaSP() . '">
                <div class="card">
                    <div class="card-img">
                        <img src="./assets/img/' . $row->getHinhAnh(). '" alt="">
                    </div>
                    <p class="card-title">' . $row->getTenSP() . '</p>
                    <div class="card-price-rate">
                        <div class="card-price">
                            <span>' . formatCurrency($row->getGiaMoi()) .' </span>
                            <span><del>' . formatCurrency($row->getGiaCu()) .'  </del></span>  
                        </div>
                        <div class="card-rate">
                            <i class="fa-solid fa-star"></i>
                            '. $row->getSoSaoDanhGia() . ' 
                        </div>
                    </div>   
                    <i class=" card-btn__like fa-regular fa-heart"></i>
                    <div class="card-new-hot">';
            if ($row->getSanPhamMoi()== 1) {
                $output .= '
                <div class="card-special card-hot">
                    Mới
                </div>
                ';
            }
            if ($row->getSanPhamHot() == 1) {
                $output .= '
                <div class="card-special card-new">
                    Hot
                </div>
                ';
            }
            $output .= '
                        </div>
                    </div>
                </a>
            ';
        }
        return $output;
    }
    function showListProductStringTuongTu($arrProduct){
        $output = '';
        foreach ($arrProduct as $row) {
            $output .= '
            <a href="index.php?danhmuc=product-detail&id=' . $row->getMaSP() . '">
                <div class="card cardTuongTu">
                    <div class="card-img">
                        <img src="./assets/img/' . $row->getHinhAnh(). '" alt="">
                    </div>
                    <p class="card-title">' . $row->getTenSP() . '</p>
                    <div class="card-price-rate">
                        <div class="card-price">
                            <span>' . formatCurrency($row->getGiaMoi()) .' </span>
                            <span><del>' . formatCurrency($row->getGiaCu()) .'  </del></span>  
                        </div>
                        <div class="card-rate">
                            <i class="fa-solid fa-star"></i>
                            '. $row->getSoSaoDanhGia() . ' 
                        </div>
                    </div>   
                    <i class=" card-btn__like fa-regular fa-heart"></i>
                    <div class="card-new-hot">';
            if ($row->getSanPhamMoi()== 1) {
                $output .= '
                <div class="card-special card-hot">
                    Mới
                </div>
                ';
            }
            if ($row->getSanPhamHot() == 1) {
                $output .= '
                <div class="card-special card-new">
                    Hot
                </div>
                ';
            }
            $output .= '
                        </div>
                    </div>
                </a>
            ';
        }
        return $output;
    }
    function getSoLuongDaBan($maSP){
        $db = new DTB();
        $query="SELECT * FROM `sanpham` WHERE MaSP=$maSP";
        $kq = mysqli_query($db->getConnection(), $query);
        $row = mysqli_fetch_assoc($kq);
        return $row['SoLuongDaBan'];
    }
    function updateSoLuongDaBan($maSP, $soLuongBan){
        $soLuongMoi=intval(getSoLuongDaBan($maSP)) + intval($soLuongBan);
        $db = new DTB();
        $query="UPDATE `sanpham` SET `SoLuongDaBan`=$soLuongMoi WHERE MaSP=$maSP";
        $kq = mysqli_query($db->getConnection(), $query);
    }
    // function getMaNhanHieu($id){
    //     getProduct($id);
    //     return getProduct($id)->getMaNhanHieu();
    // }
    function getListProductFromNhanHieu($id){
        $maNhanHieu=  intval(getProduct($id)->getMaNhanHieu());
        $db = new DTB();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM `sanpham` WHERE MaNhanHieu = $maNhanHieu");
        $productArr = array();
        while ($row = mysqli_fetch_assoc($kq)) {
            $sanPham = new SanPham(
                $row['MaSP'],
                $row['TenSP'],
                $row['SoSaoDanhGia'],
                $row['SoLuotDanhGia'],
                $row['MoTa'],
                $row['HinhAnh'],
                $row['SanPhamMoi'],
                $row['SanPhamHot'],
                $row['GiaCu'],
                $row['GiaMoi'],
                $row['SoLuongDaBan'],
                $row['MaNhanHieu'],
                $row['MaLoai']
            );
            $productArr[] = $sanPham;
        }
        $db->disconnect();
        return $productArr;
    }
    function getListProductFromArr($arr){
        $db = new DTB();
        $valuesString = implode(', ', $arr);
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM `sanpham` WHERE `hide`=1 AND MaSP IN ($valuesString) LIMIT 6");
        $productArr = array();
        while ($row = mysqli_fetch_assoc($kq)) {
            $sanPham = new SanPham(
                $row['MaSP'],
                $row['TenSP'],
                $row['SoSaoDanhGia'],
                $row['SoLuotDanhGia'],
                $row['MoTa'],
                $row['HinhAnh'],
                $row['SanPhamMoi'],
                $row['SanPhamHot'],
                $row['GiaCu'],
                $row['GiaMoi'],
                $row['SoLuongDaBan'],
                $row['MaNhanHieu'],
                $row['MaLoai']
            );
            $productArr[] = $sanPham;
        }
        $db->disconnect();
        return $productArr;
    }
?>