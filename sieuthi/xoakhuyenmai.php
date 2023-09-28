<?php 
    $mkm=$_GET['MaKhuyenMai'];
    //kết nối đến DB
    $consss=mysqli_connect("localhost","root","","ql_sieuthi")
    or die('Lỗi kết nối');
    //tạo truy vấn xóa
    $sql6="DELETE FROM khuyenmai WHERE MaKhuyenMai='$mkm'";
    $kq4= mysqli_query($consss, $sql6);
    if($kq4) echo "<script>alert('Xóa thành công')</script>";
    else echo "<script>alert('Xóa thất bại!')</script>";
     echo "<script>window.location.href='./khuyenmai.php'</script>"
 ?>