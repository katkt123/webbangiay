<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/hinhanh.php');


function showListAnh($maSP){
    $db = new DTB();
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM hinhanh where MaSP=$maSP");
    $output='';
    while ($row = mysqli_fetch_assoc($kq)) {
        $output.='
        <li class="detail-show__item ">
            <img src="./assets/img/'.$row['SCR_ANH'].'" alt="" class="">
        </li>
        ';
    }
    $db->disconnect();
    return $output;
}
function getListAnh($maSP){
    $db = new DTB();
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM hinhanh where MaSP=$maSP");
    $output='';
    while ($row = mysqli_fetch_assoc($kq)) {
        $output.=$row['SCR_ANH']."|";
    }
    $db->disconnect();
    return $output;
}
?>
