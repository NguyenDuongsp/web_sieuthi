<?php
$mnv = '';
$tnv = '';
$cv = '';
$em = '';
$sdt = '';

// Kết nối đến cơ sở dữ liệu
$consss = mysqli_connect("localhost", "root", "", "ql_sieuthi");
if (!$consss) {
    die('Lỗi kết nối: ' . mysqli_connect_error());
}

// Lấy mã kho hàng từ tham số truyền vào
if (isset($_GET['MaNhanVien'])) {
    $mnv = $_GET['MaNhanVien'];

    // Truy vấn để lấy thông tin kho hàng
    $sql4 = "SELECT * FROM nhanvien WHERE MaNhanVien='$mnv'";
    $data4 = mysqli_query($consss, $sql4);
    if (!$data4) {
        die('Lỗi truy vấn: ' . mysqli_error($consss));
    }
}

// Xử lý khi nhấn nút Lưu
if (isset($_POST['btnLuu'])) {
    $mnv = $_POST['txtmanv'];
    $tnv = $_POST['txttennv'];
    $cv = $_POST['txtcv'];
    $em = $_POST['txtem'];
    $sdt = $_POST['txtsdt'];

    // Cập nhật thông tin kho hàng
    $sql5 = "UPDATE nhanvien SET  TenNhanVien='$tnv', ChucVu='$cv', Email='$em', SDT = '$sdt' WHERE MaNhanVien='$mnv'";
    $kq4 = mysqli_query($consss, $sql5);
    if ($kq4) {
        mysqli_close($consss);
        header("Location: dsnv.php");
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
    <title>Sửa Thông Tin Nhân Viên</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
</head>
<body>
    <div class="conten">
        <form method="post" action="">
            <table  class="table table-striped">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5>Sửa Thông Tin Nhân VIên</h5>
                    </td>
                </tr>

                <?php
                if (isset($data4) && $data4 != null) {
                    while ($row = mysqli_fetch_array($data4)) {
                        ?>  
                        <tr>
                            <td class="col1">Mã nhân viên</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtmanv" value="<?php echo $row['MaNhanVien'] ?>" style="width:450px;" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Tên nhân viên</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txttennv" value="<?php echo $row['TenNhanVien'] ?>" style="width:450px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Chức vụ</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtcv" value="<?php echo $row['ChucVu'] ?>" style="width:450px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Email</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtem" value="<?php echo $row['Email'] ?>" style="width:450px;">
                            </td>   
                        </tr>
                        <tr>
                            <td class="col1">SĐT</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtsdt" value="<?php echo $row['SDT'] ?>" style="width:450px;">
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