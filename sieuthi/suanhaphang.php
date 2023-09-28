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
if(isset($_POST['btnLuu'])){

    $msp=$_POST['txtmasanpham'];
   
    $soluong=$_POST['txtsoluonghangnhap'];
    $ngaynhap=$_POST['txtngaynhap'];

    $sql5="UPDATE nhaphang set MaSanPham='$msp',
     SoLuongNhap='$soluong', NgayNhap='$ngaynhap' 
     where MaNhapHang='$mnh'";
     
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

        <form method="post" action="">
            <table>
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
                                <input class="form-control" type="text" name="txtmanhaphang" value="<?php echo $row['MaNhapHang'] ?>" style="width:450px;">
                            </td>
        
                        </tr>
                        <tr>
                            <td class="col1">Mã sản phẩm</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtmasanpham"value="<?php echo $row['MaSanPham'] ?>" style="width:450px;">
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
</body>
</html>