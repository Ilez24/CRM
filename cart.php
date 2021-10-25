<?php
require "php/db.php";

if (isset($_SESSION['user'])) {

    if (isset($_POST['cart'])) {

        $cart = $_POST['cart'];

        $_SESSION['cart'] = $cart;

        foreach ($cart as $key => $val) {
            $remains = R::findOne('products', 'id = ?', [$key]);

            if (isset($remains)) {
                $products = R::load('products', $key);
                $products->quantity = $products->quantity - $val;
                R::store($products);

                $sell = R::dispense('sell');
                $sell->count_products = $val;
                $sell->sale_date = date("Y-m-d H:i:s");

                $products->ownSell[] = $sell;
                R::store($products);
            }
        }
    }
}
