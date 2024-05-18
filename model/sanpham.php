<?php
class SanPham {
    private $maSP;
    private $tenSP;
    private $soSaoDanhGia;
    private $soLuotDanhGia;
    private $moTa;
    private $hinhAnh;
    private $sanPhamMoi;
    private $sanPhamHot;
    private $giaCu;
    private $giaMoi;
    private $soLuongDaBan;
    private $maNhanHieu;
    private $maLoai;

    function __construct($maSP, $tenSP, $soSaoDanhGia, $soLuotDanhGia, $moTa, $hinhAnh, $sanPhamMoi, $sanPhamHot, $giaCu, $giaMoi, $soLuongDaBan, $maNhanHieu, $maLoai) {
        $this->maSP = $maSP;
        $this->tenSP = $tenSP;
        $this->soSaoDanhGia = $soSaoDanhGia;
        $this->soLuotDanhGia = $soLuotDanhGia;
        $this->moTa = $moTa;
        $this->hinhAnh = $hinhAnh;
        $this->sanPhamMoi = $sanPhamMoi;
        $this->sanPhamHot = $sanPhamHot;
        $this->giaCu = $giaCu;
        $this->giaMoi = $giaMoi;
        $this->soLuongDaBan = $soLuongDaBan;
        $this->maNhanHieu = $maNhanHieu;
        $this->maLoai = $maLoai;
    }

    // Getters and setters for each property go here
    public function getMaSP() {
        return $this->maSP;
    }
    public function setMaSP($maSP) {
        $this->maSP = $maSP;
    }
    public function getTenSP() {
        return $this->tenSP;
    }
    public function setTenSP($tenSP) {
        $this->tenSP = $tenSP;
    }
    public function getSoSaoDanhGia() {
        return $this->soSaoDanhGia;
    }
    public function setSoSaoDanhGia($soSaoDanhGia) {
        $this->soSaoDanhGia = $soSaoDanhGia;
    }
    public function getSoLuotDanhGia() {
        return $this->soLuotDanhGia;
    }
    public function setSoLuotDanhGia($soLuotDanhGia) {
        $this->soLuotDanhGia = $soLuotDanhGia;
    }
    public function getMoTa() {
        return $this->moTa;
    }
    public function setMoTa($moTa) {
        $this->moTa = $moTa;
    }
    public function getHinhAnh() {
        return $this->hinhAnh;
    }
    public function setHinhAnh($hinhAnh) {
        $this->hinhAnh = $hinhAnh;
    }
    public function getSanPhamMoi() {
        return $this->sanPhamMoi;
    }
    public function setSanPhamMoi($sanPhamMoi) {
        $this->sanPhamMoi = $sanPhamMoi;
    }
    public function getSanPhamHot() {
        return $this->sanPhamHot;
    }
    public function setSanPhamHot($sanPhamHot) {
        $this->sanPhamHot = $sanPhamHot;
    }
    public function getGiaCu() {
        return $this->giaCu;
    }
    public function setGiaCu($giaCu) {
        $this->giaCu = $giaCu;
    }
    public function getGiaMoi() {
        return $this->giaMoi;
    }
    public function setGiaMoi($giaMoi) {
        $this->giaMoi = $giaMoi;
    }
    public function getSoLuongDaBan() {
        return $this->soLuongDaBan;
    }
    public function setSoLuongDaBan($soLuongDaBan) {
        $this->soLuongDaBan = $soLuongDaBan;
    }
    public function getMaNhanHieu() {
        return $this->maNhanHieu;
    }
    public function setMaNhanHieu($maNhanHieu) {
        $this->maNhanHieu = $maNhanHieu;
    }
    public function getMaLoai() {
        return $this->maLoai;
    }
    public function setMaLoai($maLoai) {
        $this->maLoai = $maLoai;
    }
}
?>