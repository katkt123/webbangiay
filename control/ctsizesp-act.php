<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/ctsizesp.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');

function getSoluongTuMaVaSize($MaSP, $SizeSP){
    $db = new DTB();
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM `ctsizesp` WHERE MaSP =$MaSP AND SizeSP = $SizeSP ");
    $row=mysqli_fetch_array($kq);
    $ctSizeSP = new CTSizeSP(
        $row['MaSP'],
        $row['SizeSP'],
        $row['SoLuong']
    );
    $db->disconnect();
    return $ctSizeSP;
}

function giamSoLuongTrongKho($maSP, $sizeSP, $soLuongBan){
    $db = new DTB();
    $soLuongConLai=intval(getSoluongTuMaVaSize($maSP, $sizeSP)->getSoLuong())-intval($soLuongBan);
    $query="UPDATE `ctsizesp` SET `SoLuong`=$soLuongConLai WHERE `MaSP`=$maSP AND `SizeSP`=$sizeSP";
    $kq = mysqli_query($db->getConnection(), $query);

}

//Hoàn lại sản phẩm khi khách hàng hủy đơn
function tangSoLuongTrongKho($maSP, $sizeSP, $soLuongBan){
    $db = new DTB();
    $soLuongConLai=intval(getSoluongTuMaVaSize($maSP, $sizeSP)->getSoLuong())+intval($soLuongBan);
    $query="UPDATE `ctsizesp` SET `SoLuong`=$soLuongConLai WHERE `MaSP`=$maSP AND `SizeSP`=$sizeSP";
}
?>
