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
if (isset($_GET['delS'])) {
    $idS = $_GET['delS'];	
    mysqli_query($database, "DELETE FROM stocks WHERE id_stocks = '$idS' ") or die(mysqli_error($database));
    # code...
}
if (isset($_POST['catStock'])) {
    $catStock = mysqli_escape_string($database,$_POST['catStock']);
    mysqli_query($database, "INSERT INTO stocks VALUES (NULL, '$catStock', null, null)") or die(mysqli_error($database));

    # code...
}
if (isset($_POST['AddProd'])) {
    print_r($_POST);exit();
     // Informations sur le fichier téléchargé
     $photo = uniqid() . '_' . $_FILES['ProdFile']['name'];
     $verso = uniqid() . '_' . $_FILES['ProdFile2']['name'];
     $photoTemp = $_FILES['ProdFile']['tmp_name'];
     $versoTemp = $_FILES['ProdFile2']['tmp_name'];
     
     // Déplacer le fichier vers le répertoire d'images
     $cheminPhoto = '../assets/images/produits/' . $photo;
     move_uploaded_file($photoTemp, $cheminPhoto);
     $cheminVerso = '../assets/images/produits/' . $verso;
     move_uploaded_file($versoTemp, $cheminVerso);

     // Enregistrer le chemin de l'image dans la base de données
    $cheminPhotoF = $cheminPhoto;
    $cheminVersoF = $cheminVerso;
    $nom = trim($_POST['nom']);
    $quantite = trim($_POST['Qt']);
    $seuil = trim($_POST['Scr']);
    $prix = trim($_POST['PrixD']);
    $prix1 = trim($_POST['PrixG']);
    $description = trim($_POST['Desc']);
    $fournisseur = trim( $_POST['Four']);
    $categorie = trim($_POST['Cat']);
    $stock = trim($_POST['stock']);
    $unite = trim($_POST['unit']);
    # code...
}
