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
    </style>
</head>
<body>
    <?php include_once './contac.php'?>
<div class="conten">
                        <form method="post" action="">
           
                
            <table border="1" cellspacing="0" >
                <tr style="background: pink;">
                    <th>STT</th>
                    <th>Mã loại sách</th>
                    <th>Tên loại sách</th>
                    <th>Mô tả</th>
                </tr>
               
            </table>
        </form>
                        </div>
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