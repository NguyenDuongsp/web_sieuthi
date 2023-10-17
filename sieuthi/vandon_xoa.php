
<?php
// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
include_once ('ketnoi_csdl_quy.php');
// Xử lý xóa vận đơn nếu có yêu cầu
if (isset($_GET['MaVanDon'])) {
    $MaVanDon = $_GET['MaVanDon'];

    // Xóa vận đơn từ bảng
    $sql = "DELETE FROM vandon WHERE MaVanDon = '$MaVanDon'";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa vận đơn thành công";
        echo "<script>window.location.href='./vandon2.php'</script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
?>