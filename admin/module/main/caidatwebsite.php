<?php
// Kết nối với cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "shoestore");
$sql="SELECT *
FROM website";
$result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($result);
  $logo = $data["logo"];
  $image = $data["imghome"];
  $thuonghieu = $data["thuonghieu"];

$sql = "SELECT * FROM feedback";
$result = mysqli_query($conn, $sql);
  ?>
<style>
    .container {
  display: flex; 
  align-items: center;
  margin: 0px;
}
.form-group h5 {
  width: 300px; 
}

.change {
  width: 400px; 
}

.form-group {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  margin-left: 30px;
  width: 100%;
}

table {
  border-collapse: collapse;
}

input file, text{
  width: 300px;
  background-color: rgba(0, 0, 0, 0.9);
}

.update-button {
  color: white;
  width: 100px;
  height: 50px;
  margin: 0 auto; 
  display: block;
  border: 3px solid #ddd;
  border-radius: 10px;
  background: rgb(34,193,195);
background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(103,73,242,1) 100%);
}
.reset{
  color: white;
  width: 100px;
  height: 50px;
  margin: 0 auto; 
  display: block;
  border: 3px solid #ddd;
  border-radius: 10px;
  background: rgb(34,193,195);
  background: rgb(212,170,170);
  background: linear-gradient(0deg, rgba(212,170,170,1) 0%, rgba(255,0,0,1) 100%);
}

img{
  width: 200px; 
  height: 100px; 
  margin-right: 20px;
}
  </style>

  <div class="container">
  <form action="module/main/caidatwebsite-capnhat.php" method="post" enctype="multipart/form-data" style="width: 100%;">
  <h1>Cài đặt website</h1>
  <div class="form-group">
      <h5 for="logo">Thay đổi logo :</h5>
      <div class="change">
        <br>
        <img src="../assets/img/<?php echo $logo; ?>">
        <br>
        <input type="file" id="logo" name="logo">
      </div>
  </div>

  <div class="form-group">
      <h5 for="logo">Thay đổi hình nền trang home:</h5>
      <div class="change">
        <br>
        <img src="../assets/img/<?php echo $image; ?>">
        <br>
        <input type="file" id="img" name="img">
      </div>
  </div>
  
  <div class="form-group">
      <h5 for="logo">Tên thương hiệu:</h5>
      <input type="text" name="name" maxlength=5 placeholder="<?php echo $thuonghieu; ?>">
  </div>

  <div class="form-group" style="display: block;">
    <br></br>
    <h5>Chọn đánh giá đưa vào Feedback</h5>
    <table style="width: 100%;">
        <thead>
            <tr style="background-color: cornflowerblue;">
                <th >STT</th>
                <th>Tên</th>
                <th>Ảnh</th>
                <th>Nội dung</th>
                <th>Số sao</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
      <tr>
        <td><input type="text" readonly style="width: 20px;" name="id[]" value="<?php echo $row['Mafb']; ?>"></td>
        <td><input type="text" style="width: 100px;" name="ten[]" value="<?php echo $row['TenNgFb']; ?>"></td>
        <td>
          <ul style="padding: 0px;margin: 0px;">
            <li><img src="../assets/img/<?php echo $row['Image']; ?>"  style="width: 70px;height: 70px;border-radius: 50%;margin-bottom: 10px;"></li>
            <li><input type="file" name="avt[]"></li>
          </ul>
        </td>
        <td><textarea name="NoiDung[]" cols="50" rows="5" style="width: 100%;"><?php echo $row['NoiDung']; ?></textarea></td>
        <td><input type="number" name="SoSao[]" value="<?php echo $row['SoSao']; ?>" max="5" min="1"></td>
      </tr>
      <?php }?>
        </tbody>
  </table>
  </div>
  <div style="display: flex;">
    <button class="update-button" type="submit">Cập nhật</button>
    <input type="reset" value="Reset" class="reset">
  </div>
</form>
</div>
