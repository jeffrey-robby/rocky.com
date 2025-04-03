<?php
include 'layouts/control.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $idVenteAAnnuler = $_REQUEST['id'];

    try {
        $pdo = getConnection(); // Connexion à la base de données
    
        $stmtDetails = $pdo->prepare("SELECT ap.id_produits, ap.quantite_achats_produits 
                                       FROM achats_produits ap 
                                       JOIN achats a ON ap.id_achats = a.id_achats 
                                       WHERE a.id_achats = :id_achats");
        $stmtDetails->execute([':id_achats' => $idVenteAAnnuler]);
        $produitsAAnnuler = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);

        foreach ($produitsAAnnuler as $produit) {
            $quantiteRetournee = $produit['quantite_achats_produits'];
            $idProduit = $produit['id_produits'];
    
            // Mettre à jour la quantité en stock
            $stmtUpdateStock = $pdo->prepare("UPDATE quantite_en_stocks SET quantite_quantite_en_stocks = quantite_quantite_en_stocks + :quantite 
                                               WHERE id_produits = :id_produits");
            $stmtUpdateStock->execute([
                ':quantite' => $quantiteRetournee,
                ':id_produits' => $idProduit
            ]);
        }
    
        $stmtDeleteVente = $pdo->prepare("DELETE FROM achats WHERE id_achats = :id_achats");
        $stmtDeleteVente->execute([':id_achats' => $idVenteAAnnuler]);

        header("Location: liste_achats.php");
        exit();
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>