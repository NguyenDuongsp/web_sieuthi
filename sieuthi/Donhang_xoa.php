<?php 
    $mdh=$_GET['MaDonHang'];
    //kết nối đến DB
    $con_3=mysqli_connect("localhost","root","","ql_sieuthi")
    or die('Lỗi kết nối');
    //tạo truy vấn xóa
    $sql_3="DELETE FROM donhang WHERE MaDonHang='$mdh'";
    $kq_3= mysqli_query($con_3, $sql_3);
    if($kq_3) echo "<script>alert('Xóa thành công')</script>";
    else echo "<script>alert('Xóa thất bại!')</script>";
    echo "<script>window.location.href='Quanlydonhang.php'</script>"
 ?>