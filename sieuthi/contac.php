<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'web_qlsieuthi1') or die('lỗi kết nối');

// Kiểm tra session để xác định xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['username'])) {
    $tk = $_SESSION['username'];

    // Truy vấn thông tin tài khoản
    $sql = "SELECT hotenAM FROM taikhoan WHERE email='$tk' OR sdtAM='$tk'";
    $data = mysqli_query($con, $sql);

    // Đóng kết nối
    mysqli_close($con);
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/frame.css">
    <link rel="stylesheet" href="./assets/css/base.css">
 
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.4.2-web/css/all.min.css">
</head>
<body>
   
    <div class="app">
        <div class="gird wrap">
            <div class="grid_row wrap2">
                <div class=" grid_colum-2">
                    <div class="area-pos">
                        <div class="logo-web">
                            <img class="logo-web__img" src="./assets/img/logo5.jpg" alt="">
                        </div>
                        <ul class="menu">
                            <li class="menu__item-s"> 
                                <a href="#" class="menu__item-link">
                                <i class="menu__item-link-icon fa-regular fa-clipboard"></i>
                                        <span>Báo Cáo</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item"> 
                                        <a href="#" class="menu__item-link">
                                        <i class="menu__item-link-icon fa-solid fa-people-group fa-sm"></i>
                                            <span>Báo cáo doanh số</span>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item"> 
                                        <a href="#" class="menu__item-link">
                                            <span>báo cáo hàng hóa</span>
                                        </a>
                                    </li>         
                                </ul>
                            </li>
                            <li class="menu__item-s"> 
                                <a href="#" class="menu__item-link">
                                <i class="menu__item-link-icon fa-solid fa-people-group fa-sm"></i>
                                     <span>Quản lý nhân viên</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item"> 
                                        <a href="#" class="menu__item-link">
                                            <span>o</span>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item"> 
                                        <a href="#" class="menu__item-link">
                                            <span>o</span>
                                        </a>
                                    </li>                                  
                                </ul>
                            </li>
                            <li class="menu__item"  > 
                                <a href="./nhaphang.php" class="menu__item-link">
                                <i class="menu__item-link-icon fa-solid fa-dolly"></i>
                                    <span>Nhập hàng</span>
                                </a>
                            </li>
                            <li class="menu__item"> 
                                <a href="#" class="menu__item-link">
                                <i class="menu__item-link-icon fa-solid fa-rug"></i>
                                    <span>Khuyến mãi</span>
                                </a>
                            </li>
                            <li class="menu__item"> 
                                <a href="#" class="menu__item-link">
                                <i class="menu__item-link-icon fa-solid fa-truck-moving"></i>
                                     <span>Nhà cung cấp</span>
                                </a>
                            </li>
                    </ul>

                    </div>
                   
                </div>
                <div class="grid_colum-10">
                        <header class="header-web">
                            <div class="header-navbar">
                                <ul class="header-navbar__list">
                                    <li class="header-navbar__list-item">
                                        <a href="" class="header-link">
                                            <i class=" header__navbar-icon fa-solid fa-question"></i>
                                                <Span>Trợ giúp</Span>
                                        </a>
                                    </li>
                                    <li class="header-navbar__list-item">
                                        <a href="" class="header-link">
                                            <i class=" header__navbar-icon fa-solid fa-bell"></i>
                                                <Span>Thông báo</Span>
                                        </a>
                                    </li>
                                  
                                    <li class="header-navbar__list-item header__navbar-user">
                                        <img src="https://kynguyenlamdep.com/wp-content/uploads/2022/06/avatar-cute-meo-con-than-chet-700x695.jpg" alt="" class="header__navbar-user-img">
                                        <?php
                                        if (isset($data) && $data != null) {
                                            while ($row = mysqli_fetch_array($data)) {
                                                ?>
                                                <span class="header__navbar-user-name"><?php echo $row['hotenAM'] ?></span>
                                                <?php
                                            }
                                        }
                                        else{
                                            ?>
                                            <span class="header__navbar-user-name">Tài khoản</span>
                                            <?php
                                        }
                                        ?>


                                        <ul class="header__navbar-user-menu">
                                            <li class="header__navbar-user-item">
                                                <a href="">Tài khoản của tôi</a>
                                            </li>
                                            <li class="header__navbar-user-item">
                                                <a href="">Địa chỉ của tôi</a>
                                            </li>
                                            <li class="header__navbar-user-item">
                                                <a href="">Đơn mua</a>
                                            </li>
                                            <li class="header__navbar-user-item header__navbar-user-item--separate">
                                                <a href="">Đăng xuất</a>
                                            </li>
                                        </ul>
                            </li>

                                </ul>
                            </div>
                        </header>
                        <div class="search-add-filter">
                            <div class="area-search">
                                    <input type="text" class="area-search__text" placeholder="Nhập thông tin tìm kiếm">
                                <button class="area-search__btn">
                                     <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                            
                            <div class="add-filter">
                                    <button class="add-item">
                                         <i class="add-item__icon fa-solid fa-plus"></i>
                                         <p class="add-item__text">Thêm ...</p>
                                    </button>
                                    <button class="filter-list">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                            </div>

                        </div>


                       
                </div>
            </div>
        </div>
    </div>
    <script>
    // Lấy danh sách tất cả các menu cấp 1
    var menuItems = document.getElementsByClassName('menu__item');
    var subMenuItems = document.getElementsByClassName('sub-menu-item');
      
  
        var menuItemsS = document.getElementsByClassName('menu__item-s');
         
            for (var i = 0; i < menuItemsS.length; i++) {
                menuItemsS[i].addEventListener('click', function(event) {
                    var subMenu = this.getElementsByClassName('sub-menu')[0];
                    if (subMenu.style.display === 'block') {
                        subMenu.style.display = 'none';
                        subMenu.style.backgroundColor = "#373942";
                    } else {
                        subMenu.style.display = 'block';
                        subMenu.style.backgroundColor = "#373942";
                    }
                    event.stopPropagation();
                });
            }

            for (var i = 0; i < subMenuItems.length; i++) {
                subMenuItems[i].addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            }

    </script>

    <script>
       var menuUser = document.getElementsByClassName('header__navbar-user')[0];
menuUser.addEventListener('click', function() {
    var submenuUser = document.getElementsByClassName('header__navbar-user-menu')[0];
    if (submenuUser.style.display === 'block') {
        submenuUser.style.display = 'none';
    } else {
        submenuUser.style.display = 'block';
    }
});
            
    </script>

<script>
        // Lấy danh sách các phần tử có class "sub-item-link"
        var subItemLinks = document.getElementsByClassName('menu__item');

        // Gán sự kiện click cho mỗi phần tử
        for (var i = 0; i < subItemLinks.length; i++) {
            subItemLinks[i].addEventListener('click', storeData);
        }

        function storeData(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>

            // Lấy dữ liệu từ ô được bấm
            var cellData = this.querySelector('.menu__item-link').innerText;

            // Lưu dữ liệu vào localStorage để truyền sang trang khác
            localStorage.setItem('selectedCellData', cellData);

            // Lưu đường dẫn hiện tại vào localStorage để truyền sang trang khác
            localStorage.setItem('currentPagePath', window.location.href);

            // Chuyển đến đường dẫn trong thuộc tính href của thẻ <a>
            window.location.href = this.querySelector('.menu__item-link').href;
        }
    </script>




    
</body>
</html>