<?php
$conn=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
$curenDate=date('Y-m-d');
        $sql_sohoadon = " SELECT COUNT(DISTINCT MaHoaDon) AS count FROM hoadon";
$sql_sosanpham = "SELECT COUNT(DISTINCT MaSanPham) AS count FROM sanpham where HanSuDung > '$curenDate'";
$sql_sonhanvien = "SELECT COUNT(DISTINCT SDT) AS count FROM nhanvien";
$sql_sokhachhang = "SELECT COUNT(DISTINCT SDT) AS count FROM khachhang";
$kq1 = mysqli_query($conn,$sql_sohoadon);
$kq2 = mysqli_query($conn,$sql_sosanpham);

$kq3 = mysqli_query($conn,$sql_sonhanvien);
$kq4 = mysqli_query($conn,$sql_sokhachhang);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .large-number {
            font-size: 30px;
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>
    <?php 
        include_once './contac.php'
    ?>
    <div class="conten are_display">
        <div class="main_item">
            <div class="item_baoboc">
                <a class="item_app" href="./hoadon.php">
                    <div class="item_name">
                        <div class="span-css">

                            <span  class="large-number"> <?php echo mysqli_fetch_assoc($kq1)['count']; ?></span><span>Tổng hóa đơn</span>
                        </div>
                        <i class=" btn btn-info item_icon fa-solid fa-money-bill-1-wave "></i>
                    </div>
                </a>
                <a class="item_app" href="./Quanlysanpham.php">
                    <div class="item_name">
                    <div class="span-css">
                        <span class="large-number"><?php echo mysqli_fetch_assoc($kq2)['count']; ?></span><span>Các mặt hàng đang bán </span>
                    </div>
                        <i style="color:white" class=" btn btn-warning item_icon fa-solid fa-cart-shopping"></i>
                    </div>
                </a>
            </div>
            <div class="item_baoboc">
                <a class="item_app" href="./Quanlykhachhang.php">
                    <div class="item_name">
                    <div class="span-css">
                        
                        <span class="large-number"><?php echo mysqli_fetch_assoc($kq4)['count']; ?></span><span>Số Khách Hàng</span>
                    </div>
                        <i class="btn btn-primary  item_icon fa-solid fa-users-line"></i>
                    </div>
                </a>
                <a class="item_app" href="./dsnv.php">
                    <div class="item_name">
                    <div class="span-css">
                        <span class="large-number"><?php echo mysqli_fetch_assoc($kq3)['count']; ?></span><span>Nhân Viên</span> 
                    </div>
                        <i class="  btn btn-danger  item_icon fa-solid fa-user-tie"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="conten_dieukhien" >
            <br>
            <br>
            
            <br>
            <p > MANAGE 999 SỰ LỰA CHỌN CỦA BẠN và tôi </p>
           
            <br>
            <br>
            <br>
            <br>
            
            
          

        </div>
    </div>

    
    <style>
        .search-add-filter{
            display: none;
        }
        .form-control{
            width: 550px;
            height:40px;
        }
    </style>
    <script>
        // Lấy dữ liệu từ localStorage
        var selectedCellData = localStorage.getItem('selectedCellData');

        // Tìm và đánh dấu ô có dữ liệu tương tự
        var cells = document.getElementsByClassName('menu__item');
        for (var i = 0; i < cells.length; i++) {
            if (cells[i].innerText === selectedCellData) {
                cells[i].classList.add('highlight');
            }
        }
    </script> 
</body>
</html>