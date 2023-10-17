<?php
 include_once './Classes/PHPExcel.php';
 include_once './Classes/PHPExcel/IOFactory.php';
 $msp = "";$tsp = "";$sl = "";$mnh = "";$nnk = "";$mncc ="";
//B1: kết nối đến database
$conn=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
//tạo và thực hiện truy vấn
$sql1=" SELECT*FROM khohang ";
$data1=mysqli_query($conn, $sql1);
if(isset($_POST['btntim'])){
    $mkh=$_POST['txttimkiem'];
    $sqltk9="SELECT * FROM khohang where MaSanPham like '%$mkh%'";
    $data1=mysqli_query($conn,$sqltk9);
}
if(isset($_POST['btnLuu'])){
    $msp = $_POST['txtmasp'];
    $tsp = $_POST['txttensp'];
    $sl = $_POST['txtsl'];
    $mnh = $_POST['txtmnh'];
    $nnk = $_POST['txtnnk'];
    $mncc = $_POST['txtmncc'];  
   
// KIỂM TRA MÃ LOẠI RỖNG 
        if($msp==''){
            echo "<script>alert('Phải nhập ten hang ')</script>";
        }
        else{
 // kiểm tra khóa chính (mã loại)
 
 $sql1="SELECT * FROM khohang WHERE MaSanPham ='$msp'";
 $data1=mysqli_query($conn,$sql1);
      if(mysqli_num_rows($data1)>0){
          echo "<script> alert('Trung ma loai!')</script>";  
      }
        else{
        //Tao truy van chen du  lieu vao bang Loaisach
        $sql1="INSERT INTO khohang VALUES ('$msp','$tsp','$sl','$mnh','$nnk','$mncc')";
        $kq=mysqli_query($conn,$sql1);
        if($kq) {
            echo "<script> alert('Them moi thanh cong!')</script>";
            echo "<script>window.location.href='./dskhohang.php'</script>";
            exit;}
        else echo "<script>alert('Them moi that bai!')</script>";
        }
}
}
//xư lý button tìm kiếm
if(isset($_POST['btnnhapexcel'])){
    echo "<script>window.location.href='./nhapfilekhohang.php'</script>";
    exit;
}
 //Xu li xuat excel
 if(isset($_POST['btnxuatexcel'])){

    $objExcel=new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet=$objExcel->getActiveSheet()->setTitle('DSKH');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A'.$rowCount,'Mã sản phẩm');
    $sheet->setCellValue('B'.$rowCount,'Tên sản phẩm');
    $sheet->setCellValue('C'.$rowCount,'Số lượng');
    $sheet->setCellValue('D'.$rowCount,'Mã nhập hàng');
    $sheet->setCellValue('E'.$rowCount,'Ngày nhập kho');
    $sheet->setCellValue('F'.$rowCount,'Mã nhà cung cấp');
   
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
    $msp=$_POST['txtmasp'];
    $tsp=$_POST['txttensp'];
    $sqltk="SELECT * FROM khohang WHERE MaSanPham like '%$msp' and TenSanPham like'%$tsp'";
    $data = mysqli_query($conn,$sqltk);

    while($row=mysqli_fetch_array($data)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['MaSanPham']);
        $sheet->setCellValue('B'.$rowCount,$row['TenSanPham']);
        $sheet->setCellValue('C'.$rowCount,$row['SoLuong']);
        $sheet->setCellValue('D'.$rowCount,$row['MaNhapHang']);
        $sheet->setCellValue('E'.$rowCount,$row['NgayNhapKho']);
        $sheet->setCellValue('F'.$rowCount,$row['MaNhaCungCap']);
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
mysqli_close($conn);
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
        
            
            <table  class="table table-striped ">
            <tr>
                        <td colspan="9" style="text-align: left;">
                            <h2>THÔNG TIN KHO HÀNG</h2>
                        </td>
                    </tr>
    
                    <tr >
                      
                        <td colspan="7" class="cold2">
                          
                        </td>
                    </tr>
                <tr >
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Mã nhập hàng</th>
                    <th>Ngày nhập kho</th>
                    <th>Mã nhà cung cấp</th>
                    <th>Tác vụ</th>

                </tr>
                
                <?php
                //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                if(isset($data1)&& $data1!=null){
                   
                    while($row=mysqli_fetch_array($data1)){
                ?>
                    <tr>
                        <td><?php echo $row['MaSanPham'] ?></td>
                        <td><?php echo $row['TenSanPham'] ?></td>
                        <td><?php echo $row['SoLuong'] ?></td>
                        <td><?php echo $row['MaNhapHang'] ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['NgayNhapKho'])) ?></td>
                        <td><?php echo $row['MaNhaCungCap'] ?></td>
                        <td>
                            <span class="btntool btn btn-primary">

                                <a href="./suakh.php?MaSanPham=<?php echo $row['MaSanPham']?>" > Sửa </a> &nbsp;&nbsp;
                            </span>
                            <span class="btntool btn btn-danger">

                                <a href="./xoakh.php?MaSanPham=<?php echo $row['MaSanPham']?>">Xóa</a>
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
                            CẬP NHẬT THÔNG TIN KHO HÀNG 
                            </h5>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class = "col1">Mã sản phẩm</td>
                        <td class = "col2">
                            <input class="form-control" type="text"name ="txtmasp" value="<?php echo $msp?>" style="width:450px">
                        </td>
                    </tr>
                    <tr>
                        <td class = "col1">Tên sản phẩm</td>
                        <td class = "col2">
                            <input class="form-control" type="text"name ="txttensp"value="<?php echo $tsp?>" style="width:450px">
                        </td>
                    </tr> 
                   <tr>
                        <td class = "col1">Số lượng</td>
                        <td class = "col2">
                            <input class="form-control" type="text"name ="txtsl"value="<?php echo $sl?>" style="width:450px">
                        </td>
                    </tr>  
                    
                    <tr>
                        <td class = "col1">Mã nhập hàng</td>
                        <td class = "col2">
                            <input  class="form-control" type="text"name ="txtmnh" value="<?php echo $mnh?>" style="width:450px">
                        </td>
                    </tr>
                    <tr>
                        <td class = "col1">Ngày nhập kho</td>
                        <td class = "col2">
                            <input  class="form-control" type="date"name ="txtnnk" value="<?php echo $nnk?>" style="width:450px">
                        </td>
                    </tr>
                    <tr>
                        <td class = "col1">Mã nhà cung cấp</td>
                        <td class = "col2">
                            <input  class="form-control" type="text"name ="txtmncc" value="<?php echo $mncc?>" style="width:450px">
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