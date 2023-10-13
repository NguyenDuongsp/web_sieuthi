<?php
include_once'./Classes/PHPExcel.php';
include_once'./Classes/PHPExcel/IOFactory.php';

$msp=''; $tsp='';$mncc=''; $nsx='';$hsd='';$k=''; $gb='';$dvt='';$lsp='';
//B1: kết nối đến database
$con_5=mysqli_connect("localhost","root","","ql_sieuthi")
or die('Lỗi kết nối');
//tạo và thực hiện truy vấn
$curenDate=date('Y-m-d');

$sql_5="SELECT*FROM sanpham WHERE HanSuDung > '$curenDate'";
$data_5=mysqli_query($con_5, $sql_5);
//xư lý button tìm kiếm
if(isset($_POST['btntim'])){
    $msp=$_POST['txttimkiem'];
    $sqltk_5="SELECT * FROM sanpham WHERE MaSanPham like '%$msp%'";
    $data_5=mysqli_query($con_5, $sqltk_5);
}
//Xử lý button luu
if (isset($_POST['btnLuu'])) {
    $msp = $_POST['txtMaSanPham'];
    $tsp = $_POST['txtTenSanPham'];
    $mncc = $_POST['txtMaNhaCungCap'];
    $nsx = $_POST['txtNgaySanXuat'];
    $hsd = $_POST['txtHanSuDung'];
    $k = $_POST['txtKeHang'];
    $gb = $_POST['txtGiaBan'];
    $dvt = $_POST['txtDonViTinh'];
    $lsp = $_POST['txtLoaiSanPham'];
    
    // Kiểm tra dữ liệu rỗng (MaSanPham)
    if ($msp == '') {
        echo "<script>alert('Phải nhập mã sản phẩm')</script>";
    } else {
        // Kiểm tra trùng khóa chính (MaSanPham)
        $sql_5 = "SELECT * FROM sanpham WHERE MaSanPham='$msp'";
        $dt_5 = mysqli_query($con_5, $sql_5);
        if (mysqli_num_rows($dt_5) > 0) {
            echo "<script>alert('Trùng mã sản phẩm')</script>";
        } else {
            // Thực hiện câu lệnh INSERT INTO
            $sql_5 = "INSERT INTO sanpham (MaSanPham, TenSanPham, MaNhaCungCap, NgaySanXuat, HanSuDung, KeHang, GiaBan, DonViTinh, LoaiSanPham) 
                      VALUES ('$msp', '$tsp', '$mncc', '$nsx', '$hsd','$k', '$gb','$dvt', '$lsp')";
            $kq_5 = mysqli_query($con_5, $sql_5);
            
            // Upload ảnh
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
                $sql_h5 = "UPDATE sanpham SET Anh='$image' WHERE MaSanPham='$msp'";
                $dt_H6 = mysqli_query($con_5, $sql_h5);
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                  
                } 
            }
            
            if ($kq_5) {
                echo "<script>alert('Thêm mới thành công!')</script>";
                echo "<script>window.location.href='./Quanlysanpham.php'</script>";
                exit;
            } else {
                echo "<script>alert('Thêm mới thất bại!')</script>";
            }
        }
    }
}
//XỬ lý xuất Excel

if(isset($_POST['btnxuatexcel'])){
    //code xuất excel
    $objExcel=new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet=$objExcel->getActiveSheet()->setTitle('QLSP');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A'.$rowCount,'Mã Sản Phẩm');
    $sheet->setCellValue('B'.$rowCount,'Tên Sản Phẩm');
    $sheet->setCellValue('C'.$rowCount,'Mã Nhà Cung Cấp');
    $sheet->setCellValue('D'.$rowCount,'Ngày Sản Xuất');
    $sheet->setCellValue('E'.$rowCount,'Hạn Sử Dụng');
    $sheet->setCellValue('F'.$rowCount,'Kệ Hàng');
    $sheet->setCellValue('G'.$rowCount,'Giá Bán');
    $sheet->setCellValue('H'.$rowCount,'Đơn Vị Tính');
    $sheet->setCellValue('I'.$rowCount,'Loại Sản Phẩm');

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
    $msp=$_POST['txtMaSanPham'];
    $tsp=$_POST['txtTenSanPham'];
    $sqltk_5="SELECT * FROM sanpham WHERE MaSanPham like '%$msp%' and TenSanPham like '%$tsp%' ";
    $data_5=mysqli_query($con_5, $sqltk_5);

    while($row=mysqli_fetch_array($data_5)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['MaSanPham']);
        $sheet->setCellValue('B'.$rowCount,$row['TenSanPham']);
        $sheet->setCellValue('C'.$rowCount,$row['MaNhaCungCap']);
        $sheet->setCellValue('D'.$rowCount,$row['NgaySanXuat']);
        $sheet->setCellValue('E'.$rowCount,$row['HanSuDung']);
        $sheet->setCellValue('F'.$rowCount,$row['KeHang']);
        $sheet->setCellValue('G'.$rowCount,$row['GiaBan']);
        $sheet->setCellValue('H'.$rowCount,$row['DonViTinh']);
        $sheet->setCellValue('I'.$rowCount,$row['LoaiSanPham']);
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







mysqli_close($con_5);
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
        table img{
    width: 50px;
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
                        <td colspan="9" style="text-align: left;">
                            <h2>THÔNG TIN SẢN PHẨM</h2>
                        </td>
                    </tr>
    
                    <tr >
                      
                        <td colspan="9" class="cold2">
                          
                        </td>
                    </tr>
                    <tr >
                        <th>STT</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Mã nhà cung cấp</th>
                        <th>Ảnh Sản Phẩm</th>
                        <th>Ngày sản xuất</th>
                        <th>Hạn sử dụng</th>
                        <th>Kệ Hàng</th>
                        <th>Giá bán</th>
                        <th>Đơn Vị Tính</th>
                        <th>Loại sản phẩm</th>
                        <th>Công cụ</th>
                    </tr>
                    <?php
                    //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                    if(isset($data_5)&& $data_5!=null){
                        $i=0;
                        while($row=mysqli_fetch_array($data_5)){
                    ?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $row['MaSanPham'] ?></td>
                            <td><?php echo $row['TenSanPham'] ?></td>
                            <td><?php echo $row['MaNhaCungCap'] ?></td>
                            <td><?php echo "<img src='photo/".$row['Anh']."' >";?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['NgaySanXuat'])) ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['HanSuDung'])) ?></td>
                            <td><?php echo $row['KeHang'] ?></td>
                            <td><?php echo $row['GiaBan'] ?></td>
                            <td><?php echo $row['DonViTinh'] ?></td>
                            <td><?php echo $row['LoaiSanPham'] ?></td>
                            <td>
                                <span class="btntool btn btn-primary">

                                    <a href="./sanpham_sua.php?MaSanPham=<?php echo $row['MaSanPham'] ?>"><font color="red">Sửa</a>&nbsp;&nbsp;
                                </span>
                                <span class="btntool btn btn-danger">

                                    <a href="./sanpham_xoa.php?MaSanPham=<?php echo $row['MaSanPham'] ?>">Xóa</a>
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
                    <form method="post" action="" enctype="multipart/form-data">
                    <table>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <h5 >CẬP NHẬT THÔNG TIN SẢN PHẨM</h5>
                    </td>
                </tr>

                <tr>
                    <td class="col1">Mã sản phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaSanPham" value="<?php echo $msp ?>" style="width:450px;">
                    </td>

                </tr>
                <tr>
                    <td> Hình Ảnh</td>
                    <td>
                    <input type="hidden" name="size" value="1000000"> 
                        <input type="file" name="image"> 
                        <button type="submit" name="upload">POST</button>
                        
                    </td>
                </tr>
                <tr>
                    <td class="col1">Tên sản phẩm</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtTenSanPham"value="<?php echo $tsp ?>" style="width:450px;">
                    </td>
                    
                </tr>
                <tr>
                    <td class="col1">Mã nhà cung cấp</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtMaNhaCungCap" value="<?php echo $mncc ?>" style="width:450px;">
                    </td>
                </tr>
                
                <tr>
                    <td class= "col1">Ngày sản xuất</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtNgaySanXuat" value="<?php echo $nsx ?>" style="width:450px;">
                    </td>   
                </tr>

                <tr>
                    <td class= "col1">Hạn sử dụng</td>
                    <td class="col2">
                        <input class="form-control" type="date" name="txtHanSuDung" value="<?php echo $hsd ?>" style="width:450px;">
                    </td>   
                </tr>
                <tr>
    <td class="col1">Kệ hàng</td>
    <td class="col2">
        <select class="form-control" name="txtKeHang" style="width: 450px;">
            <option value="">--CHỌN KỆ HÀNG--</option>
            <?php
            $kehang_options = array("Kệ 1", "Kệ 2", "Kệ 3", "Kệ 4"); // Thay thế bằng danh sách tùy chọn thực tế
            foreach ($kehang_options as $option) {
                $selected = ($option == $k) ? 'selected' : '';
                echo "<option value='$option' $selected>$option</option>";
            }
            ?>
        </select>
    </td>
</tr>

                <tr>
                    <td class= "col1">Giá bán</td>
                    <td class="col2">
                        <input class="form-control" type="number" name="txtGiaBan" value="<?php echo $gb ?>" style="width:450px;">
                    </td>   
                </tr>
                <tr>
                <tr>
    <td class="col1">Đơn vị tính</td>
    <td class="col2">
        <select class="form-control" name="txtDonViTinh" style="width: 450px;">
            <option value="">--CHỌN ĐƠN VỊ TÍNH--</option>
            <?php
            $donvitinh_options = array("Cái", "Gói", "Thùng", "Hộp", "Bịch", "Túi"); // Thay thế bằng danh sách tùy chọn thực tế
            foreach ($donvitinh_options as $option) {
                $selected = ($option == $dvt) ? 'selected' : '';
                echo "<option value='$option' $selected>$option</option>";
            }
            ?>
        </select>
    </td>
</tr>
<tr>
    <td class="col1">Loại sản phẩm</td>
    <td class="col2">
        <select class="form-control" name="txtLoaiSanPham" style="width: 450px;">
            <option value="">--CHỌN LOẠI SẢN PHẨM--</option>
            <?php
            $loaisanpham_options = array("Bánh", "Nước Giải khát", "Gia vị", "Kẹo"); // Thay thế bằng danh sách tùy chọn thực tế
            foreach ($loaisanpham_options as $option) {
                $selected = ($option == $lsp) ? 'selected' : '';
                echo "<option value='$option' $selected>$option</option>";
            }
            ?>
        </select>
    </td>
</tr>

                <tr>
                    <td class="col1"></td>
                    <td class="col2">
                    <input type="hidden" name="size" value="1000000"> 
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