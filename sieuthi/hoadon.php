<?php
 include_once './Classes/PHPExcel.php';
 include_once './Classes/PHPExcel/IOFactory.php';
 $mhd = "";$mkh = "";$tt = "";$ntao ="";
//B1: kết nối đến database
$con4n=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
//tạo và thực hiện truy vấn
$sql1=" SELECT*FROM hoadon ";
$data1=mysqli_query($con4n, $sql1);

if(isset($_POST['btntim'])){
    $mhd=$_POST['txttimkiem'];
    $sqltk9="SELECT * FROM hoadon where MaHoaDon like '%$mhd%'";
    $data1=mysqli_query($con4n,$sqltk9);
}

if(isset($_POST['btnLuu'])){
    $mhd = $_POST['txtmahd'];
    $mkh = $_POST['txtmakh'];
    $tt = $_POST['txttt'];
    $ntao = $_POST['txtntao'];
     
   
// KIỂM TRA MÃ LOẠI RỖNG 
        if($mhd==''){
            echo "<script>alert('Phải nhập tên hang ')</script>";
        }
        else{
 // kiểm tra khóa chính (mã loại)
 
 $sql1="SELECT * FROM hoadon WHERE MaHoaDon ='$mhd'";
 $data1=mysqli_query($con4n,$sql1);
      if(mysqli_num_rows($data1)>0){
          echo "<script> alert('Trung ma loai!')</script>";  
      }
        else{
        //Tao truy van chen du  lieu vao bang Loaisach
        $sql1="INSERT INTO hoadon VALUES ('$mhd','$mkh','$tt','$ntao')";
        $kq=mysqli_query($con4n,$sql1);
        if($kq) {
            echo "<script> alert('Them moi thanh cong!')</script>";
            echo "<script>window.location.href='./hoadon.php'</script>";
            exit;}
        else echo "<script>alert('Them moi that bai!')</script>";
        }
}
}
 //Xu li xuat excel
 if(isset($_POST['btnxuatexcel'])){

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
//ngắt kết nối
mysqli_close($con4n);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    
    <style>
       .conten{
        background-color: #ccc;
        width: 83.334%;;
        float: right;
       }
     .highlight{
           
            background-Color : #202126;
            border-Left :3px solid #dce1ea;
        }
        table{
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
   
        <form method="post" action="">
            <?php include_once './contac.php'?>
            <div class="conten" style = "font-size: 15px">
        
            

            <table  class="table table-striped">
            <tr>
                        <td colspan="5" style="text-align: left;">
                            <h2>THÔNG TIN HOÁ ĐƠN</h2>
                        </td>
                    </tr>
    
                    <tr >
                      
                        <td colspan="9" class="cold2">
                          
                        </td>
                    </tr>
                <tr >
                    <th>Mã hóa đơn</th>
                    <th>Mã khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày tạo</th>
                    <th>Tác vụ</th>

                </tr>
                
                
                <?php
                //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                if(isset($data1)&& $data1!=null){
                   
                    while($row=mysqli_fetch_array($data1)){
                ?>
                    <tr>
                        <td><?php echo $row['MaHoaDon'] ?></td>
                        <td><?php echo $row['MaKhachHang'] ?></td>
                        <td><?php echo $row['TongTien'] ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['NgayTao'])) ?></td>
                        
                        <td>
                        <span class="btntool btn btn-primary">
                            <a href="./suahd.php?MaHoaDon=<?php echo $row['MaHoaDon']?>" style="color:#0018;    text-decoration: none"> Sửa </a> &nbsp;&nbsp; 
                        </span>
                            <span class="btntool btn btn-danger">

                                <a href="./xoahd.php?MaHoaDon=<?php echo $row['MaHoaDon']?>">Xóa</a>
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
                        <table class="table table-striped">
                     <tr>
                        <td colspan="2" style="text-align: center;">
                        <h5>
                            CẬP NHẬT THÔNG TIN HÓA ĐƠN
                            </h5>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class = "col1">Mã hóa đơn</td>
                        <td class = "col2">
                            <input class="form-control" type="text"name ="txtmahd" value="<?php echo $mhd?>" style="width:450px">
                        </td>
                    </tr>
                    <tr>
                        <td class = "col1">Mã khách hàng</td>
                        <td class = "col2">
                            <input class="form-control" type="text"name ="txtmakh"value="<?php echo $mkh?>" style="width:450px">
                        </td>
                    </tr> 
                   <tr>
                        <td class = "col1">Tổng tiền</td>
                        <td class = "col2">
                            <input class="form-control" type="number"name ="txttt"value="<?php echo $tt?>" style="widtt:450px">
                        </td>
                    </tr>  
                    
                    <tr>
                        <td class = "col1">Ngày tạo</td>
                        <td class = "col2">
                            <input  class="form-control" type="date"name ="txtntao" value="<?php echo $ntao?>" style="width:450px">
                        </td>
                    </tr>
                    
                    <tr>
                        <td class = "col1"></td>
                        <td class = "col2">
                            <input  class =" btn btn-primary" type="submit"name ="btnLuu" value = "Lưu" style="width:100px;">
                        </td>
                    </tr>
                        
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