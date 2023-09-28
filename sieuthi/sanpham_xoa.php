<?php 
    $msp=$_GET['MaSanPham'];
    //kết nối đến DB
    $con_5=mysqli_connect("localhost","root","","ql_sieuthi")
    or die('Lỗi kết nối');
    //tạo truy vấn xóa
    $sql_5="DELETE FROM sanpham WHERE MaSanPham='$msp'";
    $kq_5= mysqli_query($con_5, $sql_5);
    if($kq_5) echo "<script>alert('Xóa thành công')</script>";
    else echo "<script>alert('Xóa thất bại!')</script>";
    echo "<script>window.location.href='Quanlysanpham.php'</script>"
 ?>