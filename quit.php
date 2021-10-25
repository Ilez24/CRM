<?php
require 'php/db.php';
unset($_SESSION['user']);
header("Location: index.php");
