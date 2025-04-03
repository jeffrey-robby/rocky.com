<?php 
include 'layouts/control.php'; 

$id = $_REQUEST['id'];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Informations sur le fichier téléchargé
    $photo = uniqid() . '_' . $_FILES['imageP']['name'];
    $verso = uniqid() . '_' . $_FILES['imageD']['name'];
    $photoTemp = $_FILES['imageP']['tmp_name'];
    $versoTemp = $_FILES['imageD']['tmp_name'];
    
    // Déplacer le fichier vers le répertoire d'images
    $cheminPhoto = 'assets/images/produits/' . $photo;
    move_uploaded_file($photoTemp, $cheminPhoto);
    $cheminVerso = 'assets/images/produits/' . $verso;
    move_uploaded_file($versoTemp, $cheminVerso);
    
    // Enregistrer le chemin de l'image dans la base de données
    $cheminPhotoF = $cheminPhoto;
    $cheminVersoF = $cheminVerso;
    $nom = trim($_POST['nom']);
    $quantite = trim($_POST['quantite']);
    $seuil = trim($_POST['seuil']);
    $prix = trim($_POST['prix']);
    $description = trim($_POST['description']);
    $fournisseur = trim( $_POST['fournisseur']);
    $categorie = trim($_POST['categorie']);
    $stock = trim($_POST['stock']);
 
    // Obtenir la connexion à la base de données
    $pdo = getConnection();

    // Initialiser la requête de mise à jour
    $query = "UPDATE produits SET ";
    $params = [];
    
    // Vérification et ajout des mises à jour pour les champs de produits
    if ($nom !== '') {
        $query .= "nom_produits = :nom, ";
        $params[':nom'] = $nom;
    }
    if ($prix !== '') {
        $query .= "prix_produits = :prix, ";
        $params[':prix'] = $prix;
    }
    if ($_FILES['imageP']['name'] !== '') {
        $query .= "photo_produits1 = :cheminPhotoF, ";
        $params[':cheminPhotoF'] = $cheminPhotoF;
    }
    if ($_FILES['imageD']['name'] !== '') {
        $query .= "photo_produits2 = :cheminVersoF, ";
        $params[':cheminVersoF'] = $cheminVersoF;
    }
    if ($description !== '') {
        $query .= "description_produits = :description, ";
        $params[':description'] = $description;
    }
    
    // Mettre à jour l'horodatage
    $query .= "updated_at_produits = NOW() ";
    
    // Ajout de la clause WHERE
    $query .= "WHERE id_produits = :id";
    $params[':id'] = $id;
    
    // Préparer la requête
    $stmt = $pdo->prepare($query);

    try {
        // Lier les paramètres
        foreach ($params as $key => &$value) {
            $stmt->bindParam($key, $value);
        }
        // Exécuter la mise à jour
        $stmt->execute();

        // Mise à jour des autres tables
        if ($quantite !== '') {
            $queryQuantite = "UPDATE quantite_en_stocks SET quantite_quantite_en_stocks = :quantite WHERE id_produits = :id_produits";
            $stmtQuantite = $pdo->prepare($queryQuantite);
            $stmtQuantite->execute([':quantite' => $quantite, ':id_produits' => $id]);
        }
        if ($seuil !== '') {
            $querySeuil = "UPDATE quantite_en_stocks SET seuil_quantite_en_stocks = :seuil WHERE id_produits = :id_produits";
            $stmtSeuil = $pdo->prepare($querySeuil);
            $stmtSeuil->execute([':seuil' => $seuil, ':id_produits' => $id]);
        }
        if (is_numeric($fournisseur) && $fournisseur > 0) {
            $queryFournisseur = "UPDATE produits SET id_fournisseurs = :id_fournisseurs  WHERE id_produits = :id_produits";
            $stmtFournisseur = $pdo->prepare($queryFournisseur);
            $stmtFournisseur->execute([':id_fournisseurs' => $fournisseur, ':id_produits' => $id]);
        }
        if (is_numeric($categorie) && $categorie > 0) {
            $queryCategorie = "UPDATE produits SET 	id_categorie_produits = :id_categorie_produits WHERE id_produits = :id_produits";
            $stmtCategorie = $pdo->prepare($queryCategorie);
            $stmtCategorie->execute([':id_categorie_produits' => $categorie, ':id_produits' => $id]);
        }
        if (is_numeric($stock) && $stock > 0) {
            $queryStock = "UPDATE quantite_en_stocks SET id_stocks = :id_stocks WHERE id_produits = :id_produits";
            $stmtStock = $pdo->prepare($queryStock);
            $stmtStock->execute([':id_stocks' => $stock, ':id_produits' => $id]);
        }
            
        $_SESSION['successMessage'] = "
          document.addEventListener(\"DOMContentLoaded\", function() {
           // Afficher le popup lors du chargement de la page
           new window.Swal({
               icon: 'success',
               title: 'Les modification ont été enregistrées avec succès !',
               text: 'Vous pouvez le consulter dans la liste des produits.',
               padding: '2em',
           });
       });";
       header("Location: liste_des_produits.php");
       exit();
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour des données : " . $e->getMessage());
    }
 
}  
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="liste_des_produits";?>

    <body
        x-data="main"
        class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased vertical full ltr"
        :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '']"
    >
        <!-- sidebar menu overlay -->
        <div x-cloak class="fixed inset-0 z-50 bg-[black]/60 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>

        <!-- screen loader -->
        <?php include 'layouts/loader.php'; ?>

        <!-- scroll to top button -->
        <?php include 'layouts/scroll_top.php'; ?>

        <div class="main-container min-h-screen text-black dark:text-white-dark navbar-floating">
            <!-- start sidebar section -->
            <?php include 'layouts/sidebare.php'; ?>
            <!-- end sidebar section -->

            <div class="main-content flex min-h-screen flex-col">
                <!-- start header section -->
                <?php include 'layouts/header.php'; ?>
                <!-- end header section -->

                <div class="animate__animated p-6 animate__fadeInDown">
                    <!-- start main content section -->
                    <ul class="flex space-x-2 rtl:space-x-reverse">
                        <li>
                            <a href="javascript:;" class="text-primary hover:underline">Produits</a>
                        </li>
                        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                            <span>Modification d'un produit</span>
                        </li>
                        <?php if (isset($_SESSION['successMessage'])) { echo '<script>' . $_SESSION['successMessage'] . '</script>'; unset($_SESSION['successMessage']); } ?>
                    </ul>
                    <div class ="pt-5">
                        <?php
                        function getProduitsById($id) {
                          $pdo = getConnection();
                          $query = "SELECT * FROM produits WHERE id_produits = :id";
                          $stmt = $pdo->prepare($query);
                          
                          try {
                              // Lier la variable à la requête
                              $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                              $stmt->execute();
                              return $stmt->fetch(PDO::FETCH_ASSOC); // Récupérer une seule ligne
                          } catch (PDOException $e) {
                              die("Erreur lors de la récupération des données : " . $e->getMessage());
                          }
                      }
                       $id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Récupérer l'ID depuis l'URL, par exemple
                      
                       // Utilisation de la fonction pour récupérer le personnel
                       $produit = getProduitsById($id);
                      ?>
                      <div class="mb-5">
                          <h5 class="font-semibold text-lg dark:text-white-light">Vous modifier le produit qui a pour nom <b><?php echo htmlspecialchars($produit['nom_produits']);?></b></h5>
                      </div>
                    </div>
                    <div  x-data="form">
                        <form  @submit.prevent="submitForm1()" x-ref="myForm" action="" method="POST" enctype="multipart/form-data">
                            <div class="gap-5 lg:flex">
                                <div class="grow space-y-5">
                                    <div class="panel">
                                        <div class="space-y-8">
                                            <div :class="[isSubmitForm1 ? (form1.nom ? 'has-success' : 'has-error') : '']">
                                                <label for="nom">Nom</label>
                                                <input type="text" placeholder="Entrer le nom du produit" class="form-input" x-model="form1.nom" name="nom"  />
                                                <template x-if="isSubmitForm1 && !form1.nom">
                                                    <p class="text-danger mt-1">Le champ nom ne peut pas être vide.</p>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel p-0">
                                        <div class="border-b p-4 text-base font-semibold dark:border-[#191e3a] dark:text-white">Image</div>
                                        <div class="space-y-8 p-4">
                                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                                                <div :class="[isSubmitForm1 ? (form1.imageP ? 'has-success' : 'has-error') : '']">
                                                    <input name="imageP" type="file" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" x-model="form1.imageP" accept=".jpg"/>
                                                    <template x-if="isSubmitForm1 && !form1.imageP">
                                                        <p class="text-danger mt-1">Le champ image 1 ne peut pas être vide.</p>
                                                    </template>
                                                </div>
                                                <div :class="[isSubmitForm1 ? (form1.imageD ? 'has-success' : 'has-error') : '']">
                                                    <input name="imageD" type="file" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" x-model="form1.imageD" accept=".jpg"/>
                                                    <template x-if="isSubmitForm1 && !form1.imageD">
                                                        <p class="text-danger mt-1">Le champ image 2 ne peut pas être vide.</p>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel p-0">
                                        <div class="space-y-8 p-4">
                                        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-2">
                                                <div :class="[isSubmitForm1 ? (form1.prix ? 'has-success' : 'has-error') : '']">
                                                    <label>Prix de détail</label>
                                                    <input name="prix" type="number" placeholder="Entrer le prix de détail du produit" class="form-input" x-model="form1.prix"  />
                                                    <template x-if="isSubmitForm1 && !form1.prix">
                                                       <p class="text-danger mt-1">Le champ prix de détail ne peut pas être vide.</p>
                                                    </template>
                                                </div>
                                                <div :class="[isSubmitForm1 ? (form1.prix1 ? 'has-success' : 'has-error') : '']">
                                                    <label>Prix de gros</label>
                                                    <input name="prix1" type="number" placeholder="Entrer le prix de gros du produit" class="form-input" x-model="form1.prix1"  />
                                                    <template x-if="isSubmitForm1 && !form1.prix1">
                                                       <p class="text-danger mt-1">Le champ prix de gros ne peut pas être vide.</p>
                                                    </template>
                                                </div>
                                            </div>
                                            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-2">
                                                <div :class="[isSubmitForm1 ? (form1.quantite ? 'has-success' : 'has-error') : '']">
                                                    <label>Quantité</label>
                                                    <input name="quantite" type="number" placeholder="Entrer la quantité du produit" class="form-input" x-model="form1.quantite" />
                                                    <template x-if="isSubmitForm1 && !form1.quantite">
                                                        <p class="text-danger mt-1">Le champ quantité ne peut pas être vide.</p>
                                                    </template>
                                                </div>
                                                <div :class="[isSubmitForm1 ? (form1.seuil ? 'has-success' : 'has-error') : '']">
                                                    <label>Quantité de seuil</label>
                                                    <input name="seuil" type="number" placeholder="Entrer la quantité de seuil du produit" class="form-input" x-model="form1.seuil"  />
                                                    <template x-if="isSubmitForm1 && !form1.seuil">
                                                       <p class="text-danger mt-1">Le champ prix quantité seuil ne peut pas être vide.</p>
                                                    </template>
                                                </div>
                                            </div>
                                            <div :class="[isSubmitForm1 ? (form1.description ? 'has-success' : 'has-error') : '']">
                                                <label>Description</label>
                                                <textarea placeholder="Entrer la description du produit" rows="4" class="form-textarea" x-model="form1.description" name="description" ></textarea>
                                                <template x-if="isSubmitForm1 && !form1.description">
                                                    <p class="text-danger mt-1">Le champ description ne peut pas être vide.</p>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 w-full shrink-0 lg:mt-0 lg:max-w-xs">
                                    <div style="padding-bottom: 19px;">
                                        <div class="panel p-0">
                                            <div class="border-b p-4 text-base font-semibold dark:border-[#191e3a] dark:text-white">Fournisseur</div>
                                            <div class="space-y-8 p-4">
                                                <div :class="[isSubmitForm1 ? (form1.fournisseur ? 'has-success' : 'has-error') : '']">
                                                    <label class="">Fournisseur de produit</label>
                                                    <select name="fournisseur" class="form-select" x-model="form1.fournisseur">
                                                        <option values="0">Sélectionnez le fournisseur du produit</option>
                                                        <?php
                                                        // Connexion à la base de données
                                                        $pdo = getConnection();
                                                        
                                                        // Récupération des fournisseurs
                                                        $stmt = $pdo->query("SELECT nom_fournisseurs, id_fournisseurs FROM fournisseurs");
                                                        
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo '<option value="' . htmlspecialchars($row['id_fournisseurs']) . '">' . htmlspecialchars($row['nom_fournisseurs']) . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <template x-if="isSubmitForm1 && !form1.fournisseur">
                                                        <p class="text-danger mt-1">Le champ fournisseur produit ne peut pas être vide.</p>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding-bottom: 19px;">
                                        <div class="panel p-0">
                                            <div class="border-b p-4 text-base font-semibold dark:border-[#191e3a] dark:text-white">Stock</div>
                                            <div class="space-y-8 p-4">
                                                <div :class="[isSubmitForm1 ? (form1.stock ? 'has-success' : 'has-error') : '']">
                                                    <label class="">Stock de produit</label>
                                                    <select name="stock" class="form-select" x-model="form1.stock">
                                                        <option values="0" >Sélectionnez le stock du produit</option>
                                                        <?php
                                                        // Connexion à la base de données
                                                        $pdo = getConnection();
                                                        
                                                        // Récupération des stocks
                                                        $stmt = $pdo->query("SELECT nom_stocks, id_stocks FROM stocks");
                                                        
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo '<option value="' . htmlspecialchars($row['id_stocks']) . '">' . htmlspecialchars($row['nom_stocks']) . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <template x-if="isSubmitForm1 && !form1.stock">
                                                        <p class="text-danger mt-1">Le champ stock produit ne peut pas être vide.</p>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding-bottom: 19px;">
                                        <div class="panel p-0">
                                            <div class="border-b p-4 text-base font-semibold dark:border-[#191e3a] dark:text-white">Catégorie</div>
                                            <div class="space-y-8 p-4">
                                                <div :class="[isSubmitForm1 ? (form1.categorie ? 'has-success' : 'has-error') : '']">
                                                    <label class="">Catégorie de produit</label>
                                                    <select name="categorie" class="form-select" x-model="form1.categorie">
                                                        <option values="0" >Sélectionnez la catégorie du produit</option>
                                                        <?php
                                                        // Connexion à la base de données
                                                        $pdo = getConnection();
                                                        
                                                        // Récupération des stocks
                                                        $stmt = $pdo->query("SELECT nom_categorie_produits,id_categorie_produits FROM categorie_produits");
                                                        
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo '<option value="' . htmlspecialchars($row['id_categorie_produits']) . '">' . htmlspecialchars($row['nom_categorie_produits']) . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <template x-if="isSubmitForm1 && !form1.categorie">
                                                        <p class="text-danger mt-1">Le champ catégorie de produit ne peut pas être vide.</p>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success w-full">Enregistrer</button>
                        </form>
                    </div>
                    <script>
                        document.addEventListener("alpine:init", () => {
                            Alpine.data("form", () => ({
                                form1: {
                                    nom: '',
                                    imageP: '',
                                    imageD: '',
                                    quantite: '',
                                    seuil: '',
                                    prix: '',
                                    description:'',
                                    fournisseur: '',
                                    stock: '',
                                    categorie: '',
                                },
                                isSubmitForm1: false,
                                submitForm1() {
                                    this.isSubmitForm1 = true;

                                    // Vérifier si au moins un champ est rempli
                                    const atLeastOneFilled = Object.values(this.form1).some(value => value.trim() !== '');
                                    if (atLeastOneFilled ) {
                                         this.$refs.myForm.submit();
                                        // this.showMessage('Form submitted successfully.');
                                    }
                                },
                            }));
                          });
                      </script>
                     <!-- end main content section -->

                    </div>
                    <!-- start footer section -->
                    <?php include 'layouts/footer.php'; ?>
                    <!-- end footer section -->
            </div>
        </div>

        <?php include 'layouts/footer_js.php'; ?>

        <script>
            document.addEventListener('alpine:init', () => {
                // main section
                Alpine.data('scrollToTop', () => ({
                    showTopButton: false,
                    init() {
                        window.onscroll = () => {
                            this.scrollFunction();
                        };
                    },

                    scrollFunction() {
                        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                            this.showTopButton = true;
                        } else {
                            this.showTopButton = false;
                        }
                    },

                    goToTop() {
                        document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 0;
                    },
                }));


                // sidebar section
                Alpine.data('sidebar', () => ({
                    init() {
                        const selector = document.querySelector('.sidebar ul a[href="' + window.location.pathname + '"]');
                        if (selector) {
                            selector.classList.add('active');
                            const ul = selector.closest('ul.sub-menu');
                            if (ul) {
                                let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                                if (ele) {
                                    ele = ele[0];
                                    setTimeout(() => {
                                        ele.click();
                                    });
                                }
                            }
                        }
                    },
                }));

                // header section
                Alpine.data('header', () => ({
                    init() {
                        const selector = document.querySelector('ul.horizontal-menu a[href="' + window.location.pathname + '"]');
                        if (selector) {
                            selector.classList.add('active');
                            const ul = selector.closest('ul.sub-menu');
                            if (ul) {
                                let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                                if (ele) {
                                    ele = ele[0];
                                    setTimeout(() => {
                                        ele.classList.add('active');
                                    });
                                }
                            }
                        }
                    },

                    notifications: [
                        // {
                        //     id: 1,
                        //     profile: 'user-profile.jpeg',
                        //     message: '<strong class="text-sm mr-1">John Doe</strong>invite you to <strong>Prototyping</strong>',
                        //     time: '45 min ago',
                        // },
                    ],

                    removeNotification(value) {
                        this.notifications = this.notifications.filter((d) => d.id !== value);
                    },
                }));
            });
        </script>
    </body>
</html>
