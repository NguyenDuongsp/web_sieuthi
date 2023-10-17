<?php
 include_once './Classes/PHPExcel.php';
 include_once './Classes/PHPExcel/IOFactory.php';
 $mnv = "";$tnv = "";$cv = "";$em = "";$sdt = "";$mk="";
//B1: kết nối đến database
$connn=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
//tạo và thực hiện truy vấn
$sql2=" SELECT*FROM nhanvien ";
$data2=mysqli_query($connn, $sql2);
if(isset($_POST['btntim'])){
    $mkh=$_POST['txttimkiem'];
    $sqltk9="SELECT * FROM nhanvien where MaNhanVien like '%$mkh%'";
    $data2=mysqli_query($connn,$sqltk9);
}
if(isset($_POST['btnLuu'])){
    $mnv = $_POST['txtmanv'];
    $tnv = $_POST['txttennv'];
    $cv = $_POST['txtcv'];
    $em = $_POST['txtem'];
    $sdt = $_POST['txtsdt'];
    $mk = $_POST['txtmk'];
    // KIỂM TRA MÃ LOẠI RỖNG 
     if($mnv==''){
        echo "<script>alert('Phải nhập ten hang ')</script>";
    }
    else{
// kiểm tra khóa chính (mã loại)

$sql2="SELECT * FROM nhanvien WHERE MaNhanVien ='$mnv'";
$data2=mysqli_query($connn,$sql2);
  if(mysqli_num_rows($data2)>0){
      echo "<script> alert('Trung ma loai!')</script>";  
  }
    else{
    //Tao truy van chen du  lieu vao bang Loaisach
    $sql2="INSERT INTO nhanvien VALUES ('$mnv','$tnv','$cv','$em','$sdt',$mk)";
    $kq1=mysqli_query($connn,$sql2);
    if($kq1) {
        echo "<script> alert('Them moi thanh cong!')</script>";
        echo "<script>window.location.href='./dsnv.php'</script>";
        exit;}
    else echo "<script>alert('Them moi that bai!')</script>";
    }
}
}
//xư lý button tìm kiếm
if(isset($_POST['btnnhapexcel'])){
    echo "<script>window.location.href='./nhapfilenv.php'</script>";
    exit;
}
 //Xu li xuat excel
 if(isset($_POST['btnxuatexcel'])){

    $objExcel=new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet=$objExcel->getActiveSheet()->setTitle('DSNV');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A'.$rowCount,'Mã nhân viên');
    $sheet->setCellValue('B'.$rowCount,'Tên nhân viên');
    $sheet->setCellValue('C'.$rowCount,'Chức vụ');
    $sheet->setCellValue('D'.$rowCount,'Email');
    $sheet->setCellValue('E'.$rowCount,'SĐT');
    $sheet->setCellValue('F'.$rowCount,'mk');
   
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
    $mnv=$_POST['txtmanv'];
    
    $sqltk="SELECT * FROM nhanvien WHERE MaNhanVien like '%$mnv'" ;
    $data2 = mysqli_query($connn,$sqltk);

    while($row=mysqli_fetch_array($data2)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['MaNhanVien']);
        $sheet->setCellValue('B'.$rowCount,$row['TenNhanVien']);
        $sheet->setCellValue('C'.$rowCount,$row['ChucVu']);
        $sheet->setCellValue('D'.$rowCount,$row['Email']);
        $sheet->setCellValue('E'.$rowCount,$row['SDT']);
        $sheet->setCellValue('F'.$rowCount,$row['mk']);
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
}
//ngắt kết nối
mysqli_close($connn);
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
            <div class="conten" >
       
            
            
            <table  class="table table-striped">
            <tr>
                        <td colspan="9" style="text-align: left;">
                            <h2>THÔNG TIN NHÂN VIÊN</h2>
                        </td>
                    </tr>
    
                    <tr >
                      
                        <td colspan="6" class="cold2">
                          
                        </td>
                    </tr>
                <tr >
                    <th>Mã nhân viên</th>
                    <th>Tên nhân viên</th>
                    <th>Chức vụ</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Mật khẩu</th>
                    <th>Tác vụ</th>
                </tr>
                
                <?php
                //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                if(isset($data2)&& $data2!=null){
                   
                    while($row=mysqli_fetch_array($data2)){
                ?>
                    <tr>
                        <td><?php echo $row['MaNhanVien'] ?></td>
                        <td><?php echo $row['TenNhanVien'] ?></td>
                        <td><?php echo $row['ChucVu'] ?></td>
                        <td><?php echo $row['Email'] ?></td>
                        <td><?php echo $row['SDT'] ?></td>
                        <td><?php echo $row['mk'] ?></td>
                        <td>
                            <span class="btntool btn btn-primary">

                                <a href="./suanv.php?MaNhanVien=<?php echo $row['MaNhanVien']?>" >Sửa  </a> &nbsp;&nbsp;
                            </span>
                            <span class="btntool btn btn-danger">

                                <a href="./xoanv.php?MaNhanVien=<?php echo $row['MaNhanVien']?>">Xóa</a>
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
                            CẬP NHẬT THÔNG TIN NHÂN VIÊN
                            </h5>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class = "col1">Mã nhân viên</td>
                        <td class = "col2">
                            <input class="form-control" type="text"name ="txtmanv" value="<?php echo $mnv?>" style="width:450px">
                        </td>
                    </tr>
                    <tr>
                        <td class = "col1">Tên nhân viên</td>
                        <td class = "col2">
                            <input class="form-control" type="text"name ="txttennv"value="<?php echo $tnv?>" style="width:450px">
                        </td>
                    </tr> 
                    
                    <tr>
                        <td class = "col1">Chức vụ</td>
                        <td class = "col2">
                            <input  class="form-control" type="text"name ="txtcv" value="<?php echo $cv?>" style="width:450px">
                        </td>
                     </tr>
                   <tr>
                        <td class = "col1">Email</td>
                        <td class = "col2">
                            <input class="form-control" type="text"name ="txtem"value="<?php echo $em?>" style="width:450px">
                        </td>
                    </tr>  
                    
                    <tr>
                        <td class = "col1">SĐT</td>
                        <td class = "col2">
                            <input class="form-control" type="text"name ="txtsdt"value="<?php echo $sdt?>" style="width:450px">
                        </td>
                    </tr> 
                     <tr>
                        <td class = "col1">Mật khẩu</td>
                        <td class = "col2">
                            <input  class="form-control" type="text"name ="txtmk" value="<?php echo $mk?>" style="width:450px">
                        </td>
                     
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