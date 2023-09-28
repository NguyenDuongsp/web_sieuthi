<?php 
    $mKH=$_GET['MaKhachHang'];
    //kết nối đến DB
    $con_1=mysqli_connect("localhost","root","","ql_sieuthi")
    or die('Lỗi kết nối');
    //tạo truy vấn xóa
    $sql_1="DELETE FROM khachhang WHERE MaKhachHang='$mKH'";
    $kq_1= mysqli_query($con_1, $sql_1);
    if($kq_1) echo "<script>alert('Xóa thành công')</script>";
    else echo "<script>alert('Xóa thất bại!')</script>";
    echo "<script>window.location.href='Quanlykhachhang.php'</script>"
 ?>