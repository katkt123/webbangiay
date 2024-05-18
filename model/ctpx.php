<?php
    class ChiTietPhieuXuat {
        private $MaPX;
        private $MaSP;
        private $SoLuong;
        private $GiaBan;
        private $SizeSP;
        private $trangThai;

        public function __construct($MaPX, $MaSP, $SoLuong, $GiaBan, $SizeSP, $trangThai) {
            $this->MaPX = $MaPX;
            $this->MaSP = $MaSP;
            $this->SoLuong = $SoLuong;
            $this->GiaBan = $GiaBan;
            $this->SizeSP = $SizeSP;
            $this->trangThai = $trangThai;
        }

        public function getMaPX() {
            return $this->MaPX;
        }

        public function setMaPX($MaPX) {
            $this->MaPX = $MaPX;
        }

        public function getMaSP() {
            return $this->MaSP;
        }

        public function setMaSP($MaSP) {
            $this->MaSP = $MaSP;
        }

        public function getSoLuong() {
            return $this->SoLuong;
        }

        public function setSoLuong($SoLuong) {
            $this->SoLuong = $SoLuong;
        }

        public function getGiaBan() {
            return $this->GiaBan;
        }

        public function setGiaBan($GiaBan) {
            $this->GiaBan = $GiaBan;
        }

        public function getSizeSP() {
            return $this->SizeSP;
        }

        public function setSizeSP($SizeSP) {
            $this->SizeSP = $SizeSP;
        }

        public function getTrangThai() {
            return $this->trangThai;
        }

        public function setTrangThai($trangThai) {
            $this->trangThai = $trangThai;
        }
    }
?>