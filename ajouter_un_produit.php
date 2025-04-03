<?php 
include 'layouts/control.php'; 

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
    $prix1 = trim($_POST['prix1']);
    $description = trim($_POST['description']);
    $fournisseur = trim( $_POST['fournisseur']);
    $categorie = trim($_POST['categorie']);
    $stock = trim($_POST['stock']);
    $unite = trim($_POST['unite']);
 
    // Obtenir la connexion à la base de données
    $pdo = getConnection();
 
    // Étape 1: Récupérer les IDs nécessaires
    $id_fournisseurs = $pdo->query("SELECT id_fournisseurs FROM fournisseurs WHERE nom_fournisseurs = '$fournisseur'")->fetchColumn();
    $id_categorie_produits = $pdo->query("SELECT id_categorie_produits FROM categorie_produits WHERE nom_categorie_produits = '$categorie'")->fetchColumn();
    $id_stock = $pdo->query("SELECT id_stocks FROM stocks WHERE nom_stocks = '$stock'")->fetchColumn();
    
    // Étape 2: Insérer dans la table produits
    $pdo->prepare("INSERT INTO produits (id_fournisseurs, id_categorie_produits, nom_produits, prix_produits, prix_produits1, photo_produits1, photo_produits2, description_produits, unite_produits) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")
        ->execute([$id_fournisseurs, $id_categorie_produits, $nom, $prix, $prix1, $cheminPhotoF, $cheminVersoF, $description, $unite]);
    
    // Étape 3: Récupérer l'ID du produit nouvellement inséré
    $id_produits = $pdo->lastInsertId();
    
    // Étape 4: Insérer dans la table quantite_stock
    $pdo->prepare("INSERT INTO quantite_en_stocks (id_stocks, id_produits, quantite_quantite_en_stocks, seuil_quantite_en_stocks) VALUES (?, ?, ?, ?)")
        ->execute([$id_stock, $id_produits, $quantite, $seuil]);
    
        $_SESSION['successMessage'] = "
        document.addEventListener(\"DOMContentLoaded\", function() {
         // Afficher le popup lors du chargement de la page
         new window.Swal({
             icon: 'success',
             title: 'Le produit a été enregistré !',
             text: 'Vous pouvez maintenant le consulter dans liste des produits',
             padding: '2em',
         });
     });";
     header("Location: ajouter_un_produit.php");
     exit();
}  
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="ajouter_un_produit";?>

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
                    <?php if (isset($_SESSION['successMessage'])) { echo '<script>' . $_SESSION['successMessage'] . '</script>'; unset($_SESSION['successMessage']); } ?>
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
                                            <div class="grid gap-6 sm:grid-cols-3 xl:grid-cols-3">
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
                                                <div :class="[isSubmitForm1 ? (form1.unite ? 'has-success' : 'has-error') : '']" class="">
                                                    <label for="unite">Unité</label>
                                                    <select id="gridState" class="form-select text-white-dark" x-model="form1.unite" name="unite">
                                                        <option values="">Sélectionnez l'unité</option>
                                                        <option values="Carton">Carton</option>
                                                        <option values="Piece">Piece</option>
                                                        <option values="Paquet">Paquet</option>  
                                                        <option values="Boite">Boite</option> 
                                                        <option values="Cartouche">Cartouche</option> 
                                                    </select>
                                                    <template x-if="isSubmitForm1 &amp;&amp; !form1.unite">
                                                        <p class="text-danger mt-1">Le champ code ne peut pas être vide.</p>
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
                                                        <option values="">Sélectionnez le fournisseur du produit</option>
                                                        <?php
                                                        // Connexion à la base de données
                                                        $pdo = getConnection();
                                                        
                                                        // Récupération des fournisseurs
                                                        $stmt = $pdo->query("SELECT nom_fournisseurs FROM fournisseurs");
                                                        
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo '<option value="' . htmlspecialchars($row['nom_fournisseurs']) . '">' . htmlspecialchars($row['nom_fournisseurs']) . '</option>';
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
                                                        <option values="" >Sélectionnez le stock du produit</option>
                                                        <?php
                                                        // Connexion à la base de données
                                                        $pdo = getConnection();
                                                        
                                                        // Récupération des stocks
                                                        $stmt = $pdo->query("SELECT nom_stocks FROM stocks");
                                                        
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo '<option value="' . htmlspecialchars($row['nom_stocks']) . '">' . htmlspecialchars($row['nom_stocks']) . '</option>';
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
                                                        <option values="" >Sélectionnez la catégorie du produit</option>
                                                        <?php
                                                        // Connexion à la base de données
                                                        $pdo = getConnection();
                                                        
                                                        // Récupération des stocks
                                                        $stmt = $pdo->query("SELECT nom_categorie_produits FROM categorie_produits");
                                                        
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo '<option value="' . htmlspecialchars($row['nom_categorie_produits']) . '">' . htmlspecialchars($row['nom_categorie_produits']) . '</option>';
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
                                    prix1: '',
                                    unite: '',
                                    description:'',
                                    fournisseur: '',
                                    stock: '',
                                    categorie: '',
                                },
                                isSubmitForm1: false,
                                submitForm1() {
                                    this.isSubmitForm1 = true;
                                    if (this.form1.nom && this.form1.imageP && this.form1.imageD && this.form1.quantite && this.form1.unite && this.form1.seuil && this.form1.prix && this.form1.prix1 && this.form1.description && this.form1.fournisseur && this.form1.stock && this.form1.categorie) {
                                        //form validated success
                                        this.$refs.myForm.submit();
                                        //this.showMessage('Form submitted successfully.');
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
