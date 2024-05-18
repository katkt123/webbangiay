<?php
class HinhAnh {
    private $idHinhAnh;
    private $src;
    private $maSP;

    public function __construct($idHinhAnh, $src, $maSP) {
        $this->idHinhAnh = $idHinhAnh;
        $this->src = $src;
        $this->maSP = $maSP;
    }

    public function getIdHinhAnh() {
        return $this->idHinhAnh;
    }

    public function setIdHinhAnh($idHinhAnh) {
        $this->idHinhAnh = $idHinhAnh;
    }

    public function getSrc() {
        return $this->src;
    }

    public function setSrc($src) {
        $this->src = $src;
    }

    public function getMaSP() {
        return $this->maSP;
    }

    public function setMaSP($maSP) {
        $this->maSP = $maSP;
    }
}
?>