let cart = {};
let amount = {};
$('.add_cart').on('click', function() {
    let th = $(this);
    let sum = 0;
    let out_price = 0;
    let id = th.attr('data-id');
    let sell_price = parseInt(th.attr('data-price'));
    let quantity = parseInt(th.prev().val());
    if (quantity === 0) {
        return 0;
    }
    if (cart[id]) {
        cart[id] = cart[id] + quantity;
    } else {
        cart[id] = quantity;
    }

    amount[id] = cart[id] * sell_price;

    if (Object.keys(cart).length > 0) {
        $('.btn_buy').removeAttr('disabled');
    } else {
        $('.btn_buy').prop('disabled', 'disabled');
    }

    for (let key in cart) {
        sum += cart[key];
    }

    for (let vak in amount) {
        out_price += amount[vak];
    }

    amount[id] = cart[id] * sell_price;

    $('.count_coupon span').text(sum);
    $('.price span').text(out_price);

    console.log(amount); //объект в котором хранится сумма 
    console.log(sum); // считает кол-во товара добавленного в корзину
    console.log(out_price); // считает сумму всего товара. кол-во товара * sell_price, после суммирует объект
    console.log(cart); // объект в котором хранится корзина, где id = кол-ву добавленного товара

});


$('.btn_buy').on('click', function() {
    $.post("cart.php", { cart: cart });
    window.location.reload();
});


$('.add_cart').on('click', function() {
    $(this).addClass('buy');
    setTimeout(function() { $('.add_cart').removeClass('buy'); }, 500);
});