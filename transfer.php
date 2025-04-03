<?php
include 'layouts/control.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $toStock = $data['to_stock'];
    $transfers = $data['transfers'];
    $fromStock = $data['fromStock'];
   

    // Connexion à la base de données
    try {
        $pdo = getConnection();
        // Initialiser la variable pour vérifier les stocks
        $hasSameStock = false;
        
        // Vérifiez si au moins un produit a le même ID de stock que fromStock
        foreach ($transfers as $transfer) {
            $productId = $transfer['id'];
        
            // Vérifier la quantité disponible dans l'emplacement d'origine
            $stmtCheck = $pdo->prepare("SELECT id_stocks FROM quantite_en_stocks WHERE id_produits = ?");
            $stmtCheck->execute([$productId]);
            $productStockInfo = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        
            // Vérifiez si fromStock est le même que l'ID du stock du produit
            if ($productStockInfo['id_stocks'] != $fromStock) {
                $hasSameStock = true;
                break; 
            }
        }
        
        // Si au moins un produit a le même ID de stock, renvoyer un message d'erreur
        if ($hasSameStock === true) {
            echo json_encode(['success' => false, 'message' => 'Un ou plusieurs produits proviennent du même stock que le stock de transfert.']);
            exit();
        }

        foreach ($transfers as $transfer) {
            $productId = $transfer['id'];
            $quantity = $transfer['quantity'];

            // Vérifier la quantité disponible dans l'emplacement d'origine
            $stmtCheck = $pdo->prepare("SELECT quantite_quantite_en_stocks FROM quantite_en_stocks WHERE id_produits = ? AND id_stocks = ?");
            $stmtCheck->execute([$productId, $fromStock]);
            $currentStock = $stmtCheck->fetchColumn();

            
            if ($currentStock >= $quantity) {
                // Mettre à jour la quantité dans l'emplacement d'origine
                $stmtUpdateFrom = $pdo->prepare("UPDATE quantite_en_stocks SET quantite_quantite_en_stocks = quantite_quantite_en_stocks - ? WHERE id_produits = ? AND id_stocks = ?");
                $stmtUpdateFrom->execute([$quantity, $productId, $fromStock]);

                // Mettre à jour la quantité dans l'emplacement de destination
                $stmtUpdateTo = $pdo->prepare("UPDATE quantite_en_stocks SET quantite_quantite_en_stocks = quantite_quantite_en_stocks + ? WHERE id_produits = ? AND id_stocks = ?");
                $stmtUpdateTo->execute([$quantity, $productId, $toStock]);

                // Enregistrer l'historique du transfert
                $stmtHistory = $pdo->prepare("INSERT INTO historique_transfert (id_produits, quantite_historique_transfert, id_stocks, de_stock_historique_transfert) VALUES (?, ?, ?, ?)");
                $stmtHistory->execute([$productId, $quantity, $toStock, $fromStock]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Quantité insuffisante dans l\'emplacement d\'origine.']);
                exit();
            }
        }
        
        echo json_encode(['success' => true, 'message' => 'Transfert réussi !']);
        
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()]);
    }
}
?>