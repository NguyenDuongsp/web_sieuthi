<?php
$mhd = "";$mkh = "";$tt = "";$ntao ="";

// Kết nối đến cơ sở dữ liệu
$con1n = mysqli_connect("localhost", "root", "", "ql_sieuthi");
if (!$con1n) {
    die('Lỗi kết nối: ' . mysqli_connect_error());
}

// Lấy mã kho hàng từ tham số truyền vào
if (isset($_GET['MaHoaDon'])) {
    $mhd = $_GET['MaHoaDon'];

    // Truy vấn để lấy thông tin kho hàng
    $sql4 = "SELECT * FROM hoadon WHERE MaHoaDon='$mhd'";
    $data4 = mysqli_query($con1n, $sql4);
    if (!$data4) {
        die('Lỗi truy vấn: ' . mysqli_error($con1n));
    }
}

// Xử lý khi nhấn nút Lưu
if (isset($_POST['btnLuu'])) {
    $mhd = $_POST['txtmahd'];
    $mkh = $_POST['txtmakh'];
    $tt = $_POST['txttt'];
    $ntao = $_POST['txtntao'];
    

    // Cập nhật thông tin kho hàng
    $sql5 = "UPDATE hoadon SET  MaKhachHang='$mkh', TongTien='$tt', NgayTao='$ntao' WHERE MaHoaDon='$mhd'";
    $kq4 = mysqli_query($con1n, $sql5);
    if ($kq4) {
        mysqli_close($con1n);
        header("Location: hoadon.php");
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
    <title></title>
    
</head>
<body>
<?php 
    include_once'./contac.php';

    ?>

    <div class="conten">
        <form method="post" action="">
            <table  class="table table-striped">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5>Sửa Thông Tin Hóa Đơn</h5>
                    </td>
                </tr>

                <?php
                if (isset($data4) && $data4 != null) {
                    while ($row = mysqli_fetch_array($data4)) {
                        ?>  
                        <tr>
                            <td class="col1">Mã hóa đơn</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtmahd" value="<?php echo $row['MaHoaDon'] ?>" style="width:450px;" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Mã khách hàng</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtmakh" value="<?php echo $row['MaKhachHang'] ?>" style="width:450px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Tổng tiền</td>
                            <td class="col2">
                                <input class="form-control" type="number" name="txttt" value="<?php echo $row['TongTien'] ?>" style="width:450px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">NgayTao</td>
                            <td class="col2">
                                <input class="form-control" type="date" name="txtntao" value="<?php echo $row['NgayTao'] ?>" style="width:450px;">
                            </td>   
                        </tr>
                        
                    <?php            
                    }
                }
                ?>

                <tr>
                    <td class="col1"></td>
                    <td class="col2">
                        <input class="btn btn-primary" type="submit" name="btnLuu" value = "Lưu">
                        
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>