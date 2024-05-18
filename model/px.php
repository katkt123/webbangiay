<?php
class PhieuXuat {
    private $MaPX;
    private $MaNV;
    private $MaKH;
    private $NgayDatHang;
    private $TinhTrangDH;
    private $TongTien;
    private $TongSoLuong;
    private $trangThai;

    public function __construct($MaPX, $MaNV, $MaKH, $NgayDatHang, $TinhTrangDH, $TongTien, $TongSoLuong, $trangThai) {
        $this->MaPX = $MaPX;
        $this->MaNV = $MaNV;
        $this->MaKH = $MaKH;
        $this->NgayDatHang = $NgayDatHang;
        $this->TinhTrangDH = $TinhTrangDH;
        $this->TongTien = $TongTien;
        $this->TongSoLuong = $TongSoLuong;
        $this->trangThai = $trangThai;
    }

    public function getMaPX() {
        return $this->MaPX;
    }

    public function setMaPX($MaPX) {
        $this->MaPX = $MaPX;
    }

    public function getMaNV() {
        return $this->MaNV;
    }

    public function setMaNV($MaNV) {
        $this->MaNV = $MaNV;
    }

    public function getMaKH() {
        return $this->MaKH;
    }

    public function setMaKH($MaKH) {
        $this->MaKH = $MaKH;
    }

    public function getNgayDatHang() {
        return $this->NgayDatHang;
    }

    public function setNgayDatHang($NgayDatHang) {
        $this->NgayDatHang = $NgayDatHang;
    }

    public function getTinhTrangDH() {
        return $this->TinhTrangDH;
    }

    public function setTinhTrangDH($TinhTrangDH) {
        $this->TinhTrangDH = $TinhTrangDH;
    }

    public function getTongTien() {
        return $this->TongTien;
    }

    public function setTongTien($TongTien) {
        $this->TongTien = $TongTien;
    }

    public function getTongSoLuong() {
        return $this->TongSoLuong;
    }

    public function setTongSoLuong($TongSoLuong) {
        $this->TongSoLuong = $TongSoLuong;
    }

    public function getTrangThai() {
        return $this->trangThai;
    }

    public function setTrangThai($trangThai) {
        $this->trangThai = $trangThai;
    }
}
?>