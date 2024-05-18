<?php
class ChitietPhieuNhap {
    public $maSp;
    public $sizeSP;
    public $soLuong;

    public function __construct($maSp, $sizeSP, $soLuong) {
        $this->maSp = $maSp;
        $this->sizeSP = $sizeSP;
        $this->soLuong = $soLuong;
    }

    // Getter and Setter methods for each property
    public function getMaSp() {
        return $this->maSp;
    }

    public function setMaSp($maSp) {
        $this->maSp = $maSp;
    }

    public function getSizeSP() {
        return $this->sizeSP;
    }

    public function setSizeSP($sizeSP) {
        $this->sizeSP = $sizeSP;
    }

    public function getSoLuong() {
        return $this->soLuong;
    }

    public function setSoLuong($soLuong) {
        $this->soLuong = $soLuong;
    }

    // Other methods of the class
}
?>