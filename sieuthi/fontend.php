<?php 
session_start();
$con=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
$sql_banhang="SELECT sp.MaSanPham, sp.TenSanPham, sp.MaNhaCungCap, sp.Anh, sp.NgaySanXuat, sp.HanSuDung, sp.GiaBan, km.PhanTramKhuyenMai
FROM sanpham AS sp
LEFT JOIN khuyenmai AS km ON sp.MaSanPham = km.MaSanPham";
$result = mysqli_query($con, $sql_banhang);
if (isset($_SESSION['username'])) {
    if(isset($_POST['btnthemgiohang'])){
        $tensp= $_POST['txttensp'];
        $giasp= $_POST['txtgiasp'];
        $tk = $_SESSION['username'];
    
  }}
  //xư lý button tìm kiếm
if(isset($_POST['btntim'])){
    $msp=$_POST['txttimkiem'];
    $sqltk="SELECT sp.MaSanPham, sp.TenSanPham, sp.MaNhaCungCap, sp.Anh, sp.NgaySanXuat, sp.HanSuDung, sp.GiaBan, km.PhanTramKhuyenMai
    FROM sanpham AS sp
    LEFT JOIN khuyenmai AS km ON sp.MaSanPham = km.MaSanPham WHERE sp.TenSanPham like '%$msp%'";
    $result=mysqli_query($con, $sqltk);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="./assets/css/fontend.css">
        <link rel="stylesheet" href="./assets/css/font_base.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.4.2-web/css/all.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="app">
            <header class="header">
                <div class="grid">
                    <nav class="header__navbar">
                        <ul class="header__navbar-list">
                            <li class="header__navbar-item header__navbar-ite--has-qr header__navbar-item--separate">
                                

                                <!-- header qr code -->
                                <div class="header__qr">
                                    <img src="./assets/img/qr_code.png" alt="QRCODE" class="header__qr-img">
                                    <div class="header__qr-app">
                                        <a href="https://apps.apple.com/vn/app/5-5-shopee-outlet/id959841449?l=vi" class="header__qr-link">
                                            <img src="./assets/img/app_store.png" alt="App store" class="header__qr-dowload-img">
                                        </a>
                                        <a href="https://play.google.com/store/search?q=shopee&c=apps&hl=vi" class="header__qr-link">
                                            <img src="./assets/img/gg_play.png" alt="ggplay" class="header__qr-dowload-img">
                                        </a>
                                        
                                    </div>
                                </div>
                            </li>
                            <li class="header__navbar-item">
                                <span class="header__navbar-title-nopointer"></span>
                                <a href="https://www.facebook.com/ShopeeVN" class="header__navbar-icon-link">
                                    <i class="header__navbar-icon fa-brands fa-facebook"></i>
                                </a>
                                <a href="https://www.instagram.com/shopee_vn/?igshid=NTc4MTIwNjQ2YQ%3D%3D" class="header__navbar-icon-link">
                                    <i class="header__navbar-icon fa-brands fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
        
                        <ul class="header__navbar-list">
                            <li class="header__navbar-item header__navbar-item--has-notify">
                                <a href="" class="header__navbar-item-link">
                                    <i class="fa-regular fa-bell"></i>
                                    Thông báo
                                </a>
                                <div class="header__notify">
                                    <header class="header__notify-header">
                                        <h3>Thông báo mới nhận</h3>
                                    </header>
                                    <ul class="header__notify-list">
                                        <li class="header__notify-item header__notify-item--viewed">
                                            <a href="" class="header__notify-link">
                                                <img src="https://myphamohuichinhhang.vn/wp-content/uploads/2016/08/xcream.png.pagespeed.ic_.Otm_Ys4I60.png" alt="" class="header__notify-img">
                                                <div class="header__notify-info">
                                                    <span class="header__notify-name">Xác thực chính hãng nguồn gốc các sản phẩm Ohui</span>
                                                    <span class="header__notify-description">Thành phố thịt nướng mới nổi ở Trung Quốc</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="header__notify-item">
                                            <a href="" class="header__notify-link">
                                                <img src="https://myphamohuichinhhang.vn/wp-content/uploads/2016/08/xcream.png.pagespeed.ic_.Otm_Ys4I60.png" alt="" class="header__notify-img">
                                                <div class="header__notify-info">
                                                    <span class="header__notify-name">
                                                        Sale sốc bộ dưỡng Ohui The First tái tạo trẻ hóa da 
                                                        SALE OFF 70%
                                                    </span>
                                                    <span class="header__notify-description">Giá chỉ còn 350k( giá gốc 1750k)</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="header__notify-item">
                                            <a href="" class="header__notify-link">
                                                <img src="https://myphamohuichinhhang.vn/wp-content/uploads/2016/08/xcream.png.pagespeed.ic_.Otm_Ys4I60.png" alt="" class="header__notify-img">
                                                <div class="header__notify-info">
                                                    <span class="header__notify-name">Ohui chính thức ra mắt dòng son lì mới The First Genture Lipstick</span>
                                                    <span class="header__notify-description">Siêu bão Mawar giật trên cấp 17 có ảnh hưởng đến Việt Nam</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <footer class="header__notify-footer">
                                        <a href="" class="header__notify-footer-btn">Xem tất cả</a>
                                    </footer>
                                </div>
                            </li>
                            <li class="header__navbar-item">
                                <a href="" class="header__navbar-item-link">
                                    <i class="header__navbar-icon fa-regular fa-circle-question"></i>
                                    Trợ giúp
                                </a>
                            </li>
                            <!-- <li class="header__navbar-item header__navbar-item--bold header__navbar-item--separate">Đăng ký</li>
                            <li class="header__navbar-item header__navbar-item--bold">Đăng nhập</li> -->
                            <li class="header__navbar-item header__navbar-user">
                                <img src="https://kynguyenlamdep.com/wp-content/uploads/2022/06/avatar-cute-meo-con-than-chet-700x695.jpg" alt="" class="header__navbar-user-img">
                                <span class="header__navbar-user-name">Nguyễn Đương</span>

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
                    </nav>
                    <!-- header with search -->
                    <div class="header-with-search">
                        <div class="header__logo">
                            <a href="/" class="header__logo-link">
                               <img class="logoimg" src="./assets/img/logo5.jpg" alt="" style="width: 200px; height: 100px;">
                            </a>
                        </div>
                    <form action="" method="post">
                        <div class="header__search" >
                            <div class="header__search-input-wrap">
                                <input type="text" name="txttimkiem" class="header__search-input" placeholder="Nhập để tìm kiếm" >
                                
                                <!-- Search history -->
                                <div class="header__search-history">
                                    <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                                    <ul class="header__search-history-list">
                                        <li class="header__search-history-item">
                                            <a href="">Kem dưỡng da</a>
                                        </li>
                                        <li class="header__search-history-item">
                                            <a href="">Kem dưỡng ẩm</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="header__search-select">
                                <span class="header__search-select-label">Trong shop</span>
                                <i class="header__search-select-icon fa-solid fa-angle-down"></i>
                                <ul class="header__search-option">
                                    <li class="header__search-option-item">
                                        <span>Trong shop</span>
                                        <i class="fa-solid fa-check"></i>
                                    </li>
                                    <li class="header__search-option-item">
                                        <span>Ngoài shop</span>
                                        <i class="fa-solid fa-check"></i>
                                    </li>
                                </ul>
                            </div>
                            <button name="btntim" class="header__search-btn">
                                <i class="header__search-btn-icon fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                        <!-- cart layout -->
                        <div class="header__cart">
                            <div class="header__cart-wrap">
                           
                                <i class="header__cart-icon fa-solid fa-cart-shopping"></i>
                                <span class="header__cart-notice">3</span>

                                <!-- no cart: header__cart-list--no-cart -->
                                <div class="header__cart-list  ">
                                    <img src="./assets/img/no_cart.png" alt="" class="header__cart-no-cart-img">
                                    <span class="header__cart-list-no-cart-msg">
                                        Chưa có sản phẩm
                                    </span>

                                    <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                                    <ul class="header__cart-list-item">
                                        <!-- cart item -->
                                        <li class="header__cart-item">
                                            <img src="https://www.tugo.com.vn/wp-content/uploads/1591679365_l1.jpg" alt="" class="header__cart-img">
                                            <div class="header__cart-item-info">
                                                <div class="header__cart-item-head">
                                                    <h5 class="header__cart-item-name">Bộ kem đặc trị mụn đặc trị mụn đặc trị mụn đặc trị mụn đặc trị mụn đặc trị mụn đặc trị mụn đặc trị mụn</h5>
                                                    <div class="header__cart-item-price-wrap">
                                                        <span class="header__cart-item-price">2.000.000đ</span>
                                                        <span class="header__cart-item-mulitply">x</span>
                                                        <span class="header__cart-item-qnt">2</span>
                                                    </div>
                                                </div>
                                                <div class="header__cart-item-body">
                                                    <span class="header__cart-item-desription">
                                                        Phân loại: Bạc
                                                    </span>
                                                    <span class="header__cart-item-remove">Xóa</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="header__cart-item">
                                            <img src="https://ohui.vn/wp-content/uploads/2022/03/SET-OHUI-XANH-PRIME-ADVANCER-SPECIAL-SET.jpg" alt="" class="header__cart-img">
                                            <div class="header__cart-item-info">
                                                <div class="header__cart-item-head">
                                                    <h5 class="header__cart-item-name">Bộ kem đặc trị sạm da</h5>
                                                    <div class="header__cart-item-price-wrap">
                                                        <span class="header__cart-item-price">1.000.000đ</span>
                                                        <span class="header__cart-item-mulitply">x</span>
                                                        <span class="header__cart-item-qnt">2</span>
                                                    </div>
                                                </div>
                                                <div class="header__cart-item-body">
                                                    <span class="header__cart-item-desription">
                                                        Phân loại: Bạc
                                                    </span>
                                                    <span class="header__cart-item-remove">Xóa</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="header__cart-item">
                                            <img src="https://product.hstatic.net/200000536477/product/49_f2635788e69a4d0e8fd919e2d6d11d79.jpg" alt="" class="header__cart-img">
                                            <div class="header__cart-item-info">
                                                <div class="header__cart-item-head">
                                                    <h5 class="header__cart-item-name">Bộ kem đặc trị tàn nhang</h5>
                                                    <div class="header__cart-item-price-wrap">
                                                        <span class="header__cart-item-price">1.500.000đ</span>
                                                        <span class="header__cart-item-mulitply">x</span>
                                                        <span class="header__cart-item-qnt">1</span>
                                                    </div>
                                                </div>
                                                <div class="header__cart-item-body">
                                                    <span class="header__cart-item-desription">
                                                        Phân loại: Bạc
                                                    </span>
                                                    <span class="header__cart-item-remove">Xóa</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                    <a href="" class="header__cart-view-cart btn btn--primary">Xem giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="app__container">
                <div class="grid">
                    <div class="grid__row app__content">
                        <div class="grid__column-2">
                            <nav class="category">
                                <h3 class="category__heading">
                                    <i class="category__heading-icon fa-solid fa-list"></i>
                                    Danh mục
                                </h3>
                                <ul class="category-list">
                                    <li class="category-item category-item--active">
                                        <a href="#" class="category-item__link">Mỳ ăn liền</a>
                                    </li>
                                    <li class="category-item">
                                        <a href="#" class="category-item__link">Chăm sóc da mặt</a>
                                    </li>
                                    <li class="category-item">
                                        <a href="#" class="category-item__link">Đồ dùng cá nhân</a>
                                    </li>
                                    <li class="category-item">
                                        <a href="#" class="category-item__link">Chăm sóc tóc</a>
                                    </li>
                                    <li class="category-item">
                                        <a href="#" class="category-item__link">Đồ dùng nhà bếp</a>
                                    </li>
                                    <li class="category-item">
                                        <a href="#" class="category-item__link">Sữa</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        
                        <div class="grid__column-10">
                            <div class="home-filter">
                                <span class="home-filter__label">Sắp xêp theo</span>
                                <button class="home-filter__btn btn">Phổ biến</button>
                                <button class="home-filter__btn btn btn--primary">Mới nhất</button>
                                <button class="home-filter__btn btn">Bán chạy</button>

                                <div class="select-input">
                                    <span class="select-input__label">Giá</span>
                                    <i class="select-input__icon fa-solid fa-angle-down"></i>

                                    <!-- list option -->
                                    <ul class="select-input__list">
                                        <li class="select-input__item">
                                            <a href="" class="select-input__link">Giá: Thấp đến cao</a>
                                        </li>
                                        <li class="select-input__item">
                                            <a href="" class="select-input__link">Giá: Cao đến thấp</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="home-filter__page">
                                    <span class="home-filter__page-num">
                                        <span class="home-filter__page-curent">1</span>/14
                                    </span>
                                    <div class="home-filter__page-control">
                                        <a href="" class="home-filter__page-btn home-filter__page-btn--disable">
                                            <i class="home-filter__page-icon fa-solid fa-angle-left"></i>
                                        </a>
                                        <a href="" class="home-filter__page-btn">
                                            <i class="home-filter__page-icon fa-solid fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="home-product">
                                <div class="grid__row">
                                    <!-- product item -->
<?php 
                                
  
                                 
    for ($i = 0; $i < 10; $i++) {
        $row = mysqli_fetch_assoc($result);
    
        if ($row) {
            if($row['PhanTramKhuyenMai'] == null)
            {
                $row['PhanTramKhuyenMai'] = 0;
                $giabannew = $row['GiaBan'] ;
            }
            else{  
                $giabannew = $row['GiaBan'] * ( $row['PhanTramKhuyenMai'] / 100);
            }
            echo '<a class="home-product-item" href="#"  onclick="showModal(\'' . $row['TenSanPham'] . '\', \'' . $row['Anh'] . '\', \'' . $row['GiaBan'] . '\')">
                <form method="POST" action="upload.php" enctype="multipart/form-data"> 
                    <div class="grid__column-1-5">
                    <div class="home-product-item__img" style="background-image: url(photo/' . $row['Anh'] . ');"></div>
                    
                </form> 
                <h4 class="home-product-item__name">' . $row['TenSanPham'] . '</h4>
                <div class="home-product-item__price">
                    <span class="home-product-item__price-old">' . $row['GiaBan'] . '</span>
                    <span class="home-product-item__price-new">'.$giabannew.'</span>
                </div>
                <div class="home-product-item__action">
                    <div class="home-product-item__rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="home-product-item__sold">Đã bán 60k</h4>
                </div>
                <h4 class="home-product-item__origin">Hà Nội</h4>
                <div class="home-product-item__favorite">
                    <i class="fa-solid fa-check"></i>
                    <span>Yêu thích</span>
                </div>
                <div class="home-product-item__sale-off">
                    <span class="home-product-item__sale-off-percent">'.  $row['PhanTramKhuyenMai'].'%</span>
                    <span class="home-product-item__sale-off-label">GIẢM</span>
                </div>
            </a>
        </div>';
        } else {
            break; // Nếu không còn dữ liệu, thoát khỏi vòng lặp
        }
    }
    mysqli_close($con);
?>

                                  
                                   
                            </div>
                        </div>
                          




<!-- Modal -->
<!-- Modal -->
<div id="productModal" class="modal">
  <div class="modal-contentner">
    <span class="close" onclick="closeModal()">&times;</span>
    <div id="modalProductInfo">
    '<a class="home-product-item" href="#">
      <div class="grid__column-1-5">
           <img id="modalProductImage" class="home-product-item__img" src="" alt="Product Image">
                    
               
<input type="text" name="txttensp" class="home-product-item__name" id="modalProductNameInput" readonly>
                <div class="home-product-item__price">
                <input type="text" name="txtgiasp" class="home-product-item__price-old" id="modalProductPriceInput" readonly>
                    <span class="home-product-item__price-new"></span>
                </div>
                <div class="home-product-item__action">
                    <div class="home-product-item__rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="home-product-item__sold">Đã bán 60k</h4>
                </div>
                <h4 class="home-product-item__origin">Hà Nội</h4>
                <div class="home-product-item__favorite">
                    <i class="fa-solid fa-check"></i>
                    <span>Yêu thích</span>
                </div>
                <div class="home-product-item__sale-off">
                    <span class="home-product-item__sale-off-percent">%</span>
                    <span class="home-product-item__sale-off-label">GIẢM</span>
                </div>
            </a>
        </div>';
      <div class="modal-buttons">
        <button name="btnthemgiohang" onclick="addToCart()">Thêm vào giỏ hàng</button>
        <button name="btnmuangay" onclick="buyNow()">Mua ngay</button>
      </div>
    </div>
  </div>
</div>
<script>
function showModal(name, image, price) {
    var modal = document.getElementById("productModal");
    var modalProductName = document.getElementById("modalProductName");
    var modalProductImage = document.getElementById("modalProductImage");
    var modalProductPrice = document.getElementById("modalProductPrice");
    var modalProductNameInput = document.getElementById("modalProductNameInput");
    var modalProductPriceInput = document.getElementById("modalProductPriceInput");

    modalProductNameInput.value = name;
    modalProductImage.src = "photo/" + image;
    modalProductPriceInput.value = price;

    modal.style.display = "flex";
  }

  function closeModal() {
    var modal = document.getElementById("productModal");
    modal.style.display = "none";
  }
</script>
                            <ul class="pagination home-product__pagination">
                                <li class="pagination-item">
                                    <a href="" class="pagination-item__link">
                                        <i class="pagination-item__icon fa-solid fa-angle-left"></i>
                                    </a>
                                </li>
                                <li class="pagination-item pagination-item--active">
                                    <a href="" class="pagination-item__link">1</a>
                                </li>
                                <li class="pagination-item">
                                    <a href="" class="pagination-item__link">2</a>
                                </li>
                                <li class="pagination-item">
                                    <a href="" class="pagination-item__link">3</a>
                                </li>
                                <li class="pagination-item">
                                    <a href="" class="pagination-item__link">4</a>
                                </li>
                                <li class="pagination-item">
                                    <a href="" class="pagination-item__link">5</a>
                                </li>
                                <li class="pagination-item">
                                    <a href="" class="pagination-item__link">...</a>
                                </li>
                                <li class="pagination-item">
                                    <a href="" class="pagination-item__link">14</a>
                                </li>
                                <li class="pagination-item">
                                    <a href="" class="pagination-item__link">
                                        <i class="pagination-item__icon fa-solid fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="grid">
                    <div class="grid__row">
                        <div class="grid__column-2-4">
                            <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                            <ul class="footer-list">
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Trung Tâm Trợ Giúp</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Blog</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Mall</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Hướng Dẫn Mua Hàng</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Hướng Dẫn Bán Hàng</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Thanh Toán</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Vận Chuyển</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Trả Hàng & Hoàn Tiền</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Chăm Sóc Khách Hàng</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Chính Sách Bảo Hành</a>
                                </li>
                            </ul>
                        </div>
                        <div class="grid__column-2-4">
                            <h3 class="footer__heading">Giới thiệu</h3>
                            <ul class="footer-list">
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Giới Thiệu</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Tuyển Dụng</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Điều Khoản</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Chính Sách Bảo Mật</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Chính Hãng</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Kênh Người Bán</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Flash Sales</a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">Liên Hệ Với Truyền Thông</a>
                                </li>
                            </ul>
                        </div>
                        <div class="grid__column-2-4">
                            <h3 class="footer__heading">Thanh toán</h3>
                            <ul class="footer-list_pay">
                                <li class="footer-item">
                                    <img src="https://down-vn.img.susercontent.com/file/d4bbea4570b93bfd5fc652ca82a262a8" alt="" class="footer__pay-apps-img">
                                </li>
                                <li class="footer-item">
                                    <img src="https://down-vn.img.susercontent.com/file/a0a9062ebe19b45c1ae0506f16af5c16" alt="" class="footer__pay-apps-img">
                                </li>
                                <li class="footer-item">
                                    <img src="https://down-vn.img.susercontent.com/file/38fd98e55806c3b2e4535c4e4a6c4c08" alt="" class="footer__pay-apps-img">
                                </li>
                                <li class="footer-item">
                                    <img src="https://down-vn.img.susercontent.com/file/bc2a874caeee705449c164be385b796c" alt="" class="footer__pay-apps-img">
                                </li>
                                <li class="footer-item">
                                    <img src="https://down-vn.img.susercontent.com/file/2c46b83d84111ddc32cfd3b5995d9281" alt="" class="footer__pay-apps-img">
                                </li>
                                <li class="footer-item">
                                    <img src="https://down-vn.img.susercontent.com/file/5e3f0bee86058637ff23cfdf2e14ca09" alt="" class="footer__pay-apps-img">
                                </li>
                            </ul>
                        </div>
                        <div class="grid__column-2-4">
                            <h3 class="footer__heading">Theo dõi chúng tôi trên</h3>
                            <ul class="footer-list">
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">
                                        <i class="footer-item__icon fa-brands fa-facebook"></i>
                                        Facebook
                                    </a>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">
                                        <i class="footer-item__icon fa-brands fa-square-instagram"></i>
                                        Instagram
                                    </a>
                                </li>
                                <li class="footer-item">
                                    <a href="" class="footer-item__link">
                                        <i class="footer-item__icon fa-brands fa-linkedin"></i>
                                        LinkedIn
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="grid__column-2-4">
                            <h3 class="footer__heading">Tải ứng dụng ngay thôi</h3>
                            <div class="footer__download">
                                <a href="https://shopee.vn/web" class="footer__download-qr-link">
                                    <img src="/f8shop/assets/img/qr_code.png" alt="" class="footer__download-qr">
                                </a>
                                <div class="footer__download-apps">
                                    <a href="https://apps.apple.com/vn/app/5-5-shopee-outlet/id959841449?l=vi" class="footer__download-app-link">
                                        <img src="/f8shop/assets/img/app_store.png" alt="" class="footer__download-app-img">
                                    </a>
                                    <a href="https://play.google.com/store/search?q=shopee&c=apps&hl=vi" class="footer__download-app-link">
                                        <img src="/f8shop/assets/img/gg_play.png" alt="" class="footer__download-app-img">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer__bottom">
                    <div class="grid">
                        <p class="footer__text">© 2023 - Bản quyền thuộc về Công ty QNA</p>
                    </div>
                </div>
            </footer>
        </div>

 
            </div> 
        </div>
    </body>
</html>


  
   