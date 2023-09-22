<!DOCTYPE html>
<html>
<head>
    <style>
        .highlight {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <?php include './demo1.php'?>

    <script>
        // Lấy dữ liệu từ localStorage
        var selectedCellData = localStorage.getItem('selectedCellData');

        // Tìm và đánh dấu ô có dữ liệu tương tự
        var cells = document.getElementsByClassName('sub-item-link');
        for (var i = 0; i < cells.length; i++) {
            if (cells[i].innerText === selectedCellData) {
                cells[i].classList.add('highlight');
            }
        }
    </script>
</body>
</html>