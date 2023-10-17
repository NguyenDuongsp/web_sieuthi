<?php
    include_once './Classes/PHPExcel.php';
    include_once './Classes/PHPExcel/IOFactory.php';
    //kết nối dba_close
    $connnn=mysqli_connect('localhost','root','','ql_sieuthi')
    or die('lỗi kết nối');
    if(isset($_POST['btnUpload'])){
        $file=$_FILES['txtFile']['tmp_name'];
		$objReader=PHPExcel_IOFactory::createReaderForFile($file);
		$objExcel=$objReader->load($file);
		//Lấy sheet hiện tại
		$sheet=$objExcel->getSheet(0);
		$sheetData=$sheet->toArray(null,true,true,true);
		for($i=2;$i<=count($sheetData);$i++){
			$mnh=$sheetData[$i]["A"];
			$msp=$sheetData[$i]["B"];
			$tensp=$sheetData[$i]["C"];
            $mncc=$sheetData[$i]["D"];
            $slp=$sheetData[$i]["E"];
            $nn=$sheetData[$i]["F"];
            $ngaysx=$sheetData[$i]["G"];
            $hsd=$sheetData[$i]["H"];
            $anh=$sheetData[$i]["I"];
			$sql_9="INSERT INTO nhaphang VALUES('$mnh','$msp','$tensp','$mncc','$sl','$nn', '$ngaysx', '$hsd', '$anh')";
			$connnn->query($sql_9);
		}
		echo "<script>alert('Thêm mới thành công!')</script>";

    }
    mysqli_close($connnn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>
   
<form method="post" enctype="multipart/form-data" action="" >
    <?php include_once './contac.php' ?>
    <div class="conten">
        
        <table>
            <tr>
                <td class="col2" style="text-align: center;">
                <input type="file" class="form-control-file" id="myFile2" name="txtFile">
                </td>
                <td class="col1">
                <input type="submit" name="btnUpload" value="Upload file">
                </td>
            </tr>
            
        </table>    
    </div>
   
    </form>
    <style>
        .search-add-filter{
            display: none;
        }
    </style>
</body>
</html>