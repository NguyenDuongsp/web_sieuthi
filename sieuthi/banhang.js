


const productList = document.getElementsByClassName("home-product-item");
for (let i = 0; i < productList.length; i++) {
    const product = productList[i];
    productList[i].addEventListener("click", function(event) {
        var productItem = event.target.closest(".home-product-item");
        var productImg = productItem.querySelector("img").src;
        var productPrice = productItem.querySelector(".home-product-item__price-old").textContent;
        var productName = productItem.querySelector(".home-product-item__name").textContent;
        addProduct(productImg, productName, productPrice);
    });
}
function addProduct(productImg, productName, productPrice) {
    var add = document.createElement("tr");
    var content = '<tr>' +
        '<td style="display: flex; align-items:center"><img style="width:50px" src="' + productImg + '" alt=""></td>' +
        '<td><p>' + productName + '</p></td>' +
        '<td><p><span>' + productPrice + '</span><sup>đ</sup></p></td>' +
        '<td>' +
        '<button class="btn-minus">-</button>' +
        '<input class="txtsl" type="number" value="1">' +
        '<button class="btn-plus">+</button>' +
        '</td>' +
        '</tr>';
    add.innerHTML = content;
    var table = document.getElementById("productInfo");
    table.appendChild(add);
    inputchange();
    carttol();
}

function carttol() {
    var totalC = 0;
    var cartItem = document.querySelectorAll("#productInfo tr");

    for (var i = 0; i < cartItem.length; i++) {
        var inputValue = parseInt(cartItem[i].querySelector("input").value);
        var proPrice = parseInt(cartItem[i].querySelector("span").innerHTML);
        var totalA = inputValue * proPrice;
        totalC += totalA;
    }

    var cartTotal = document.querySelector(".txttongtien");
    var totalD = totalC;
    cartTotal.value = totalD;
}
function increaseQuantity(button) {
    var input = button.parentNode.querySelector('.txtsl');
    var currentValue = parseInt(input.value);
    input.value = currentValue + 1;
    carttol();
}

function decreaseQuantity(button) {
    var input = button.parentNode.querySelector('.txtsl');
    var currentValue = parseInt(input.value);
    if (currentValue > 0) {
        input.value = currentValue - 1;
        carttol();
        if (currentValue - 1 === 0) {
            var tr = button.parentNode.parentNode;
            tr.parentNode.removeChild(tr);
        }
    }
}

function inputchange() {
    var cartItemm = document.querySelectorAll("#productInfo tr");
    for (var i = 0; i < cartItemm.length; i++) {
        var minusButton = cartItemm[i].querySelector(".btn-minus");
        var plusButton = cartItemm[i].querySelector(".btn-plus");
        minusButton.removeEventListener("click", decreaseQuantity);
        plusButton.removeEventListener("click", increaseQuantity);
        minusButton.addEventListener("click", function() {
            decreaseQuantity(this);
        });
        plusButton.addEventListener("click", function() {
            increaseQuantity(this);
        });
    }
}
