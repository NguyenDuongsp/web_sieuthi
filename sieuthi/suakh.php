<?php
$msp = "";$tsp = "";$sl = "";$mnh = "";$nnk = "";$mncc ="";

// Kết nối đến cơ sở dữ liệu
$consss = mysqli_connect("localhost", "root", "", "ql_sieuthi");
if (!$consss) {
    die('Lỗi kết nối: ' . mysqli_connect_error());
}

// Lấy mã kho hàng từ tham số truyền vào
if (isset($_GET['MaSanPham'])) {
    $msp = $_GET['MaSanPham'];

    // Truy vấn để lấy thông tin kho hàng
    $sql4 = "SELECT * FROM khohang WHERE MaSanPham='$msp'";
    $data4 = mysqli_query($consss, $sql4);
    if (!$data4) {
        die('Lỗi truy vấn: ' . mysqli_error($consss));
    }
}

// Xử lý khi nhấn nút Lưu
if (isset($_POST['btnLuu'])) {
    $msp = $_POST['txtmasp'];
    $tsp = $_POST['txttensp'];
    $sl = $_POST['txtsl'];
    $mnh = $_POST['txtmnh'];
    $nnk = $_POST['txtnnk'];
    $mncc = $_POST['txtmncc'];

    // Cập nhật thông tin kho hàng
    $sql5 = "UPDATE khohang SET   TenSanPham='$tsp', SoLuong='$sl', MaNhapHang='$mnh', NgayNhapKho = '$nnk', MaNhaCungCap = '$mncc' WHERE MaSanPham='$msp'";
    $kq4 = mysqli_query($consss, $sql5);
    if ($kq4) {
        mysqli_close($consss);
        header("Location: dskhohang.php");
        exit;
    } else {
        echo "<script>alert('Sửa thất bại!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Kho Hàng</title>
   
</head>
<body>
    <form class="" method="post" action="">
        <?php include_once './contac.php' ?>
        <div class="conten ">
            <table class="table table-bordered table-striped" style="height:100vh">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5>Sửa Thông Tin Kho Hàng</h5>
                    </td>
                </tr>

                <?php
                if (isset($data4) && $data4 != null) {
                    while ($row = mysqli_fetch_array($data4)) {
                        ?>  
                        <tr>
                            <td class="col1">Mã sản phẩm</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtmasp" value="<?php echo $row['MaSanPham'] ?>" style="width:450px;" readonly> 
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Tên sản phẩm</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txttensp" value="<?php echo $row['TenSanPham'] ?>" style="width:450px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Số lượng</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtsl" value="<?php echo $row['SoLuong'] ?>" style="width:450px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Mã nhập hàng</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtmnh" value="<?php echo $row['MaNhapHang'] ?>" style="width:450px;">
                            </td>   
                        </tr>
                        <tr>
                            <td class="col1">Ngày nhập kho</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtnnk" value="<?php echo $row['NgayNhapKho'] ?>" style="width:450px;">
                            </td>   
                        </tr>
                        <tr>
                            <td class="col1">Mã nhà cung cấp</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtmncc" value="<?php echo $row['MaNhaCungCap'] ?>" style="width:450px;">
                            </td>   
                        </tr>
                    <?php            
                    }
                }
                ?>

                <tr>
                    <td class="col1"></td>
                    <td class="col2">
                        <input style ="font-size: 15px;" class="btn btn-primary" type="submit" name="btnLuu" value ="Lưu">
                        
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