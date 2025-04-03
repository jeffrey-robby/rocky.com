<?php
include 'layouts/control.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_REQUEST['id'];

    $pdo = getConnection();

    $query = "DELETE FROM categorie_produits WHERE id_categorie_produits = :id";
    $stmt = $pdo->prepare($query);

    try {
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: categorie_de_produit.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la suppression des données : " . $e->getMessage());
    }
}
?>