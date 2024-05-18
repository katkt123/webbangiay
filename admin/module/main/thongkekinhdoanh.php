<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "SELECT TongSoLuong, TongTien FROM phieuxuat WHERE TinhTrangDH = 'Đã hoàn thành'";
$result = $conn->query($sql);
$tongSoLuong = array();
$tongTien = array();
$sql = "SELECT nh.TenNhanHieu, SUM(ctpx.SoLuong) AS TongSoLuong FROM phieuxuat px
      JOIN ctpx ON px.MaPX = ctpx.MaPX
      JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
      JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
      WHERE px.TinhTrangDH = 'Đã hoàn thành'
      GROUP BY nh.TenNhanHieu";
$sql = "SELECT loai.TenLoai, SUM(ctpx.SoLuong) AS TongSoLuong
      FROM phieuxuat px
      JOIN ctpx ON px.MaPX = ctpx.MaPX
      JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
      JOIN loaisp loai ON sp.MaLoai = loai.MaLoai
      WHERE px.TinhTrangDH = 'Đã hoàn thành'
      GROUP BY loai.TenLoai";
$sql_nhanhieu = "SELECT nh.TenNhanHieu, SUM(ctpx.SoLuong) AS TongSoLuong
                 FROM phieuxuat px
                 JOIN ctpx ON px.MaPX = ctpx.MaPX
                 JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
                 JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
                 WHERE px.TinhTrangDH = 'Đã hoàn thành'
                 GROUP BY nh.TenNhanHieu;";

$result_nhanhieu = $conn->query($sql_nhanhieu);
$data_nhanhieu = array();

if ($result_nhanhieu->num_rows > 0) {
    while($row = $result_nhanhieu->fetch_assoc()) {
        $data_nhanhieu[] = array(
            'label' => $row['TenNhanHieu'],
            'value' => $row['TongSoLuong']
        );
    }
}

$sql_loaisp = "SELECT loai.TenLoai, SUM(ctpx.SoLuong) AS TongSoLuong
               FROM phieuxuat px
               JOIN ctpx ON px.MaPX = ctpx.MaPX
               JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
               JOIN loaisp loai ON sp.MaLoai = loai.MaLoai
               WHERE px.TinhTrangDH = 'Đã hoàn thành'
               GROUP BY loai.TenLoai;";

$result_loaisp = $conn->query($sql_loaisp);
$data_loaisp = array();

if ($result_loaisp->num_rows > 0) {
    while($row = $result_loaisp->fetch_assoc()) {
        $data_loaisp[] = array(
            'label' => $row['TenLoai'],
            'value' => $row['TongSoLuong']
        );
    }
}
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tongSoLuong[] = $row["TongSoLuong"];
        $tongTien[] = $row["TongTien"];
    }
}
$sql_doanhthu = "SELECT SUM(doanhthusanpham) AS DoanhThu
                 FROM (
                   SELECT ctpx.MaSP, ctpx.SoLuong, ctpx.GiaBan, (ctpx.GiaBan * 0.1 * ctpx.SoLuong) AS doanhthusanpham
                   FROM ctpx
                   JOIN phieuxuat px ON ctpx.MaPX = px.MaPX
                   WHERE px.TinhTrangDH = 'Đã hoàn thành'
                 ) AS temp";

$result_doanhthu = $conn->query($sql_doanhthu);
$doanhthu = 0;

if ($result_doanhthu->num_rows > 0) {
    $row = $result_doanhthu->fetch_assoc();
    $doanhthu = $row['DoanhThu'];
}

$conn->close();
?>
<style>
   :root {
  --background-color: #ccfbff; 
}

.tongTienDisplay {
  background-color: var(--background-color); 
  color: #333; 
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 10px;
  text-align: center;
}

.tongTienDisplay h3 {
  margin-top: 0;
  margin-bottom: 5px;
}

.tongTienDisplay span {
  font-size: 18px;
  font-weight: bold;
}
.chart-container {
    display: flex;
    justify-content: center;
    gap: 20px; 
}

.chart-container canvas {
    max-width: 400px; 
    max-height: 400px; 
}
#myChart {
  width: 50px; 
  height: 50px; 
}
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<div class="content">
    <div class="tableBox">
        <div class="tableTitle">
            <p>Thống kê Doanh Thu</p>
            <div class="table-func">
                <button type="button" class="btn btn-primary Thongkesp-button" data-bs-toggle="modal" data-bs-target="#myModal">Thống kê sản phẩm bán chạy theo khoản thời gian</button>
                <?php
                echo '
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Thống kê sản phẩm bán chạy theo khoảng thời gian</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form id="date-range-form">
                                    <div class="form-group">
                                        <label for="start-date">Ngày bắt đầu:</label>
                                        <input type="date" class="form-control" id="start-date" name="start-date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end-date">Ngày kết thúc:</label>
                                        <input type="date" class="form-control" id="end-date" name="end-date" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" id="submit-date-range">OK</button>
                            </div>
                        </div>
                    </div>
                </div>';
                ?>
                
                <button type="button" class="btn btn-primary thongke-button" data-bs-toggle="modal" data-bs-target="#thongkeModal">Thống kê</button>
                <div class="modal fade" id="thongkeModal" tabindex="-1" aria-labelledby="thongkeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="thongkeModalLabel">Thống kê</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="startDate-1" class="form-label">Ngày bắt đầu</label>
                                    <input type="date" class="form-control" id="startDate-1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="endDate-1" class="form-label">Ngày kết thúc</label>
                                    <input type="date" class="form-control" id="endDate-1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productCategory" class="form-label">Loại sản phẩm</label>
                                    <select class="form-select" id="productCategory">
                                        <option value="">Tất cả</option>
                                        <?php
                                        
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "shoestore";
                                        $conn = new mysqli($servername, $username, $password, $dbname);
            
                                     
                                        if ($conn->connect_error) {
                                            die("Kết nối thất bại: " . $conn->connect_error);
                                        }
            
                                       
                                        $sql = "SELECT TenLoai FROM loaisp WHERE hide = 1";
                                        $result = $conn->query($sql);
            
                                     
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row["TenLoai"] . "'>" . $row["TenLoai"] . "</option>";
                                            }
                                        }
            
                             
                                        $conn->close();
                                        ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" id="submit-date-range-thongke">Thống kê</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary loc-button" data-bs-toggle="modal" data-bs-target="#locsanphamModal">Lọc</button>
                <div class="modal fade" id="locsanphamModal" tabindex="-1" role="dialog" aria-labelledby="locsanphamLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="locsanphamLabel">Lọc sản phẩm</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="locTheo">Lọc theo:</label>
                                    <select class="form-control" id="locTheo">
                                        <option value="ngay">Ngày</option>
                                        <option value="nhanhieu">Nhãn Hiệu</option>
                                        <option value="loai">Loại</option>
                                    </select>
                                </div>
                                <div class="form-group" id="ngayInput" style="display: none;">
                                    <label for="ngay">Chọn ngày:</label>
                                    <input type="date" class="form-control" id="ngay" name="ngay">
                                </div>
                                <div class="form-group" id="nhanhieuInput" style="display: none;">
                                <label for="productCategory-1" class="form-label">Nhãn Hiệu</label>
                                    <select class="form-select" id="productCategory-1">
                                        <?php
                                      
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "shoestore";
                                        $conn = new mysqli($servername, $username, $password, $dbname);
            
                                        
                                        if ($conn->connect_error) {
                                            die("Kết nối thất bại: " . $conn->connect_error);
                                        }
            
                                    
                                        $sql = "SELECT TenNhanHieu FROM nhanhieu WHERE hide = 1";
                                        $result = $conn->query($sql);
            
                                    
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row["TenNhanHieu"] . "'>" . $row["TenNhanHieu"] . "</option>";
                                            }
                                        }
            
                              
                                        $conn->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="loaiInput" style="display: none;">
                                <label for="productCategory-2" class="form-label">Loại sản phẩm</label>
                                    <select class="form-select" id="productCategory-2">
                                        
                                        <?php
                                   
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "shoestore";
                                        $conn = new mysqli($servername, $username, $password, $dbname);
            
                         
                                        if ($conn->connect_error) {
                                            die("Kết nối thất bại: " . $conn->connect_error);
                                        }
            
                                    
                                        $sql = "SELECT TenLoai FROM loaisp WHERE hide = 1";
                                        $result = $conn->query($sql);
            
                                  
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row["TenLoai"] . "'>" . $row["TenLoai"] . "</option>";
                                            }
                                        }
            
                    
                                        $conn->close();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" id="loc-submit">Lọc</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tongTienDisplay">
            <div id="tongSoLuongDisplay"></div>
            <canvas id="myChart"></canvas>
            <div class="chart-container">
                <canvas id="donutChartNhanHieu"></canvas>
                <canvas id="donutChartLoaiSP"></canvas>
            </div>
            <div id="productTable"></div>
           

        </div>
    </div>
</div>
</div>
<script>
    var doanhthu = <?php echo $doanhthu; ?>;
</script>
<script>
    var tongSoLuong = <?php echo json_encode($tongSoLuong); ?>;
    var tongTien = <?php echo json_encode($tongTien); ?>;
    var ctx = document.getElementById('myChart').getContext('2d');

    var tongTienHoaDon = tongTien.reduce((total, currentValue) => total + currentValue, 0);
    tongTienHoaDon = tongTien.join('+');
    tongTienHoaDon = tongTienHoaDon.split('+').reduce((total, currentValue) => total + parseInt(currentValue), 0);

    var tongSoLuongSanPham = tongSoLuong.join('+');
    tongSoLuongSanPham = tongSoLuongSanPham.split('+').reduce((total, currentValue) => total + parseInt(currentValue), 0);

    // Plugin để hiển thị giá trị ở dưới mỗi cột
    Chart.register({
        id: 'valueLabelsPlugin',
        afterDatasetsDraw(chart) {
            const { ctx, data } = chart;
            ctx.save();
            ctx.font = '12px Arial';
            ctx.fillStyle = 'black';
            data.datasets.forEach((dataset, datasetIndex) => {
                const meta = chart.getDatasetMeta(datasetIndex);
                meta.data.forEach((value, index) => {
                    if (datasetIndex === 1) {
                        const data = dataset.data[index];
                        ctx.fillText(`${data}`, value.x, value.y + 20);
                    }
                });
            });
            ctx.restore();
        }
    });

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: tongSoLuong.map((value, index) => `Đơn hàng ${index + 1}`),
            datasets: [{
                    label: 'Số lượng sản phẩm đã bán',
                    data: tongSoLuong,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    borderRadius: 5,
                    hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)'
                },
                {
                    label: 'Tổng tiền đơn hàng',
                    data: tongTien,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    borderRadius: 5,
                    hoverBackgroundColor: 'rgba(255, 99, 132, 0.8)',
                    hidden: true
                }
            ]
        },
        options: {
            plugins: {
                title: {
                    display: false
                },
                valueLabelsPlugin: {
                    display: true,
                    font: {
                        family: 'Arial',
                        size: 14
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            family: 'Arial',
                            size: 14
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            family: 'Arial',
                            size: 14
                        }
                    }
                }
            },
            layout: {
                padding: 20
            }
        },
        plugins: [{
            id: 'totalValueBoxes',
            beforeInit: (chart) => {
                const totalTienHoaDon = tongTienHoaDon.toLocaleString('en-US');
            const totalSoLuongSanPham = tongSoLuongSanPham;

            const totalTienBox = document.createElement('div');
            totalTienBox.classList.add('tongTienDisplay');
            totalTienBox.innerHTML = `<h3>Tổng tiền đơn hàng</h3><span>${totalTienHoaDon} (VNĐ)</span>`;

            const totalSoLuongBox = document.createElement('div');
            totalSoLuongBox.classList.add('tongTienDisplay');
            totalSoLuongBox.innerHTML = `<h3>Tổng số lượng sản phẩm đã bán</h3><span>${totalSoLuongSanPham}</span>`;

            const doanhThuBox = document.createElement('div');
            doanhThuBox.classList.add('tongTienDisplay');
            doanhThuBox.innerHTML = `<h3>Doanh thu bán được</h3><span>${doanhthu.toLocaleString('en-US')} (VNĐ)</span>`;

            const chartContainer = chart.canvas.parentNode;
            chartContainer.appendChild(totalTienBox);
            chartContainer.appendChild(totalSoLuongBox);
            chartContainer.appendChild(doanhThuBox);
            }
        }]
    });
</script>

<script>
    var dataDonutChartNhanHieu = <?php echo json_encode($data_nhanhieu); ?>;
    var dataDonutChartLoaiSP = <?php echo json_encode($data_loaisp); ?>;

    var configDonutChartNhanHieu = {
        type: 'doughnut',
        data: {
            labels: dataDonutChartNhanHieu.map(item => item.label),
            datasets: [{
                data: dataDonutChartNhanHieu.map(item => item.value),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ]
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Thống kê nhãn hiệu bán được'
                }
            }
        }
    };

    var configDonutChartLoaiSP = {
        type: 'doughnut',
        data: {
            labels: dataDonutChartLoaiSP.map(item => item.label),
            datasets: [{
                data: dataDonutChartLoaiSP.map(item => item.value),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ]
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Thống kê loại sản phẩm bán được'
                }
            }
        }
    };
    var donutChartNhanHieu = new Chart(
        document.getElementById('donutChartNhanHieu'),
        configDonutChartNhanHieu
    );
    var donutChartLoaiSP = new Chart(
        document.getElementById('donutChartLoaiSP'),
        configDonutChartLoaiSP
    );
</script>

<script>
 $(document).ready(function() {
  $('#submit-date-range').click(function() {
    var startDate = $('#start-date').val();
    var endDate = $('#end-date').val();
    if (startDate > endDate) {
      alert("Lỗi ngày nhập");
      return;
    }
    $.ajax({
      url: 'module/main/dulieu/get_sales_data.php',
      type: 'POST',
      data: {
        start_date: startDate,
        end_date: endDate
      },
      success: function(response) {
        var data = JSON.parse(response);
        var tongSoLuongSanPham = data.tong_so_luong.reduce((total, item) => total + item.value, 0);
        var tongTienHoaDon = data.tong_tien[0]?.value ?? 0;

        if (!data.san_pham || data.san_pham.length === 0 || (tongSoLuongSanPham === 0 && tongTienHoaDon === 0)) {
          alert("Không tồn tại đơn hàng nào trong khoảng thời gian đã chọn.");
          return;
        }

        if (data.nhan_hieu && data.loai_sp && data.tong_tien && data.tong_so_luong) {
          var tongSoLuongSanPham = data.tong_so_luong.reduce((total, item) => total + item.value, 0);

          // Xóa các phần tử hiển thị cũ
          $('.tongTienDisplay').remove();

          if (data.tong_tien[0]?.value) {
            var tongTienHoaDon = data.tong_tien[0].value;

            const totalTienBox = document.createElement('div');
            totalTienBox.classList.add('tongTienDisplay');
            totalTienBox.innerHTML = `<h3>Tổng tiền đơn hàng</h3><span>${tongTienHoaDon.toLocaleString('en-US')} (VNĐ)</span>`;

            const chartContainer = $('#myChart').parent();
            chartContainer.append(totalTienBox);
          } else {
            const chartContainer = $('#myChart').parent();
            const noDataMessage = document.createElement('div');
            noDataMessage.classList.add('tongTienDisplay');
            noDataMessage.innerHTML = '<h3>Không có dữ liệu về tổng tiền đơn hàng</h3>';
            chartContainer.append(noDataMessage);
          }

          const totalSoLuongBox = document.createElement('div');
          totalSoLuongBox.classList.add('tongTienDisplay');
          totalSoLuongBox.innerHTML = `<h3>Tổng số lượng sản phẩm đã bán</h3><span>${tongSoLuongSanPham}</span>`;

          const chartContainer = $('#myChart').parent();
          chartContainer.append(totalSoLuongBox);
          if (data.doanh_thu && data.doanh_thu[0]?.value) {
    const doanhThu = data.doanh_thu[0].value;
    const doanhThuString = doanhThu.toLocaleString('en-US', { maximumFractionDigits: 0 });
    const doanhThuBox = document.createElement('div');
    doanhThuBox.classList.add('tongTienDisplay');
    doanhThuBox.innerHTML = `<h3>Doanh thu</h3><span>${doanhThuString} (VNĐ)</span>`;
    chartContainer.append(doanhThuBox);
} else {
    const chartContainer = $('#myChart').parent();
    const noDataMessage = document.createElement('div');
    noDataMessage.classList.add('tongTienDisplay');
    noDataMessage.innerHTML = '<h3>Không có dữ liệu về doanh thu</h3>';
    chartContainer.append(noDataMessage);
}
          // Cập nhật dữ liệu cho biểu đồ tròn nhãn hiệu
          configDonutChartNhanHieu.data.labels = data.nhan_hieu.map(item => item.label);
          configDonutChartNhanHieu.data.datasets[0].data = data.nhan_hieu.map(item => item.value);

          if (!donutChartNhanHieu) {
            donutChartNhanHieu = new Chart(
              document.getElementById('donutChartNhanHieu'),
              configDonutChartNhanHieu
            );
          } else {
            donutChartNhanHieu.update();
          }

          // Cập nhật dữ liệu cho biểu đồ tròn loại sản phẩm
          configDonutChartLoaiSP.data.labels = data.loai_sp.map(item => item.label);
          configDonutChartLoaiSP.data.datasets[0].data = data.loai_sp.map(item => item.value);

          if (!donutChartLoaiSP) {
            donutChartLoaiSP = new Chart(
              document.getElementById('donutChartLoaiSP'),
              configDonutChartLoaiSP
            );
          } else {
            donutChartLoaiSP.update();
          }

          // Cập nhật dữ liệu cho biểu đồ cột
          var configMyChart = {
            type: 'bar',
            data: {
              labels: data.nhan_hieu.map(item => item.label),
              datasets: [
                {
                  label: 'Số lượng sản phẩm đã bán',
                  data: data.nhan_hieu.map(item => item.value),
                  backgroundColor: 'rgba(75, 192, 192, 0.6)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 2,
                  borderRadius: 5,
                  hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)'
                }
              ]
            },
            options: {
              plugins: {
                title: {
                  display: false
                },
                valueLabelsPlugin: {
                  display: true,
                  font: {
                    family: 'Arial',
                    size: 14
                  }
                }
              },
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    font: {
                      family: 'Arial',
                      size: 14
                    }
                  }
                },
                x: {
                  ticks: {
                    font: {
                      family: 'Arial',
                      size: 14
                    }
                  }
                }
              },
              layout: {
                padding: 20
              }
            },
            plugins: [
             
            ]
          };

          if (!myChart) {
            myChart = new Chart(document.getElementById('myChart'), configMyChart);
          } else {
            myChart.data.labels = data.nhan_hieu.map(item => item.label);
            myChart.data.datasets[0].data = data.nhan_hieu.map(item => item.value);
            myChart.update();
          }

          $('#productTable').empty();
          if (data.san_pham && data.san_pham.length > 0) {
            var productTable = $('<table>').addClass('table table-striped');
            var thead = $('<thead>').append('<tr><th>Tên sản phẩm</th><th>Nhãn hiệu</th><th>Tổng Số Lượng</th></tr>');
            var tbody = $('<tbody>');

            $.each(data.san_pham, function(index, product) {
              var row = $('<tr>');
              row.append('<td>' + product.TenSP + '</td>');
              row.append('<td>' + product.TenNhanHieu + '</td>');
              row.append('<td>' + product.TongSoLuong + '</td>');
              tbody.append(row);
            });

            productTable.append(thead).append(tbody);
            $('#productTable').html(productTable);
            $('#productTable table').DataTable({
                                    language: {
                                        search: "Tìm kiếm:"
                                    }
                                });
          }
        }

        // Đóng modal sau khi cập nhật dữ liệu
        $('#myModal').modal('hide');
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
});
</script>
<script>
    $(document).ready(function() {
        $('.loc-button').click(function() {
            $('#locsanpham').modal('show');
        });

        $('#locTheo').change(function() {
            var locTheo = $(this).val();
            $('#ngayInput').hide();
            $('#nhanhieuInput').hide();
            $('#loaiInput').hide();

            if (locTheo === 'ngay') {
                $('#ngayInput').show();
            } else if (locTheo === 'nhanhieu') {
                $('#nhanhieuInput').show();
            } else if (locTheo === 'loai') {
                $('#loaiInput').show();
            }
        });

        $('#loc-submit').click(function() {
            var locTheo = $('#locTheo').val();
            if (locTheo === 'ngay') {
                var ngay = $('#ngay').val();
                if (ngay !== '') {
                    $.ajax({
                        url: 'module/main/dulieu/loc.php',
                        type: 'POST',
                        data: { ngay: ngay },
                        success: function(response) {
                            var data = JSON.parse(response);
                            updateCharts(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    alert('Vui lòng chọn ngày');
                }
              } else if (locTheo === 'nhanhieu') {
        var nhanhieu = $('#productCategory-1').val();
        if (nhanhieu !== '') {
            $.ajax({
                url: 'module/main/dulieu/locnhanhieu.php',
                type: 'POST',
                data: { nhan_hieu: nhanhieu }, 
                success: function(response) {
                    var data = JSON.parse(response);
                    updateCharts(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } else {
            alert('Vui lòng nhập nhãn hiệu');
        }
      } else if (locTheo === 'loai') {
        var loai = $('#productCategory-2').val();
        if (loai !== '') {
            $.ajax({
                url: 'module/main/dulieu/locloai.php',
                type: 'POST',
                data: { loai: loai },
                success: function(response) {
                    var data = JSON.parse(response);
                    updateCharts(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } else {
            alert('Vui lòng nhập loại sản phẩm');
        }
    }
    function updateCharts(data) {

        if (data.nhan_hieu && data.nhan_hieu.length > 0 && data.loai_sp && data.loai_sp.length > 0 && data.tong_tien && data.tong_tien.length > 0 && data.tong_so_luong && data.tong_so_luong.length > 0) {
        // Phá hủy các đối tượng Chart cũ
        if (donutChartNhanHieu) donutChartNhanHieu.destroy();
        if (donutChartLoaiSP) donutChartLoaiSP.destroy();
        if (myChart) myChart.destroy();

        var tongTienHoaDon = data.tong_tien[0].value;
        var tongSoLuongSanPham = data.tong_so_luong.reduce((total, item) => total + item.value, 0);

        // Xóa các phần tử hiển thị cũ
        $('.tongTienDisplay').remove();

        // Tạo các phần tử hiển thị mới
        const totalTienBox = document.createElement('div');
        totalTienBox.classList.add('tongTienDisplay');
        totalTienBox.innerHTML = `<h3>Tổng tiền đơn hàng</h3><span>${tongTienHoaDon.toLocaleString('en-US')} (VNĐ)</span>`;

        const totalSoLuongBox = document.createElement('div');
        totalSoLuongBox.classList.add('tongTienDisplay');
        totalSoLuongBox.innerHTML = `<h3>Tổng số lượng sản phẩm đã bán</h3><span>${tongSoLuongSanPham}</span>`;
        

        // Thêm các phần tử mới vào DOM
        const chartContainer = $('#myChart').parent();
        chartContainer.append(totalTienBox, totalSoLuongBox);
        if (data.doanh_thu && data.doanh_thu.length > 0) {
    const doanhThu = data.doanh_thu[0].value;
    const doanhThuString = doanhThu.toLocaleString('en-US', { maximumFractionDigits: 0 });

    const doanhThuBox = document.createElement('div');
    doanhThuBox.classList.add('tongTienDisplay');
    doanhThuBox.innerHTML = `<h3>Doanh thu</h3><span>${doanhThuString} (VNĐ)</span>`;
    chartContainer.append(doanhThuBox);
}

        // Cập nhật dữ liệu cho biểu đồ tròn nhãn hiệu
        configDonutChartNhanHieu.data.labels = data.nhan_hieu.map(item => item.label);
        configDonutChartNhanHieu.data.datasets[0].data = data.nhan_hieu.map(item => item.value);

        // Tạo đối tượng Chart mới cho biểu đồ tròn nhãn hiệu
        donutChartNhanHieu = new Chart(
            document.getElementById('donutChartNhanHieu'),
            configDonutChartNhanHieu
        );


        configDonutChartLoaiSP.data.labels = data.loai_sp.map(item => item.label);
        configDonutChartLoaiSP.data.datasets[0].data = data.loai_sp.map(item => item.value);

        
        donutChartLoaiSP = new Chart(
            document.getElementById('donutChartLoaiSP'),
            configDonutChartLoaiSP
        );

       
        var configMyChart = {
            type: 'bar',
            data: {
                labels: data.nhan_hieu.map(item => item.label),
                datasets: [{
                    label: 'Số lượng sản phẩm đã bán',
                    data: data.nhan_hieu.map(item => item.value),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    borderRadius: 5,
                    hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)'
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: false
                    },
                    valueLabelsPlugin: {
                        display: true,
                        font: {
                            family: 'Arial',
                            size: 14
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                family: 'Arial',
                                size: 14
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                family: 'Arial',
                                size: 14
                            }
                        }
                    }
                },
                layout: {
                    padding: 20
                }
            }
        };

        $('#productTable').empty();

    
        if (data.san_pham && data.san_pham.length > 0) {
            var productTable = $('<table>').addClass('table table-striped');
            var thead = $('<thead>').append('<tr><th>Tên sản phẩm</th><th>Nhãn hiệu</th><th>Loại sản phẩm</th><th>Tổng Số Lượng</th></tr>');
            var tbody = $('<tbody>');

            $.each(data.san_pham, function(index, product) {
                var row = $('<tr>');
                row.append('<td>' + product.TenSP + '</td>');
                row.append('<td>' + product.TenNhanHieu + '</td>');
                row.append('<td>' + product.TenLoai + '</td>');
                row.append('<td>' + product.TongSoLuong + '</td>');
                tbody.append(row);
            });

            productTable.append(thead).append(tbody);
            $('#productTable').append(productTable);
            $('#productTable table').DataTable({
                                language: {
                                    search: "Tìm kiếm:"
                                }
                            });
        }

        myChart = new Chart(document.getElementById('myChart'), configMyChart);
    } else {
        alert('Không có đơn hàng nào tồn tại.');
    }

        myChart = new Chart(document.getElementById('myChart'), configMyChart);
    }

    $('#locsanphamModal').modal('hide');
        });

    });
    
</script>
<script>
   $('#submit-date-range-thongke').click(function() {
            var startDate = $('#startDate-1').val();
            var endDate = $('#endDate-1').val();
            var tenLoai = $('#productCategory').val();
            if (tenLoai === "") {
                tenLoai = "ALL";
            }

            $.ajax({
                url: 'module/main/dulieu/thongke1loai.php',
                type: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    ten_loai: tenLoai
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var tongSoLuongSanPham = data.tong_so_luong.reduce((total, item) => total + item.value, 0);
                    var tongTienHoaDon = data.tong_tien[0]?.value ?? 0;

                    if (!data.san_pham || data.san_pham.length === 0 || (tongSoLuongSanPham === 0 && tongTienHoaDon === 0)) {
                        alert("Không tồn tại đơn hàng nào trong khoảng thời gian đã chọn.");
                        return;
                    }

                    if (data.nhan_hieu && data.loai_sp && data.tong_tien && data.tong_so_luong) {
                        if (data.nhan_hieu && data.loai_sp && data.tong_tien && data.tong_so_luong) {
                // Tính toán tổng tiền đơn hàng và tổng số lượng sản phẩm
                var tongTienHoaDon = data.tong_tien[0].value;
                var tongSoLuongSanPham = data.tong_so_luong.reduce((total, item) => total + item.value, 0);
                var tongTienDoanhThu = data.doanh_thu[0].value;

                // Xóa các phần tử hiển thị cũ
                $('.tongTienDisplay').remove();
                

                const totalTienBox = document.createElement('div');
                totalTienBox.classList.add('tongTienDisplay');
                totalTienBox.innerHTML = `<h3>Tổng tiền đơn hàng</h3><span>${tongTienHoaDon.toLocaleString('en-US')} (VNĐ)</span>`;

                const totalSoLuongBox = document.createElement('div');
                totalSoLuongBox.classList.add('tongTienDisplay');
                totalSoLuongBox.innerHTML = `<h3>Tổng số lượng sản phẩm đã bán</h3><span>${tongSoLuongSanPham}</span>`;

                const chartContainer = $('#myChart').parent();
                chartContainer.append(totalTienBox, totalSoLuongBox);
                if (data.doanh_thu && data.doanh_thu.length > 0) {
    const doanhThu = data.doanh_thu[0].value;
    const doanhThuString = doanhThu.toLocaleString('en-US', { maximumFractionDigits: 0 });

    const doanhThuBox = document.createElement('div');
    doanhThuBox.classList.add('tongTienDisplay');
    doanhThuBox.innerHTML = `<h3>Doanh thu</h3><span>${doanhThuString} (VNĐ)</span>`;
    chartContainer.append(doanhThuBox);
}

                // Cập nhật dữ liệu cho biểu đồ tròn nhãn hiệu
                configDonutChartNhanHieu.data.labels = data.nhan_hieu.map(item => item.label);
                configDonutChartNhanHieu.data.datasets[0].data = data.nhan_hieu.map(item => item.value);

                if (!donutChartNhanHieu) {
                    donutChartNhanHieu = new Chart(
                        document.getElementById('donutChartNhanHieu'),
                        configDonutChartNhanHieu
                    );
                } else {
                    donutChartNhanHieu.update();
                }

                // Cập nhật dữ liệu cho biểu đồ tròn loại sản phẩm
                configDonutChartLoaiSP.data.labels = data.loai_sp.map(item => item.label);
                configDonutChartLoaiSP.data.datasets[0].data = data.loai_sp.map(item => item.value);

                if (!donutChartLoaiSP) {
                    donutChartLoaiSP = new Chart(
                        document.getElementById('donutChartLoaiSP'),
                        configDonutChartLoaiSP
                    );
                } else {
                    donutChartLoaiSP.update();
                }

                // Cập nhật dữ liệu cho biểu đồ cột
                var configMyChart = {
                    type: 'bar',
            data: {
              labels: data.nhan_hieu.map(item => item.label),
              datasets: [
                {
                  label: 'Số lượng sản phẩm đã bán',
                  data: data.nhan_hieu.map(item => item.value),
                  backgroundColor: 'rgba(75, 192, 192, 0.6)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 2,
                  borderRadius: 5,
                  hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)'
                }
              ]
            },
            options: {
              plugins: {
                title: {
                  display: false
                },
                valueLabelsPlugin: {
                  display: true,
                  font: {
                    family: 'Arial',
                    size: 14
                  }
                }
              },
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    font: {
                      family: 'Arial',
                      size: 14
                    }
                  }
                },
                x: {
                  ticks: {
                    font: {
                      family: 'Arial',
                      size: 14
                    }
                  }
                }
              },
              layout: {
                padding: 20
              }
            },
            plugins: [
             
            ]
                };

                if (!myChart) {
                    myChart = new Chart(document.getElementById('myChart'), configMyChart);
                } else {
                    myChart.data.labels = data.nhan_hieu.map(item => item.label);
                    myChart.data.datasets[0].data = data.nhan_hieu.map(item => item.value);
                    myChart.update();
                }
            }

                        $('#productTable').empty();

                        if (data.san_pham && data.san_pham.length > 0) {
                            var productTable = $('<table>').addClass('table table-striped');
                            var thead = $('<thead>').append('<tr><th>Tên sản phẩm</th><th>Nhãn hiệu</th><th>loại</th><th>Tổng Số Lượng</th></tr>');
                            var tbody = $('<tbody>');

                            $.each(data.san_pham, function(index, product) {
                                var row = $('<tr>');
                                row.append('<td>' + product.TenSP + '</td>');
                                row.append('<td>' + product.TenNhanHieu + '</td>');
                                row.append('<td>' + product.TenLoai + '</td>');
                                row.append('<td>' + product.TongSoLuong + '</td>');
                                tbody.append(row);
                            });

                            productTable.append(thead).append(tbody);
                            $('#productTable').append(productTable);

                            // Khởi tạo DataTables cho bảng sản phẩm
                            $('#productTable table').DataTable({
                                language: {
                                    search: "Tìm kiếm:"
                                }
                            });
                        }

                        $('#thongkeModal').modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
</script>