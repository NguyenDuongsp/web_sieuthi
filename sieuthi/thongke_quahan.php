<?php

//thư viện xuất excel
include_once './Classes/PHPExcel.php';
include_once './Classes/PHPExcel/IOFactory.php';

// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
include_once ('ketnoi_csdl_quy.php');

// Kiểm tra xem người dùng đã gửi tệp tin lên chưa
if (isset($_POST['btnTai'])) {
    $file = $_FILES['file']['tmp_name'];

    // Đọc dữ liệu từ tệp tin Excel
    
    $inputFileType = PHPExcel_IOFactory::identify($file);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($file);
    
    // Lấy dữ liệu từ tệp tin Excel
    $worksheet = $objPHPExcel->getActiveSheet();
    $highestRow = $worksheet->getHighestRow();
    
    
    // Lưu dữ liệu vào cơ sở dữ liệu
    for ($row = 2; $row <= $highestRow; $row++) {
        $tenSanPham = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
        $maSanPham = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
        $soLuong = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        $hanSuDung = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        
        // Thực hiện truy vấn INSERT vào cơ sở dữ liệu (thay đổi tên bảng và cột tương ứng)
        $query = "INSERT INTO sanpham ( MaSanPham,TenSanPham, SoLuong, HanSuDung) VALUES ('$maSanPham','$tenSanPham',  '$soLuong', '$hanSuDung')";
        $conn->query($query);
    }   
}

// Truy vấn SQL để thống kê sản phẩm quá hạn
$currentDate = date('Y-m-d');
$query1 = "SELECT TenSanPham, MaSanPham, SoLuong, HanSuDung FROM sanpham WHERE HanSuDung < '$currentDate'";
$result1 = $conn->query($query1);


    // Xử lý xuất Excel
    if (isset($_POST['btnXuatExcel'])) {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('quahan');
    
        // Set tiêu đề cho các cột
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Tên sản phẩm')
            ->setCellValue('B1', 'Mã sản phẩm ')
            ->setCellValue('C1', 'Số lượng')
            ->setCellValue('D1', 'Hạn sử dụng');
            
    
        // Lấy dữ liệu từ cơ sở dữ liệu
        $row = 2;
        while ($data = $result1->fetch_assoc()) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $data['TenSanPham'])
                ->setCellValue('B' . $row, $data['MaSanPham'])
                ->setCellValue('C' . $row, $data['SoLuong'])
                ->setCellValue('D' . $row, $data['HanSuDung']);
    
            $row++;
        }
    
        // Xuất file Excel
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = 'quahan.xlsx';
        $objWriter->save($filename);
    
        // Tải file Excel về
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($filename);
        exit();
    }


?>

<!DOCTYPE html>
<html>
<head>
    <title>Thống kê sản phẩm quá hạn</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<form method="post" action="" enctype="multipart/form-data">
        <?php include_once('contac.php')?>
        <div class = 'conten'>

            <table>
                <tr>
                    <td colspan = "4">
                        <h2>Thống kê sản phẩm quá hạn</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan = "3">
                        
                            <input type="file" name="file">
                            <button type="submit" name = "btnTai">Tải lên</button>
                        
                    </td>
                
                    <td>
                        <input type="submit" value ="Xuất Excel " name = "btnXuatExcel" >
                    </td>
                </tr>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Ngày hết hạn</th>
                </tr>
                <?php
                if ($result1->num_rows > 0) {
                    while ($row = $result1->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["TenSanPham"]."</td>";
                        echo "<td>".$row["MaSanPham"]."</td>";
                        echo "<td>".$row["SoLuong"]."</td>";
                        echo "<td>".$row["HanSuDung"]."</td>";
                        echo "<td><a href='sanpham_xoa.php?MaSanPham=" .$row["MaSanPham"] . "'>Xoá</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Không có sản phẩm quá hạn</td></tr>";
                }
                ?>
            </table>
        </div>
            
</form>

    <?php
   // Đóng kết nối cơ sở dữ liệu
    $conn->close();
    ?>
</body>
</html>