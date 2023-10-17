<?php
    //kết nối đến DB
    $con_2= mysqli_connect('localhost', 'root', '', 'ql_sieuthi')
    or die('Lỗi kết nối');
    $mNcc=$_GET['MaNhaCungCap'];
    $sql_2="SELECT*FROM nhacungcap WHERE MaNhaCungCap='$mNcc'";
    $data_2=mysqli_query($con_2, $sql_2);
    //xử lý button luu
    if(isset($_POST['btnLuu'])){
        $tNcc=$_POST['txtTenNhaCungCap'];
        $msp=$_POST['txtMaSanPham'];
        $dc_ncc=$_POST['txtDiaChi'];
        $sdt_ncc=$_POST['txtSDT'];
        $gmail_ncc=$_POST['txtGmail'];
         //tạo và thực hiện truy vấn chèn dữ liệu vào bảng loaisach
            $sql_2="UPDATE nhacungcap SET TenNhaCungCap='$tNcc', MaSanPham='$msp', DiaChi='$dc_ncc', SDT=' $sdt_ncc', Gmail='$gmail_ncc' WHERE MaNhaCungCap='$mNcc'";
            $kq_2=mysqli_query($con_2, $sql_2);
            if($kq_2) {
                header("location:Quanlynhacungcap.php");
                exit;
            }
            else echo "<script>alert('Thêm mới thất bại!')</script>";
            
    }
    //đóng kết nối
    mysqli_close($con_2);
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
            <table class="table table-bordered table-striped" style="height:100vh" >
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5 >SỬA THÔNG TIN NHÀ CUNG CẤP</h5>
                    </td>
                </tr>

                <?php
                    if(isset($data_2)&& $data_2!=null){
                        while($row=mysqli_fetch_array($data_2)){
                 ?>  

                <tr>
                    <td class="col1">Mã nhà cung cấp</td>
                    <td class="col2">
                        <input disable class="form-control" type="text" name="txtMaNhaCungCap" value="<?php echo $row['MaNhaCungCap'] ?>" disabled style="width:450px;">
                    </td>

                </tr>

                <tr>
                    <td class="col1">Tên nhà cung cấp</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTenNhaCungCap"value="<?php echo $row['TenNhaCungCap'] ?>" style="width:450px;">
                    </td>
                    
                </tr>

                <tr>
                    <td class="col1">Mã Sản Phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaSanPham" value="<?php echo $row['MaSanPham'] ?>" style="width:450px;">
                    </td>
                </tr> 

                <tr>
                    <td class= "col1">SDT</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtSDT" value="<?php echo $row['SDT'] ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class="col1">Địa Chỉ</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtDiaChi" value="<?php echo $row['DiaChi'] ?>" style="width:450px;">
                    </td>
                </tr> 

                <tr>
                    <td class= "col1">Gmail</td>
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