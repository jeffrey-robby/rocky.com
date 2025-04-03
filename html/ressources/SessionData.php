<?php
// Vérification de l'existence du cookie
if (!isset($_COOKIE['user_cookie'])) {
	header("Location: ./auth/sign_in.php");exit(); # redirection à la page connexion en cas de faux	
}

$user_id  = base64_decode($_COOKIE['user_cookie']);
// Get user data
$request = mysqli_query($database, "SELECT personnels.* FROM utilisateurs, personnels WHERE utilisateurs.id_utilisateurs = '$user_id' AND personnels.id_personnels = utilisateurs.id_personnels ");
$response = mysqli_fetch_assoc($request);
