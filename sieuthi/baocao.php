
<?php
$con_h4 = mysqli_connect('localhost', 'root', '', 'ql_sieuthi') or die('lỗi kết nối');
$kq = '';
$a = '';
$b = '';
$c = '';

if (isset($_POST['txta']) && isset($_POST['txtb'])) {
    $a = $_POST['txta'] ?? $a;
    $b = $_POST['txtb'] ?? $b;

    if (!empty($a) && !empty($b)) {
        // Chuyển đổi định dạng ngày từ d/m/y sang y-m-d
        $a = date('Y-m-d', strtotime(str_replace('/', '-', $a)));
        $b = date('Y-m-d', strtotime(str_replace('/', '-', $b)));

        $sql_all_sales = "SELECT * FROM hoadon WHERE NgayTao BETWEEN '$a' AND '$b'";
        $result_all_sales = mysqli_query($con_h4, $sql_all_sales);

        // Kiểm tra và hiển thị danh sách hóa đơn
    }
}


 $sql_sales = "SELECT SUM(TongTien) AS `Tổng số tiền` 
             FROM hoadon 
             WHERE NgayTao BETWEEN '$a' AND '$b'";

         $result_sales = mysqli_query($con_h4, $sql_sales);
        

         if ($result_sales ) {
             $row_sales = mysqli_fetch_assoc($result_sales);
           

             $total_sales = $row_sales['Tổng số tiền'];
            
          
     }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng đơn hàng bán và đơn nhập hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script>
        function autoFetchData() {
            var txta = document.getElementById('txta').value;
            var txtb = document.getElementById('txtb').value;

            if (txta !== '' && txtb !== '') {
                var dateA = new Date(txta);
                var dateB = new Date(txtb);

                if (dateA <= dateB) {
                    document.getElementById('form').submit();
                } else {
                    alert('Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.');
                }
            }
        }
    </script>
</head>
<body>
    
        <form id="form" method="post" action="">
            
            <?php include_once './contac.php'?>
            <div class="conten">
            <table  class="table table-striped" style="width:100%">
                <tr>
                    <td colspan="5" style="text-align: center;">
                        <h5 >THỐNG KÊ DOANH THU </h5>
                    </td>
                </tr>
                <tr>
    <td class="col1" colspan="2" style="text-align: right">Từ ngày</td>
    <td colspan="3" class="col2" style="text-align: left;">
        <input type="date" id="txta" name="txta" value="<?php echo $a; ?>" onchange="autoFetchData()">
    </td>
</tr>
<tr>
    <td class="col1" colspan="2" style="text-align: right">Đến ngày</td>
    <td colspan="3" class="col2" style="text-align: left;">
        <input type="date" id="txtb" name="txtb" value="<?php echo $b; ?>" onchange="autoFetchData()">
    </td>
</tr>
               
                <td class="col1" colspan="2" style="text-align: right" >Số tiền bán được </td>
                    <td colspan="3" class="col2" style="text-align: left;">
                        <input type="text" value="<?php echo isset($total_sales) ? $total_sales : ''; ?>" style="width:140px;" readonly>
                    </td>
                </tr>
                
                    <tr >
                        
                        <td colspan="5"class="cold2">
                        </td>
                    </tr>
                    <tr >
                        <th>STT</th>
                        <th>Mã hóa đơn</th>
                        <th>Mã khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày tạo</th>
                    </tr>
                    <?php
                    $hasInvoices = false; // Biến kiểm tra có hóa đơn hay không
                    //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                    if (isset($result_all_sales) && $result_all_sales != null && mysqli_num_rows($result_all_sales) > 0) {
                        $i=0;
                        while($row=mysqli_fetch_array($result_all_sales)){
                           
                            $hasInvoices = true; // Đánh dấu đã tìm thấy hóa đơn
                    ?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $row['MaHoaDon'] ?></td>
                            <td><?php echo $row['MaKhachHang'] ?></td>
                            <td><?php echo $row['TongTien'] ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['NgayTao'])) ?></td>
                            
                        </tr>
                        <?php
    }
} if (!$hasInvoices) {
    echo '<tr><td colspan="5">Không có hóa đơn trong khoảng ngày đã chọn.</td></tr>';
}
?>
                </table>
            
    </div>
        </form>
</body>
<style>
        .add-item {
            display: none;
        }
    </style>
</html>