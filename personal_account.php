<?php
require "php/db.php";
if (isset($_POST['verify'])) {

    $login = trim($_POST['login']);
    $user = R::findOne('user', 'login = ?', [$login]);

    $answer = $_SESSION['num_3'] + $_SESSION['num_4'];

    $errors = [];
    if (trim($_POST['captcha2'] == $answer)) {
    } else {
        $errors[] = '<p class="auth warning">Введите Капчу</p>';
    }

    if (empty($errors)) {
        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['user'] = $user;
        }
    } else {
    }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>NEING кабинет администратора</title>
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
                <?php
                if (isset($_SESSION['user'])) {
                    print_r($_SESSION['user']->login);
                ?>
                    <span class="quit"><a href="quit.php">Выйти</a></span>
                <?php
                } else {
                ?>
                    <span class="quit"><a href="sign.php">Зарегистрироваться</a></span>
                <?php
                }
                ?>
            </div>
        </div>
    </header>

    <main class="container opacity">

        <?php
        if (isset($_SESSION['user'])) :
        ?>

            <section class="container">
                <div class="personal_frame">
                    <div class="user_info">
                        <img src="img/user.png" alt="user logo" height="130">
                        <div>
                            <?php
                            $us_msg = R::findOne('user', 'login = ?', [$_SESSION['user']->login]);
                            ?>
                            <p class="user_login"><?= $_SESSION['user']->login ?></p>
                        </div>
                    </div>

                </div>
            </section>

        <?php else : ?>

            <h2 class="create_acc">Вход в кабинет администратора</h2>
            <?php
            if (!empty($errors)) {
                echo array_shift($errors);
            }
            ?>
            <form class="form" name="to_log_in" action="personal_account.php" method="POST" autocomplete="off">
                <input class="login" type="text" name="login" placeholder="Логин" value="<?= $_SESSION['user']->login ?>">
                <input class="password" type="password" name="password" placeholder="Пароль">

                <?php

                $num_3 = mt_rand(1, 10);
                $num_4 = mt_rand(1, 10);

                $_SESSION['num_3'] = $num_3;
                $_SESSION['num_4'] = $num_4;

                echo $num_3 . ' + ' . $num_4 . ' = ';

                ?>

                <input class="captcha" type="text" name="captcha2" placeholder="Ответ">
                <button class="btn" type="submit" name="verify">Войти в кабинет администратора</button>
            </form>

        <?php endif; ?>

        <?php
        if ($_SESSION['user']->login == 'madina_ilez_adamo_00_sunzha') :
        ?>

            <section class="only_add_product">
                <h2>Использовать только для добавления НОВОГО товара</h2>
                <form name="published" class="form_add_product" action="personal_account.php" enctype="multipart/form-data" method="POST" autocomplete="off">

                    <?php

                    if (isset($_POST['send'])) {

                        $errors = [];

                        $product_name = $_POST['product_name'];

                        if ($product_name == '') {
                            $errors[] = 'Введите название товара';
                        }

                        if (empty($errors)) {

                            $products = R::dispense('products');

                            $products->product_name = $_POST['product_name'];
                            $products->purchase_price = $_POST['purchase_price'];
                            $products->sell_price = $_POST['sell_price'];
                            $products->quantity = $_POST['quantity'];
                            $products->article = $_POST['article'];
                            $products->img = $_POST['img'];

                            $crypt_name =   bin2hex(random_bytes(20));
                            move_uploaded_file($_FILES['img']['tmp_name'], 'img/' . $crypt_name . $_FILES['img']['name']);
                            $products->img = $crypt_name . $_FILES['img']['name'];

                            R::store($products);
                        } else {
                            echo $errors[0];
                        }
                    }
                    ?>

                    <input required type="file" class="file" name="img">
                    <input required type="text" class="inp" name="product_name" placeholder="Название товара">
                    <div class="remains_point">
                        <span>при указании остатка использовать . (ТОЧКУ)</span>
                        <input required type="text" class="inp" name="purchase_price" placeholder="Закупочная цена">
                        <input required type="text" class="inp" name="sell_price" placeholder="Цена продажи">
                    </div>
                    <input required type="text" class="inp" name="quantity" placeholder="Сколько товара поступило">
                    <input required type="text" class="inp" name="article" placeholder="Артикул">

                    <button class="btn" type="submit" name="send">Добавить Товар</button>
                </form>

                </div>

            </section>

            <section class="pick_up_money">
                <h2>Использовать для учета денег</h2>

                <form name="published" class="form_add_product" action="personal_account.php" enctype="multipart/form-data" method="POST" autocomplete="off">

                    <?php

                    if (isset($_POST['take'])) {
                        $errors = [];

                        $amount_money = $_POST['amount_money'];

                        if ($amount_money == '') {
                            $errors[] = 'Введите сумму которую хотите снять';
                        }

                        if (empty($errors)) {
                            $money = R::dispense('money');

                            $money->date_take =  date("Y-m-d H:i:s");
                            $money->amount_money = $_POST['amount_money'];
                            $money->people_name = $_POST['people_name'];

                            R::store($money);
                        } else {
                            echo $errors[0];
                        }
                    }

                    ?>

                    <select name="people_name">
                        <option value="Madina">Мадина</option>
                        <option value="Ilez">Илез</option>
                    </select>
                    <input required type="number" class="inp" name="amount_money" placeholder="Сумма снятия">
                    <button class="btn" type="submit" name="take">Забрать</button>
                </form>
            </section>

        <?php endif; ?>

    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>