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
    <title>NEING Регистрация аккаунта</title>
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
                <p><a href="personal_account.php">Войти</a></p>
            </div>
        </div>
    </header>

    <main class="container opacity">

        <section class="container">

            <?php
            if (!isset($_SESSION['user'])) :
            ?>

                <h2 class="create_acc">Регистрация аккаунта</h2>
                <?php
                /*

                закомментировано для того что бы не было лишних регистраций на сайте, регистрацию мог производить только администратор

                if (isset($_POST['send'])) {

                    $login = $_POST['login'];

                    $answer = $_SESSION['num_1'] + $_SESSION['num_2'];

                    $user = R::findOne('user', 'login = ?', [$login]);

                    $errors = [];
                    if (trim($login == '')) {
                        $errors[] = '<p class="auth warning">Введите Логин</p>';
                    }
                    if (trim($user)) {
                        $errors[] = '<p class="auth warning">Данный логин занят</p>';
                    }
                    if (trim($_POST['password'] == '')) {
                        $errors[] = '<p class="auth warning">Введите Пароль</p>';
                    }
                    if (trim($_POST['captcha'] == $answer)) {
                    } else {
                        $errors[] = '<p class="auth warning">Введите Капчу</p>';
                    }

                    if (empty($errors)) {
                        $user_add = R::dispense('user');
                        $user_add->login = $_POST['login'];
                        $user_add->password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                        R::store($user_add);
                        header("Location: personal_account.php");
                    } else {
                        echo array_shift($errors);
                    }
                }
*/
                ?>
                <form class="form" name="registration" action="sign.php" method="POST" autocomplete="off">
                    <input class="login" required type="text" name="login" placeholder="login" value="<?= $_POST['login'] ?>">
                    <input class="password" required type="password" name="password" placeholder="password">
                    <?php

                    $num_1 = mt_rand(1, 10);
                    $num_2 = mt_rand(1, 10);

                    $_SESSION['num_1'] = $num_1;
                    $_SESSION['num_2'] = $num_2;

                    echo $num_1 . ' + ' . $num_2 . ' = ';

                    ?>
                    <input class="captcha" type="text" name="captcha" placeholder="Ответ">
                    <button class="btn" type="submit" name="send">Зарегистрироваться</button>
                </form>

            <?php
            else :
            ?>
                <h1 class="at_the_moment">Вы уже зарегистрированы</h1>
            <?php
            endif;
            ?>
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>