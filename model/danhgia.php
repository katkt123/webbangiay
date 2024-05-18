<?php
class DanhGia {
    private $MaDanhGia;
    private $MaSP;
    private $MaKH;
    private $NoiDungDanhGia;
    private $ThoiGianDanhGia;
    private $SoTimDanhGia;

    public function __construct($MaDanhGia, $MaSP, $MaKH, $NoiDungDanhGia, $ThoiGianDanhGia, $SoTimDanhGia) {
        $this->MaDanhGia = $MaDanhGia;
        $this->MaSP = $MaSP;
        $this->MaKH = $MaKH;
        $this->NoiDungDanhGia = $NoiDungDanhGia;
        $this->ThoiGianDanhGia = $ThoiGianDanhGia;
        $this->SoTimDanhGia = $SoTimDanhGia;
    }

    // Getters and setters for each property

    public function getMaDanhGia() {
        return $this->MaDanhGia;
    }

    public function setMaDanhGia($MaDanhGia) {
        $this->MaDanhGia = $MaDanhGia;
    }

    public function getMaSP() {
        return $this->MaSP;
    }

    public function setMaSP($MaSP) {
        $this->MaSP = $MaSP;
    }

    public function getMaKH() {
        return $this->MaKH;
    }

    public function setMaKH($MaKH) {
        $this->MaKH = $MaKH;
    }

    public function getNoiDungDanhGia() {
        return $this->NoiDungDanhGia;
    }

    public function setNoiDungDanhGia($NoiDungDanhGia) {
        $this->NoiDungDanhGia = $NoiDungDanhGia;
    }

    public function getThoiGianDanhGia() {
        return $this->ThoiGianDanhGia;
    }

    public function setThoiGianDanhGia($ThoiGianDanhGia) {
        $this->ThoiGianDanhGia = $ThoiGianDanhGia;
    }

    public function getSoTimDanhGia() {
        return $this->SoTimDanhGia;
    }

    public function setSoTimDanhGia($SoTimDanhGia) {
        $this->SoTimDanhGia = $SoTimDanhGia;
    }
}
?>