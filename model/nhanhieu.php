<?php
class NhanHieu {
    private $MaNhanHieu;
    private $TenNhanHieu;
    
    public function __construct($maNhanHieu, $tenNhanHieu) {
        $this->MaNhanHieu = $maNhanHieu;
        $this->TenNhanHieu = $tenNhanHieu;
    }
    
    public function getMaNhanHieu() {
        return $this->MaNhanHieu;
    }
    
    public function setMaNhanHieu($maNhanHieu) {
        $this->MaNhanHieu = $maNhanHieu;
    }
    
    public function getTenNhanHieu() {
        return $this->TenNhanHieu;
    }
    
    public function setTenNhanHieu($tenNhanHieu) {
        $this->TenNhanHieu = $tenNhanHieu;
    }
}
?>