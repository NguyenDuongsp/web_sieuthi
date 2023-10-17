<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'ql_sieuthi') or die('lỗi kết nối');
$tk = '';
$mk = '';

if (isset($_POST['btn-login'])) {
    $tk = $_POST['txtuser'];
    $mk = $_POST['txtpassword'];

    // Kiểm tra thông tin đăng nhập
    $sql = "SELECT SDT, Email, MatKhau FROM taikhoan WHERE (Email='$tk' OR SDT='$tk') AND MatKhau='$mk'";
    $kq = mysqli_query($con, $sql);

    if (mysqli_num_rows($kq) > 0) {
        $_SESSION['username'] = $tk; // Lưu tên người dùng vào session
        header("location: dieukhien.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Tên người dùng hoặc mật khẩu không đúng!";
        header("location: login.php");
        exit;
    }
} elseif (isset($_POST['btnLuu'])) {
    $email = $_POST['txtmanhaphang'];
    $matkhauMoi = $_POST['txtmakhohang'];
    $xacNhanMatKhauMoi = $_POST['txtxacnhanmakhohang'];

    if ($matkhauMoi === $xacNhanMatKhauMoi) {
        // Kiểm tra thông tin và thực hiện cập nhật mật khẩu
        $sql9 = "UPDATE taikhoan SET MatKhau='$matkhauMoi' WHERE Email='$email'";
        $kq9 = mysqli_query($con, $sql9);

        if ($kq9) {
            $_SESSION['success_message'] = "Mật khẩu đã được cập nhật thành công!";
           
        } else {
            $_SESSION['error_message'] = "Cập nhật mật khẩu thất bại!";
           
        }
    } else {
        $_SESSION['error_message'] = "Xác nhận mật khẩu không khớp!";
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
                        <label for =""><input type="checkbox" name="remember"  id="remember-checkbox">Ghi nhớ password</label>
                        <a href="./quenmatkhau.php" class="quenmk">Quên mật khẩu</a>
                    </div>
                    <button type="submit" name='btn-login' class="btn-login">Login</button>

                </form>
            </div>

        </div>
    </div>



   
    <script>
document.addEventListener('DOMContentLoaded', function() {
  var rememberCheckbox = document.getElementById('remember-checkbox');
  var usernameInput = document.getElementsByName('txtuser')[0];
  var passwordInput = document.getElementsByName('txtpassword')[0];

  rememberCheckbox.addEventListener('change', function() {
    if (rememberCheckbox.checked) {
      // Lưu tài khoản và mật khẩu vào localStorage khi ô checkbox được chọn
      localStorage.setItem('username', usernameInput.value);
      localStorage.setItem('password', passwordInput.value);
    } else {
      // Xóa tài khoản và mật khẩu từ localStorage khi ô checkbox không được chọn
      localStorage.removeItem('username');
      localStorage.removeItem('password');
    }
  });

  // Kiểm tra xem có tài khoản và mật khẩu đã lưu trong localStorage hay không
  if (localStorage.getItem('username') && localStorage.getItem('password')) {
    usernameInput.value = localStorage.getItem('username');
    passwordInput.value = localStorage.getItem('password');
    rememberCheckbox.checked = true;
  }
});
</script>



</body>

</html>
