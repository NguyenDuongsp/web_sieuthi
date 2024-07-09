<?php
include_once'./Classes/PHPExcel.php';
include_once'./Classes/PHPExcel/IOFactory.php';
$mKH=''; $tKH='';$tenTK=''; $SDT='';$Gmail='';
//B1: kết nối đến database
$con_1=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
//tạo và thực hiện truy vấn
$sql_1="SELECT*FROM khachhang";
$data_1=mysqli_query($con_1, $sql_1);
//xư lý button tìm kiếm
if(isset($_POST['btntim'])){
    $mKH=$_POST['txttimkiem'];
    $sqltk_1="SELECT * FROM khachhang WHERE MaKhachHang like '%$mKH%'";
    $data_1=mysqli_query($con_1, $sqltk_1);
}
//Xử lý button luu
if(isset($_POST['btnLuu'])){
    $mKH=$_POST['txtMaKhachHang'];
    $tKH=$_POST['txtTenKhachHang'];
    $tenTK=$_POST['txtTenTaiKhoan'];
    $SDT=$_POST['txtSDT'];
    $Gmail=$_POST['txtGmail'];
    //ktra dữ liệu rỗng (MaKhachHang)
    if($mKH==''){
        echo "<script>alert('Phải nhập mã khách hàng')</script>";
    }
    else{
         //ktra trùng khóa chính (MaKhachHangngng)
    $sql_1="SELECT * FROM khachhang WHERE MaKhachHang='$mKH'";
    $dt_1=mysqli_query($con_1, $sql_1);
    if(mysqli_num_rows($dt_1)>0){
        echo "<script>alert('Trùng mã loại')</script>";
    }
    else{
        //tạo và thực hiện truy vấn chèn dữ liệu vào bảng khachhang
        $sql_1="INSERT INTO khachhang VALUES('$mKH', '$tKH', '$tenTK', '$SDT', '$Gmail')";
        $kq_1=mysqli_query($con_1, $sql_1);
        if($kq_1) {
        echo "<script>alert('Thêm mới thành công!')</script>";
        echo "<script>window.location.href='./Quanlykhachhang.php'</script>";
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
    $sheet=$objExcel->getActiveSheet()->setTitle('QLKH');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A'.$rowCount,'Mã Khách Hàng');
    $sheet->setCellValue('B'.$rowCount,'Tên Khách Hàng');
    $sheet->setCellValue('C'.$rowCount,'Tên Tài Khoản');
    $sheet->setCellValue('D'.$rowCount,'SDT');
    $sheet->setCellValue('E'.$rowCount,'Gmail');

    //định dạng cột tiêu đề
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    //gán màu nền
    $sheet->getStyle('A'.$rowCount.':E'.$rowCount)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
    //căn giữa
    $sheet->getStyle('A'.$rowCount.':E'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
    $mKH=$_POST['txtMaKhachHang'];
    $tKH=$_POST['txtTenKhachHang'];
    $sqltk_1="SELECT * FROM khachhang WHERE MaKhachHang like '%$mKH%' and TenKhachHang like '%$tKH%' ";
    $data_1=mysqli_query($con_1, $sqltk_1);

    while($row=mysqli_fetch_array($data_1)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['MaKhachHang']);
        $sheet->setCellValue('B'.$rowCount,$row['TenKhachHang']);
        $sheet->setCellValue('C'.$rowCount,$row['TenTaiKhoan']);
        $sheet->setCellValue('D'.$rowCount,$row['SDT']);
        $sheet->setCellValue('E'.$rowCount,$row['Gmail']);
    }
    //Kẻ bảng 
    $styleAray=array(
        'borders'=>array(
            'allborders'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN
            )
        )
        );
    $sheet->getStyle('A1:'.'E'.($rowCount))->applyFromArray($styleAray);
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
if(isset($_POST['btnnhapexcel'])){
    echo "<script>window.location.href='./nhapfile_KH.php'</script>";
    exit;
}

//ngắt kết nối
mysqli_close($con_1);
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
    include_once './contac.php';

    ?>
           
            <div class="conten">
            
                
                
                <table class="table table-striped" >
                    <tr>
                        <td colspan="7" style="text-align: left;">
                            <h2>THÔNG TIN KHÁCH HÀNG</h2>
                        </td>
                    </tr>
    
                    <tr >
                        
                        <td colspan="7"class="cold2">
                           
                        </td>
                    </tr>
                    <tr >
                        <th>STT</th>
                        <th>Mã khách hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Công cụ</th>
                    </tr>
                    <?php
                    //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                    if(isset($data_1)&& $data_1!=null){
                        $i=0;
                        while($row=mysqli_fetch_array($data_1)){
                    ?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $row['MaKhachHang'] ?></td>
                            <td><?php echo $row['TenKhachHang'] ?></td>
                            <td><?php echo $row['TenTaiKhoan'] ?></td>
                            <td><?php echo $row['SDT'] ?></td>
                            <td><?php echo $row['Gmail'] ?></td>
                            <td>
                                <span class="btntool btn btn-primary">

                                    <a href="./Khachhang_sua.php?MaKhachHang=<?php echo $row['MaKhachHang'] ?>">Sửa</a>&nbsp;&nbsp;
                                </span>
                                <span class="btntool btn btn-danger">

                                    <a href="./Khachhang_xoa.php?MaKhachHang=<?php echo $row['MaKhachHang'] ?>">Xóa</a>
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
                        <h5 >CẬP NHẬT THÔNG TIN KHÁCH HÀNG</h5>
                    </td>
                </tr>

                <tr>
                    <td class="col1">Mã khách hàng</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaKhachHang" value="<?php echo $mKH ?>" style="width:450px;">
                    </td>

                </tr>
                <tr>
                    <td class="col1">Tên khách hàng</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTenKhachHang"value="<?php echo $tKH ?>" style="width:450px;">
                    </td>
                    
                </tr>
                <tr>
                    <td class="col1">Tên tài khoản</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTenTaiKhoan" value="<?php echo $tenTK ?>" style="width:450px;">
                    </td>
                </tr>
                
                <tr>
                    <td class= "col1">Số điện thoại</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtSDT" value="<?php echo $SDT ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Email</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtGmail" value="<?php echo $Gmail ?>" style="width:450px;">
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