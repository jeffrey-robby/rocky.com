<?php 
if (isset($_POST['AddCat'])) {
    $CatName = mysqli_escape_string($database,$_POST['catName']);
    mysqli_query($database, "INSERT INTO categorie_produits VALUES (NULL, '$CatName', null, null)") or die(mysqli_error($database));
    # code...
}
