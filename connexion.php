<?php
// CONNEXION.PHP
// Objet de connexion PDO

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO('mysql:host=localhost;dbname=testnewminecraft','root','',$options);