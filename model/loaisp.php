<?php
class LoaiSP {
    private $MaLoai;
    private $TenLoai;

    public function __construct($MaLoai, $TenLoai) {
        $this->MaLoai = $MaLoai;
        $this->TenLoai = $TenLoai;
    }
    public function getMaLoai() {
        return $this->MaLoai;
    }

    public function setMaLoai($MaLoai) {
        $this->MaLoai = $MaLoai;
    }

    public function getTenLoai() {
        return $this->TenLoai;
    }

    public function setTenLoai($TenLoai) {
        $this->TenLoai = $TenLoai;
    }
}
?>