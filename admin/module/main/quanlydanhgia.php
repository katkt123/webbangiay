<style
>
    .img-pr{
        width: 40px;
        height: 40px;
        border-radius: 1000px;
        overflow: hidden;
    }
    .img-pr img{
        width: 100%;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<div class="tableBox ">
<div class="tableTitle">
        <p>Danh sách dánh giá</p>
        <div class="table-func">
            <div class="filter-container">
                <select id="filterSelect">
                    <option value="">Rate</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            
        </div>
    </div>
    <table id="myTable" class="table table-striped " style="width: 100%;">
        <thead>
            <tr>
                <th style="min-width: 100px;">Mã DG</th>
                <th style="min-width: 100px;">Mã SP</th>
                <th style="min-width: 150px;">Mã Khách hàng</th>
                <th>Nội dung</th>
                <th style="min-width: 180px;">Thời gian</th>
                <th style="min-width: 120px;">Số sao</th>
                <th style="min-width: 120px;">Hành động</th>

            </tr>
        </thead>
        <tbody>
            <?php     
            require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/danhgia-act.php');
            showListDanhGiaAdmin();
            ?>
        </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    
    $(document).ready(function(){
        var btnDanhGias=document.querySelectorAll(".btnDanhGia");
        btnDanhGias.forEach(element => {
            element.addEventListener('click', function(){
                if(confirm("Bạn có chăc chắn muốn ẩn không")){
                    $.ajax({
                        url: "./module/main/quanlydanhgia-an.php",
                        method: "POST",
                        data: {
                            maDanhGia:element.parentElement.parentElement.children[0].textContent,
                            action: "AnDanhGia"
                        },
                        success: function(data){
                            element.parentElement.parentElement.remove();
                            alert(data);
                        }
                    });
                }
            }); 
        });
        $('#filterSelect').on('change', function() {
            $('#myTable').DataTable().column(5).search($(this).val()).draw();
            console.log($(this).val());
        });
    });
</script>