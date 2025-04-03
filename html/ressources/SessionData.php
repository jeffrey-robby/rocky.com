<?php
// Vérification de l'existence du cookie
if (!isset($_COOKIE['user_cookie'])) {
	header("Location: ./sign-in.php");exit(); # redirection à la page connexion en cas de faux
	
} else {
   
}