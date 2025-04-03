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

        // Calculer le total pour chaque produit
        $totalVentes += $produit['quantity'] * $produit['price'];
    }

    // Insérer la vente dans la base de données
    $stmt = $pdo->prepare("INSERT INTO ventes (id_personnels, id_clients, total_ventes, reduction_ventes, numero_facture_ventes) VALUES (:id_personnels, :id_clients, :total_ventes, :reduction_ventes, :numero_facture_ventes)");
    $stmt->execute([
        ':id_personnels' => $personnelId,
        ':id_clients' => $clientId,
        ':total_ventes' => $totalVentes,
        ':reduction_ventes' => $data['totalDiscount'] ?? 0,
        ':numero_facture_ventes' => $numeroFacture
    ]);

    // Récupérer l'ID de la vente
    $idVente = $pdo->lastInsertId();

    // Traiter chaque produit
    foreach ($produits as $produit) {
        $quantite = $produit['quantity'];
        $prixUnitaire = $produit['price'];

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

    // Calculer l'avance finale
    $avance = $data['avance'] ?? 0;
    $avanceFinale = $totalVentes - $avance;

    // Mettre à jour le crédit dans la base de données
    $stmtAvance = $pdo->prepare("INSERT INTO dettes_clients (id_ventes, montant_dettes_clients, avance_dettes_clients, date_dettes_clients, statut_dettes_clients, id_clients) VALUES (:id_ventes, :montant_dettes_clients, :avance_dettes_clients, NOW(), :statut_dettes_clients, :id_clients)");
    $stmtAvance->execute([
        ':id_ventes' => $idVente,
        ':montant_dettes_clients' => $avanceFinale,
        ':avance_dettes_clients' => $avance,
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