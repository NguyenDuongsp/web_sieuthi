<?php
include_once'./Classes/PHPExcel.php';
include_once'./Classes/PHPExcel/IOFactory.php';

//B1: kết nối đến database
$con_3=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
$mdh=''; $mKH='';$sdt_dh=''; $gmail_dh=''; $ngaylap_dh=''; $sl_dh='';$ngaytaoDH=''; $tongtien_dh=''; $tinhtrang_dh='';
//tạo và thực hiện truy vấn
$sql_3=" SELECT* FROM donhang ";
$data_3=mysqli_query($con_3, $sql_3);
//xư lý button tìm kiếm
if(isset($_POST['btntim'])){
    $mdh=$_POST['txttimkiem'];
    $sqltk_3="SELECT * FROM donhang WHERE MaDonHang like '%$mdh%'";
    $data_3=mysqli_query($con_3, $sqltk_3);
}
//Xử lý button luu
if(isset($_POST['btnLuu'])){
    $mdh=$_POST['txtMaDonHang'];
    $mKH=$_POST['txtMaKhachHang'];
    $sdt_dh=$_POST['txtSDT'];
    $gmail_dh=$_POST['txtGmail'];
    $ngaylap_dh=$_POST['txtNgayLap'];
    $tontien_dh=$_POST['txtTongTien'];
    $tinhtrang_dh=$_POST['txtTinhTrang'];
    //ktra dữ liệu rỗng (manhacungcap)
    if($mdh==''){
        echo "<script>alert('Phải nhập mã đơn hàng')</script>";
    }
    else{
         //ktra trùng khóa chính (manhacungcap)
    $sql_3="SELECT * FROM donhang WHERE MaDonHang='$mdh'";
    $dt_3=mysqli_query($con_3, $sql_3);
    if(mysqli_num_rows($dt_3)>0){
        echo "<script>alert('Trùng mã đơn hàng')</script>";
    }
    else{
        //tạo và thực hiện truy vấn chèn dữ liệu vào bảng khachhang
        //$sql_3 ="INSERT INTO donhang (MaDonHang, MaKhachHang, SDT, Gmail, NgayLap, soluongdh, ngaytaodh, TongTien, TinhTrang) VALUES ('$mdh, '$$mKH','$sdt_dh', '$gmail_dh', '$NgayLap, '$$sl_dh','$ngaytaoDH', '$TongTien', '$TinhTrang')";
        // $kq = mysqli_query($con2,$sql);
        $sql_3="INSERT INTO donhang VALUES('$mdh', '$mKH','$sdt_dh', '$gmail_dh', '$ngaylap_dh', '$tongtien_dh', '$tinhtrang_dh')";
        $kq_3=mysqli_query($con_3,$sql_3);
        if($kq_3){
            echo "<script>alert('Thêm mới thành công!')</script>";
            echo "<script>window.location.href='./Quanlydonhang.php'</script>";
                    exit;
            }
        else echo "<script>alert('Thêm mới thất bại!')</script>";
        }

    }
}


//XỬ lý xuất Excel
if(isset($_POST['btnxuatexcel'])){
    //code xuất excel
    $objExcel=new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet=$objExcel->getActiveSheet()->setTitle('QLDH');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A'.$rowCount,'Mã Đơn Hàng');
    $sheet->setCellValue('B'.$rowCount,'Mã Khách Hàng');
    $sheet->setCellValue('C'.$rowCount,'SDT');
    $sheet->setCellValue('D'.$rowCount,'Gmail');
    $sheet->setCellValue('E'.$rowCount,'Ngày Lập');
    $sheet->setCellValue('F'.$rowCount,'Tổng tiền');
    $sheet->setCellValue('G'.$rowCount,'Tình trạng');
    //định dạng cột tiêu đề
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    //gán màu nền
    $sheet->getStyle('A'.$rowCount.':G'.$rowCount)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
    //căn giữa
    $sheet->getStyle('A'.$rowCount.':G'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
    $mdh=$_POST['txtMaDonHang'];
    $mKH=$_POST['txtMaKhachHang'];
    $sqltk_3="SELECT * FROM donhang WHERE MaDonHang like '%$mdh%' and MaKhachHang like '%$mKH%' ";
    $data_3=mysqli_query($con_3, $sqltk_3);

    while($row=mysqli_fetch_array($data_3)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['MaDonHang']);
        $sheet->setCellValue('B'.$rowCount,$row['MaKhachHang']);
        $sheet->setCellValue('C'.$rowCount,$row['SDT']);
        $sheet->setCellValue('D'.$rowCount,$row['Gmail']);
        $sheet->setCellValue('E'.$rowCount,$row['NgayLap']);
        $sheet->setCellValue('F'.$rowCount,$row['TongTien']);
        $sheet->setCellValue('G'.$rowCount,$row['TinhTrang']);
    }
    //Kẻ bảng 
    $styleAray=array(
        'borders'=>array(
            'allborders'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN
            )
        )
        );
    $sheet->getStyle('A1:'.'G'.($rowCount))->applyFromArray($styleAray);
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

//ngắt kết nối
mysqli_close($con_3);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
   
     .highlight{
           
            background-Color : #202126;
            border-Left :3px solid #dce1ea;
        }
    </style>
  
</head>
<body>

        <form method="post" action="">
        <?php 
            include_once'./contac.php';

            ?>
        <div class="conten">
           
            
            <table class="table table-striped">
                <tr>
                        <td colspan="9" style="text-align: left;">
                            <h2>THÔNG TIN ĐƠN HÀNG</h2>
                        </td>
                    </tr>
    
                    <tr >
                      
                        <td colspan="9" class="cold2">
                          
                        </td>
                    </tr>
                <tr >
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Mã khách hàng</th>
                    <th>SDT</th>
                    <th>Gmail</th>
                    <th>Ngày lập</th>
                    <th>Tổng tiền</th>
                    <th>Tình trạng</th>
                    <th>Công cụ</th>

                </tr>
                <?php
                //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                if(isset($data_3)&& $data_3!=null){
                    $i=0;
                    while($row=mysqli_fetch_array($data_3)){
                ?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td><?php echo isset($row['MaDonHang']) ? $row['MaDonHang'] : ''; ?></td>
                        <td><?php echo isset($row['MaKhachHang']) ? $row['MaKhachHang'] : ''; ?></td>
                        <td><?php echo isset($row['SDT']) ? $row['SDT'] : ''; ?></td>
                        <td><?php echo isset($row['Gmail']) ? $row['Gmail'] : ''; ?></td>
                        <td><?php echo isset($row['NgayLap']) ? $row['NgayLap'] : ''; ?></td>
                        <td><?php echo isset($row['TongTien']) ? $row['TongTien'] : ''; ?></td>
                        <td><?php echo isset($row['TinhTrang']) ? $row['TinhTrang'] : ''; ?></td>
                        <td>
                            <span class="btntool btn btn-primary">

                                <a href="./Donhang_sua.php?MaDonHang=<?php echo $row['MaDonHang'] ?>">Sửa</a>&nbsp;&nbsp;
                            </span>
                            <span class="btntool btn btn-danger">

                                <a href="./Donhang_xoa.php?MaDonHang=<?php echo $row['MaDonHang'] ?>">Xóa</a>
                            </span>
                        </td>
                    </tr>
                <?php        
                        }
                    }
                    //kết thúc b3
                ?>
            </table>
        </div>
        </form>
        
        <div class="modal js-modal">
              <div class="modal-container js-modal-container">
                <div class="modal-close js-modal-close">
                <i class="fa-solid fa-xmark"></i>
                </div>
                    <form method="post" action="">
                    <table>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5 >CẬP NHẬT THÔNG TIN ĐƠN HÀNG</h5>
                    </td>
                </tr>

                <tr>
                    <td class="col1">Mã đơn hàng</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaDonHang" value="<?php echo $mdh ?>" style="width:450px;">
                    </td>

                </tr>
                <tr>
                    <td class="col1">Mã khách hàng</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaKhachHang"value="<?php echo $mKH ?>" style="width:450px;">
                    </td>
                    
                </tr>
                <tr>
                    <td class="col1">Mã sản phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtSDT" value="<?php echo $sdt_dh ?>" style="width:450px;">
                    </td>
                </tr>
                
                <tr>
                    <td class= "col1">Tên sản phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtGmail" value="<?php echo $gmail_dh ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Giá bán</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtNgayLap" value="<?php echo $ngaylap_dh ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Tổng tiền</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTongTien" value="<?php echo $tongtien_dh ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Tình trạng đơn hàng</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTinhTrang" value="<?php echo $tinhtrang_dh ?>" style="width:450px;">
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
    <script  >
        const buyBtn= document.querySelector('.js-buy-ticket')
       const modal=document.querySelector('.js-modal')
       const modalClose=document.querySelector('.js-modal-close')
       const modalContainer=document.querySelector('.js-modal-container')
       //thêm class open vào modal

       function showBuyTickers(){
              modal.classList.add('open')
               var formElement = document.querySelector('form');
            formElement.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form submission

                 // Call the function to show the modal
                // Additional logic for form submission if needed
            });
            
       }
       
       //gỡ bỏ class open khỏi modal
       function hideBuyTickers(){
              modal.classList.remove('open')
              var form = document.querySelector('form');
          form.submit();
       }
        
            
            buyBtn.addEventListener('click',showBuyTickers)
        
        modalClose.addEventListener('click',hideBuyTickers)

        modal.addEventListener('click',hideBuyTickers)

        modalContainer.addEventListener('click',function(event){
           event.stopPropagation()      })
          
    </script>

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