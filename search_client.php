<?php
session_start(); // Démarrer la session
// Connexion à la base de données
$host = 'localhost'; // Remplace par ton host
$dbname = 'rushcompta'; // Remplace par le nom de ta base de données
$username = 'root'; // Remplace par ton nom d'utilisateur
$password = ''; // Remplace par ton mot de passe


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}

if (isset($_POST['search'])) {
    $search = '%' . $_POST['search'] . '%';
    $stmt = $pdo->prepare("SELECT nom_clients, prenom_clients, type_clients FROM clients WHERE nom_clients LIKE ? OR prenom_clients LIKE ?");
    $stmt->execute([$search, $search]);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['type_client'] = htmlspecialchars($row['type_clients']);
           // Stocker le type de client dans une variable
        }
    } else {
        echo "Aucun résultat trouvé.";
    }
}
?>