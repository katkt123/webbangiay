<?php
    class CTSizeSP {
        private $MaSP;
        private $SizeSP;
        private $SoLuong;
        public function __construct($MaSP, $SizeSP, $SoLuong) {
            $this->MaSP = $MaSP;
            $this->SizeSP = $SizeSP;
            $this->SoLuong = $SoLuong;
        }
        public function getMaSP() {
            return $this->MaSP;
        }

        public function setMaSP($MaSP) {
            $this->MaSP = $MaSP;
        }

        public function getSizeSP() {
            return $this->SizeSP;
        }

        public function setSizeSP($SizeSP) {
            $this->SizeSP = $SizeSP;
        }

        public function getSoLuong() {
            return $this->SoLuong;
        }

        public function setSoLuong($SoLuong) {
            $this->SoLuong = $SoLuong;
        }
    }
?>