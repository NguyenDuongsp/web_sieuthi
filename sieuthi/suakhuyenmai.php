<?php
$mkm="";$tenkm="";$ngaybatdau="";$ngayketthuc="";$phantramkhuyenmai="";$mota="";
    //B1: kết nối đến database
$consss=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
//tạo và thực hiện truy vấn

    $mkm = $_GET['MaKhuyenMai'];
   
$sql4=" SELECT * FROM khuyenmai where MaKhuyenMai='$mkm'";
$data4=mysqli_query($consss, $sql4);
//xư lý button 
if(isset($_POST['btnLuu'])){

    $mkm=$_POST['txtmakm'];
   
    $tenkm=$_POST['txttkm'];
    $ngaybatdau=$_POST['txtngaybatdau'];
    $ngayketthuc=$_POST['txtngayketthuc'];
    $phantramkhuyenmai=$_POST['txttile'];
    $mota=$_POST['txtmota'];

    $sql5="UPDATE khuyenmai set MaKhuyenMai='$mkm',
     TenKhuyenMai='$tenkm', NgayBatDau='$ngaybatdau', NgayKetThuc = '$ngayketthuc', PhanTramKhuyenMai = '$phantramkhuyenmai', MoTa = '$mota' 
     where MaKhuyenMai='$mkm'";
     
     $kq4=mysqli_query($consss,$sql5);
     if($kq4){
        header("location: khuyenmai.php");
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
                        <h5 >SỬA THÔNG TIN KHUYẾN MÃI </h5>
                    </td>
                </tr>

                <?php
                    if(isset($data4)&& $data4!=null){
                        while($row=mysqli_fetch_array($data4)){
                    ?>  
                        <tr>
                            <td class="col1">Mã khuyến mãi</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtmakm" value="<?php echo $row['MaKhuyenMai'] ?>" style="width:450px;">
                            </td>
        
                        </tr>
                        <tr>
                            <td class="col1">Tên khuyến mãi</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txttkm"value="<?php echo $row['TenKhuyenMai'] ?>" style="width:450px;">
                            </td>
                            
                        </tr>
                       
                            <tr>
                            <td class= "col1">Ngày bắt đầu</td>
                            <td class="col2">
                                <input class="form-control" type="number" name="txtngaybatdau" value="<?php echo $row['NgayBatDau'] ?>" style="width:450px;">
                            </td>   
                        </tr>
                        <tr>
                            <td class= "col1">Ngày kết thúc</td>
                            <td class="col2">
                                <input class="form-control" type="date" name="txtngayketthuc" value="<?php echo $row['NgayKetThuc']  ?>" style="width:450px;">
                            </td>   
                        </tr>
                        <tr>
                            <td class= "col1">Phần Trăm khuyến mãi</td>
                            <td class="col2">
                                <input class="form-control" type="number" name="txttile" value="<?php echo $row['PhanTramKhuyenMai']  ?>" style="width:450px;">
                            </td>   
                        </tr>
                        <tr>
                            <td class= "col1">Mô tả</td>
                            <td class="col2">
                                <input class="form-control" type="date" name="txtmota" value="<?php echo $row['MoTa']  ?>" style="width:450px;">
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