<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'web_qlsieuthi') or die('lỗi kết nối');

// Kiểm tra session để xác định xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['username'])) {
    $tk = $_SESSION['username'];

    // Truy vấn thông tin tài khoản
    $sql = "SELECT hoten FROM taikhoanad WHERE gmail='$tk' OR sdt='$tk'";
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
    <h1>hoang cao duong</h1>
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
                            <li class="menu__item"> 
                                <a href="#" class="menu__item-link">
                                <i class="menu__item-link-icon fa-solid fa-dolly"></i>
                                    <span>Hàng hóa</span>
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
                                                <span class="header__navbar-user-name"><?php echo $row['hoten'] ?></span>
                                                <?php
                                            }
                                        }
                                        ?>

                                        <?php
                                        if (isset($data) && $data != null) {
                                            while ($row = mysqli_fetch_array($data)) {
                                                ?>
                                                <span class="header__navbar-user-name"><?php echo $row['hoten'] ?></span>
                                                <?php
                                            }
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


                        <div class="conten">
                        <form method="post" action="">
           
                
            <table border="1" cellspacing="0" >
                <tr style="background: pink;">
                    <th>STT</th>
                    <th>Mã loại sách</th>
                    <th>Tên loại sách</th>
                    <th>Mô tả</th>
                </tr>
                <!-- <?php
                //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                if(isset($data)&& $data!=null){
                    $i=0;
                    while($row=mysqli_fetch_array($data)){
                ?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td><?php echo $row['Maloai'] ?></td>
                        <td><?php echo $row['Tenloai'] ?></td>
                        <td><?php echo $row['Mota'] ?></td>
                        <td>
                            <a href="./Loaisach_sua.php?Maloai=<?php echo $row['Maloai'] ?>"><font color="red">Sửa</a>&nbsp;&nbsp;
                            <a href="./Loaisachxoa.php?Maloai=<?php echo $row['Maloai'] ?>">Xóa</a>
                        </td>
                    </tr>
                <?php        
                        }
                    }
                    //kết thúc b3
                ?> -->
              
            </table>
        </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Lấy danh sách tất cả các menu cấp 1
    var menuItems = document.getElementsByClassName('menu__item');
    var subMenuItems = document.getElementsByClassName('sub-menu-item');
      
    // đổi màu sub-menu-item khi nhấn vào
        for(var i = 0; i<subMenuItems.length; i++)
        {
            subMenuItems[i].addEventListener('click', function(){
                for(var j = 0; j<subMenuItems.length; j++)
                {
                    subMenuItems[j].style.backgroundColor = "#373942";
                    subMenuItems[j].style.borderLeft = "none";
                }
                this.style.backgroundColor = "#202126";
                this.style.borderLeft = "3px solid #dce1ea";
            })
        }
        for (var i = 0; i < menuItems.length; i++) {
        menuItems[i].addEventListener('click', function() {
            for (var j = 0; j < menuItems.length; j++) {
                menuItems[j].style.backgroundColor = "#373942";
                menuItems[j].style.borderLeft = "none";
            }
            // Đổi màu nền và viền trái cho menu cấp 1 khi được nhấp vào
                this.style.backgroundColor = "#202126";
                this.style.borderLeft = "3px solid #dce1ea";
        });
        }
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
//             var menuItems = document.getElementsByClassName('menu__item');
// var subMenuItems = document.getElementsByClassName('sub-menu-item');

// Đổi màu sub-menu-item khi nhấn vào menu-item
for (var i = 0; i < menuItems.length; i++) {
  menuItems[i].addEventListener('click', function() {
    // Đặt màu cho tất cả sub-menu-item là #FFF
    for (var j = 0; j < subMenuItems.length; j++) {
      subMenuItems[j].style.backgroundColor = "#373942";
      subMenuItems[j].style.borderLeft = "none";
    }
  });
}

// Đổi màu menu-item khi nhấn vào sub-menu-item
for (var i = 0; i < subMenuItems.length; i++) {
  subMenuItems[i].addEventListener('click', function() {
    // Đặt màu cho tất cả menu-item là #FFF
    for (var j = 0; j < menuItems.length; j++) {
      menuItems[j].style.backgroundColor = "#373942";
      menuItems[j].style.borderLeft = "none";
    }
  });
}
// Đổi màu menu-item khi nhấn vào menu-item-s
for (var i = 0; i < menuItemsS.length; i++) {
  menuItemsS[i].addEventListener('click', function() {
    // Đặt màu cho tất cả menu-item là #FFF
    for (var j = 0; j < menuItems.length; j++) {
      menuItems[j].style.backgroundColor = "#373942";
      menuItems[j].style.borderLeft = "none";
    }
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
</body>
</html>