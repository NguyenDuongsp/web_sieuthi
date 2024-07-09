<?php
    //kết nối đến DB
    $con_2= mysqli_connect('localhost', 'root', '', 'ql_sieuthi')

    or die('Lỗi kết nối');
    $mhd=$_GET['MaHoaDon'];
    $sql_2 = "SELECT 
    h.MaHoaDon, 
    h.MaKhachHang,
    h.TongTien,
    h.NgayTao, 
    s.TenSanPham, 
    s.GiaBan, 
    s.DonViTinh,
    s.SoLuong,
    s.MaSanPham
FROM hoadon h
JOIN sanpham s ON h.MaSanPham = s.MaSanPham
WHERE h.MaHoaDon = '$mhd'";
    $data_2=mysqli_query($con_2, $sql_2);
   
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
            <table class="table table-bordered table-striped" style="height:100vh">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5 >XEM CHI TIẾT THÔNG TIN HÓA ĐƠN</h5>
                    </td>
                </tr>
              

                <?php
                    if(isset($data_2)&& $data_2!=null){
                        $i=0;
                        while($row=mysqli_fetch_array($data_2)){
                 ?>  
                 
                <tr>
                    <td class="col1">Mã Hóa Đơn</td>
                    <td class="col2">
                    <input disabled class="form-control" type="text" name="txtmahd" value="<?php echo $row['MaHoaDon'] ?>" disabled style="width:550px;height:40px;">
                    </td>
                </tr>
                <tr>
                    <td class="col1">Mã Khách Hàng</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtmakh"value="<?php echo $row['MaKhachHang'] ?>" disabled  style="width:550px;height:40px;">
                    </td>
                    
                </tr>
                <tr>
                    <td class= "col1">Ngày Tạo</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtntao" value="<?php echo $row['NgayTao'] ?>" disabled style="width:550px;height:40px;">
                    </td>   
                </tr>
                <tr>
                    <td class="col1">Mã Sản Phẩm</td>
                    <td class="col2">
                    <input disabled class="form-control" type="text" name="txtMaSanPham" value="<?php echo $row['MaSanPham'] ?>" disabled style="width:550px;height:40px;">
                    </td>
                </tr> 
                <tr>
                    <td class= "col1">Số Lượng</td>
                    <td class="col2">
                        <input class="form-control" type="number" name="txtSoLuong" value="<?php echo $row['SoLuong'] ?>" disabled style style="width:550px;height:40px;">
                    </td>   
                </tr> 
                <tr>
                    <td class= "col1">Giá Bán</td>
                    <td class="col2">
                        <input class="form-control" type="number" name="txtGiaBan" value="<?php echo $row['GiaBan'] ?>" disabled style="width:550px;height:40px;">
                    </td>   
                </tr>
                <tr>
                    <td class="col1">Tổng Tiền</td>
                    <td class="col2">
                    <input disabled class="form-control" type="number" name="txttt" value="<?php echo $row['TongTien'] ?>" disabled style="width:550px;height:40px;">
                    </td>
                </tr> 
                
                <tr>
    <td class="col1">Đơn vị tính</td>
    <td class="col2">
        <select class="form-control" name="txtDonViTinh" style="width:450px;" disabled>
            <option value="">-- CHỌN ĐƠN VỊ TÍNH --</option>
            <option value="Cái" <?php if ($row['DonViTinh'] == 'Cái') echo 'selected'; ?>>Cái</option>
            <option value="Hộp" <?php if ($row['DonViTinh'] == 'Hộp') echo 'selected'; ?>>Hộp</option>
            <option value="Thùng" <?php if ($row['DonViTinh'] == 'Thùng') echo 'selected'; ?>>Thùng</option>
            <option value="Gói" <?php if ($row['DonViTinh'] == 'Gói') echo 'selected'; ?>>Gói</option>
            <option value="Túi" <?php if ($row['DonViTinh'] == 'Túi') echo 'selected'; ?>>Túi</option>
            <option value="Bịch" <?php if ($row['DonViTinh'] == 'Bịch') echo 'selected'; ?>>Bịch</option>
            <!-- Thêm các tùy chọn khác tại đây -->
        </select>
    </td>
</tr>


                

                <?php            
                        }
                    }
                ?>

                
            </table>
        </form>
    </div>
    <style>
        .search-add-filter{
            display: none;
        }
        .form-control{
            width: 550px;
            height:40px;
        }
    </style>
</body>
</html>