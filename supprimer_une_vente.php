<?php
include 'layouts/control.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $idVenteAAnnuler = $_REQUEST['id'];

    try {
        $pdo = getConnection(); // Connexion à la base de données
    
        $stmtDetails = $pdo->prepare("SELECT v.id_clients, vp.id_produits, vp.quantite_ventes_produits 
                                       FROM ventes_produits vp 
                                       JOIN ventes v ON vp.id_ventes = v.id_ventes 
                                       WHERE v.id_ventes = :id_ventes");
        $stmtDetails->execute([':id_ventes' => $idVenteAAnnuler]);
        $produitsAAnnuler = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);
        
        $idClient = $produitsAAnnuler[0]['id_clients'] ?? null; 

        if ($idClient) {
            $stmtCheckDebt = $pdo->prepare("SELECT id_clients FROM dettes_clients WHERE id_clients = :id_client");
            $stmtCheckDebt->execute([':id_client' => $idClient]);
            $debtExists = $stmtCheckDebt->fetch(PDO::FETCH_ASSOC);
            
            if ($debtExists) {
                $stmtUpdateDebt = $pdo->prepare("UPDATE dettes_clients 
                                                   SET montant_dettes_clients = 0, 
                                                       avance_dettes_clients = 0 
                                                   WHERE id_clients = :id_client");
                $stmtUpdateDebt->execute([':id_client' => $idClient]);
            }
        }

        foreach ($produitsAAnnuler as $produit) {
            $quantiteRetournee = $produit['quantite_ventes_produits'];
            $idProduit = $produit['id_produits'];
    
            // Mettre à jour la quantité en stock
            $stmtUpdateStock = $pdo->prepare("UPDATE quantite_en_stocks SET quantite_quantite_en_stocks = quantite_quantite_en_stocks + :quantite 
                                               WHERE id_produits = :id_produits");
            $stmtUpdateStock->execute([
                ':quantite' => $quantiteRetournee,
                ':id_produits' => $idProduit
            ]);
        }
    
        $stmtDeleteVente = $pdo->prepare("DELETE FROM ventes WHERE id_ventes = :id_ventes");
        $stmtDeleteVente->execute([':id_ventes' => $idVenteAAnnuler]);

        header("Location: liste_de_vente.php");
        exit();
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>