<?php
require "php/db.php";

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>NEING Главная</title>
</head>

<body>

    <header class="container opacity">
        <div class="header">
            <img src="img/logo.png" alt="logo" width="200px">
            <nav class="nav">
                <ul class="menu">
                    <li><a href="index.php">Главная</a></li>
                </ul>
            </nav>
            <div class="auth">
                <a href="personal_account.php">
                    <?php
                    if (isset($_SESSION['user'])) {
                        print_r($_SESSION['user']->login);
                    ?>
                </a>
                <span class="quit"><a href="quit.php">Выйти</a></span>
            <?php
                    } else {
            ?>
                <p><a href="sign.php">Зарегистрироваться</a></p>
                <p><a href="personal_account.php">Войти</a></p>
            <?php } ?>
            </div>
        </div>
    </header>

    <main class="container opacity">

        <section class="container">

            <?php
            if (isset($_SESSION['user'])) {
            ?>

                <div class="block_coupon">
                    <div class="specifications">

                        <table>
                            <tr>
                                <th>id</th>
                                <th>img</th>
                                <th>Название продукта</th>
                                <th>Цена продажи</th>
                                <th>Остаток</th>
                                <th>Артикул</th>
                                <th>Добавить</th>
                            </tr>
                            <?php
                            $products = R::findAll('products');

                            foreach ($products as $product) :
                            ?>
                                <tr>
                                    <th><?= $product->id ?></th>
                                    <th><img src="img/<?= $product->img ?>" height="100" width="100"></th>
                                    <th><?= $product->product_name ?></th>
                                    <th><?= $product->sell_price ?></th>
                                    <th><?= $product->quantity ?></th>
                                    <th><?= $product->article ?></th>
                                    <th>
                                        <div class="d_column">
                                            <input type="number" class="number_inp" value="0">
                                            <button class="add_cart" data-id="<?= $product->id ?>" data-price="<?= $product->sell_price ?>">В корзину</button>
                                        </div>
                                    </th>
                                </tr>

                            <?php
                            endforeach;
                            ?>

                            <div class="cart">
                                <div class="icon_cart"></div>
                                <div class="count_price">
                                    <p class="count_coupon">Количество: <span>0</span></p>
                                    <p class="price">Цена: <span>0</span></p>
                                </div>
                                <button class="btn_buy" disabled>Купить</button>
                            </div>

                        </table>

                    </div>
                </div>

            <?php
            }
            ?>

        </section>



    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>