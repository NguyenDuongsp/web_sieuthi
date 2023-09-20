<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link rel="stylesheet" href="./assets/css/demo.css">
       
</head>
<body>
<<<<<<< HEAD
 <h2>hjfvkjfjvhfk</h2>
=======
 SUPERMAN
>>>>>>> ceff819a36155495b22fffac532ea94dcc95d1a8
<div class="menu">
  <ul class="menu-level-1">
    <li class="menu-item">
      <a href="#">Menu 1</a>
      <ul class="menu-level-2">
        <li class="menu-item">Submenu 1</li>
        <li class="menu-item">Submenu 2</li>
        <li class="menu-item">Submenu 3</li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="#">Menu 2</a>
      <ul class="menu-level-2">
        <li class="menu-item"><a href="#">Submenu 4</a></li>
        <li class="menu-item"><a href="#">Submenu 5</a></li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="#">Menu 3</a>
      <ul class="menu-level-2">
        <li class="menu-item">Submenu 6</li>
        <li class="menu-item">Submenu 7</li>
        <li class="menu-item">Submenu 8</li>
        <li class="menu-item">Submenu </li>
      </ul>
    </li>
  </ul>
</div>
                   
</body>
<script>
         var menuItems = document.querySelectorAll('.menu-item');

menuItems.forEach(function(item) {
  item.addEventListener('click', function() {
    var subMenu = this.querySelector('.menu-level-2');
    if (subMenu.style.display === 'block') {
      subMenu.style.display = 'none';
    } else {
      subMenu.style.display = 'block';
    }
  });
});
        </script>
</html>
