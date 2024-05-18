<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/ctpx.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/sanpham-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/px-act.php');
    function insertChiTietPhieuXuat($MaPX, $MaSP, $SoLuong, $GiaBan, $SizeSP, $trangThai){
        $db = new DTB();
        $query = "INSERT INTO ctpx (MaPX, MaSP, SoLuong, GiaBan, SizeSP, trangThai) 
                    VALUES ('$MaPX', '$MaSP', '$SoLuong', '$GiaBan', '$SizeSP', '$trangThai')";
        $result = mysqli_query($db->getConnection(), $query);
    }
    function deleteChiTietPhieuXuat($MaPX){
        $db = new DTB();
        $query = "DELETE FROM `ctpx` WHERE MaPX=$MaPX";
        $result = mysqli_query($db->getConnection(), $query);
    }
    // insertChiTietPhieuXuat(1, 1 ,1,300000,37,1);
    function showChiTietPhieuXuat($maPX){
        $db = new DTB();
        $query = "SELECT * FROM ctpx WHERE MaPX=$maPX";
        $result = mysqli_query($db->getConnection(), $query);
        $output='
            <div style="display: flex; align-items: center; justify-content: end;">
                <span class="close">&times;</span>
            </div>
            <table class="table table-chitietdonhang table-borderless table-striped" style="width: 100%;">
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
        ';
        $i=1;
        $thanhTien=0;
        $tienCanTra=getTongTien($maPX);
        while($row=mysqli_fetch_array($result)){
            $output.='
            <tr>
                <td scope="row">'.$i.'</td>
                <td> '.getProduct($row['MaSP'])->getTenSP().'</td>
                <td>'.$row['SizeSP'].'</td>
                <td class="text-right">'.$row['SoLuong'].'</td>
                <td class="text-right">'.formatCurrency($row['GiaBan']*$row['SoLuong']).'</td>
            </tr>
            ';
            $i++;
            $thanhTien+=$row['GiaBan']*$row['SoLuong'];
        }
        $vanChuyen=$tienCanTra-$thanhTien;
        $output.='
            </tbody>
            </table>
            <div class="row mt-5" style="display: flex; justify-content: end; margin-top: 20px; padding: 10px;">
                <div class="col-md-12">
                    <div class="text-right mr-2" style="text-align: end;">
                        <p class="mb-2 h6">
                            <span class="text-muted">Thành tiền : </span>
                            <strong>'.formatCurrency($thanhTien).'</strong>
                        </p>
                        <p class="mb-2 h6">
                            <span class="text-muted">Vận chuyển : </span>
                            <strong>'.formatCurrency($vanChuyen).'</strong>
                        </p>
                        <p class="mb-2 h6">
                            <span  class="text-muted">Tiền cần trả : </span>
                            <span style="color: rgba(255, 0, 0, 0.792) ; font-weight:700;" >'.formatCurrency($tienCanTra).'</span>
                        </p>
                    </div>
                </div>
            </div> ';
        $db->disconnect();
        return $output;
    }
    function checkSanPhamInPhieuXuat($listMaPX, $MaSP){
        if(empty($listMaPX)){
            return false;
        }
        $db = new DTB();
        $query = "SELECT COUNT(*) as count FROM ctpx WHERE MaPX IN ($listMaPX) AND MaSP=$MaSP";
        $result = mysqli_query($db->getConnection(), $query);
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        $db->disconnect();
        return $count > 0;
    }
    // echo checkSanPhamInPhieuXuat(implode(',', getMaPhieuXuatListFromMaKH(1)),21);
?>