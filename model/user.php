<?php
class User {
    public $Ma;
    public $TenDangNhap;
    public $HoTen;
    public $NgaySinh;
    public $SDT;
    public $Email;
    public $DiaChi;
    public $GioiTinh;
    
    // Constructor
    public function __construct($Ma, $TenDangNhap, $HoTen, $NgaySinh, $SDT, $Email, $DiaChi, $GioiTinh) {
        $this->Ma = $Ma;
        $this->TenDangNhap = $TenDangNhap;
        $this->HoTen = $HoTen;
        $this->NgaySinh = $NgaySinh;
        $this->SDT = $SDT;
        $this->Email = $Email;
        $this->DiaChi = $DiaChi;
        $this->GioiTinh = $GioiTinh;
    }
    
    // Getters
    public function getMa() {
        return $this->Ma;
    }
    
    public function getTenDangNhap() {
        return $this->TenDangNhap;
    }
    
    public function getHoTen() {
        return $this->HoTen;
    }
    
    public function getNgaySinh() {
        return $this->NgaySinh;
    }
    
    public function getSDT() {
        return $this->SDT;
    }
    
    public function getEmail() {
        return $this->Email;
    }
    
    public function getDiaChi() {
        return $this->DiaChi;
    }
    
    public function getGioiTinh() {
        return $this->GioiTinh;
    }
    
    // Setters
    public function setMa($Ma) {
        $this->Ma = $Ma;
    }
    
    public function setTenDangNhap($TenDangNhap) {
        $this->TenDangNhap = $TenDangNhap;
    }
    
    public function setHoTen($HoTen) {
        $this->HoTen = $HoTen;
    }
    
    public function setNgaySinh($NgaySinh) {
        $this->NgaySinh = $NgaySinh;
    }
    
    public function setSDT($SDT) {
        $this->SDT = $SDT;
    }
    
    public function setEmail($Email) {
        $this->Email = $Email;
    }
    
    public function setDiaChi($DiaChi) {
        $this->DiaChi = $DiaChi;
    }
    
    public function setGioiTinh($GioiTinh) {
        $this->GioiTinh = $GioiTinh;
    }
    
    // Other methods and functions can be added here
}
?>