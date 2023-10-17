<?php


// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
$conn = new mysqli('localhost', 'root', '', 'ql_sieuthi');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}
?>