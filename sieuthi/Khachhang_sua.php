<?php
    //kết nối đến DB
    $con_1 = mysqli_connect('localhost', 'root', '', 'ql_sieuthi')
    or die('Lỗi kết nối');
    $mKH=$_GET['MaKhachHang'];
    $sql_1="SELECT*FROM khachhang WHERE MaKhachHang='$mKH'";
    $data_1=mysqli_query($con_1, $sql_1);
    //xử lý button luu
    if(isset($_POST['btnLuu'])){
        $tKH=$_POST['txtTenKhachHang'];
        $dcKH=$_POST['txtTenTaiKhoan'];
        $SDT=$_POST['txtSDT'];
        $Gmail=$_POST['txtGmail'];

         //tạo và thực hiện truy vấn chèn dữ liệu vào bảng loaisach
            $sql_1="UPDATE khachhang SET TenKhachHang='$tKH', TenTaiKhoan='$dcKH', SDT='$SDT', Gmail='$Gmail' WHERE MaKhachHang='$mKH'";
            $kq_1=mysqli_query($con_1, $sql_1);
            if($kq_1) {
                header("location:Quanlykhachhang.php");
                exit;
            }
            else echo "<script>alert('Thêm mới thất bại!')</script>";
            
    }
    //đóng kết nối
    mysqli_close($con_1);
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
                        <h5 >SỬA THÔNG TIN KHÁCH HÀNG</h5>
                    </td>
                </tr>

                <?php
                    if(isset($data_1)&& $data_1!=null){
                        while($row=mysqli_fetch_array($data_1)){
                 ?>  

                <tr>
                    <td class="col1">Mã khách hàng</td>
                    <td class="col2">
                        <input disable class="form-control" type="text" name="txtMaKhachHang" value="<?php echo $row['MaKhachHang'] ?>" disabled style="width:450px;">
                    </td>

                </tr>

                <tr>
                    <td class="col1">Tên khách hàng</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTenKhachHang"value="<?php echo $row['TenKhachHang'] ?>" style="width:450px;">
                    </td>
                    
                </tr>

                <tr>
                    <td class="col1">Tên tài khoản</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTenTaiKhoan" value="<?php echo $row['TenTaiKhoan'] ?>" style="width:450px;">
                    </td>
                </tr> 

                <tr>
                    <td class= "col1">Số điện thoại</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtSDT" value="<?php echo $row['SDT'] ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Email</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtGmail" value="<?php echo $row['Gmail'] ?>" style="width:450px;">
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