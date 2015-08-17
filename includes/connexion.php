<?php
// CONNEXION.PHP
// Objet de connexion PDO

# ATTENTION: Le flag d'encodage est à garder!
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$db = new PDO('mysql:host=localhost;dbname=testnewminecraft','root','',$options);