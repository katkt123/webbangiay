<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');
    if($_POST['action']=='AnDanhGia'){
        $maDanhGia=intval($_POST['maDanhGia']);
        $query = "UPDATE danhgia SET hide = 0 WHERE maDanhGia = $maDanhGia";
        $db = new DTB();
        $result = mysqli_query($db->getConnection(), $query);
        echo "Ẩn thành công";
    }
?>