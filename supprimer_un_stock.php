<?php
include 'layouts/control.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_REQUEST['id'];

    $pdo = getConnection();

    $query = "DELETE FROM stocks WHERE id_stocks = :id";
    $stmt = $pdo->prepare($query);

    try {
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: liste_des_stocks.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la suppression des données : " . $e->getMessage());
    }
}
?>