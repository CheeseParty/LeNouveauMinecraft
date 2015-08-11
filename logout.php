<?php
// LOGOUT.PHP
// Destruction de la session et redirection
session_start();
session_unset();
session_destroy();
setcookie('AUTH', $_COOKIE['AUTH'], 1);
setcookie('HASH', $_COOKIE['HASH'], 1);
header("Location: index.php");
exit;