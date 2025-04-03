<?php
require_once 'tcpdf/tcpdf.php';
include 'layouts/control.php';  // Inclure le fichier de connexion

function genererNumeroFacture() {
    $date = date('Ymd'); // Format de la date : année mois jour
    $heure = date('His'); // Format de l'heure : heure minute seconde
    $uniqueId = uniqid('FAC-'); // Générer un ID unique pour la facture
    return $date . '-' . $heure . '-' . $uniqueId; // Combiner date, heure et ID unique
}

// Récupérer les données envoyées par le JavaScript
$data = json_decode(file_get_contents('php://input'), true);

$clientId = $data['clientId'];
$personnelId = $data['personnelId'];
$produits = $data['products'];

// Connexion à la base de données
try {
    $pdo = getConnection(); // Utiliser la fonction de connexion

    // Créer le nom de la facture avec la date et l'heure
    $numeroFacture = genererNumeroFacture(); // Générer un numéro de facture

    // Initialiser les totaux
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

     // Vérifier les quantités en stock
    foreach ($produits as $produit) { 
        // Récupérer le nom du produit
        $stmtNomProduit = $pdo->prepare("SELECT nom_produits FROM produits WHERE id_produits = :id_produits");
        $stmtNomProduit->execute([':id_produits' => $produit['id']]);
        $nomProduit = $stmtNomProduit->fetchColumn();

        // Récupérer la quantité en stock
        $stmtStock = $pdo->prepare("SELECT quantite_quantite_en_stocks FROM quantite_en_stocks WHERE id_produits = :id_produits");
        $stmtStock->execute([':id_produits' => $produit['id']]);
        $stock = $stmtStock->fetchColumn();

        // Vérifier si la quantité demandée est supérieure à la quantité en stock
        if ($produit['quantity'] > $stock) {
            echo json_encode(['success' => false, 'message' => 'Quantité insuffisante pour le produit : ' . $nomProduit]);
            exit;
        }
    }
    
    // Insérer la vente dans la base de données
    $stmt = $pdo->prepare("INSERT INTO ventes (id_personnels, id_clients, total_ventes, reduction_ventes, numero_facture_ventes) VALUES (:id_personnels, :id_clients, :total_ventes, :reduction_ventes, :numero_facture_ventes)");
    
    $stmt->execute([
        ':id_personnels' => $personnelId,
        ':id_clients' => $clientId,
        ':total_ventes' => 0, // Initialiser à 0 pour l'instant
        ':reduction_ventes' => 0, // Initialiser à 0 pour l'instant
        ':numero_facture_ventes' => $numeroFacture // Ajouter le numéro de facture
    ]);
    
    // Récupérer l'ID de la vente
    $idVente = $pdo->lastInsertId();
    
    // Traiter chaque produit pour calculer le total et les réductions
    foreach ($produits as $produit) {
        $quantite = $produit['quantity'];
        $prixUnitaire = $produit['price'];  
        $prixTotal = $data['finalTotalGeneral']; 
        $reduction = $data['totalDiscount']; // Récupérer la réduction
       
        $stmtProduit = $pdo->prepare("INSERT INTO ventes_produits (id_produits, id_ventes, quantite_ventes_produits, prix_ventes_produits) VALUES (:id_produits, :id_ventes, :quantite_ventes_produits, :prix_ventes_produits)");
        $stmtProduit->execute([
            ':id_produits' => $produit['id'],
            ':id_ventes' => $idVente, // Utiliser l'ID de vente ici
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
    
    // Mettre à jour la vente avec le total calculé et la réduction
    $stmtUpdateVente = $pdo->prepare("UPDATE ventes SET total_ventes = :total_ventes, reduction_ventes = :reduction_ventes WHERE id_ventes = :id_ventes");
    $stmtUpdateVente->execute([
        ':total_ventes' => $prixTotal,
        ':reduction_ventes' => $reduction,
        ':id_ventes' => $idVente
    ]);

    echo json_encode(['success' => true, 'invoiceNumber' => $numeroFacture]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>