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
$mnh='';$msp=''; $makhohang=''; $soluong='';$ngaynhap='';$tensp='';$mncc='';$ngaysx='';$hsd='';$anh='';
// cập nhật
if(isset($_POST['btnLuu'])){

    $mnh=$_POST['txtmanhaphang'];
    $msp=$_POST['txtmasanpham'];
    
    $soluong=$_POST['txtsoluonghangnhap'];
    $ngaynhap=$_POST['txtngaynhap'];
    $tensp=$_POST['txttensp'];
    $mncc=$_POST['txtmncc'];
    $ngaysx=$_POST['txtnsx'];
    $hsd=$_POST['txthsd'];
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
        $sql3="INSERT INTO nhaphang (MaNhapHang, MaSanPham, SoLuongNhap, NgayNhap, TenSanPham, MaNhaCungCap, NgaySanXuat, HanSuDung) VALUES('$mnh', '$msp','$tensp','$mncc', '$soluong', '$ngaynhap','$ngaysx', '$hsd')";
        $kq2=mysqli_query($cons,$sql3);
        if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            
            if ($file_size > 2097152) {
                $errors[] = 'Kích thước file không được lớn hơn 2MB';
            }
            
            $image = $_FILES['image']['name'];
            $target = "photo/".basename($image);
            $sql_h5 = "UPDATE nhaphang SET Anh='$image' WHERE MaSanPham='$msp'";
            $dt_H6 = mysqli_query($cons, $sql_h5);
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
              
            } 
        }
        
        if($kq2) 
        {echo "<script>alert('Thêm mới thành công!')</script>";
        echo "<script>window.location.href='./nhaphang.php'</script>";
        exit;
        }
        else 
        {echo "<script>alert('Thêm mới thất bại!')</script>";}
    }
    }
}
if(isset($_POST['btnnhapexcel'])){
    echo "<script>window.location.href='./nhapfile_nhaphang.php'</script>";
    exit;
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
    $sheet->setCellValue('C'.$rowCount,'Tên Sản Phẩm');
    $sheet->setCellValue('D'.$rowCount,'Mã Nhà Cung Cấp');
    $sheet->setCellValue('E'.$rowCount,'Số Lượng Nhập');
    $sheet->setCellValue('F'.$rowCount,'Ngày Nhập');
    $sheet->setCellValue('G'.$rowCount,'Ngày Sản Xuất');
    $sheet->setCellValue('H'.$rowCount,'Hạn Sử Dụng');
    $sheet->setCellValue('I'.$rowCount,'Ảnh');
   

    //định dạng cột tiêu đề
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);


    //gán màu nền
    $sheet->getStyle('A'.$rowCount.':I'.$rowCount)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
    //căn giữa
    $sheet->getStyle('A'.$rowCount.':I'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
    $ml=$_POST['txttimkiem'];
    $sqltk_6="SELECT * FROM nhaphang WHERE MaNhapHang like '%$ml%'  ";
    $data_5=mysqli_query($cons, $sqltk_6);

    while($row=mysqli_fetch_array($data_5)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['MaNhapHang']);
        $sheet->setCellValue('B'.$rowCount,$row['MaSanPham']);
        $sheet->setCellValue('C'.$rowCount,$row['TenSanPham']);
        $sheet->setCellValue('D'.$rowCount,$row['MaNhaCungcap']);
        $sheet->setCellValue('E'.$rowCount,$row['SoLuongNhap']);
        $sheet->setCellValue('F'.$rowCount,$row['NgayNhap']);
        $sheet->setCellValue('G'.$rowCount,$row['NgaySanXuat']);
        $sheet->setCellValue('H'.$rowCount,$row['HanSuDung']);
        $sheet->setCellValue('I'.$rowCount,$row['Anh']);
    }
    //Kẻ bảng 
    $styleAray=array(
        'borders'=>array(
            'allborders'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN
            )
        )
        );
    $sheet->getStyle('A1:'.'I'.($rowCount))->applyFromArray($styleAray);
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

        img{
            width: 50px;
        }




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
                    <th>Tên Sản Phẩm</th>
                    <th>Mã Nhà Cung Cấp</th>
                   
                    <th>Số lượng hàng</th>
                    <th>Ngày Nhập</th>
                    <th>Ngày sản xuất</th>
                    <th>Hạn sử dụng</th>
                    <th>Ảnh</th>

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
                        <td><?php echo $row['TenSanPham'] ?></td>
                        <td><?php echo $row['MaNhaCungCap'] ?></td>
                        
                        <td><?php echo $row['SoLuongNhap'] ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['NgayNhap'])) ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['NgaySanXuat'])) ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['HanSuDung'])) ?></td>
                        <td><?php echo "<img src='photo/".$row['Anh']."' >";?></td>
                        
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
                    <form method="post" action="" enctype="multipart/form-data">
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
                    <td class="col1">Tên sản phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txttensp"value="<?php echo $tensp ?>" style="width:450px;">
                    </td>
                    
                </tr>
                <tr>
                    <td class="col1">Mã nhà cung cấp</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtmncc" value="<?php echo $mncc ?>" style="width:450px;">
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
                        <input class="form-control" type="date" name="txtngaynhap" value="<?php echo $ngaynhap   ?>" >
                    </td>   
                </tr>
                <tr>
                    <td class= "col1">Ngày sản xuất</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtnsx" value="<?php echo $nsx ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Hạn sử dụng</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txthsd" value="<?php echo $hsd ?>" style="width:450px;">
                    </td>   
                </tr>
                <tr>
                    <td> Hình Ảnh</td>
                    <td>
                    <input type="hidden" name="size" value="1000000"> 
                        <input type="file" name="image"> 
                        <!-- <button type="submit" name="upload">POST</button> -->
                        
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