<?php
// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
include_once ('ketnoi_csdl_quy.php');
// Xử lý khi nhận được yêu cầu sửa thông tin vận đơn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ biểu mẫu sửa đơn hàng
    $maVanDon = $_POST["maVanDon"];
    $moTaDonHang = $_POST["moTaDonHang"];
    $noiDen = $_POST["noiDen"];
    $tinhTrang = $_POST["tinhTrang"];

    // Cập nhật thông tin vận đơn trong cơ sở dữ liệu
    $query = "UPDATE vandon SET MoTaDonHang = '$moTaDonHang',NoiDen = '$noiDen', TinhTrang = '$tinhTrang' WHERE MaVanDon = '$maVanDon'";
    if ($conn->query($query) === TRUE) {
        echo "Cập nhật thông tin vận đơn thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Lấy mã vận đơn từ tham số truy vấn
$maVanDon = $_GET["MaVanDon"];


// Truy vấn SQL để lấy thông tin vận đơn dựa trên mã vận đơn
$query = "SELECT * FROM vandon WHERE MaVanDon = '$maVanDon'";
$result = $conn->query($query);

// Kiểm tra nếu tồn tại vận đơn với mã vận đơn đã cho
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Không tìm thấy vận đơn.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa vận đơn</title>
</head>
<body>
    <h2>Sửa vận đơn</h2>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="maVanDon" value="<?php echo $row["MaVanDon"]; ?>">

        <label for="moTaDonHang">Mô tả đơn hàng:</label>
        <input type="text" name="moTaDonHang" value="<?php echo $row["MoTaDonHang"]; ?>"><br>

        <label for="noiDen">Nơi đến:</label>
        <input type="text" name="noiDen" value="<?php echo $row["NoiDen"]; ?>"><br>

        <label for="tinhTrang">Tình trạng:</label>
        <input type="text" name="tinhTrang" value="<?php echo $row["TinhTrang"]; ?>"><br>

        <input type="submit" value="Lưu">
    </form>

    <?php
    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
    ?>
</body>
</html>