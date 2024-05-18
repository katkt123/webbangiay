<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/sanpham-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/sanpham.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/nhanhieu-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/ctsizesp-act.php');
    if(($_POST['action'])=='filter_data'){
        /////////////////////////////////////////////////////////// pagination
        $record_per_page = 20;                                   // pagination  
        $page = '';                                              // pagination
        $pagination = '';                                        // pagination
        if(isset($_POST["page"]))                                // pagination
        {                                                        // pagination
             $page = $_POST["page"];                             // pagination
        }                                                        // pagination
        else                                                     // pagination
        {                                                        // pagination
             $page = 1;                                          // pagination
        }                                                        // pagination                                                                   
        $start_from = ($page - 1)*$record_per_page;              // pagination
        /////////////////////////////////////////////////////////// pagination
        $keyWordNhanHieu = json_decode($_POST['nhanhieu']);
        $keyWordNDanhMuc = json_decode($_POST['danhmuc']);
        $minPrice = $_POST['min'];
        $maxPrice = $_POST['max'];
        $newValue = $_POST['newValue'];
        $hotValue = $_POST['hotValue'];
        $search = $_POST['search'];
        $query= "SELECT * FROM sanpham 
        INNER JOIN nhanhieu ON nhanhieu.MaNhanHieu = sanpham.MaNhanHieu 
        INNER JOIN loaisp ON loaisp.MaLoai = sanpham.MaLoai ";
        if(isset($_POST['search']) && $search!=""){
            $query.=" WHERE TenSP LIKE '%".$search."%'";
        }
        if(isset($_POST['nhanhieu']) && !empty($keyWordNhanHieu)){
            $filterNhanHieu=implode("','",$keyWordNhanHieu);
            $query.=" AND nhanhieu.TenNhanHieu IN('".$filterNhanHieu."')";
        }
        if(isset($_POST['danhmuc']) && !empty($keyWordNDanhMuc)){
            $filterDanhMuc=implode("','",$keyWordNDanhMuc);
            $query.=" AND loaisp.TenLoai IN('".$filterDanhMuc."')";
        }
        if(isset($_POST['min']) && isset($_POST['max'])){
            $query.=" AND sanpham.GiaMoi BETWEEN ".$minPrice." AND ".$maxPrice."";
        }
        if(isset($_POST['newValue']) && $_POST['newValue']!=0){
            $query.=" AND sanpham.SanPhamMoi = ".$newValue."";
        }
        if(isset($_POST['hotValue']) && $_POST['hotValue']!=0){
            $query.=" AND sanpham.SanPhamHot = ".$hotValue."";
        }
        $query.=" AND sanpham.hide = 1";
        if(isset($_POST['sortprice']) && $_POST['sortprice']!=""){
            $sortPrice=$_POST['sortprice'];
            if($sortPrice=="asc"){
                $query.=" ORDER BY sanpham.GiaMoi ASC";
            }else{
                $query.=" ORDER BY sanpham.GiaMoi DESC";
            }
        }
        ////////////////////////////////////////////////////////// pagination
        $query.=" LIMIT $start_from, $record_per_page";         // pagination
        ////////////////////////////////////////////////////////// pagination
        $db = new DTB();
        $result = mysqli_query($db->getConnection(), $query);
        $productArr = array();
        while ($row = mysqli_fetch_assoc($result)) {
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

        if($productArr==[]){
            $response = array(
                'data1' => "<h2>Không tìm thấy sản phẩm</h2>",
                'data2' => " ",
                'data3' => 0
            );
            echo json_encode($response);
        }
        else{
            /////////////////////////////////////////////////////////// pagination
            $queryExplore=explode("LIMIT",$query);                   // pagination
            $queryTemp=$queryExplore[0];                             // pagination
            $result = mysqli_query($db->getConnection(), $queryTemp);// pagination
            $total_records = mysqli_num_rows($result);               // pagination            
            $total_pages = ceil($total_records/$record_per_page);    // pagination
            for($i=1; $i<=$total_pages; $i++)                        // pagination    
            {                                                        // pagination
                $pagination .= "<span class='pagination_link' style='cursor:pointer; padding:6px; margin:0 5px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
            }                                                        // pagination
            $pagination .= '<br /><br />';                     // pagination
            /////////////////////////////////////////////////////////// pagination
            $response = array(
                'data1' => showListProductString($productArr),
                'data2' => $pagination,
                'data3' => $total_records
            );
            echo json_encode($response);
        }
        $db->disconnect();
    }
    if($_POST['action']=='kiemTraKho'){
        echo getSoluongTuMaVaSize($_POST['MaSP'],$_POST['SizeSP'])->getSoLuong();
    }
    if($_POST['action']=='themVaoGioHang'){
        if($_POST['SoLuong']>getSoluongTuMaVaSize($_POST['MaSP'],$_POST['SizeSP'])->getSoLuong()){
            echo 0;
        }else{
            session_start();
            $tempProduct[]=[$_POST['MaSP'],$_POST['SizeSP'],$_POST['SoLuong']];
            $_SESSION['voHang']=$tempProduct;
            echo count($_SESSION['voHang']);
        }
    }
    if($_POST['action']=='showCart'){
        $output='';
        $cart=json_decode($_POST['cart']);
        foreach($cart as $product){
            $sanPham=new SanPham(null,null,null,null,null,null,null,null,null,null,null,null,null);
            $sanPham=getProduct($product->MaSP);
            $output.='
            <tr>
                <td>
                    <div class="shell-product">
                        <div class="shell-img">
                            <img src="./assets/img/'.$sanPham->getHinhAnh().'" alt="" class="">
                        </div>
                        <div class="shell-title-repository">
                            <div class="shell-title">
                                '.$sanPham->getTenSP().'
                            </div>
                            <div class="shell-repository">
                                Còn lại: '.getSoluongTuMaVaSize(intval($product->MaSP) , intval($product->Size))->getSoLuong().'
                            </div>
                        </div>
                    </div>
                </td>
                <td class="cartSize">'.$product->Size.'</td>
                <td class="cartSoluong">'.$product->SoLuong.'</td>
                <td>'.formatCurrency($sanPham->getGiaMoi()*$product->SoLuong).'</td>
                <td style="display:flex; align-item:center; padding:30px 0; gap:5px" >
                    <input class="inputCart" style="width: 20px; height: 20px;" type="checkbox" value="'.$product->MaSP.'">
                    <button class="buttonDeleteCart" id="'.$product->MaSP.'" style="width: 20px; height: 20px;"> 
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </td>
            </tr>
            ';
        }
        echo $output;
    }
    if($_POST['action']=='addProductToTotal'){
        $output='';
        $products=json_decode($_POST['products']);
        foreach($products as $product){
            $sanPham=new SanPham(null,null,null,null,null,null,null,null,null,null,null,null,null);
            $sanPham=getProduct($product->MaSP);
            $output.='
            <li class="shell-total-item">
                <div class="shell-total-item-detail">
                    <div class="shell-total-img-quanlity">
                        <div class="shell-total-img">
                            <img src="./assets/img/'.$sanPham->getHinhAnh().'" alt="" class="">
                        </div>
                        <div class="shell-total-item_quanlity">
                            '.$product->SoLuong.'
                        </div>
                    </div>
                    <div class="shell-total-title_size">
                        <div class="shell-total-title">
                            '.$sanPham->getTenSP().'
                        </div>
                        <div class="shell-total-size">
                            Size: '.$product->Size.'
                        </div>
                    </div>
                </div>
                <div class="shell-total-item-price">
                    <span>'.formatCurrency($sanPham->getGiaMoi()*$product->SoLuong).'</span>
                </div>  
            </li>
            ';
        }
        echo $output;
    }
    if($_POST['action'] == "getListProductFromCart") {
        $carts = json_decode($_POST['cart']);
        $productArr = array();
        foreach($carts as $cart) {
            $sanPham=getProduct($cart->MaSP);
            $product = array(
                'HinhAnh' => $sanPham->getHinhAnh(),
                'MaSP' => $sanPham->getMaSP(),
                'TenSP' => $sanPham->getTenSP(),
                'GiaMoi' => $sanPham->getGiaMoi(),
                'SoLuong' => $cart->SoLuong,
                'Size' => $cart->Size                
            );
            $productArr[]=$product;
        } 
        echo json_encode($productArr);
    }
    if($_POST['action']=='showCheckout'){
        $output='';
        $products=json_decode($_POST['listCart']);
        foreach($products as $product){
            $sanPham=new SanPham(null,null,null,null,null,null,null,null,null,null,null,null,null);
            $sanPham=getProduct($product->MaSP);
            $output.='
            <li class="shell-total-item">
                <div class="shell-total-item-detail">
                    <div class="shell-total-img-quanlity">
                        <div class="shell-total-img">
                            <img src="./assets/img/'.$sanPham->getHinhAnh().'" alt="" class="">
                        </div>
                        <div class="shell-total-item_quanlity">
                            '.$product->SoLuong.'
                        </div>
                    </div>
                    <div class="shell-total-title_size">
                        <div class="shell-total-title">
                            '.$sanPham->getTenSP().'
                        </div>
                        <div class="shell-total-size">
                            Size: '.$product->Size.'
                        </div>
                    </div>
                </div>
                <div class="shell-total-item-price">
                    <span>'.formatCurrency($sanPham->getGiaMoi()*$product->SoLuong).'</span>
                </div>  
            </li>
            ';
        }
        echo $output;
    }
    if($_POST['action']=='updateProfile'){
        $tenDangNhap=$_POST['tenDangNhap'];
        $hoTen=$_POST['hoTen'];
        $ngaySinh=$_POST['ngaySinh'];
        $sdt=$_POST['sdt'];
        $email=$_POST['email'];
        $diaChi=$_POST['diaChi'];
        $passNew=$_POST['passNew'];
        $db = new DTB();
        $query="UPDATE user
        INNER JOIN taikhoan ON user.TenDangNhap=taikhoan.TenDangNhap
        SET user.HoTen='".$hoTen."',
            user.NgaySinh='".$ngaySinh."',
            user.SDT='".$sdt."',
            user.Email='".$email."',
            user.DiaChi='".$diaChi."',
            taikhoan.MatKhau='".$passNew."'
        WHERE user.TenDangNhap='".$tenDangNhap."'";
        $result = mysqli_query($db->getConnection(), $query);
        if ($result) {
            $affectedRows = mysqli_affected_rows($db->getConnection());
            if ($affectedRows > 0) {
                echo 1; // Cập nhật thành công
            } else {
                echo 0;//không hàm nào được cập nhật
            }
        } else {
            echo "Lỗi khi thực hiện câu lệnh SQL: " . mysqli_error($db->getConnection());
        }
    }
    if($_POST['action']=='checkout'){
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/user-act.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/px-act.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/ctpx-act.php');
        $tongTienHang=$_POST['tongTienHang'];
        $phiVanChuyen=$_POST['phiVanChuyen'];
        $tongThanhToan=$_POST['tongThanhToan'];
        $products=json_decode($_POST['listCart']);

        //Insert phiếu xuất
        $maKH=intval(getUser($_POST['tenDangNhap'])->getMa());
        $ngayDatHang = date('Y-m-d');
        $tinhTrangDonHang="Tạm giữ";
        $tongThanhToan=intval($_POST['tongThanhToan']); 
        $tongSoLuong=0;
        $trangThai=1;
        foreach($products as $product){
            $tongSoLuong+=$product->SoLuong;
        }
        $insertSql=insertPhieuXuat(0, $maKH ,$ngayDatHang,$tinhTrangDonHang,$tongThanhToan,$tongSoLuong,$trangThai);
        // Insert chi tiết phiếu xuất
        foreach($products as $product){
            $sanPham=new SanPham(null,null,null,null,null,null,null,null,null,null,null,null,null);
            $sanPham=getProduct($product->MaSP);
            $maPX=$insertSql;
            $maSP=$product->MaSP;
            $soLuong=$product->SoLuong;
            $giaBan=intval($sanPham->getGiaMoi());
            $size=$product->Size;
            $trangThai=1;

            insertChiTietPhieuXuat($maPX, $maSP ,$soLuong,$giaBan,$size,$trangThai);

            giamSoLuongTrongKho($maSP,$size,$soLuong);
            updateSoLuongDaBan($product->MaSP,$product->SoLuong);
        }
        // Số lượng đã bán trong bản sản phẩm tăng lên
        //trừ đi số lượng trong kho các sản phẩm
    }
    if($_POST['action']=='deleteDonHang'){
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/px-act.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/ctpx-act.php');
        $maPX=intval($_POST['MaPX']);
        // $maSP=intval($_POST['MaSP']);
        // $soLuong=intval($_POST['SoLuong']);
        // $size=intval($_POST['Size']);
        if(getTinhTrangPhieuXat($maPX)=='Tạm giữ'){
            // deleteChiTietPhieuXuat($maPX);
            huyPhieuXuat($maPX);

            $db = new DTB();
            $query = "SELECT MaSP,SoLuong,SizeSP FROM ctpx WHERE MaPX=$maPX";
            $result = mysqli_query($db->getConnection(), $query);
            while ($row = $result->fetch_assoc()) {
                $ma = $row["MaSP"];
                $sl = $row["SoLuong"];
                $size = $row["SizeSP"];

                //hoàn trả lại số lượng vô kho
                $query = "UPDATE ctsizesp SET SoLuong = SoLuong + $sl WHERE MaSP = $ma AND SizeSP = $size";
                mysqli_query($db->getConnection(), $query);

                // trừ số lượng đã bán
                $query = "UPDATE sanpham SET SoLuongDaBan = SoLuongDaBan - $sl WHERE MaSP = $ma";
                mysqli_query($db->getConnection(), $query);
            }

            echo 1;
        }
        else{
            echo 0;
        }
    }
    if($_POST['action']=='showChiTietPhieuXuat'){
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/ctpx-act.php');
        $maPX=intval($_POST['MaPX']);
        echo showChiTietPhieuXuat($maPX);
    }
    if($_POST['action']=='checkSoLuongTonKho'){
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/ctsizesp-act.php');
        $flag=1;
        $output='';
        $products=json_decode($_POST['products']);
        foreach($products as $product){
            $output.=$product->TaiKhoan.",".$product->MaSP.",".$product->Size.",".$product->SoLuong."/";
            if($product->SoLuong > getSoluongTuMaVaSize($product->MaSP,$product->Size)->getSoLuong()){
                $flag=0;
                break;
            }
        }
        if($flag==1){
            echo $output;
        }
        else{
            echo 0;
        }
    }
    if($_POST['action']=='themvaoyeuthich'){
        echo 0;
    }
    if($_POST['action']=='showWish'){
        $output='';
        $wish=json_decode($_POST['wish']);
        foreach($wish as $product){
            $sanPham=new SanPham(null,null,null,null,null,null,null,null,null,null,null,null,null);
            $sanPham=getProduct($product->maSP);
            $output.='
            <tr>
                <td>
                    <a href="index.php?danhmuc=product-detail&id='.$sanPham->getMaSP().'">
                    <div class="shell-product">
                        <div class="shell-img">
                            <img src="./assets/img/'.$sanPham->getHinhAnh().'" alt="" class="">
                        </div>
                        <div class="shell-title-repository">
                            <div class="shell-title" style="color:black;">
                                '.$sanPham->getTenSP().'
                            </div>
                            <div class="shell-repository">
                                Đã bán :'.$sanPham->getSoLuongDaBan().' 
                            </div>
                        </div>
                    </div>
                    </a>
                    
                </td>
                </td>
                <td>'.formatCurrency($sanPham->getGiaMoi()).'</td>
                <td>
                    <button class="buttonDeleteWish" id="'.$sanPham->getMaSP().'" style="width: 20px; height: 20px;"> 
                        <i class="fa-regular fa-trash-can"></i>
                    </button>   
                </td>
            </tr>
            ';
        }
        echo $output;
    }
    if($_POST['action']=='review'){
        $reviewContent=$_POST['reviewContent'];
        $star=$_POST['star'];
        $size=$_POST['size'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $gioHienTai=date("H:i Y-m-d");
        $tenDangNhap=$_POST['tenDangNhap'];
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/user-act.php');
        $hoTen=getUser($tenDangNhap)->getHoTen();
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/taikhoan-act.php');
        $avt=getTaiKhoan($tenDangNhap)->getAvt();
        $numberStar='';
        for ($i=1; $i <=$star ; $i++) { 
            $numberStar.='<i class="fa-solid fa-star" style="margin-right:3px;" ></i>';
        }
        for ($i=1; $i <=5-$star ; $i++) { 
            $numberStar.='<i class="fa-light fa-star" style="margin-right:3px;" ></i>';
        }
        $output='
        <div class="describe-reviews_detail-item">
            <div class="describe-reviews_detail-info">
                <div class="describe-reviews_detail-avt">
                    <img src="./assets//img/'.$avt.'" alt="" class="">
                    <div class="describe-reviews_detail-name_type">
                        <div class="describe-reviews_detail-name">'.$hoTen.'</div>
                        <div class="describe-reviews_detail-star">
                            '.$numberStar.'

                        </div>
                    </div>
                </div>
                <div class="describe-reviews_detail-time">
                    '.$gioHienTai.'
                </div>
            </div>
            <div class="describe-reviews_detail-rating">
                <div class="describe-reviews_detail-cmt">
                    '.$reviewContent.'                                           
                </div>
            </div>
            
        </div>  
        ';

        // insert CSDL
        $MaSP=intval($_POST['maSP']);
        $MaKH=intval(getUser($tenDangNhap)->getMa());
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/danhgia-act.php');
        insertDanhGia($MaSP,$MaKH,$reviewContent,$gioHienTai,intval($star));
        echo $output;
    }
?>
