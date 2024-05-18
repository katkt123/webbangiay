<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/nhanhieu.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/sanpham-act.php');


function getNhanHieuList(){
    $db = new DTB();
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM nhanhieu where hide=1");
    $nhanHieuArr = array();
    while ($row = mysqli_fetch_assoc($kq)) {
        $nhanHieu = new NhanHieu(
            $row['MaNhanHieu'],
            $row['TenNhanHieu']
        );
        $nhanHieuArr[] = $nhanHieu;
    }
    $db->disconnect();
    return $nhanHieuArr;
}
function getTenNhanHieu($id){
    $db = new DTB();
    $kq = mysqli_query($db->getConnection(), "SELECT TenNhanHieu FROM nhanhieu WHERE MaNhanHieu = $id");
    $row = mysqli_fetch_assoc($kq);
    $tenNhanHieu = $row['TenNhanHieu'];
    $db->disconnect();
    return $tenNhanHieu;
}
function showNhanHieu(){
    $nhanHieuArr = getNhanHieuList();
    foreach($nhanHieuArr as $nhanHieu){
        echo "
        <li class='filter__list-item filter__list-item-text'>
            <input class='inputFilter nhanhieuFilter' type='checkbox' name='' id='' value='".$nhanHieu->getTenNhanHieu()."'>
            <span>".$nhanHieu->getTenNhanHieu()."</span>
        </li>
        ";
    }
}
function showNhanHieuMegaMenu(){
    $nhanHieuArr = getNhanHieuList();
    foreach($nhanHieuArr as $nhanHieu){
        echo "<a href='index.php?danhmuc=products&nhanhieu=".$nhanHieu->getTenNhanHieu()."' class='menu__hover__content-li'>".$nhanHieu->getTenNhanHieu()."</a>";
    }
}
function showNhanHieuProductDetail($maSP){
    echo "
    <a href='index.php?danhmuc=products&nhanhieu=".getTenNhanHieu(getProduct($maSP)->getMaNhanHieu())."' class='detail-content__tag-item'>
        ".getTenNhanHieu(getProduct($maSP)->getMaNhanHieu())."
    </a>
    ";
}
?>