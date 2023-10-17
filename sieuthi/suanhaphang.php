<?php
$msp=''; $makhohang=''; $soluong='';$ngaynhap='';$mnh='';
    //B1: kết nối đến database
$consss=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
//tạo và thực hiện truy vấn

    $mnh = $_GET['MaNhapHang'];
   
$sql4=" SELECT * FROM nhaphang where MaNhapHang='$mnh'";
$data4=mysqli_query($consss, $sql4);
//xư lý button 
if(isset($_POST['btnluu'])){

    $msp=$_POST['txtmasanpham'];
   
    $soluong=$_POST['txtsoluonghangnhap'];
    $ngaynhap=$_POST['txtngaynhap'];
   
    $tensp=$_POST['txttensp'];
    $mncc=$_POST['txtmncc'];
    $ngaysx=$_POST['txtnsx'];
    $hsd=$_POST['txthsd'];
    $sql5="UPDATE nhaphang set MaSanPham='$msp',
     SoLuongNhap='$soluong', NgayNhap='$ngaynhap',TenSanPham ='$tensp',MaNhaCungCap = '$mncc', NgaySanXuat = '$ngaysx', HanSuDung = '$hsd'
     where MaNhapHang='$mnh'";
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
        $target = "photo/".basename($image);
        $sql_h5 = "UPDATE nhaphang SET Anh='$image' WHERE MaNhapHang='$mnh'";
        $dt_H6 = mysqli_query($consss, $sql_h5);
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
          
        } 
    }
    
     $kq4=mysqli_query($consss,$sql5);
     if($kq4){
        header("location: nhaphang.php");
        exit;
     }
     else{
        echo "<script>alert('Sửa thất bại!')</script>";
     }
}

//đóng kết nối
mysqli_close($consss);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include_once './contac.php'
    ?>
    <div class="conten">

        <form method="post" action="" enctype="multipart/form-data">
            <table class="table table-bordered table-striped" style="height:100vh">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5 >SỬA THÔNG TIN NHẬP HÀNG </h5>
                    </td>
                </tr>

                <?php
                    if(isset($data4)&& $data4!=null){
                        while($row=mysqli_fetch_array($data4)){
                    ?>  
                        <tr>
                            <td class="col1">Mã nhập hàng</td>
                            <td class="col2">
                                <input disabled class="form-control" type="text" name="txtmanhaphang" value="<?php echo $row['MaNhapHang'] ?>" style="width:450px;" >
                            </td>
        
                        </tr>
                        <tr>
                            <td class="col1">Mã sản phẩm</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtmasanpham"value="<?php echo $row['MaSanPham'] ?>" style="width:450px;" readonly>
                            </td>
                            
                        </tr>
                        <tr>
                    <td class="col1">Tên sản phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txttensp"value="<?php echo $row['TenSanPham'] ?>" style="width:450px;">
                    </td>
                    
                </tr>
                <tr>
                    <td class="col1">Mã nhà cung cấp</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtmncc" value="<?php echo $row['MaNhaCungCap'] ?>" style="width:450px;">
                    </td>
                </tr>
                            <tr>
                            <td class= "col1">Số lượng</td>
                            <td class="col2">
                                <input class="form-control" type="number" name="txtsoluonghangnhap" value="<?php echo $row['SoLuongNhap'] ?>" style="width:450px;">
                            </td>   
                        </tr>
                        <tr>
                            <td class= "col1">Ngày nhập</td>
                            <td class="col2">
                                <input class="form-control" type="date" name="txtngaynhap" value="<?php echo $row['NgayNhap']  ?>" style="width:450px;">
                            </td>   
                        </tr>
                        <tr>
                    <td class= "col1">Ngày sản xuất</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtnsx" value="<?php echo $row['NgaySanXuat'] ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Hạn sử dụng</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txthsd" value="<?php echo $row['HanSuDung'] ?>" style="width:450px;">
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
                        <?php            
                        }
                    }
                ?>
                
                        <tr>
                            <td class="col1"></td>
                            <td class="col2">
                                <input class="btn btn-primary" type="submit" name="btnluu" value="Lưu" style="width:100px;">
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