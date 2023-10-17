<?php
$mkm = "";
$tenkm = "";
$ngaybatdau = "";
$ngayketthuc = "";
$phantramkhuyenmai = "";
$mota = "";

// Bước 1: Kết nối đến cơ sở dữ liệu
$consss = mysqli_connect("localhost", "root", "", "ql_sieuthi") or die('Lỗi kết nối');

// Bước 2: Lấy giá trị MaKhuyenMai từ URL
$mkm = $_GET['MaKhuyenMai'];

// Bước 3: Lấy thông tin khuyến mãi từ cơ sở dữ liệu
$sql4 = "SELECT * FROM khuyenmai WHERE MaKhuyenMai='$mkm'";
$data4 = mysqli_query($consss, $sql4);

// Xử lý khi nhấn nút "Lưu"
if (isset($_POST['btnLuu'])) {
    $mkm = $_POST['txtmakm'];
    $msp = $_POST['ddLoaisach'];
    $ngaybatdau = $_POST['txtngaybatdau'];
    $ngayketthuc = $_POST['txtngayketthuc'];
    $phantramkhuyenmai = $_POST['txttile'];
    $mota = $_POST['txtmota'];

    // Cập nhật thông tin khuyến mãi trong cơ sở dữ liệu
    $sql5 = "UPDATE khuyenmai SET MaKhuyenMai='$mkm', MaSanPham='$msp', NgayBatDau='$ngaybatdau', NgayKetThuc='$ngayketthuc', PhanTramKhuyenMai='$phantramkhuyenmai' WHERE MaKhuyenMai='$mkm'";
    $kq4 = mysqli_query($consss, $sql5);

    if ($kq4) {
        header("location: khuyenmai.php");
        exit;
    } else {
        echo "<script>alert('Sửa thất bại!')</script>";
    }
}

// Truy vấn danh sách sản phẩm
$slq_msp = "SELECT * FROM sanpham";
$dt = mysqli_query($consss, $slq_msp);

// Đóng kết nối cơ sở dữ liệu
mysqli_close($consss);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin khuyến mãi</title>
</head>
<body>
    <?php include_once './contac.php'; ?>

    <div class="conten">
        <form method="post" action="">
            <table class="table table-bordered table-striped" style="height:100vh">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5>SỬA THÔNG TIN KHUYẾN MÃI</h5>
                    </td>
                </tr>

                <?php
                if (isset($data4) && $data4 != null) {
                    while ($row = mysqli_fetch_array($data4)) {
                ?>
                        <tr>
                            <td class="col1">Mã khuyến mãi</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtmakm" value="<?php echo $row['MaKhuyenMai'] ?>" style="width: 450px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Mã Sản Phẩm</td>
                            <td class="col2">
                                <select class="form-control" name="ddLoaisach">
                                    <option value="">-- Chọn loại sách --</option>
                                    <?php
                                    if (isset($dt) && $dt != null) {
                                        while ($row2 = mysqli_fetch_array($dt)) {
                                    ?>
                                            <option value="<?php echo $row2['MaSanPham'] ?>" <?php if ($row2['MaSanPham'] == $row['MaSanPham']) echo 'selected'; ?>><?php echo $row2['MaSanPham'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
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