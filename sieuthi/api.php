<?php
// Kết nối đến cơ sở dữ liệu
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'ql_sieuthi';

$connection = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($connection->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $connection->connect_error);
}

// Phương thức API để lấy tất cả thông tin hóa đơn
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM hoadon";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $response = array();
        while ($row = $result->fetch_assoc()) {
            $response[] = array(
                'id' => $row['id'],
                'MaHoaDon' => $row['MaHoaDon'],
                'MaSanPham' => $row['MaSanPham'],
                'SoLuong' => $row['SoLuong'],
                'MaKhachHang' => $row['MaKhachHang'],
                'TongTien' => $row['TongTien'],
                'NgayTao' => $row['NgayTao']
            );
        }

        // Trả về dữ liệu dưới định dạng JSON
        http_response_code(200); // Trạng thái OK
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Trả về thông báo lỗi nếu không có hóa đơn
        http_response_code(404); // Not Found
        $response = array('error' => 'Không có hóa đơn nào');
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xử lý phương thức POST
    $data = json_decode(file_get_contents('php://input'), true);
    $maHoaDon = $data['MaHoaDon'];
    $maSanPham = $data['MaSanPham'];
    $soLuong = $data['SoLuong'];
    $maKhachHang = $data['MaKhachHang'];
    $tongTien = $data['TongTien'];
    $ngayTao = $data['NgayTao'];

    $query = "INSERT INTO hoadon (MaHoaDon, MaSanPham, SoLuong, MaKhachHang, TongTien, NgayTao) VALUES ('$maHoaDon', '$maSanPham', '$soLuong', '$maKhachHang', '$tongTien', '$ngayTao')";
    if ($connection->query($query) === TRUE) {
        http_response_code(201); // Created
        $response = array('message' => 'Thêm hóa đơn thành công');
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(500); // Internal Server Error
        $response = array('error' => 'Thêm hóa đơn thất bại: ' . $connection->error);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Xử lý phương thức PUT
    $data = json_decode(file_get_contents('php://input'), true);
   
    $maHoaDon = $data['MaHoaDon'];
    $maSanPham = $data['MaSanPham'];
    $soLuong = $data['SoLuong'];
    $maKhachHang = $data['MaKhachHang'];
    $tongTien = $data['TongTien'];
    $ngayTao = $data['NgayTao'];

    $query = "UPDATE hoadon SET  MaSanPham='$maSanPham', SoLuong='$soLuong', MaKhachHang='$maKhachHang', TongTien='$tongTien', NgayTao='$ngayTao' WHERE MaHoaDon='$maHoaDon'";
    if ($connection->query($query) === TRUE) {
        http_response_code(200); // Trạng thái OK
        $response = array('message' => 'Cập nhật hóa đơn thành công');
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(500); // Internal Server Error
        $response = array('error' => 'Cập nhật hóa đơn thất bại: ' . $connection->error);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Xử lý phương thức DELETE
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['MaHoaDon'];

    $query = "DELETE FROM hoadon WHERE MaHoaDon='$id'";
    if ($connection->query($query) === TRUE) {
        http_response_code(200); // Trạng thái OK
        $response = array('message' => 'Xóa hóa đơn thành công');
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(500); // Internal Server Error
        $response = array('error' => 'Xóa hóa đơn thất bại: ' . $connection->error);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // Trả về thông báo lỗi nếu phương thức không được hỗ trợ
    http_response_code(405); // Method Not Allowed
    $response = array('error' => 'Phương thức không được hỗ trợ');
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối cơ sở dữ liệu
$connection->close();
?>