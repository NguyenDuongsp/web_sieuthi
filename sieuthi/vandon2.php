<?php
//thư viện xuất excel
include_once './Classes/PHPExcel.php';
include_once './Classes/PHPExcel/IOFactory.php';


// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
include_once ('ketnoi_csdl_quy.php');

//đây là thêm
// Xử lý khi submit form
if (isset($_POST['btnluu'])) {
    $MaVanDon = $_POST['MaVanDon'] ?? '';
    $NgayLapDon = $_POST['NgayLapDon'] ?? '';
    $MaDonHang = $_POST['MaDonHang'] ?? '';
    $MoTaDonHang = $_POST['MoTaDonHang'] ?? '';
    $NoiDi = $_POST['NoiDi'] ?? '';
    $NoiDen = $_POST['NoiDen'] ?? '';
    $TinhTrang = $_POST['TinhTrang'] ?? '';
    $MaNhanVien = $_POST['MaNhanVien'] ?? '';
    $MaKhachHang = $_POST['MaKhachHang'] ?? '';
    $TrongLuongHangHoa = $_POST['TrongLuongHangHoa'] ?? '';
    $PhiVanChuyen = $_POST['PhiVanChuyen'] ?? '';
    $PhuongThucVanChuyen = $_POST['PhuongThucVanChuyen'] ?? '';
    $SoLuongKienHang = $_POST['SoLuongKienHang'] ?? '';

    // Tiếp theo, bạn có thể sử dụng các biến này trong câu truy vấn INSERT hoặc các hoạt động xử lý khác.
}

// Kiểm tra giá trị khóa chính trước khi thực hiện truy vấn INSERT
if (!empty($MaVanDon)) {
    // Kết nối tới cơ sở dữ liệu
   

    // Kiểm tra giá trị khóa chính đã tồn tại trong bảng chưa
    $query = "SELECT * FROM vandon WHERE MaVanDon = '$MaVanDon'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Giá trị khóa chính đã tồn tại, thông báo lỗi cho người dùng
        echo "Giá trị khóa chính đã tồn tại. Vui lòng chọn giá trị khác.";
    } else {
        // Giá trị khóa chính không tồn tại, thực hiện truy vấn INSERT
        $sql = "INSERT INTO vandon (MaVanDon, NgayLapDon, MaDonHang, MoTaDonHang, NoiDi, NoiDen, TinhTrang, MaNhanVien, MaKhachHang, TrongLuongHangHoa, PhiVanChuyen, PhuongThucVanChuyen, SoLuongKienHang)
         VALUES ('$MaVanDon', '$NgayLapDon', '$MaDonHang', '$MoTaDonHang', '$NoiDi', '$NoiDen', '$TinhTrang', '$MaNhanVien', '$MaKhachHang', '$TrongLuongHangHoa', '$PhiVanChuyen', '$PhuongThucVanChuyen', '$SoLuongKienHang')";
        // Thực hiện truy vấn INSERT
        if ($conn->query($sql) === TRUE) {
            echo "Thêm bản ghi thành công.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }

}
//hết phần thêm


// Xử lý tìm kiếm vận đơn nếu có yêu cầu
if (isset($_POST['btntim'])) {
    $search = $_POST['txttimkiem'];

    // Truy vấn SQL để tìm kiếm vận đơn
    $query = "SELECT * FROM vandon WHERE MaVanDon LIKE '%$search%'" ;
    $result = $conn->query($query);
} else {
    // Truy vấn SQL để thống kê tất cả sản phẩm quá hạn
    $query = "SELECT * FROM vandon";
    $result = $conn->query($query);
}

    
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
        $MaVanDon = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
        $NgayLapDon = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
        $MaDonHang = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        $MoTaDonHang = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        $NoiDi = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
        $NoiDen = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
        $TinhTrang = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
        $MaNhanVien = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
        $MaKhachHang = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
        $TrongLuongHangHoa = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
        $PhiVanChuyen = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
        $PhuongThucVanChuyen = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
        $SoLuongKienHang = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
        
        // Thực hiện truy vấn INSERT vào cơ sở dữ liệu (thay đổi tên bảng và cột tương ứng)
        $query = "INSERT INTO vandon (MaVanDon, NgayLapDon, MaDonHang, MoTaDonHang,NoiDi,NoiDen,TinhTrang,MaNhanVien,MaKhachHang,TrongLuongHangHoa,PhiVanChuyen,PhuongThucVanChuyen,SoLuongKienHang) VALUES ('$MaVanDon', '$NgayLapDon', '$MaDonHang', '$MoTaDonHang', '$NoiDi', '$NoiDen', '$TinhTrang','$MaNhanVien','$MaKhachHang','$TrongLuongHangHoa','$PhiVanChuyen','$PhuongThucVanChuyen','$SoLuongKienHang')";
        $conn->query($query);
    }
}



    // Xử lý xuất Excel
    if (isset($_POST['btnXuatExcel'])) {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('vandon');
    
        // Set tiêu đề cho các cột
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Mã vận đơn')
            ->setCellValue('B1', 'Ngày lập đơn')
            ->setCellValue('C1', 'Mã đơn hàng')
            ->setCellValue('D1', 'Mô tả đơn hàng')
            ->setCellValue('E1', 'Nơi đi')
            ->setCellValue('F1', 'Nơi đến')
            ->setCellValue('G1', 'Tình trạng')
            ->setCellValue('H1', 'Mã nhân viên')
            ->setCellValue('I1', 'Mã khách hàng')
            ->setCellValue('J1', 'Trọng lượng hàng hoá')
            ->setCellValue('K1', 'Phí vận chuyển')
            ->setCellValue('L1', 'Phương thức vận chuyển')
            ->setCellValue('M1', 'Số lượng kiện hàng');
    
        // Lấy dữ liệu từ cơ sở dữ liệu
        $row = 2;
        while ($data = $result->fetch_assoc()) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $data['MaVanDon'])
                ->setCellValue('B' . $row, $data['NgayLapDon'])
                ->setCellValue('C' . $row, $data['MaDonHang'])
                ->setCellValue('D' . $row, $data['MoTaDonHang'])
                ->setCellValue('E' . $row, $data['NoiDi'])
                ->setCellValue('F' . $row, $data['NoiDen'])
                ->setCellValue('G' . $row, $data['TinhTrang'])
                ->setCellValue('H' . $row, $data['MaNhanVien'])
                ->setCellValue('I' . $row, $data['MaKhachHang'])
                ->setCellValue('J' . $row, $data['TrongLuongHangHoa'])
                ->setCellValue('K' . $row, $data['PhiVanChuyen'])
                ->setCellValue('L' . $row, $data['PhuongThucVanChuyen'])
                ->setCellValue('M' . $row, $data['SoLuongKienHang']);
    
            $row++;
        }
    
        // Xuất file Excel
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = 'vandon.xlsx';
        $objWriter->save($filename);
    
        // Tải file Excel về
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($filename);
        exit();
    }

// Đóng kết nối cơ sở dữ liệu
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Vận đơn của sản phẩm </title>
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
        h2 {
            color: #333;
        }

        /* form {
            max-width: 400px;
            margin: 20px auto;
        } */

        label {
            display: block;
            margin-top: 5px;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 50%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 50px;
        }

        input[type="submit"] {
            margin-top: 5px;
            padding: 4px 7px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <!-- từ cái này là của thêm mới -->
<title>Chức năng Vận đơn</title>
    
</head>
<body>

    <form method="post" action=""enctype="multipart/form-data">
        <?php include_once'./contac.php' ?>
            <div class ="conten"  >
    

    <!-- Form tìm kiếm -->
    
    <table>
        <tr >
            
            <td colspan="4"><h2>Danh sách vận đơn</h2></td>

            <td colspan = "6">
                            
                <input type="file" name="file">
                <button type="submit" name = "btnTai">Tải lên</button>
                
            </td>

            <td colspan="2"> <input type="submit" value ="Xuất Excel " name = "btnXuatExcel" ></td>
            <td colspan = "2"><button><a href='vandon_them.php'>Thêm </a></button></td>
        </tr>
    
        <tr>
            <th>Mã vận đơn</th>
            <th>Ngày lập đơn</th>
            <th>Mã đơn hàng</th>
            <th>Mô tả đơn hàng</th>
            <th>Nơi đi</th>
            <th>Nơi đến</th>
            <th>Tình trạng</th>
            <th>Mã nhân viên</th>
            <th>Mã khách hàng</th>
            <th>Trọng lượng hàng hoá</th>
            <th>Phí vận chuyển</th>
            <th>Phương thức vận chuyển</th>
            <th>Số lượng kiện hàng</th>
            <th>Thao tác sửa</th>
            <th>Thao tác xoá</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["MaVanDon"] . "</td>";
                echo "<td>" . $row["NgayLapDon"] . "</td>";
                echo "<td>" . $row["MaDonHang"] . "</td>";
                echo "<td>" . $row["MoTaDonHang"] . "</td>";
                echo "<td>" . $row["NoiDi"] . "</td>";
                echo "<td>" . $row["NoiDen"] . "</td>";
                echo "<td>" . $row["TinhTrang"] . "</td>";
                echo "<td>" . $row["MaNhanVien"] . "</td>";
                echo "<td>" . $row["MaKhachHang"] . "</td>";
                echo "<td>" . $row["TrongLuongHangHoa"] . "</td>";
                echo "<td>" . $row["PhiVanChuyen"] . "</td>";
                echo "<td>" . $row["PhuongThucVanChuyen"] . "</td>";
                echo "<td>" . $row["SoLuongKienHang"] . "</td>";
                echo "<td><a href='vandon_sua2.php?MaVanDon=" . $row["MaVanDon"] . "'>Sửa</a></td>";
                echo "<td><a href='vandon_xoa.php?MaVanDon=" .$row["MaVanDon"] . "'>Xoá</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='14'>Không có sản phẩm trong database</td></tr>";
        }
        ?>
            </table>

    
        </div>
    </form>

    <!-- từ đây là phần thêm mới -->
    
    
        <div class="modal js-modal">
            <div class="modal-container js-modal-container">
                <div class="modal-close js-modal-close">
                    <i class="fa-solid fa-xmark"></i>
                    </div>
                        <form method="post" action="" enctype="multipart/form-data">
                            
                                <label for="MaVanDon">Mã vận đơn:</label>
                                <input type="text" name="MaVanDon" required>

                                <label for="NgayLapDon">Ngày lập đơn:</label>
                                <input type="date" name="NgayLapDon" required>

                                <label for="MaDonHang">Mã đơn hàng:</label>
                                <input type="text" name="MaDonHang">

                                <label for="MoTaDonHang">Mô tả đơn hàng:</label>
                                <textarea name="MoTaDonHang"></textarea>

                                <label for="NoiDi">Nơi đi:</label>
                                <input type="text" name="NoiDi">

                                <label for="NoiDen">Nơi đến:</label>
                                <input type="text" name="NoiDen">

                                <label for="TinhTrang">Tình trạng:</label>
                                <input type="text" name="TinhTrang">

                                <label for="MaNhanVien">Mã nhân viên:</label>
                                <input type="text" name="MaNhanVien">

                                <label for="MaKhachHang">Mã khách hàng:</label>
                                <input type="text" name="MaKhachHang">

                                <label for="TrongLuongHangHoa">Trọng lượng hàng hóa:</label>
                                <input type="text" name="TrongLuongHangHoa">

                                <label for="PhiVanChuyen">Phí vận chuyển:</label>
                                <input type="text" name="PhiVanChuyen">

                                <label for="PhuongThucVanChuyen">Phương thức vận chuyển:</label>
                                <input type="text" name="PhuongThucVanChuyen">

                                <label for="SoLuongKienHang">Số lượng kiện hàng:</label>
                                <input type="text" name="SoLuongKienHang">

                                <input type="submit" value="Tạo vận đơn" name = "btnluu">
                           
                        </form>
                    </div>
               
    <!--  hết phần thêm mới -->
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