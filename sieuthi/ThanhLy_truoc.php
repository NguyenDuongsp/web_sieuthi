<?php
    // Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
    include_once ('ketnoi_csdl_quy.php');   

   // Lấy mã vận đơn từ tham số truy vấn
   $MaSanPham = $_GET["MaSanPham"];
   $query2 = "SELECT * FROM sanpham WHERE MaSanPham = '$MaSanPham'";
   $result2 = $conn->query($query2);

   if ($result2->num_rows > 0) {
       while ($row = $result2->fetch_assoc()) {
           
            $gia=$row["GiaBan"]/2;
           
       }
   }
   // Cập nhật thông tin vận đơn trong cơ sở dữ liệu
   $query1 = "UPDATE sanpham SET ThanhLy = '1',GiaBan = '$gia' WHERE MaSanPham = '$MaSanPham'";
   $result1 = $conn->query($query1);
   
   if ($result1 && empty($conn->error)) {
       echo "Cập nhật thành công!";
       echo "<script>window.location.href='./ThanhLy_my.php'</script>";
       exit;
   } else {
       echo "Cập nhật không thành công! Lỗi: " . $conn->error;
   }
?>