<?php 
// Parametre d'environnement de travail
require '../ressources/Envi.php';
// Protocole de connection à la base de données
require '../ressources/DataBaseConnection.php';

// Fetching Post data
$user_name = mysqli_escape_string($database, $_POST['user_name']);
$password = md5(mysqli_escape_string($database, $_POST['pwd']));

// Query
$query = mysqli_query($database, "
    SELECT * FROM utilisateurs WHERE username = '$user_name' and password = '$password'
");
if (mysqli_num_rows($query) == 1) {
    // response
    $response = mysqli_fetch_assoc($query);
    echo $response['id_utilisateurs'];
    # code...
}else {
    echo "false";
}