<?php
include 'layouts/control.php'; 
// Établir la connexion à la base de données
$db = getConnection();

// Vérifier si une requête de recherche a été envoyée
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $db->prepare("SELECT * FROM clients WHERE prenom_clients LIKE :query OR nom_clients LIKE :query");
    $stmt->execute(['query' => "%$query%"]);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des clients ont été trouvés
    if (!empty($clients)) {
        // Stocker le type de client pour le premier client trouvé dans la session
        $_SESSION['type_client'] = htmlspecialchars($clients[0]['type_client'] ?? 'Type de client inconnu'); // Assurez-vous que la colonne existe

        // Retourner les résultats en JSON
        header('Content-Type: application/json');
        echo json_encode($clients);
    } else {
        // Si aucun client n'est trouvé, retourner un tableau vide
        echo json_encode([]);
    }
} else {
    // Si aucune requête n'est fournie, retourner un tableau vide
    echo json_encode([]);
}
?>