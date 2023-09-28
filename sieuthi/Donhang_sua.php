<?php
    //kết nối đến DB
    $con_3= mysqli_connect('localhost', 'root', '', 'ql_sieuthi')
    or die('Lỗi kết nối');
    $mdh=$_GET['MaDonHang'];
    $sql_3="SELECT*FROM donhang WHERE MaDonHang='$mdh'";
    $data_3=mysqli_query($con_3, $sql_3);
    //xử lý button luu
    if(isset($_POST['btnLuu'])){
      
        $mKH=$_POST['txtMaKhachHang'];
        $sdt_dh=$_POST['txtSDT'];
        $gmail_dh=$_POST['txtGmail'];
        $ngaylap_dh=$_POST['txtNgayLap'];
        $tongtien_dh=$_POST['txtTongTien'];
        $tinhtrang_dh=$_POST['txtTinhTrang'];

         //tạo và thực hiện truy vấn chèn dữ liệu vào bảng loaisach
            $sql_3="UPDATE donhang SET MaKhachHang='$mKH', SDT='$sdt_dh', Gmail='$gmail_dh',
                    NgayLap='$ngaylap_dh', TongTien='$tongtien_dh', TinhTrang='$tinhtrang_dh' WHERE MaDonHang='$mdh'";
            $kq_3=mysqli_query($con_3, $sql_3);
            if($kq_3) {
                header("Quanlydonhang.php");
                exit;
            }
            else echo "<script>alert('Thêm mới thất bại!')</script>";
            
    }
    //đóng kết nối
    mysqli_close($con_3);
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
            <table>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5 >SỬA THÔNG TIN ĐƠN HÀNG</h5>
                    </td>
                </tr>

                <?php
                    if(isset($data_3)&& $data_3!=null){
                        while($row=mysqli_fetch_array($data_3)){
                 ?>  

                <tr>
                    <td class="col1">Mã đơn hàng</td>
                    <td class="col2">
                        <input disable class="form-control" type="text" name="txtMaDonHang" value="<?php echo $row['MaDonHang'] ?>" disabled style="width:450px;">
                    </td>

                </tr>

                <tr>
                    <td class="col1">Mã khách hàng</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaKhachHang"value="<?php echo $row['MaKhachHang'] ?>" style="width:450px;">
                    </td>
                    
                </tr>

                <tr>
                    <td class="col1">SDT</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtSDT" value="<?php echo $row['SDT'] ?>" style="width:450px;">
                    </td>
                </tr> 

                <tr>
                    <td class= "col1">Gmail</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtGmail" value="<?php echo $row['Gmail'] ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class="col1">Ngày lập</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtNgayLap" value="<?php echo $row['NgayLap'] ?>" style="width:450px;">
                    </td>
                </tr> 

                <tr>
                    <td class= "col1">Tổng tiền</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTongTien" value="<?php echo $row['TongTien'] ?>" style="width:450px;">
                    </td>   
                </tr>
                
                <tr>
                    <td class= "col1">Tình trạng đơn hàng</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTinhTrang" value="<?php echo $row['TinhTrang'] ?>" style="width:450px;">
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