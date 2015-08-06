<?php
// LOGOUT.PHP
// Destruction de la session et redirection
session_start();
session_unset();
session_destroy();
setcookie('Pseudo', $pseudo, 1);
setcookie('Password', $password, 1);
header("Location:login.php");
exit;