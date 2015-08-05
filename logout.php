<?php
// LOGOUT.PHP
// Destruction de la session et redirection
session_start();
session_unset();
session_destroy();
header("Location:login.php");
exit;