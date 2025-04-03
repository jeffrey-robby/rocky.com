<?php
include 'layouts/control.php';

try {
    $pdo = getConnection();
} catch (PDOException $e) {
    echo json_encode(['error' => "Erreur de connexion : " . $e->getMessage()]);
    exit;
}

// Vérification si les dates ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dateDebut = $_POST['date_debut'] ?? null;
    $dateFin = $_POST['date_fin'] ?? null;

    if (!$dateDebut || !$dateFin) {
        echo json_encode(['error' => 'Les dates de début et de fin sont requises.']);
        exit;
    }

    // Requête pour le total des ventes
    $queryVentes = "SELECT SUM(total_ventes) AS total_ventes FROM ventes WHERE created_at_ventes BETWEEN :dateDebut AND :dateFin";
    $stmtVentes = $pdo->prepare($queryVentes);
    $stmtVentes->execute(['dateDebut' => $dateDebut, 'dateFin' => $dateFin]);
    $resultVentes = $stmtVentes->fetch(PDO::FETCH_ASSOC);
    $totalVentes = $resultVentes['total_ventes'] ?? 0;

    // Requête pour les factures impayées
    $queryDettes = "SELECT SUM(montant_dettes_clients) AS montant_dettes_clients FROM dettes_clients WHERE created_at_dettes_clients BETWEEN :dateDebut AND :dateFin";
    $stmtDettes = $pdo->prepare($queryDettes);
    $stmtDettes->execute(['dateDebut' => $dateDebut, 'dateFin' => $dateFin]);
    $resultDettes = $stmtDettes->fetch(PDO::FETCH_ASSOC);
    $montantImpaye = $resultDettes['montant_dettes_clients'] ?? 0;

    // Requête pour le total des achats
    $queryAchats = "SELECT SUM(total_achats) AS total_achats FROM achats WHERE created_at_achats BETWEEN :dateDebut AND :dateFin";
    $stmtAchats = $pdo->prepare($queryAchats);
    $stmtAchats->execute(['dateDebut' => $dateDebut, 'dateFin' => $dateFin]);
    $resultAchats = $stmtAchats->fetch(PDO::FETCH_ASSOC);
    $totalAchats = $resultAchats['total_achats'] ?? 0;

    // Calcul du net
    $net = $totalVentes - $montantImpaye - $totalAchats;

    // Retourner les résultats au format JSON
    echo json_encode([
        'totalVentes' => number_format((float)$totalVentes, 2, ',', ' '),
        'montantImpaye' => number_format((float)$montantImpaye, 2, ',', ' '),
        'net' => number_format((float)$net, 2, ',', ' '),
        'depenses' => number_format((float)$totalAchats, 2, ',', ' ')
    ]);
}
?>