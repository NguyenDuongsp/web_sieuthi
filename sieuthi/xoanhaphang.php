<?php 
    $mnh=$_GET['MaNhapHang'];
    //kết nối đến DB
    $conss=mysqli_connect("localhost","root","","ql_sieuthi")
    or die('Lỗi kết nối');
    //tạo truy vấn xóa
    $sql4="DELETE FROM nhaphang WHERE MaNhapHang='$mnh'";
    $kq3= mysqli_query($conss, $sql4);
    if($kq3) echo "<script>alert('Xóa thành công')</script>";
    else echo "<script>alert('Xóa thất bại!')</script>";
    echo "<script>window.location.href='./nhaphang.php'</script>"
 ?>