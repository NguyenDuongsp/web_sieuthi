<?php
include_once './Classes/PHPExcel.php';
include_once './Classes/PHPExcel/IOFactory.php';
$mkm="";$tenkm="";$ngaybatdau="";$ngayketthuc="";$phantramkhuyenmai="";$mota="";
//B1: kết nối đến database
$cons1=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
//tạo và thực hiện truy vấn
$sql1=" SELECT*FROM khuyenmai ";
$data1=mysqli_query($cons1, $sql1);
//xư lý button tìm kiếm
if(isset($_POST['btntim'])){
    $ml=$_POST['txttimkiem'];
    
    $sqltk1 = "SELECT * FROM khuyenmai WHERE MaKhuyenMai like '%$ml%';";
    $data1=mysqli_query($cons1, $sqltk1);
}

// cập nhật
if(isset($_POST['btnLuu'])){

    $mkm=$_POST['txtmakm'];
    $tenkm=$_POST['txttkm'];  
    $ngaybatdau=$_POST['txtngaybatdau'];
    $ngayketthuc=$_POST['txtngayketthuc'];
    $phantramkhuyenmai=$_POST['txttile'];
    $mota=$_POST['ttxmota'];
    //ktra dulieu
    if($mkm==''){
       echo "<spript> alert('phai nhap ma nhap hang')</script>";
    }
    else{
       $sql2="SELECT * from khuyenmai where MaKhuyenMai='$mkm'";
       $data1=mysqli_query($cons1,$sql2);
       if(mysqli_num_rows($data1)>0){
           echo "<script>alert('Trùng mã nhập hàng')</script>";
       }
    else{
        $sql3="INSERT INTO khuyenmai VALUES('$mkm', '$tenkm', '$ngaybatdau', '$ngayketthuc',' $phantramkhuyenmai', '$mota')";
        $kq3=mysqli_query($cons1,$sql3);
        if($kq3) echo "<script>alert('Thêm mới thành công!')</script>";
        else echo "<script>alert('Thêm mới thất bại!')</script>";
    }
    }
}
//excel
if(isset($_POST['btnxuatexcel'])){

    //xử lý excel
    $objExcel=new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet=$objExcel->getActiveSheet()->setTitle('QLMKM');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A'.$rowCount,'Mã Khuyến Mãi');
    $sheet->setCellValue('B'.$rowCount,'Tên Khuyến Mãi');
    $sheet->setCellValue('C'.$rowCount,'Ngày Bắt Đầu');
    $sheet->setCellValue('D'.$rowCount,'Ngày Kết Thúc');
    $sheet->setCellValue('E'.$rowCount,'Phần Trăm Khuyến Mãi');
    $sheet->setCellValue('F'.$rowCount,'Mô Tả');
    
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
    $mkm=$_POST['txtmakm'];
    
    $sqltk1="SELECT * FROM khuyenmai WHERE MaKhuyenMai like '%$mkm%' ";
    $data1=mysqli_query($cons1, $sqltk1);
    while($row=mysqli_fetch_array($data1)){
        $rowCount++;
     
        $sheet->setCellValue('A'.$rowCount,$row['MaKhuyenMai']);
        $sheet->setCellValue('B'.$rowCount,$row['TenKhuyenMai']);
        $sheet->setCellValue('C'.$rowCount,$row['NgayBatDau']);
        $sheet->setCellValue('D'.$rowCount,$row['NgayKetThuc']);
        $sheet->setCellValue('E'.$rowCount,$row['PhanTramKhuyenMai']);
        $sheet->setCellValue('F'.$rowCount,$row['MoTa']);
        
    }
    //Kẻ bảng 
    $styleAray=array(
        'borders'=>array(
            'allborders'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN
            )
        )
        );
    $sheet->getStyle('A2:'.'F'.($rowCount))->applyFromArray($styleAray);
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
    print_r($data);
}




//ngắt kết nối
mysqli_close($cons1);
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
            <table   class="table table-striped">
            <tr>
                        <td colspan="7" style="text-align: left;">
                            <h2>THÔNG TIN KHUYẾN MÃI</h2>
                        </td>
                    </tr>
    
                    <tr >
                      
                        <td colspan="9" class="cold2">
                          
                        </td>
                    </tr>
                <tr>
                    <th>Mã khuyến mãi</th>
                    <th>Tên khuyến mãi</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Phần trăm khuyến mãi</th>
                    <th>Mô tả</th>
                    <th>Thao Tác</th>
                </tr>
                <?php
                //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                if(isset($data1)&& $data1!=null){
                   
                    while($row=mysqli_fetch_array($data1)){
                ?>
                    <tr>
                        <td><?php echo $row['MaKhuyenMai'] ?></td>
                        <td><?php echo $row['TenKhuyenMai'] ?></td>
                        
                        <td><?php echo $row['NgayBatDau'] ?></td>
                        <td><?php echo $row['NgayKetThuc'] ?></td>
                      
                        <td><?php echo $row['PhanTramKhuyenMai'] ?></td>
                        <td><?php echo $row['NgayKetThuc'] ?></td>
                        <td>
                            <span class="btntool btn btn-primary">

                                <a href="./suakhuyenmai.php?MaKhuyenMai=<?php echo $row['MaKhuyenMai'] ?>">Sửa</a>
                            </span>&nbsp;&nbsp;

                            <button class="btntool btn btn-danger">

                                <a href="./xoakhuyenmai.php?MaKhuyenMai=<?php echo $row['MaKhuyenMai'] ?>">Xóa</a>
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
                        <h5 >Thêm Mã Khuyến Mãi</h5>
                    </td>
                </tr>

                <tr>
                    <td class="col1">Mã Khuyến Mãi </td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtmakm" value="<?php echo $mkm ?>">
                    </td>

                </tr>
                <tr>
                    <td class="col1">Tên Khuyến Mãi</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txttkm"value="<?php echo $tenkm ?>" >
                    </td>
                    
                </tr>
                
                    <tr>
                    <td class= "col1">Ngày Bắt Đầu</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtngaybatdau" value="<?php echo $ngaybatdau ?>" >
                    </td>   
                </tr>
                <tr>
                    <td class= "col1">Ngày Kết Thúc</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtngayketthuc" value="<?php echo $ngayketthuc  ?>" >
                    </td>   
                </tr>
                
                <tr>
                    <td class= "col1">Phần Trăn Khuyến Mãi</td>
                    <td class="col2">
                        <input class="form-control" type="number" name="txttile" value="<?php echo $phantramkhuyenmai   ?>" >
                    </td>   
                </tr>
                <tr>
                    <td class= "col1">Mô Tả</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="ttxmota" value="<?php echo $mota  ?>" >
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