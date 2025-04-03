<?php
include 'layouts/control.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $transfers = $data['transfers'];

    // Initialiser le total
    $prixTotal = 0;

    try {
        $pdo = getConnection();

        // Insérer la vente dans la base de données
        $stmt = $pdo->prepare("INSERT INTO achats (total_achats, reste_achats) VALUES (:total_achats, :reste_achats)");
        
        $stmt->execute([
            'total_achats' => 0, 
            ':reste_achats' => 0,
        ]);
        
        // Récupérer l'ID de la vente
        $idAchat = $pdo->lastInsertId();
        
        foreach ($transfers as $transfer) {
            $productId = $transfer['id'];
            $quantity = $transfer['quantity']; 
            $prix = $transfer['prix'];
           
            // Calculer le prix total pour ce produit
            $prixTotal += $quantity * $prix;

            $stmtProduit = $pdo->prepare("INSERT INTO achats_produits (id_achats, id_produits, quantite_achats_produits, prix_achats_produits) VALUES (:id_achats, :id_produits, :quantite_achats_produits, :prix_achats_produits)");
            $stmtProduit->execute([
                ':id_achats' => $idAchat,
                ':id_produits' => $productId, 
                ':quantite_achats_produits' => $quantity,
                ':prix_achats_produits' => $prix
            ]);
    
            // Mettre à jour la quantité en stock
            $stmtUpdateStock = $pdo->prepare("UPDATE quantite_en_stocks SET quantite_quantite_en_stocks = quantite_quantite_en_stocks + :quantite WHERE id_produits = :id_produits");
            $stmtUpdateStock->execute([
                ':quantite' => $quantity,
                ':id_produits' => $productId
            ]);
        }

        // Mettre à jour l'achat avec le total calculé
        $stmtUpdateVente = $pdo->prepare("UPDATE achats SET total_achats = :total_achats WHERE id_achats = :id_achats");
        $stmtUpdateVente->execute([
            ':total_achats' => $prixTotal,
            ':id_achats' => $idAchat
        ]);
        
        echo json_encode(['success' => true, 'message' => 'Achat validé avec succès !']);
        
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()]);
    }
}
?>