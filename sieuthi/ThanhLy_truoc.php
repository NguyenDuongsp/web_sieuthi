<?php
    // Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
    include_once ('ketnoi_csdl_quy.php');   

   // Lấy mã vận đơn từ tham số truy vấn
   $MaSanPham = $_GET["MaSanPham"];

   // Cập nhật thông tin vận đơn trong cơ sở dữ liệu
   $query1 = "UPDATE sanpham SET ThanhLy = '1'WHERE MaSanPham = '$MaSanPham'";
   $result1 = $conn->query($query1);
  


?>