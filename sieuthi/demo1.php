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
    <table>
        <tr>
            <td class="sub-item-link">
                <a href="demo2.php">Cell 1</a>
            </td>
            <td class="sub-item-link">
                <a href="page2.html">Cell 2</a>
            </td>
        </tr>
    </table>

    <script>
        // Lấy danh sách các phần tử có class "sub-item-link"
        var subItemLinks = document.getElementsByClassName('sub-item-link');

        // Gán sự kiện click cho mỗi phần tử
        for (var i = 0; i < subItemLinks.length; i++) {
            subItemLinks[i].addEventListener('click', storeData);
        }

        function storeData(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>

            // Lấy dữ liệu từ ô được bấm
            var cellData = this.querySelector('a').innerText;

            // Lưu dữ liệu vào localStorage để truyền sang trang khác
            localStorage.setItem('selectedCellData', cellData);

            // Lưu đường dẫn hiện tại vào localStorage để truyền sang trang khác
            localStorage.setItem('currentPagePath', window.location.href);

            // Chuyển đến đường dẫn trong thuộc tính href của thẻ <a>
            window.location.href = this.querySelector('a').href;
        }
    </script>
</body>
</html>