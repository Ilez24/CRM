<?php
require "rb.php";
R::setup('mysql:host=localhost;dbname=madina', 'root', 'mysql');
session_start();
R::freeze(TRUE);

echo '<noscript>
<div class="noscript">Извините Ваш браузер не поддерживает JavaScript.</div>
</noscript>';
