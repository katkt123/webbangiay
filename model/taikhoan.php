<?php
class TaiKhoan {
    private $TenDangNhap;
    private $MatKhau;
    private $NgayTaoTK;
    private $MaQuyen;
    private $Avt;
    public function __construct($TenDangNhap, $MatKhau, $NgayTaoTK, $MaQuyen, $Avt) {
        $this->TenDangNhap = $TenDangNhap;
        $this->MatKhau = $MatKhau;
        $this->NgayTaoTK = $NgayTaoTK;
        $this->MaQuyen = $MaQuyen;
        $this->Avt = $Avt;
    }
    public function getTenDangNhap() {
        return $this->TenDangNhap;
    }

    public function setTenDangNhap($TenDangNhap) {
        $this->TenDangNhap = $TenDangNhap;
    }

    public function getMatKhau() {
        return $this->MatKhau;
    }

    public function setMatKhau($MatKhau) {
        $this->MatKhau = $MatKhau;
    }

    public function getNgayTaoTK() {
        return $this->NgayTaoTK;
    }

    public function setNgayTaoTK($NgayTaoTK) {
        $this->NgayTaoTK = $NgayTaoTK;
    }

    public function getMaQuyen() {
        return $this->MaQuyen;
    }

    public function setMaQuyen($MaQuyen) {
        $this->MaQuyen = $MaQuyen;
    }

    public function getAvt() {
        return $this->Avt;
    }

    public function setAvt($Avt) {
        $this->Avt = $Avt;
    }
}
?>