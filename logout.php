<?php
// LOGOUT.PHP
// Destruction de la session et redirection
session_start();
session_unset();
session_destroy();
setcookie('AUTH', null, -1);
setcookie('HASH', null, -1);
header("Location: index.php");
exit;