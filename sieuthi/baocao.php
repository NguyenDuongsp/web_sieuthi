<?php
$con_h4 = mysqli_connect('localhost', 'root', '', 'ql_sieuthi') or die('lỗi kết nối');
$kq = '';
$a = '';
$b = '';
$c = '';

if (isset($_POST['txta']) && isset($_POST['txtb'])) {
    $a = $_POST['txta'];
    $b = $_POST['txtb'];

    if (!empty($a) && !empty($b)) {
        // Chuyển đổi định dạng ngày từ d/m/y sang y-m-d
        $a = date('Y-m-d', strtotime(str_replace('/', '-', $a)));
        $b = date('Y-m-d', strtotime(str_replace('/', '-', $b)));

        $sql_purchases  = "SELECT SUM(TongTien) AS `Tổng số tiền` 
        FROM hoadonnhaphang
        WHERE NgayNhap BETWEEN '$a' AND '$b'";

$sql_sales = "SELECT SUM(TongTien) AS `Tổng số tiền` 
            FROM hoadon 
            WHERE NgayTao BETWEEN '$a' AND '$b'";

        $result_sales = mysqli_query($con_h4, $sql_sales);
        $result_purchases = mysqli_query($con_h4, $sql_purchases);

        if ($result_sales && $result_purchases) {
            $row_sales = mysqli_fetch_assoc($result_sales);
            $row_purchases = mysqli_fetch_assoc($result_purchases);

            $total_sales = $row_sales['Tổng số tiền'];
            $total_purchases = $row_purchases['Tổng số tiền'];

            $revenue = $total_sales - $total_purchases;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng đơn hàng bán và đơn nhập hàng</title>
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
            <div class="content">
            <table width="500px" align="center">
                <tr>
                    <td>Ngày bắt đầu:</td>
                    <td>
                        <input type="date" id="txta" name="txta" value="<?php echo $a; ?>" onchange="autoFetchData()">
                    </td>
                </tr>
                <tr>
                    <td>Ngày kết thúc:</td>
                    <td>
                        <input type="date" id="txtb" name="txtb" value="<?php echo $b; ?>" onchange="autoFetchData()">
                    </td>
                </tr>
                <tr>
                    <td>Tổng đơn nhập hàng:</td>
                    <td>
                        <input type="text" name="txtc" value="<?php echo isset($total_sales) ? $total_sales : ''; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Tổng đơn hàng bán:</td>
                    <td>
                        <input type="text" value="<?php echo isset($total_purchases) ? $total_purchases : ''; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Doanh thu:</td>
                    <td>
                        <input type="text" value="<?php echo isset($revenue) ? $revenue : ''; ?>" readonly>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>