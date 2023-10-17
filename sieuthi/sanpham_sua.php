<?php
    //kết nối đến DB
    $con_5= mysqli_connect('localhost', 'root', '', 'ql_sieuthi')
    or die('Lỗi kết nối');
    $msp=$_GET['MaSanPham'];
    $sql_5="SELECT*FROM sanpham WHERE MaSanPham='$msp'";
    $data_5=mysqli_query($con_5, $sql_5);
    //xử lý button luu
    if(isset($_POST['btnLuu'])){
        $tsp=$_POST['txtTenSanPham'];
        $mncc=$_POST['txtMaNhaCungCap'];
        $nsx=$_POST['txtNgaySanXuat'];
        $hsd=$_POST['txtHanSuDung'];
        $k = $_POST['txtKeHang'];
        $gb = $_POST['txtGiaBan'];
        $dvt = $_POST['txtDonViTinh'];
        $lsp = $_POST['txtLoaiSanPham'];
        $sl = $_POST['txtSoLuong'];
         //tạo và thực hiện truy vấn chèn dữ liệu vào bảng loaisach
          // Upload ảnh
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];

    if ($file_size > 2097152) {
        $errors[] = 'Kích thước file không được lớn hơn 2MB';
    }

    $image = $_FILES['image']['name'];
    $target = "photo/" . basename($image);
    $sql_h5 = "UPDATE sanpham SET Anh='$image' WHERE MaSanPham='$msp'";
    $dt_5 = mysqli_query($con_5, $sql_h5);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // Xử lý tải lên ảnh thành công
    } else {
        // Xử lý tải lên ảnh thất bại
    }
}

// Thực hiện truy vấn cập nhật dữ liệu
$sql_5 = "UPDATE sanpham SET TenSanPham='$tsp', MaSanPham='$msp', MaNhaCungCap='$mncc', NgaySanXuat='$nsx', HanSuDung='$hsd',KeHang='$k', GiaBan='$gb',DonViTinh='$dvt', LoaiSanPham='$lsp',SoLuong='$sl' WHERE MaSanPham='$msp'";
$kq_5 = mysqli_query($con_5, $sql_5);

if ($kq_5) {
    header("location:Quanlysanpham.php");
    exit;
} else {
    echo "<script>alert('Thêm mới thất bại!')</script>";
}
            
            if($kq_5) {
                header("location:Quanlysanpham.php");
                exit;
            }
            else echo "<script>alert('Thêm mới thất bại!')</script>";
            
    }
    //đóng kết nối
    mysqli_close($con_5);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
   
   .highlight{
         
          background-Color : #202126;
          border-Left :3px solid #dce1ea;
      }
  </style>

</head>
<body>
    
    <?php 
    include_once'./contac.php';

    ?>

    <div class="conten">
        <form method="post" action="">
            <table class="table table-bordered table-striped" style="height:100vh">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5 >SỬA THÔNG TIN SẢN PHẨM</h5>
                    </td>
                </tr>

                <?php
                    if(isset($data_5)&& $data_5!=null){
                        while($row=mysqli_fetch_array($data_5)){
                 ?>  

                <tr>
                    <td class="col1">Mã sản phẩm</td>
                    <td class="col2">
                        <input disable class="form-control" type="text" name="txtMaSanPham" value="<?php echo $row['MaSanPham'] ?>" disabled style="width:450px;">
                    </td>

                </tr>
                <tr>
                    <td> Hình Ảnh</td>
                    <td>
                    <input type="hidden" name="size" value="1000000"> 
                        <input type="file" name="image"> 
                        <!-- <button type="submit" name="upload">POST</button> -->
                        
                    </td>
                </tr>
                <tr>
                    <td class="col1">Tên sản phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTenSanPham"value="<?php echo $row['TenSanPham'] ?>" style="width:450px;">
                    </td>
                    
                </tr>

                <tr>
                    <td class="col1">Mã nhà cung cấp</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaNhaCungCap" value="<?php echo $row['MaNhaCungCap'] ?>" style="width:450px;">
                    </td>
                </tr> 

                <tr>
                    <td class= "col1">Ngày sản xuất</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtNgaySanXuat" value="<?php echo $row['NgaySanXuat'] ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Hạn sử dụng</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtHanSuDung" value="<?php echo $row['HanSuDung'] ?>" style="width:450px;">
                    </td>   
                </tr>
                <tr>
    <td class="col1">Kệ hàng</td>
    <td class="col2">
        <select class="form-control" name="txtKeHang" style="width:450px;">
            <option value="">-- CHỌN KỆ HÀNG --</option>
            <option value="Kệ 1" <?php if ($row['KeHang'] == 'Kệ 1') echo 'selected'; ?>>Kệ 1</option>
            <option value="Kệ 2" <?php if ($row['KeHang'] == 'Kệ 2') echo 'selected'; ?>>Kệ 2</option>
            <option value="Kệ 3" <?php if ($row['KeHang'] == 'Kệ 3') echo 'selected'; ?>>Kệ 3</option>
            <option value="Kệ 4" <?php if ($row['KeHang'] == 'Kệ 4') echo 'selected'; ?>>Kệ 4</option>
            <!-- Thêm các tùy chọn khác tại đây -->
        </select>
    </td>
</tr>
                <tr>
                    <td class= "col1">Giá bán</td>
                    <td class="col2">
                        <input class="form-control" type="number" name="txtGiaBan" value="<?php echo $row['GiaBan'] ?>" style="width:450px;">
                    </td>   
                </tr>
                <tr>
    <td class="col1">Đơn vị tính</td>
    <td class="col2">
        <select class="form-control" name="txtDonViTinh" style="width:450px;">
            <option value="">-- CHỌN ĐƠN VỊ TÍNH --</option>
            <option value="Cái" <?php if ($row['DonViTinh'] == 'Cái') echo 'selected'; ?>>Cái</option>
            <option value="Hộp" <?php if ($row['DonViTinh'] == 'Hộp') echo 'selected'; ?>>Hộp</option>
            <option value="Thùng" <?php if ($row['DonViTinh'] == 'Thùng') echo 'selected'; ?>>Thùng</option>
            <option value="Gói" <?php if ($row['DonViTinh'] == 'Gói') echo 'selected'; ?>>Gói</option>
            <option value="Túi" <?php if ($row['DonViTinh'] == 'Túi') echo 'selected'; ?>>Túi</option>
            <option value="Lọ" <?php if ($row['DonViTinh'] == 'Lọ') echo 'selected'; ?>>Lọ</option>
            <option value="Lon" <?php if ($row['DonViTinh'] == 'Lon') echo 'selected'; ?>>Lon</option>
            <option value="Thỏi" <?php if ($row['DonViTinh'] == 'Thỏi') echo 'selected'; ?>>Thỏi</option>
            <option value="Chai" <?php if ($row['DonViTinh'] == 'Chai') echo 'selected'; ?>>Chai</option>
            <!-- Thêm các tùy chọn khác tại đây -->
        </select>
    </td>
</tr>
<tr>
    <td class="col1">Loại sản phẩm</td>
    <td class="col2">
        <select class="form-control" name="txtLoaiSanPham" style="width:450px;">
            <option value="">-- CHỌN LOẠI SẢN PHẨM --</option>
            <option value="Gia Vị"          <?php if ($row['LoaiSanPham'] == 'Gia Vị')         echo 'selected'; ?>>Gia Vị</option>
            <option value="Nước Giải Khát " <?php if ($row['LoaiSanPham'] == 'Nước Giải Khát') echo 'selected'; ?>>Nước Giải Khát</option>
            <option value="Đồ ăn vặt"       <?php if ($row['LoaiSanPham'] == 'Đồ ăn vặt')      echo 'selected'; ?>>Đồ ăn vặt</option>
            <option value="Mĩ Phẩm"         <?php if ($row['LoaiSanPham'] == 'Mĩ Phẩm')        echo 'selected'; ?>>Mĩ Phẩm</option>
            <option value="Đồ uống có cồn " <?php if ($row['LoaiSanPham'] == 'Đồ uống có cồn') echo 'selected'; ?>>Đồ uống có cồn</option>
            <option value="Đồ ăn nhanh " <?php if ($row['LoaiSanPham'] == 'Đồ ăn nhanh') echo 'selected'; ?>>Đồ ăn nhanh</option>
            
            <!-- Thêm các tùy chọn khác tại đây -->
        </select>
    </td>
</tr>
<tr>
                    <td class= "col1">Số Lượng</td>
                    <td class="col2">
                        <input class="form-control" type="number" name="txtSoLuong" value="<?php echo $row['SoLuong'] ?>" style="width:450px;">
                    </td>   
                </tr>
                <?php            
                        }
                    }
                ?>

                <tr>
                    <td class="col1"></td>
                    <td class="col2">
                        <input class="btn btn-primary" type="submit" name="btnLuu" value="Lưu" style="width:100px;">
                    </td>
                    
                </tr>
            </table>
        </form>
    </div>
    <style>
        .search-add-filter{
            display: none;
        }
        .form-control{
            width: 200px;
        }
    </style>
</body>
</html>