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
    $cheminPhotoF = 'assets/images/produits/' . $photo;
    $cheminVersoF = 'assets/images/produits/' . $verso;
    $nom = trim($_POST['nom']);
    $quantite = trim($_POST['Qt']);
    $seuil = trim($_POST['Scr']);
    $prix = trim($_POST['PrixD']);
    $prix1 = trim($_POST['PrixG']);
    $description = trim($_POST['Desc']);
    $fournisseur = trim( $_POST['Four']);
    $categorie = trim($_POST['Cat']);
    $stock = trim($_POST['Stock']);
    $unite = trim($_POST['unit']);

    mysqli_query($database, "INSERT INTO produits VALUES (NULL, '$fournisseur', '$categorie','$nom', '$prix', '$prix1', '$cheminPhotoF', '$unite', '$cheminVersoF', '$description', null, null)") or die(mysqli_error($database));
    $idProd = mysqli_insert_id($database);
    mysqli_query($database, "INSERT INTO quantite_en_stocks VALUES (NULL, '$stock', '$idProd', '$quantite', '$seuil', null, null)") or die(mysqli_error($database));
    # code...
}
if (isset($_POST['addPers'])) {
    // Informations sur le fichier téléchargé
   $photo = uniqid() . '_' . $_FILES['img']['name'];
   $verso = uniqid() . '_' . $_FILES['cnirecto']['name'];
   $recto = uniqid() . '_' . $_FILES['cniverso']['name'];
   $photoTemp = $_FILES['img']['tmp_name'];
   $versoTemp = $_FILES['cnirecto']['tmp_name'];
   $rectoTemp = $_FILES['cniverso']['tmp_name'];

   // Déplacer le fichier vers le répertoire d'images
   $cheminPhoto = '../assets/images/personnels/photos/' . $photo;
   move_uploaded_file($photoTemp, $cheminPhoto);
   $cheminVerso = '../assets/images/personnels/cni_vesro/' . $verso;
   move_uploaded_file($versoTemp, $cheminVerso);
   $cheminRecto = '../assets/images/personnels/cni_recto/' . $recto;
   move_uploaded_file($rectoTemp, $cheminRecto);

   $nom = trim($_POST['nom']);
   $prenom = trim($_POST['prenom']);
   $dateN = trim($_POST['dateN']);
   $email = trim($_POST['mail']);
   $telN = trim( $_POST['telN']);
   $poste = trim($_POST['Poste']);
   $sexe = trim($_POST['Sexe']);
   $cni = trim($_POST['cni']);
   $adresse = trim($_POST['adresse']);

   mysqli_query($database, "INSERT INTO personnels VALUES (
   NULL, 
   '$nom', 
   '$prenom', 
   '$dateN', 
   '$poste', 
   '$poste', 
   '$telN', 
   '$email', 
   '$sexe', 
   '$adresse', 
   'assets/images/personnels/photos/$photo', 
   '$cni',
   'assets/images/personnels/cni_vesro/$verso', 
   '/assets/images/personnels/cni_recto/$recto', 
   NOW(), 
   NOW())") 
   or die(mysqli_error($database));	
    # code...
}
if (isset($_GET['delP'])) {
    $idS = $_GET['delP'];	
    mysqli_query($database, "DELETE FROM personnels WHERE id_personnels = '$idS' ") or die(mysqli_error($database));
    # code...
}
if (isset($_GET['ModP'])) {
    echo $idpersonnel = $_GET['ModP'];
    $request = mysqli_query($database, "SELECT * FROM personnels WHERE id_personnels = '$idpersonnel' ") or die(mysqli_error($database));
    $row = mysqli_fetch_array($request);
    $nom = $row['nom_personnels'];
    $prenom = $row['prenom_personnels'];
    $dateN = $row['date_de_naissance_personnels'];
    $poste_personnels = $row['poste_personnels'];
    $tel_personnels = $row['tel_personnels'];
    $sexe_personnels = $row['sexe_personnels'];
    $residence_personnels = $row['residence_personnels'];
    $image_personnels = $row['image_personnels'];
    $numero_cni_personnels = $row['numero_cni_personnels'];
    # code...
}