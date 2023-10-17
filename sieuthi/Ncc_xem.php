<?php
    //kết nối đến DB
    $con_2= mysqli_connect('localhost', 'root', '', 'ql_sieuthi')

    or die('Lỗi kết nối');
    $mNcc=$_GET['MaNhaCungCap'];
    $sql_2 = "SELECT
    NC.MaNhaCungCap,
    NC.TenNhaCungCap,
    NC.MaSanPham,
    NC.DiaChi,
    NC.SDT,
    NC.Gmail,
    SP.TenSanPham,
    SP.Anh,
    SP.NgaySanXuat,
    SP.HanSuDung,
    SP.LoaiSanPham
FROM
    nhacungcap NC
INNER JOIN
    sanpham SP ON NC.MaSanPham = SP.MaSanPham
WHERE
    NC.MaNhaCungCap = '$mNcc'";
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
            <table class="table table-bordered table-striped" style="width:100%">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5 >XEM CHI TIẾT THÔNG TIN NHÀ CUNG CẤP</h5>
                    </td>
                </tr>
              

                <?php
                    if(isset($data_2)&& $data_2!=null){
                        $i=0;
                        while($row=mysqli_fetch_array($data_2)){
                 ?>  
                 
                <tr>
                    <td class="col1">Mã nhà cung cấp</td>
                    <td class="col2">
                        <input disable class="form-control" type="text" name="txtMaNhaCungCap" value="<?php echo $row['MaNhaCungCap'] ?>" disabled style="width:550px;height 40px;">
                    </td>

                </tr>

                <tr>
                    <td class="col1">Tên nhà cung cấp</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTenNhaCungCap"value="<?php echo $row['TenNhaCungCap'] ?>" disabled style style="width:550px;height:40px;">
                    </td>
                    
                </tr>
                <tr>
                    <td class="col1">Tên sản phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTenSanPham"value="<?php echo $row['TenSanPham'] ?>"disabled style="width:550px;height:40px;">
                    </td>
                    
                </tr>

                <tr>
                    <td class="col1">Mã Sản Phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaSanPham" value="<?php echo $row['MaSanPham'] ?>" disabled style style="width:550px;height:40px;">
                    </td>
                </tr> 


                <tr>
                    <td class="col1">Địa Chỉ</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtDiaChi" value="<?php echo $row['DiaChi'] ?>" disabled style style="width:550px;height:40px;">
                    </td>
                </tr> 
                <tr>
                    <td class= "col1">SDT</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtSDT" value="<?php echo $row['SDT'] ?>" disabled style style="width:550px;height:40px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Gmail</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtGmail" value="<?php echo $row['Gmail'] ?>" disabled style style="width:550px;height:40px;">
                    </td>   
                </tr>
                <tr>
                    <td class= "col1">Ngày sản xuất</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtNgaySanXuat" value="<?php echo $row['NgaySanXuat'] ?>" disabled style="width:550px;height:40px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Hạn sử dụng</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtHanSuDung" value="<?php echo $row['HanSuDung'] ?>" disabled style="width:550px;height:40px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Loại sản phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtLoaiSanPham" value="<?php echo $row['LoaiSanPham'] ?>" disabled style="width:550px;height:40px;">
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