

<?php

include_once ('ketnoi_csdl_quy.php');
// Lấy dữ liệu từ form
// Xử lý khi submit form
if (isset($_POST['btnluu'])) {
    $MaVanDon = $_POST['MaVanDon'] ?? '';
    $NgayLapDon = $_POST['NgayLapDon'] ?? '';
    $MaDonHang = $_POST['MaDonHang'] ?? '';
    $MoTaDonHang = $_POST['MoTaDonHang'] ?? '';
    $NoiDi = $_POST['NoiDi'] ?? '';
    $NoiDen = $_POST['NoiDen'] ?? '';
    $TinhTrang = $_POST['TinhTrang'] ?? '';
    $MaNhanVien = $_POST['MaNhanVien'] ?? '';
    $MaKhachHang = $_POST['MaKhachHang'] ?? '';
    $TrongLuongHangHoa = $_POST['TrongLuongHangHoa'] ?? '';
    $PhiVanChuyen = $_POST['PhiVanChuyen'] ?? '';
    $PhuongThucVanChuyen = $_POST['PhuongThucVanChuyen'] ?? '';
    $SoLuongKienHang = $_POST['SoLuongKienHang'] ?? '';

    // Tiếp theo, bạn có thể sử dụng các biến này trong câu truy vấn INSERT hoặc các hoạt động xử lý khác.
}

// Kiểm tra giá trị khóa chính trước khi thực hiện truy vấn INSERT
if (!empty($MaVanDon)) {
    // Kết nối tới cơ sở dữ liệu
   

    // Kiểm tra giá trị khóa chính đã tồn tại trong bảng chưa
    $query = "SELECT * FROM vandon WHERE MaVanDon = '$MaVanDon'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Giá trị khóa chính đã tồn tại, thông báo lỗi cho người dùng
        echo "Giá trị khóa chính đã tồn tại. Vui lòng chọn giá trị khác.";
    } else {
        // Giá trị khóa chính không tồn tại, thực hiện truy vấn INSERT
        $sql = "INSERT INTO vandon (MaVanDon, NgayLapDon, MaDonHang, MoTaDonHang, NoiDi, NoiDen, TinhTrang, MaNhanVien, MaKhachHang, TrongLuongHangHoa, PhiVanChuyen, PhuongThucVanChuyen, SoLuongKienHang)
         VALUES ('$MaVanDon', '$NgayLapDon', '$MaDonHang', '$MoTaDonHang', '$NoiDi', '$NoiDen', '$TinhTrang', '$MaNhanVien', '$MaKhachHang', '$TrongLuongHangHoa', '$PhiVanChuyen', '$PhuongThucVanChuyen', '$SoLuongKienHang')";
        // Thực hiện truy vấn INSERT
        if ($conn->query($sql) === TRUE) {
            echo "Thêm bản ghi thành công.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }

    // Đóng kết nối
    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Chức năng Vận đơn</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">

    <style>
        h2 {
            color: #333;
        }

        /* form {
            max-width: 400px;
            margin: 20px auto;
        } */

        label {
            display: block;
            margin-top: 5px;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 50%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 50px;
        }

        input[type="submit"] {
            margin-top: 5px;
            padding: 4px 7px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style> 


</head>
<body>
    <h2>Tạo vận đơn mới</h2>
    <form action="" method="POST" >
        <div class = "form-group">
        <label for="MaVanDon">Mã vận đơn:</label>
        <input type="text" name="MaVanDon" class="form-control" required>

        <label for="NgayLapDon">Ngày lập đơn:</label>
        <input type="date" name="NgayLapDon" class="form-control" required>

        <label for="MaDonHang">Mã đơn hàng:</label>
        <input type="text" name="MaDonHang">

        <label for="MoTaDonHang">Mô tả đơn hàng:</label>
        <textarea name="MoTaDonHang"></textarea>

        <label for="NoiDi">Nơi đi:</label>
        <input type="text" name="NoiDi">

        <label for="NoiDen">Nơi đến:</label>
        <input type="text" name="NoiDen">

        <label for="TinhTrang">Tình trạng:</label>
        <input type="text" name="TinhTrang">

        <label for="MaNhanVien">Mã nhân viên:</label>
        <input type="text" name="MaNhanVien">

        <label for="MaKhachHang">Mã khách hàng:</label>
        <input type="text" name="MaKhachHang">

        <label for="TrongLuongHangHoa">Trọng lượng hàng hóa:</label>
        <input type="text" name="TrongLuongHangHoa">

        <label for="PhiVanChuyen">Phí vận chuyển:</label>
        <input type="text" name="PhiVanChuyen">

        <label for="PhuongThucVanChuyen">Phương thức vận chuyển:</label>
        <input type="text" name="PhuongThucVanChuyen">

        <label for="SoLuongKienHang">Số lượng kiện hàng:</label>
        <input type="text" name="SoLuongKienHang">

        <input type="submit" value="Tạo vận đơn" name = "btnluu">
        </div>
    </form>
</body>
</html>