<?php
// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
include_once ('ketnoi_csdl_quy.php');
// Xử lý khi nhận được yêu cầu sửa thông tin vận đơn


// Truy vấn SQL để lấy thông tin vận đơn dựa trên mã vận đơn
$query = "SELECT * FROM sanpham WHERE ThanhLy = 1";
$result = $conn->query($query);

// ?>

<!DOCTYPE html>
<html>
<head>
    <title>Thanh li</title>
    <style>
        img{
            height: 50px;
            width: 50px;
        }
    </style>
</head>
<body>
    

    <form method="post" action="">
        <?php 
    include_once './contac.php';

    ?>
    <h2>Thanh lí</h2>
           
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
                        <th>Giá bán</th>
                        <th>Loại sản phẩm</th>
                        <th>Công cụ</th>
                    </tr>
                    <?php
                    //b3: xử lý kết quả truy vấn(hiển thị mảng $data lên bảng)
                    if ($result->num_rows > 0) {
                        $i=0;
                        while ($row = $result->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $row['MaSanPham'] ?></td>
                            <td><?php echo $row['TenSanPham'] ?></td>
                            <td><?php echo $row['MaNhaCungCap'] ?></td>
                            <td><?php echo "<img src='photo/".$row['Anh']."' >";?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['NgaySanXuat'])) ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['HanSuDung'])) ?></td>
                            <td><?php echo $row['GiaBan'] ?></td>
                            <td><?php echo $row['LoaiSanPham'] ?></td>
                            <td>
                                <span class="btntool btn btn-danger">
                                    <a href="./sanpham_xoa.php?MaSanPham=<?php echo $row['MaSanPham'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm?')">Xóa</a>
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

    <?php
    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
    ?>
</body>
</html>