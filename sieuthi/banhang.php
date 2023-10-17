<?php
// Kết nối đến cơ sở dữ liệu MySQL
$con =mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
$currentDate = date('Y-m-d');
$sql_banhang = "SELECT sp.MaSanPham, sp.TenSanPham, sp.MaNhaCungCap, sp.Anh, sp.NgaySanXuat, sp.HanSuDung, sp.GiaBan, km.PhanTramKhuyenMai
                FROM sanpham AS sp
                LEFT JOIN khuyenmai AS km ON sp.MaSanPham = km.MaSanPham
                WHERE sp.HanSuDung > '$currentDate'";
$result = mysqli_query($con, $sql_banhang);
if (isset($_POST['btn_thanhtoan'])) {
// Lấy ngày và giờ hiện tại


$tongtien = $_POST['txttongtien'];
$mkh= $_POST['txtmakhachhang'];
// Câu lệnh INSERT vào bảng
$sql = "INSERT INTO hoadon (MaKhachHang,TongTien, NgayTao) VALUES ('$mkh','$tongtien', '$currentDate')";
$kq_5 = mysqli_query($con, $sql);
            
if ($kq_5) {
    echo "<script>alert('Thêm mới thành công!')</script>";
    echo "<script>window.location.href='./banhang.php'</script>";
    exit;
} else {
    echo "<script>alert('Thêm mới thất bại!')</script>";
}
}
if(isset($_POST['btntimkiem'])){
    $tk=$_POST['txttimkiem'];
    $sqltk9 = "SELECT sp.MaSanPham, sp.TenSanPham, sp.MaNhaCungCap, sp.Anh, sp.NgaySanXuat, sp.HanSuDung, sp.GiaBan, km.PhanTramKhuyenMai
    FROM sanpham AS sp
    LEFT JOIN khuyenmai AS km ON sp.MaSanPham = km.MaSanPham
    WHERE sp.TenSanPham LIKE '%$tk%' and  sp.HanSuDung > '$currentDate'";

    $result=mysqli_query($con,$sqltk9);
}
if(isset($_POST['btn_thanhtoan'])){

    $objExcel=new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet=$objExcel->getActiveSheet()->setTitle('DSHD');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A'.$rowCount,'Mã hóa đơn');
    $sheet->setCellValue('B'.$rowCount,'Mã khách hàng');
    $sheet->setCellValue('C'.$rowCount,'Tổng tiền');
    $sheet->setCellValue('D'.$rowCount,'Ngày tạo');
   
   
    //định dạng cột tiêu đề
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    
    //gán màu nền
    $sheet->getStyle('A'.$rowCount.':D'.$rowCount)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
    //căn giữa
    $sheet->getStyle('A'.$rowCount.':D'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
    $mhd=$_POST['txtmahd'];
    
    $sqltk="SELECT * FROM hoadon WHERE MaHoaDon like '%$mhd' ";
    $data1 = mysqli_query($con4n,$sqltk);

    while($row=mysqli_fetch_array($data1)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['MaHoaDon']);
        $sheet->setCellValue('B'.$rowCount,$row['MaKhachHang']);
        $sheet->setCellValue('C'.$rowCount,$row['TongTien']);
        $sheet->setCellValue('D'.$rowCount,$row['NgayTao']);
        
    }
    //Kẻ bảng 
    $styleAray=array(
        'borders'=>array(
            'allborders'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN
            )
        )
        );
    $sheet->getStyle('A2:'.'D'.($rowCount))->applyFromArray($styleAray);
    $objWriter=new PHPExcel_Writer_Excel2007($objExcel);
    $fileName='ExportExcel.xlsx';
    $objWriter->save($fileName);
    header('Content-Disposition: attachment; filename="'.$fileName.'"');
    header('Content-Type: application/vnd.openxlmformatsofficedocument.speadsheetml.sheet');
    header('Content-Length: '.filesize($fileName));
    header('Content-Transfer-Encoding:binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($fileName);
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
                                <?php
                                        if (isset($data) && $data != null) {
                                            while ($row = mysqli_fetch_array($data)) {
                                                ?>
                                                <span class="header__navbar-user-name"><?php echo $row['TenNhanVien'] ?></span>
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
                    </nav>
                    <!-- header with search -->
                    <div class="header-with-search">
                        <div class="header__logo">
                           <img class="logoimg" src="./assets/img/logo5.jpg" alt="">
                        </div>

                        
                        <!-- cart layout -->
                      
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="app__container">
                <div class="grid">
                    <div class="grid__row app__content">
                        <div class="grid__column-4 boder_5">
                            <div class="are_scroll">

                                <div class="header__search">
                                    <div class="header__search-input-wrap">
                                        <form action="" method="post">

                                            <input type="text" name="txtmakhachhang" class="header__search-input" placeholder="Nhập Mã Khách Hàng">
                                        
                                        
                                        <!-- Search history -->
                                       
                                    </div>
                                    
                                    <button class="header__search-btn">
                                        <i class="header__search-btn-icon fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
        
                                    <nav class="category">
                                        <h3 class="category__heading">
                                            <i class="category__heading-icon fa-solid fa-list"></i>
                                         Thanh Toán
                                        </h3>
                                        <table>
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody id="productInfo">
                </tbody>
            </table>
            <div class="pay"  >
                  
        
                        <input name="txttongtien" class="txttongtien" type="number" value="0">
                        <input name="btn_thanhtoan" class="btn_thanhtoan" type="submit" value="Thanh Toán" >
                    </form>
            </div>
        </nav>
        </div>
                            </div>
                       
                        <div class="grid__column-6">
                           

                            <div class="home-product">
                                <form action="" method="post">

                                    <div class="header__search">
                                    <div class="header__search-input-wrap">
                                        <input name="txttimkiem" type="text" class="header__search-input" placeholder="Nhập để tìm kiếm">
                                        
                                        <!-- Search history -->
                                       
                                    </div>
                                    <div class="header__search-select">
                                        <span class="header__search-select-label">Trong shop</span>
                                        <i class="header__search-select-icon fa-solid fa-angle-down"></i>
                                       
                                    </div>
                                    <button name="btntimkiem" class="header__search-btn">
                                        <i class="header__search-btn-icon fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                                </form>

                                <div class="grid__row">
                                    
                                    <!-- product item -->
                                        <?php 
                                                                        
                                      
                                                           
for ($i = 0; $i < 20; $i++) {
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
                                                   echo '<a class="home-product-item" href="#">
                                                        <form method="POST" action="upload.php" enctype="multipart/form-data"> 
                                                            <div class="grid__column-1-5">
                                                                <img class="homeimg-product-item__img" src="photo/' . $row['Anh'] . '" alt="">
                                                            
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
                          






                           
                        </div>
                    </div>
                </div>
            </div>

      
        </div>

 
            </div> 
        </div>
        <script src="banhang.js"></script>
    </body>
</html>


  
   