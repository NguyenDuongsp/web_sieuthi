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
			$msp=$sheetData[$i]["A"];
			$tsp=$sheetData[$i]["B"];
			$sl=$sheetData[$i]["C"];
            $mnn=$sheetData[$i]["D"];
            $nnk=$sheetData[$i]["E"];
            $mncc = $sheetData[$i]["F"];
			$sql_9="INSERT INTO nhaphang VALUES('$msp','$tsp','$sl','$mnn','$mncc')";
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