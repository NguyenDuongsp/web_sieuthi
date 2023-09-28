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
        $gb=$_POST['txtGiaBan'];
        $lsp=$_POST['txtLoaiSanPham'];
         //tạo và thực hiện truy vấn chèn dữ liệu vào bảng loaisach
            $sql_5="UPDATE sanpham SET TenSanPham='$tsp', MaSanPham='$msp', MaNhaCungCap='$mncc', NgaySanXuat='$$nsx', HanSuDung='$hsd', GiaBan='$$gb', LoaiSanPham='$lsp' WHERE MaSanPham='$msp'";
            $kq_5=mysqli_query($con_5, $sql_5);
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
            <table>
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
                    <td class= "col1">Giá bán</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtGiaBan" value="<?php echo $row['GiaBan'] ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Loại sản phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtLoaiSanPham" value="<?php echo $row['LoaiSanPham'] ?>" style="width:450px;">
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