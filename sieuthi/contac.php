<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'ql_sieuthi') or die('lỗi kết nối');

// Kiểm tra session để xác định xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['username'])) {
    $tk = $_SESSION['username'];

    // Truy vấn thông tin tài khoản
    $sql = "SELECT TenNguoiDung FROM taikhoan WHERE Email='$tk' OR SDT='$tk'";
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
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.4.2-web/css/all.min.css">
</head>
<style>
    .table{
        background-color: #fff;
    }
</style>
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
                                        <a href="./baocao.php" class="menu__item-link">
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
                            <!-- thêm chữ s -->
                            <li class="menu__item"> 
                                <a href="http://localhost/WEB_SIEUTHI/sieuthi/dsnv.php" class="menu__item-link">
                                <i class="menu__item-link-icon fa-solid fa-people-group fa-sm"></i>
                                     <span>Nhân viên</span>
                                </a>
                                <!-- <ul class="sub-menu">
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
                                </ul> -->
                            </li>
                            <li class="menu__item"  > 
                                <a href="http://localhost/WEB_SIEUTHI/sieuthi/Quanlysanpham.php" class="menu__item-link">
                                
                                <i class="menu__item-link-icon  fa-solid fa-boxes-stacked"></i>
                                    <span>Sản Phẩm</span>
                                </a>
                            </li>
                            <li class="menu__item"  > 
                                <a href="./nhaphang.php" class="menu__item-link">
                                <i class="menu__item-link-icon fa-solid fa-dolly"></i>
                                    <span>Nhập hàng</span>
                                </a>
                            </li>
                            <li class="menu__item"> 
                                <a href="http://localhost/WEB_SIEUTHI/sieuthi/khuyenmai.php" class="menu__item-link">
                                <i class="menu__item-link-icon fa-solid fa-rug"></i>
                                    <span>Khuyến mãi</span>
                                </a>
                            </li>
                            <li class="menu__item"> 
                                <a href="http://localhost/WEB_SIEUTHI/sieuthi/Quanlynhacungcap.php" class="menu__item-link">
                                <i class="menu__item-link-icon fa-solid fa-truck-moving"></i>
                                     <span>Nhà cung cấp</span>
                                </a>
                            </li>
                            <li class="menu__item"> 
                                <a href="http://localhost/WEB_SIEUTHI/sieuthi/Quanlykhachhang.php" class="menu__item-link">
                               
                                <i class="menu__item-link-icon  fa-solid fa-user-tie"></i>
                                     <span>Khách hàng</span>
                                </a>
                            </li>
                            <li class="menu__item"> 
                                <a href="http://localhost/WEB_SIEUTHI/sieuthi/Quanlydonhang.php" class="menu__item-link">
                                
                                <i class="menu__item-link-icon fa-solid fa-floppy-disk"></i>
                                     <span>Đơn hàng</span>
                                </a>
                            </li>
                            <li class="menu__item"> 
                                <a href="http://localhost/WEB_SIEUTHI/sieuthi/hoadon.php" class="menu__item-link">
                                <i class="menu__item-link-icon  fa-solid fa-receipt"></i>
                                     <span>Hóa đơn</span>
                                </a>
                            </li>
                            <li class="menu__item"> 
                                <a href="http://localhost/WEB_SIEUTHI/sieuthi/dskhohang.php" class="menu__item-link">
                                <i class="menu__item-link-icon  fa-solid fa-warehouse"></i>
                                     <span>Kho hàng</span>
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
                                                <span class="header__navbar-user-name"><?php echo $row['TenNguoiDung'] ?></span>
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
                                                <button class="js-link'" >Tài khoản của tôi</button>
                                            </li>
                                           
                                           
                                            <li class="header__navbar-user-item header__navbar-user-item--separate">
                                                <a href="./login.php">Đăng xuất</a>
                                            </li>
                                        </ul>
                            </li>

                                </ul>
                            </div>
                        </header>
                        <div class="search-add-filter">
                            <div class="area-search">
                                    <input class="area-search__text" type="text" name="txttimkiem"  placeholder="Nhập thông tin tìm kiếm">
                                <button name="btntim" type="submit" class="area-search__btn">
                                     <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                                <!-- <input class="btn-tim" type="submit" name="btntim" value="tìm kiếm "> -->
                            </div>
                            
                            <div class="add-filter">
                                    <button class="add-item js-buy-ticket">
                                         <i class="add-item__icon fa-solid fa-plus"></i>
                                         <p class="add-item__text">Thêm</p>
                                    </button>
                                    <div class="filter-list btn">
                                        <i class="fa-solid fa-ellipsis"></i>
                                        <ul class="list_excel">
                                            <li class="list_excel--item">
                                                <button class="btn btn-sucess" name="btnxuatexcel" type="submit" >xuất excel</button>
                                            </li>
                                            
                                            <li class="list_excel--item header__navbar-user-item--separate">
                                                <button name="btnnhapexcel" >Nhập excel</button>
                                            </li>
                                        </ul>
                                    </div>
                            </div>

                        </div>


                       
                </div>
                <div class="modal js-modal1">
                 <div class="modal-container js-modal-container1">
                   <div class="modal-close js-modal-close1">
                   <i class="fa-solid fa-xmark"></i>
                   </div>
                       <form method="post" action="">
                       <table class="table table-borderless`">
                   <tr>
                       <td colspan="2" style="text-align: center;">
                           <h5 >Thêm thông tin hàng nhập</h5>
                       </td>
                   </tr>
            
                   <tr>
                       <td class="col1">Mã nhập hàng</td>
                       <td class="col2">
                           <input class="form-control" type="text" name="txtmanhaphang" value="<?php echo $mnh ?>">
                       </td>
            
                   </tr>
                   <tr>
                       <td class="col1">Mã sản phẩm</td>
                       <td class="col2">
                           <input class="form-control" type="text" name="txtmasanpham"value="<?php echo $msp ?>" >
                       </td>
                       
                   </tr>
                   
                       <tr>
                       <td class= "col1">Số lượng</td>
                       <td class="col2">
                           <input class="form-control" type="text" name="txtsoluonghangnhap" value="<?php echo $soluong ?>" >
                       </td>   
                   </tr>
                   <tr>
                       <td class= "col1">Ngày Nhập</td>
                       <td class="col2">
                           <input class="form-control" type="text" name="txtngaynhap" value="<?php echo $ngaynhap   ?>" >
                       </td>   
                   </tr>
                   <tr>
                       <td class="col1"></td>
                       <td class="col2">
                           <input class="btn btn-primary" type="submit" name="btnLuu" value="Lưu" style="width:100px;">
                       </td>
                       
                   </tr>
                    </table>
                       </form>
                   </div>
            </div>
        </div>
        
          
    </div>

    
               
    <!-- <script  >
      var bBtn= document.getElementsByClassName('js-link')[0];
        console.log(bBtn);
       const modl=document.querySelector('.js-modal1')
       const modlClose=document.querySelector('.js-modal-close1')
       const modlContainer=document.querySelector('.js-modal-container1')
       //thêm class open vào modal

       function showBuyTicke(){
              modl.classList.add('open')
            //    var formElement = document.querySelector('form');
            // formElement.addEventListener('submit', function(event) {
            //     event.preventDefault(); // Prevent form submission

            //      // Call the function to show the modal
            //     // Additional logic for form submission if needed
            // });
            
       }
       
       //gỡ bỏ class open khỏi modal
       function hideBuyTicke(){
              modl.classList.remove('open')
        //       var form = document.querySelector('form');
        //   form.submit();
       }
        
            
            bBtn.addEventListener('click',showBuyTicke)
        
        modlClose.addEventListener('click',hideBuyTicke)

        modl.addEventListener('click',hideBuyTicke)

        modlContainer.addEventListener('click',function(event){
           event.stopPropagation()      })
          
    </script>
     -->
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
    <!-- <script>
        const Btn= document.querySelector('.js-buy-ticket')
      Btn.addEventListener('click',function(event){
         
          event.stopPropagation();
      })  

    </script> -->
    <!-- hiển thị menu tài khoản -->
    <!-- <script>
      var menuExcel = document.getElementsByClassName('filter-list')[0];
var submenuExcel = document.getElementsByClassName('list_excel')[0];
var formElement = document.querySelector('form');

menuExcel.addEventListener('click', function() {
  if (submenuExcel.style.display === 'block') {
    submenuExcel.style.display = 'none';
  } else {
    submenuExcel.style.display = 'block';
  }
});

formElement.addEventListener('submit', function(event) {
  if (submenuExcel.style.display === 'block') {
    // event.preventDefault(); // Ngăn chặn hành vi mặc định của sự kiện submit

    // Thực hiện hành động tương tự như khi submenu hiển thị
    // Additional logic for form submission if needed
  }
}); 
    </script> -->
    <!-- hiển thị list excel -->
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

<!-- <script>
    var logout =document.querySelector('header__navbar-user-item')
    logout.addEventListener('click',function(){

        window.location.href='./login.php';
    })

</script> -->
<!-- <script>
   var excel = document.getElementsByClassName('list_excel--item');
for (var i = 0; i < excel.length; i++) {
  excel[i].addEventListener('click', function() {
    // Gửi yêu cầu HTTP đến máy chủ để xử lý excel
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'xuly_excel.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Xử lý phản hồi từ máy chủ nếu cần
        var response = xhr.responseText;
        console.log(response);
      }
    };
    xhr.send('btnxuatexcel=true');
  });
}
</script> -->

    
</body>
</html>