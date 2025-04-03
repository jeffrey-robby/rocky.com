<?php
include 'layouts/control.php';
$pdo = getConnection(); 

if (isset($_POST['date_debut']) && isset($_POST['date_fin'])) {
    $dateDebut = $_POST['date_debut'];
    $dateFin = $_POST['date_fin'];

    // Préparer la requête SQL
    $stmt = $pdo->prepare("
        SELECT 
        produits.id_produits, 
        produits.nom_produits,
        produits.unite_produits,
        stocks.nom_stocks,
        stocks.id_stocks,
        historique_transfert.quantite_historique_transfert, 
        historique_transfert.id_stocks,
        historique_transfert.de_stock_historique_transfert 
        FROM 
            historique_transfert 
        JOIN 
            produits ON historique_transfert.id_produits = produits.id_produits
        JOIN 
            stocks ON historique_transfert.id_stocks = stocks.id_stocks
        WHERE date_historique_transfert BETWEEN ? AND ?
    ");

    try {
        $stmt->execute([$dateDebut, $dateFin]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($results);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur de base de données : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Les dates ne sont pas définies.']);
}
?>