<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/loaisp.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/sanpham-act.php');


function getLoaiSanPhamList(){
    $db = new DTB();
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM loaisp where hide=1");
    $loaiSpArr = array();
    while ($row = mysqli_fetch_assoc($kq)) {
        $loaiSP = new LoaiSP(
            $row['MaLoai'],
            $row['TenLoai']
        );
        $loaiSpArr[] = $loaiSP;
    }
    $db->disconnect();
    return $loaiSpArr;
}
function showDanhMuc(){
    $danhMucArr = getLoaiSanPhamList();
    foreach($danhMucArr as $danhMuc){
        echo "
        <li class='filter__list-item filter__list-item-text'>
            <input class='inputFilter danhmucFilter' type='checkbox' name='' id='' value='".$danhMuc->getTenLoai()."'>
            <span>".$danhMuc->getTenLoai()."</span>
        </li>
        ";
    }
}
function showDanhMucMegaMenu(){
    $danhMucArr = getLoaiSanPhamList();
    foreach($danhMucArr as $danhMuc){
        echo "<a href='index.php?danhmuc=products&loai=".$danhMuc->getTenLoai()."' class='menu__hover__content-li'>".$danhMuc->getTenLoai()."</a>";
    }
}
function getTenLoai($id){
    $db = new DTB();
    $kq = mysqli_query($db->getConnection(), "SELECT TenLoai FROM loaisp WHERE MaLoai = $id");
    $row = mysqli_fetch_assoc($kq);
    $tenLoai = $row['TenLoai'];
    $db->disconnect();
    return $tenLoai;
}
function showLoaiProductDetail($maSP){
    echo "
    <a href='index.php?danhmuc=products&loai=".getTenLoai(getProduct($maSP)->getMaLoai())."' class='detail-content__tag-item'>
        ".getTenLoai(getProduct($maSP)->getMaLoai())."
    </a>
    ";
}
?>