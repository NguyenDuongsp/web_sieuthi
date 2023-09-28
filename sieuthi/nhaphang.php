<?php
include_once'./Classes/PHPExcel.php';
include_once'./Classes/PHPExcel/IOFactory.php';
//B1: kết nối đến database
$cons=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
//tạo và thực hiện truy vấn
$sql1=" SELECT*FROM nhaphang ";
$data1=mysqli_query($cons, $sql1);
//xư lý button tìm kiếm
if(isset($_POST['btntim'])){
    $ml=$_POST['txttimkiem'];
    
    $sqltk = "SELECT * FROM nhaphang WHERE MaNhapHang like '%$ml%';";
    $data1=mysqli_query($cons, $sqltk);
}
$mnh='';$msp=''; $makhohang=''; $soluong='';$ngaynhap='';
// cập nhật
if(isset($_POST['btnLuu'])){

    $mnh=$_POST['txtmanhaphang'];
    $msp=$_POST['txtmasanpham'];
    
    $soluong=$_POST['txtsoluonghangnhap'];
    $ngaynhap=$_POST['txtngaynhap'];
    //ktra dulieu
    if($mnh==''){
       echo "<spript> alert('phai nhap ma nhap hang')</script>";
    }
    else{
       $sql2="SELECT * from nhaphang where MaNhapHang='$mnh'";
       $data2=mysqli_query($cons,$sql2);
       if(mysqli_num_rows($data2)>0){
           echo "<script>alert('Trùng mã nhập hàng')</script>";
       }
    else{
        $sql3="INSERT INTO nhaphang VALUES('$mnh', '$msp', '$soluong', '$ngaynhap')";
        $kq2=mysqli_query($cons,$sql3);
        if($kq2) echo "<script>alert('Thêm mới thành công!')</script>";
        else echo "<script>alert('Thêm mới thất bại!')</script>";
    }
    }
}

// excel
if(isset($_POST['btnxuatexcel'])){
    //code xuất excel
    $objExcel=new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet=$objExcel->getActiveSheet()->setTitle('QLSP');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A'.$rowCount,'Mã Nhập Hàng');
    $sheet->setCellValue('B'.$rowCount,'Mã Sản Phẩm');
    $sheet->setCellValue('C'.$rowCount,'Số Lượng Nhập');
    $sheet->setCellValue('D'.$rowCount,'Ngày Nhập');
   

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
    $ml=$_POST['txttimkiem'];
    $sqltk_6="SELECT * FROM nhaphang WHERE MaNhapHang like '%$ml%'  ";
    $data_5=mysqli_query($cons, $sqltk_6);

    while($row=mysqli_fetch_array($data_5)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['MaNhapHang']);
        $sheet->setCellValue('B'.$rowCount,$row['MaSanPham']);
        $sheet->setCellValue('C'.$rowCount,$row['SoLuongNhap']);
        $sheet->setCellValue('D'.$rowCount,$row['NgayNhap']);
      
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
mysqli_close($cons);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       .conten{
        background-color: #ccc;
        width: 83.334%;;
        float: right;
       }
     
        table{
            width: 100%;
            margin-top: 10px;
        }
        /* modal */






    </style>
</head>
<body>
    

                        <form method="post" action="">
                            
                        <?php include_once './contac.php'?>
                        <div class="conten">
            <table   class="table table-striped ">
                     <tr>
                        <td colspan="6" style="text-align: left;">
                            <h2>THÔNG TIN NHẬP HÀNG</h2>
                        </td>
                    </tr>
    
                    <tr >
                      
                        <td colspan="6" class="cold2">
                          
                        </td>
                    </tr>
            
                <tr>
                    <th>Mã nhập hàng</th>
                    <th>Mã sản phẩm</th>
                   
                    <th>Số lượng hàng</th>
                    <th>Ngày Nhập</th>
                    <th>Thao tác</th>
                </tr>
                <?php
                //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                if(isset($data1)&& $data1!=null){
                   
                    while($row=mysqli_fetch_array($data1)){
                ?>
                    <tr>
                        <td><?php echo $row['MaNhapHang'] ?></td>
                        <td><?php echo $row['MaSanPham'] ?></td>
                        
                        <td><?php echo $row['SoLuongNhap'] ?></td>
                        <td><?php echo $row['NgayNhap'] ?></td>
                        <td>
                            <span class="btntool btn btn-primary">

                                <a href="./suanhaphang.php?MaNhapHang=<?php echo $row['MaNhapHang'] ?>">Sửa</a>
                            </span>&nbsp;&nbsp;

                            <button class="btntool btn btn-danger">

                                <a href="./xoanhaphang.php?MaNhapHang=<?php echo $row['MaNhapHang'] ?>">Xóa</a>
                            </button>
                        </td>
                    </tr>
                <?php        
                        }
                    }
                    else{

                        echo "dữ liệu không tồn tại ";
                    }
                ?>
               
            </table>
           
       
             </form>
       
             <div class="modal js-modal">
              <div class="modal-container js-modal-container">
                <div class="modal-close js-modal-close">
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