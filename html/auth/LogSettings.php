<?php 
require_once '../ressources/DataBaseConnection.php';

//Déconnexion
if (isset($_GET['ktsp'])) {
session_start();
session_unset();
session_destroy();
// Suppression du cookie
setcookie('user_cookie');
// Suppression de la valeur du tableau $_COOKIE
unset($_COOKIE['user_cookie']);
}

//Si un cookie existe deja, rediriger vers la page d'acceuille
if (isset($_COOKIE['user_cookie'])) {
header("Location: ../");

}