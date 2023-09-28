<?php 
    $mNcc=$_GET['MaNhaCungCap'];
    //kết nối đến DB
    $con_2=mysqli_connect("localhost","root","","ql_sieuthi")
    or die('Lỗi kết nối');
    //tạo truy vấn xóa
    $sql_2="DELETE FROM nhacungcap WHERE MaNhaCungCap='$mNcc'";
    $kq_2= mysqli_query($con_2, $sql_2);
    if($kq_2) echo "<script>alert('Xóa thành công')</script>";
    else echo "<script>alert('Xóa thất bại!')</script>";
    echo "<script>window.location.href='Quanlynhacungcap.php'</script>"
 ?>