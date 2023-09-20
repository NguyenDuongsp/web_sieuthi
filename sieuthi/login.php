<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'web_qlsieuthi') or die('lỗi kết nối');
$tk = '';
$mk = '';

if (isset($_POST['btn-login'])) {
    $tk = $_POST['txtuser'];
    $mk = $_POST['txtpassword'];

    // Kiểm tra thông tin đăng nhập
    $sql = "SELECT gmail, sdt, matkhau FROM taikhoanad WHERE (gmail='$tk' OR sdt='$tk') AND matkhau='$mk'";
    $kq = mysqli_query($con, $sql);

    if (mysqli_num_rows($kq) > 0) {
        $_SESSION['username'] = $tk; // Lưu tên người dùng vào session
        header("location: contac.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Tên người dùng hoặc mật khẩu không đúng!";
        header("location: login.php");
        exit;
    }
}

// Đóng kết nối
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.4.2-web/css/all.min.css">

    
</head>

<body>

    <div class="nameapp" style="width: 60%;">

    </div>
    <div style="width: 40%;">

        <div id="main">
            <div class="body-login">
                <form action="login.php" method="post">
                    <h1 class="header-login">Login</h1>
                    <?php if (isset($_SESSION['error_message'])) : ?>
                        <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
                    <div class="text-login">
                        <input type="text" name="txtuser" placeholder="Username" required>
                        <i class="icon-login fa-solid fa-user"></i>
                    </div>

                    <div class="text-login">
                        <input type="password" name="txtpassword" placeholder="Password" required>
                        <i class="icon-login fa-solid fa-lock"></i>
                    </div>
                    <div class="remember-login">
                        <label for=""><input type="checkbox">Gi nhớ tài khoản</label>
                        <a href="#">Quên mật khẩu</a>
                    </div>
                    <button type="submit" name='btn-login' class="btn-login">Login</button>

                </form>
            </div>

        </div>
    </div>
</body>

</html>