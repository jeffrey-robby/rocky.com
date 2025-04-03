<?php
require_once 'tcpdf/tcpdf.php';
include 'layouts/control.php';

function genererNumeroFacture() {
    $date = date('Ymd'); 
    $heure = date('His'); 
    $uniqueId = uniqid('FAC-'); 
    return $date . '-' . $heure . '-' . $uniqueId; 
}

$data = json_decode(file_get_contents('php://input'), true);
$clientId = $data['clientId'];
$personnelId = $data['personnelId'];
$produits = $data['products'];

try {
    $pdo = getConnection();
    $numeroFacture = genererNumeroFacture();
    $totalVentes = 0;
    $reductionTotal = 0;

    // Vérifiez si l'ID personnel existe
    $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM personnels WHERE id_personnels = :id_personnels");
    $stmtCheck->execute([':id_personnels' => $personnelId]);
    $exists = $stmtCheck->fetchColumn();
    
    if (!$exists) {
        echo json_encode(['success' => false, 'message' => 'L\'ID du personnel n\'existe pas.']);
        exit;
    }

    // Démarrer une transaction
    $pdo->beginTransaction();

    // Vérifier les quantités en stock
    foreach ($produits as $produit) { 
        $stmtNomProduit = $pdo->prepare("SELECT nom_produits FROM produits WHERE id_produits = :id_produits");
        $stmtNomProduit->execute([':id_produits' => $produit['id']]);
        $nomProduit = $stmtNomProduit->fetchColumn();

        $stmtStock = $pdo->prepare("SELECT quantite_quantite_en_stocks FROM quantite_en_stocks WHERE id_produits = :id_produits");
        $stmtStock->execute([':id_produits' => $produit['id']]);
        $stock = $stmtStock->fetchColumn();

        if ($produit['quantity'] > $stock) {
            echo json_encode(['success' => false, 'message' => 'Quantité insuffisante pour le produit : ' . $nomProduit]);
            exit;
        }
    }

    // Insérer la vente
    $stmt = $pdo->prepare("INSERT INTO ventes (id_personnels, id_clients, total_ventes, reduction_ventes, numero_facture_ventes) VALUES (:id_personnels, :id_clients, :total_ventes, :reduction_ventes, :numero_facture_ventes)");
    $stmt->execute([
        ':id_personnels' => $personnelId,
        ':id_clients' => $clientId,
        ':total_ventes' => 0,
        ':reduction_ventes' => 0,
        ':numero_facture_ventes' => $numeroFacture
    ]);
    
    $idVente = $pdo->lastInsertId();

    foreach ($produits as $produit) {
        $quantite = $produit['quantity'];
        $prixUnitaire = $produit['price'];
        $prixTotal = $quantite * $prixUnitaire; // Calculer le total pour ce produit
        $totalVentes += $prixTotal; // Accumuler le total des ventes

        $stmtProduit = $pdo->prepare("INSERT INTO ventes_produits (id_produits, id_ventes, quantite_ventes_produits, prix_ventes_produits) VALUES (:id_produits, :id_ventes, :quantite_ventes_produits, :prix_ventes_produits)");
        $stmtProduit->execute([
            ':id_produits' => $produit['id'],
            ':id_ventes' => $idVente,
            ':quantite_ventes_produits' => $quantite,
            ':prix_ventes_produits' =>  $prixUnitaire
        ]);

        // Mettre à jour la quantité en stock
        $stmtUpdateStock = $pdo->prepare("UPDATE quantite_en_stocks SET quantite_quantite_en_stocks = quantite_quantite_en_stocks - :quantite WHERE id_produits = :id_produits");
        $stmtUpdateStock->execute([
            ':quantite' => $quantite,
            ':id_produits' => $produit['id']
        ]);
    }

    // Mettre à jour la vente avec le total calculé
    $stmtUpdateVente = $pdo->prepare("UPDATE ventes SET total_ventes = :total_ventes, reduction_ventes = :reduction_ventes WHERE id_ventes = :id_ventes");
    $stmtUpdateVente->execute([
        ':total_ventes' => $totalVentes,
        ':reduction_ventes' => $data['totalDiscount'],
        ':id_ventes' => $idVente
    ]);

    // Mettre à jour le crédit
    $stmtUpdateCredit = $pdo->prepare("INSERT INTO dettes_clients (id_ventes, montant_dettes_clients, date_dettes_clients, note_dettes_clients, statut_dettes_clients, id_clients) VALUES (:id_ventes, :montant_dettes_clients, NOW(), :note_dettes_clients, :statut_dettes_clients, :id_clients)");
    $stmtUpdateCredit->execute([
        ':id_ventes' => $idVente,
        ':montant_dettes_clients' => $totalVentes,
        ':note_dettes_clients' => $data['note'],
        ':statut_dettes_clients' => 1,
        ':id_clients' => $clientId,
    ]);

    // Valider la transaction
    $pdo->commit();

    echo json_encode(['success' => true, 'invoiceNumber' => $numeroFacture]);
} catch (PDOException $e) {
    // Annuler la transaction en cas d'erreur
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>