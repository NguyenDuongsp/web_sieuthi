<?php
session_start();
$con9=mysqli_connect('localhost','root','','web_qlsieuthi1') or die('kết lỗi nỗi');

if (isset($_POST['btn-login'])) {
    $tk = $_POST['txttk'];
    $matkhauMoi = $_POST['txtmk'];
    $xacNhanMatKhauMoi = $_POST['txtcheckmk'];

    if ($matkhauMoi === $xacNhanMatKhauMoi) {
        // Kiểm tra thông tin và thực hiện cập nhật mật khẩu
        $sql9 = "UPDATE taikhoan SET matkhau='$matkhauMoi' WHERE sdtAM='$tk'";
        $kq9 = mysqli_query($con9, $sql9);

        if ($kq9) {
            echo "<script>alert('Thay đổi mật khẩu thành công!')</script>";
    echo "<script>window.location.href='./login.php'</script>";
           
        } else {
            $_SESSION['error_message'] = "Cập nhật mật khẩu thất bại!";
            header("location: quenmatkhau.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Xác nhận mật khẩu không khớp!";
        header("location: quenmatkhau.php");
        exit;
    }
}

// Đóng kết nối
mysqli_close($con9);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="./assets/css/login.css">

</style>
<body>
<div id="main">
            <div class="body-login">
                <form action="" method="post">
                    <h1 class="header-login">Thay đổi mật khẩu</h1>
                    <?php if (isset($_SESSION['error_message'])) : ?>
                        <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
                    <div class="text-login">
                        <input type="text" name="txttk" placeholder="Username" required>
                        <i class="icon-login fa-solid fa-user"></i>
                    </div>

                    <div class="text-login">
                        <input type="password" name="txtmk" placeholder="Password" required>
                        <i class="icon-login fa-solid fa-lock"></i>
                    </div>
                    <div class="text-login">
                        <input type="password" name="txtcheckmk" placeholder="Password" required>
                        <i class="icon-login fa-solid fa-lock"></i>
                    </div>
                   
                    <button type="submit" name='btn-login' class="btn-login">SAVE</button>

                </form>
            </div>

        </div>
</body>
</html>