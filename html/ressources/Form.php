<?php 
if (isset($_POST['AddCat'])) {
    $CatName = mysqli_escape_string($database,$_POST['catName']);
    mysqli_query($database, "INSERT INTO categorie_produits VALUES (NULL, '$CatName', null, null)") or die(mysqli_error($database));
    # code...
}
if (isset($_POST['AddFour'])) {
    $nom = mysqli_escape_string($database,$_POST['nom']);
    $tel = mysqli_escape_string($database,$_POST['tel']);
    $adresse = mysqli_escape_string($database,$_POST['adresse']);
    mysqli_query($database, "INSERT INTO fournisseurs VALUES (null, '$nom', '$tel', '$adresse', null, null) ") or die(mysqli_error($database));
    # code...
}
if (isset($_GET['delF'])) {
    $idF = $_GET['delF'];
    mysqli_query($database, "DELETE FROM fournisseurs WHERE id_fournisseurs = '$idF' ") or die(mysqli_error($database));
    # code...
}
