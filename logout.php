<?php
session_start(); // Démarre la session

// Si tu veux détruire la session complètement
session_destroy();

// Supprimer le cookie "Se souvenir de moi" si nécessaire
if (isset($_COOKIE['utilisateur'])) {
    setcookie('utilisateur', '', time() - 3600, '/'); // Supprime le cookie
}

// Redirige l'utilisateur vers la page de connexion ou d'accueil
header('Location: login.php'); // Modifier en fonction de ta page de connexion
exit();
?>