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
			$mnv=$sheetData[$i]["A"];
			$tnv=$sheetData[$i]["B"];
			$cv=$sheetData[$i]["C"];
            $em=$sheetData[$i]["D"];
            $sdt=$sheetData[$i]["E"];
            $mk=$sheetData[$i]["F"];
			$sql_19="INSERT INTO nhanvien VALUES('$mnv','$tnv','$cv','$em','$sdt','$mk')";
			$connnn->query($sql_19);
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