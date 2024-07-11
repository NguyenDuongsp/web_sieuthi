<?php
include_once'./Classes/PHPExcel.php';
include_once'./Classes/PHPExcel/IOFactory.php';

//B1: kết nối đến database
$con_2=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
$mNcc=''; $tNcc='';$msp=''; $dc_ncc=''; $sdt_ncc=''; $gmail_ncc='';
//tạo và thực hiện truy vấn
$sql_2=" SELECT*FROM nhacungcap ";
$data_2=mysqli_query($con_2, $sql_2);
//xư lý button tìm kiếm
if(isset($_POST['btntim'])){
    $tNcc=$_POST['txttimkiem'];
    $sqltk_2="SELECT * FROM nhacungcap WHERE TenNhaCungCap like '%$tNcc%'";
    $data_2=mysqli_query($con_2, $sqltk_2);
}
//Xử lý button luu
if(isset($_POST['btnLuu'])){
    $mNcc=$_POST['txtMaNhaCungCap'];
    $tNcc=$_POST['txtTenNhaCungCap'];
    $msp=$_POST['txtMaSanPham'];
    $dc_ncc=$_POST['txtDiaChi'];
    $sdt_ncc=$_POST['txtSDT'];
    $gmail_ncc=$_POST['txtGmail'];
    //ktra dữ liệu rỗng (MaNhaCungCap)
    if($mNcc==''){
        echo "<script>alert('Phải nhập mã nhà cung cấp')</script>";
    }
    else{
         //ktra trùng khóa chính (MaNhaCungCap)
    $sql_2="SELECT * FROM nhacungcap WHERE MaNhaCungCap='$mNcc'";
    $dt_2=mysqli_query($con_2, $sql_2);
    if(mysqli_num_rows($dt_2)>0){
        echo "<script>alert('Trùng mã nhà cung cấp')</script>";
    }
    else{
        //tạo và thực hiện truy vấn chèn dữ liệu vào bảng khachhang
        $sql_2="INSERT INTO nhacungcap VALUES('$mNcc', '$tNcc','$msp', '$dc_ncc', '$sdt_ncc', '$gmail_ncc')";
        $kq_2=mysqli_query($con_2, $sql_2);
        if($kq_2){
            echo "<script>alert('Thêm mới thành công!')</script>";
            echo "<script>window.location.href='./Quanlynhacungcap.php'</script>";
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
    $sheet=$objExcel->getActiveSheet()->setTitle('QLNCC');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A'.$rowCount,'Mã Nhà Cung Cấp');
    $sheet->setCellValue('B'.$rowCount,'Tên Nhà Cung Cấp');
    $sheet->setCellValue('C'.$rowCount,'Mã Sản Phẩm');
    $sheet->setCellValue('D'.$rowCount,'Địa chỉ');
    $sheet->setCellValue('E'.$rowCount,'Số Điện Thoại');
    $sheet->setCellValue('F'.$rowCount,'Gmail');
    //định dạng cột tiêu đề
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    //gán màu nền
    $sheet->getStyle('A'.$rowCount.':F'.$rowCount)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
    //căn giữa
    $sheet->getStyle('A'.$rowCount.':F'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
    $mNcc=$_POST['txtMaNhaCungCap'];
    $tNcc=$_POST['txtTenNhaCungCap'];
    $sqltk_2="SELECT * FROM nhacungcap WHERE MaNhaCungCap like '%$mNcc%' and TenNhaCungCap like '%$tNcc%' ";
    $data_2=mysqli_query($con_2, $sqltk_2);

    while($row=mysqli_fetch_array($data_2)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['MaNhaCungCap']);
        $sheet->setCellValue('B'.$rowCount,$row['TenNhaCungCap']);
        $sheet->setCellValue('C'.$rowCount,$row['MaSanPham']);
        $sheet->setCellValue('D'.$rowCount,$row['DiaChi']);
        $sheet->setCellValue('E'.$rowCount,$row['SDT']);
        $sheet->setCellValue('F'.$rowCount,$row['Gmail']);
    }
    //Kẻ bảng 
    $styleAray=array(
        'borders'=>array(
            'allborders'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN
            )
        )
        );
    $sheet->getStyle('A1:'.'F'.($rowCount))->applyFromArray($styleAray);
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
mysqli_close($con_2);
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
            
            
            <table class="table table-striped" >
                <tr>
                        <td colspan="8" style="text-align: left;">
                            <h2>THÔNG TIN NHÀ CUNG CẤP</h2>
                        </td>
                    </tr>
    
                    <tr >
                        
                        <td colspan="8" class="cold2">
                           
                        </td>
                    </tr>
                <tr >
                    <th>STT1</th>
                    <th>Mã nhà cung cấp</th>
                    <th>Tên nhà cung cấp</th>
                    <th>Mã sản phẩm</th>
                    <th>Địa chỉ</th>
                    <th>SDT</th>
                    <th>Gmail</th>
                    <th>Công cụ</th>

                </tr>
                <?php
                //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                if(isset($data_2)&& $data_2!=null){
                    $i=0;
                    while($row=mysqli_fetch_array($data_2)){
                ?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td><?php echo $row['MaNhaCungCap']?></td>
                        <td><?php echo $row['TenNhaCungCap']?></td>
                        <td><?php echo $row['MaSanPham']?></td>
                        <td><?php echo $row['DiaChi']?></td>
                        <td><?php echo $row['SDT']?></td>
                        <td><?php echo $row['Gmail']?></td>
                        <td>
                            <span class="btntool btn btn-primary">

                                <a href="./Nhacungcap_sua.php?MaNhaCungCap=<?php echo $row['MaNhaCungCap'] ?>">Sửa</a>&nbsp;&nbsp;
                            </span>
                            <span class="btntool btn btn-danger">

                                <a href="./Nhacungcap_xoa.php?MaNhaCungCap=<?php echo $row['MaNhaCungCap'] ?>">Xóa</a>
                            </span>
                            <span class="btntool btn btn-danger">

                                <a href="./Ncc_xem.php?MaNhaCungCap=<?php echo $row['MaNhaCungCap'] ?>">Xem</a>
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
                        <h5 >CẬP NHẬT THÔNG TIN NHÀ CUNG CẤP</h5>
                    </td>
                </tr>

                <tr>
                    <td class="col1">Mã nhà cung cấp</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaNhaCungCap" value="<?php echo $mNcc ?>" style="width:450px;">
                    </td>

                </tr>
                <tr>
                    <td class="col1">Tên nhà cung cấp</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTenNhaCungCap"value="<?php echo $tNcc ?>" style="width:450px;">
                    </td>
                    
                </tr>
                
                <tr>
                    <td class="col1">Mã Sản Phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaSanPham" value="<?php echo $msp ?>" style="width:450px;">
                    </td>
                </tr>

                <tr>
                    <td class="col1">Địa chỉ</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtDiaChi" value="<?php echo $dc_ncc ?>" style="width:450px;">
                    </td>
                </tr>
                
                <tr>
                    <td class= "col1">SDT</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtSDT" value="<?php echo $sdt_ncc ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Gmail</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtGmail" value="<?php echo $gmail_ncc ?>" style="width:450px;">
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