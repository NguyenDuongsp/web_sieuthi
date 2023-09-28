<?php
    $mnv=$_GET['MaNhanVien'];
    //Ket noi DB
    $cons=mysqli_connect('localhost','root','','ql_sieuthi') or die('Loi ket noi');
    //Tao truy van xoa
    $sql="DELETE FROM nhanvien WHERE MaNhanVien='$mnv'";
    $kq=mysqli_query($cons,$sql);
    if($kq)  echo "<script> alert('Xoa thanh cong!')</script>"; 
    else  echo "<script>alert('Xoa that bai!')</script>";
    echo "<script>window.location.href='./dsnv.php'</script>";
?>