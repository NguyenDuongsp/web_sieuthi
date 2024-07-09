const productList = document.getElementsByClassName("home-product-item");
for (let i = 0; i < productList.length; i++) {
  const product = productList[i];
  productList[i].addEventListener("mousedown", function(event) {
    var productItem = event.target.closest(".home-product-item");
    var productImg = productItem.querySelector("img").src;
    var productPrice = productItem.querySelector(".home-product-item__price-new").textContent;
    var productName = productItem.querySelector(".home-product-item__name").textContent;
    var productCode = productItem.querySelector(".msp").textContent;
    var productQuantity = productItem.querySelector(".soluong").textContent;
    addProduct(productImg, productName, productPrice, productCode, productQuantity);
  });
}
// Hàm để thêm sản phẩm vào giỏ hàng
function addProduct(productImg, productName, productPrice, productCode, productQuantity) {
  var table = document.getElementById("productInfo");
  var cartItemRows = table.getElementsByClassName("cart-item-row");

  for (var i = 0; i < cartItemRows.length; i++) {
    var cartItem = cartItemRows[i];
    var cartItemName = cartItem.querySelector(".cart-item-name").innerText;

    if (cartItemName === productName) { // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
      var quantityInput = cartItem.querySelector(".txtsl");
      var currentQuantity = parseInt(quantityInput.value);
      var newQuantity = currentQuantity + 1;
      
      if (newQuantity > parseInt(productQuantity)) {
        // Kiểm tra xem số lượng mới có vượt quá số lượng tối đa của sản phẩm hay không
        alert("Số lượng sản phẩm vượt quá số lượng có sẵn.");
        return;
      }
      
      quantityInput.value = newQuantity;
      updateCartItemTotal(cartItem);
      carttol();
      return;
    }
  }

  // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
  var add = document.createElement("tr");
  add.classList.add("cart-item-row");
  var content =
    '<tr class="cart-item-row">' +
    '<td style="display: flex; align-items:center"><img style="width:50px" src="' + productImg + '" alt=""></td>' +
    '<td class="cart-item-name"><p>' + productName + '</p></td>' +
    '<td><p><span class="cart-item-price">' + productPrice + '</span><sup>đ</sup></p></td>' +
    '<td>' +
    '<input name="txtsl[]" class="txtsl" type="number" value="1" min="1" max="' + productQuantity + '">' +
    '<button class="btn-minus">-</button>' +
    '</td>' +
    '<td>' +
    '<input class="txtkohien" name="txtmasp[]" type="text" value="' + productCode + '">' +
    '</td>' +
    '</tr>';
  add.innerHTML = content;
  table.appendChild(add);
  var quantityInput = add.querySelector(".txtsl");
  quantityInput.addEventListener("input", updateQuantity);
  var minusButton = add.querySelector(".btn-minus");
  minusButton.addEventListener("click", decreaseQuantity);
  carttol();
}

// Hàm để tính tổng giá trị giỏ hàng
function carttol() {
  var totalC = 0;
  var cartItemRows = document.getElementsByClassName("cart-item-row");

  for (var i = 0; i < cartItemRows.length; i++) {
    var cartItem = cartItemRows[i];
    var quantityInput = cartItem.querySelector(".txtsl");
    var inputValue = parseInt(quantityInput.value);
    var proPrice = parseInt(cartItem.querySelector(".cart-item-price").innerHTML);
    var totalA = inputValue * proPrice;
    totalC += totalA;
  }

  var cartTotal = document.querySelector(".txttongtien");
  var totalD = totalC;
  cartTotal.value = totalD;
}

// Hàm để tăng số lượng của sản phẩm
function increaseQuantity(button) {
    var input = button.parentNode.querySelector('.txtsl');
    var currentValue = parseInt(input.value);
    input.value = currentValue + 1;
    updateCartItemTotal(button.parentNode.parentNode);
    carttol();
  }
  
  // Hàm để giảm số lượng của sản phẩm
  function decreaseQuantity(button) {
    var input = button.parentNode.querySelector('.txtsl');
    var currentValue = parseInt(input.value);
    
    if (currentValue > 1) {
      input.value = currentValue - 1;
      updateCartItemTotal(button.parentNode.parentNode);
    } else {
      var cartItemRow = button.parentNode.parentNode;
      cartItemRow.parentNode.removeChild(cartItemRow);
    }
    
    carttol();
  }
  
  // Hàm để cập nhật số lượng sản phẩm
  function updateQuantity() {
    var input = this;
    var currentValue = parseInt(input.value);
    
    if (currentValue >= 0) {
      updateCartItemTotal(input.parentNode.parentNode);
      carttol();
      
      if (currentValue === 0) {
        var cartItemRow = input.parentNode.parentNode;
        cartItemRow.parentNode.removeChild(cartItemRow);
      }
    }
  }

// Hàm để cập nhật tổng giá trị của sản phẩm trong giỏ hàng
function updateCartItemTotal(cartItemRow) {
  var quantityInput = cartItemRow.querySelector(".txtsl");
  var inputValue = parseInt(quantityInput.value);
  var pricePerItem = parseInt(cartItemRow.querySelector(".cart-item-price").innerHTML);
  var total = inputValue * pricePerItem;
  var totalElement = cartItemRow.querySelector(".cart-item-total");
  totalElement.textContent = total;
}