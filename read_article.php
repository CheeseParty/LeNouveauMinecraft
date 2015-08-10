<?php
// READ_ARTICLE.PHP
// Retourne la catégorie, le titre et le contenu d'un message en JSON en fonction d'un id
session_start();

if(!isset($_SESSION['RANK']) OR $_SESSION['RANK'] < 2) {
	
}