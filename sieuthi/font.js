


const productList = document.getElementsByClassName("btnthemgiohang1");
for (let i = 0; i < productList.length; i++) {
    const product = productList[i];
    productList[i].addEventListener("click", function(event) {
        var productItem = event.target.closest(".home-product-item");
        console.log(productItem)
        // var productImg = productItem.querySelector("img").src;
        // var productPrice = productItem.querySelector(".home-product-item__price-new").textContent;
        // var productName = productItem.querySelector(".home-product-item__name").textContent;
        // var productCode = productItem.querySelector(".msp").textContent;
        
        // addProduct(productImg, productName, productPrice );
    });
}
function addProduct(productImg, productName, productPrice ) {
    var add = document.createElement("li");
    var content = 
    '<li class="header__cart-item">' +
        '<img src="' + productImg + '" alt="" class="header__cart-img">' +
        '<div class="header__cart-item-info">' +
            '<div class="header__cart-item-head">' +
                '<h5 class="header__cart-item-name">' + productName + '</h5>' +
                '<div class="header__cart-item-price-wrap">' +
                    '<span class="header__cart-item-price">' + productPrice + '</span>' +
                    '<span class="header__cart-item-mulitply">x</span>' +
                    '<span class="header__cart-item-qnt">1</span>' +
                '</div>' +
            '</div>' +
            '<div class="header__cart-item-body">' +
                '<span class="header__cart-item-desription">' +
                    'Phân loại: Bạc' +
                '</span>' +
                '<span class="header__cart-item-remove">Xóa</span>' +
            '</div>' +
        '</div>' +
    '</li>';
    add.innerHTML = content;
    var table = document.getElementById("list_sp");
    table.appendChild(add);
    // inputchange();
    // carttol();
    // add.innerHTML = content;
    // var table = document.getElementById("list_sp");
    // table.appendChild(add);
    // inputchange();
    // carttol();
}

// function carttol() {
//     var totalC = 0;
//     var cartItem = document.querySelectorAll("#productInfo tr");

//     for (var i = 0; i < cartItem.length; i++) {
//         var inputValue = parseInt(cartItem[i].querySelector(".txtsl").value);
//         var proPrice = parseInt(cartItem[i].querySelector("span").innerHTML);
//         var totalA = inputValue * proPrice;
//         totalC += totalA;
//     }

//     var cartTotal = document.querySelector(".txttongtien");
//     var totalD = totalC;
//     cartTotal.value = totalD;
// }
// function increaseQuantity(button) {
//     var input = button.parentNode.querySelector('.txtsl');
//     var currentValue = parseInt(input.value);
//     input.value = currentValue + 1;
//     carttol();
// }

// function decreaseQuantity(button) {
//     var input = button.parentNode.querySelector('.txtsl');
//     var currentValue = parseInt(input.value);
//     if (currentValue > 0) {
//         input.value = currentValue - 1;
//         carttol();
//         if (currentValue - 1 === 0) {
//             var tr = button.parentNode.parentNode;
//             tr.parentNode.removeChild(tr);
//         }
//     }
// }

// function inputchange() {
//     var cartItemm = document.querySelectorAll("#productInfo tr");
//     for (var i = 0; i < cartItemm.length; i++) {
//         var minusButton = cartItemm[i].querySelector(".btn-minus");
//         var plusButton = cartItemm[i].querySelector(".btn-plus");
//         minusButton.removeEventListener("click", decreaseQuantity);
//         plusButton.removeEventListener("click", increaseQuantity);
//         minusButton.addEventListener("click", function() {
//             decreaseQuantity(this);
//         });
//         plusButton.addEventListener("click", function() {
//             increaseQuantity(this);
//         });
//     }
// }
