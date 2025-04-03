<?php
session_start();
require 'layouts/db_connection.php'; // Inclut le fichier de connexion

$pdo = getConnection(); // Récupère la connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_utilisateurs'])) {
    // Récupérer l'utilisateur de la base de données
    $stmt = $pdo->prepare("SELECT session_id FROM utilisateurs WHERE id_utilisateurs = ?");
    $stmt->execute([$_SESSION['id_utilisateurs']]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'ID de session correspond
    if ($utilisateur && $utilisateur['session_id'] !== $_SESSION['session_id']) {
        // La session a été invalidée, déconnecte l'utilisateur
        session_destroy();
        header('Location: login.php'); // Redirige vers la page de connexion
        exit();
    }
} else {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit();
}


// Déconnexion automatique après 10 minutes d'inactivité
if (time() - $_SESSION['derniere_action'] > 6000) {
    session_destroy();
    header('Location: login.php');
    exit();
}

$_SESSION['derniere_action'] = time(); // Met à jour le timestamp de la dernière action

// Récupère le grade
$personnels = $_SESSION['id_personnels'];
$code = $_SESSION['code_personnels'];

// Affiche le contenu en fonction du grade
if ($code === 'admin') {
    echo "
    ";
} 

