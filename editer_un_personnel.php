<?php 
include 'layouts/control.php'; 

$id = $_REQUEST['id'];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Informations sur le fichier téléchargé
   $photo = uniqid() . '_' . $_FILES['photo']['name'];
   $verso = uniqid() . '_' . $_FILES['verso']['name'];
   $recto = uniqid() . '_' . $_FILES['recto']['name'];
   $photoTemp = $_FILES['photo']['tmp_name'];
   $versoTemp = $_FILES['verso']['tmp_name'];
   $rectoTemp = $_FILES['recto']['tmp_name'];

   // Déplacer le fichier vers le répertoire d'images
   $cheminPhoto = 'assets/images/personnels/photos/' . $photo;
   move_uploaded_file($photoTemp, $cheminPhoto);
   $cheminVerso = 'assets/images/personnels/cni_vesro/' . $verso;
   move_uploaded_file($versoTemp, $cheminVerso);
   $cheminRecto = 'assets/images/personnels/cni_recto/' . $recto;
   move_uploaded_file($rectoTemp, $cheminRecto);

   // Enregistrer le chemin de l'image dans la base de données
   $cheminPhotoF = $cheminPhoto ;
   $cheminVersoF = $cheminVerso ;
   $cheminRectoF = $cheminRecto ;
   $nom = $_POST['name'] ;
   $prenom = $_POST['prenom'] ;
   $dateNaissance =  $_POST['dateNaissance'];
   $email = $_POST['email'] ;
   $numero = $_POST['numero'];
   $poste = $_POST['poste'];
   $code = $_POST['code'];
   $sexe = $_POST['sexe'];
   $cni = $_POST['cni'];
   $residence = $_POST['residence'];

   // Obtenir la connexion à la base de données
   $pdo = getConnection();

   // Initialiser la requête de mise à jour
   $query = "UPDATE personnels SET ";
   $params = [];
   
   if ($nom !== '') {
       $query .= "nom_personnels = :name, ";
       $params[':name'] = $nom;
    }
    if ($prenom !== '') {
        $query .= "prenom_personnels = :prenom, ";
        $params[':prenom'] = $prenom;
    }
    if ($dateNaissance !== '') {
        $query .= "date_de_naissance_personnels = :dateNaissance, ";
        $params[':dateNaissance'] = $dateNaissance;
    }
    if ($email !== '') {
        $query .= "email_personnels = :email, ";
        $params[':email'] = $email;
    }
    if ($numero !== '') {
        $query .= "tel_personnels = :numero, ";
        $params[':numero'] = $numero;
    }
    if ($poste !== '') {
        $query .= "poste_personnels = :poste, ";
        $params[':poste'] = $poste;
    }
    if ($code !== '') {
        $query .= "code_personnels = :code, ";
        $params[':code'] = $code;
    }
    if ($sexe !== '') {
        $query .= "sexe_personnels = :sexe, ";
        $params[':sexe'] = $sexe;
    }
    if ($cni !== '') {
        $query .= "numero_cni_personnels = :cni, ";
        $params[':cni'] = $cni;
    }
    if ($residence !== '') {
        $query .= "residence_personnels = :residence, ";
        $params[':residence'] = $residence;
    }
    if ($_FILES['photo']['name'] !== '') {
        $query .= "image_personnels = :photo, ";
        $params[':photo'] = $cheminPhotoF;
    }
    if ($_FILES['verso']['name'] !== '') {
        $query .= "photo_verso_personnels = :verso, ";
        $params[':verso'] = $cheminVersoF;
    }
    if ($_FILES['recto']['name'] !== '') {
        $query .= "photo_recto_personnels = :recto, ";
        $params[':recto'] = $cheminRectoF;
    }

    // Mettre à jour l'horodatage
    $query .= "updated_at_personnels = NOW() ";
    $query .= "WHERE id_personnels = :id";
    $params[':id'] = $id;

    $stmt = $pdo->prepare($query);

    try {
        // Lier les paramètres
        foreach ($params as $key => &$value) {
            $stmt->bindParam($key, $value);
        }

        // Exécuter la mise à jour
        $stmt->execute();
        $_SESSION['successMessage'] = "
          document.addEventListener(\"DOMContentLoaded\", function() {
           // Afficher le popup lors du chargement de la page
           new window.Swal({
               icon: 'success',
               title: 'Les modification ont été enregistrées avec succès !',
               text: 'Vous pouvez le consulter dans la liste des personnels.',
               padding: '2em',
           });
       });";
       header("Location: liste_du_personnel.php");
       exit();
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour des données : " . $e->getMessage());
    }
}  
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="editer_un_personnel";?>

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
                    <div>
                        <ul class="flex space-x-2 rtl:space-x-reverse">
                            <li>
                                <a href="javascript:;" class="text-primary hover:underline">Personnels</a>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                                <span>Modification d'un personnel</span>
                            </li>
                            <?php if (isset($_SESSION['successMessage'])) { echo '<script>' . $_SESSION['successMessage'] . '</script>'; unset($_SESSION['successMessage']); } ?>
                        </ul>
                        <div class="pt-5">
                            <div class="panel">
                                    <?php
                                      function getPersonnelById($id) {
                                        $pdo = getConnection();
                                        $query = "SELECT * FROM personnels WHERE id_personnels = :id";
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
                                     $personnel = getPersonnelById($id);
                                    ?>
                                    <div class="mb-5">
                                        <h5 class="font-semibold text-lg dark:text-white-light">Vous modifier le personnel qui a pour nom <b><?php echo htmlspecialchars($personnel['nom_personnels']);?></b> et prénom <b><?php echo htmlspecialchars($personnel['prenom_personnels']);?></b></h5>
                                    </div>
                                    <div class="space-y-4">
                                        <!-- basic -->
                                        <div x-data="form">
                                            <form class="space-y-5" @submit.prevent="submitForm1()" x-ref="myForm" action="" method="POST" enctype="multipart/form-data">
                                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                                  <div :class="[isSubmitForm1 ? (form1.name ? 'has-success' : 'has-error') : '']">
                                                      <label for="fullName">Nom</label>
                                                      <input id="fullName" type="text" name="name" value="<?php echo htmlspecialchars($personnel['nom_personnels']);?>" placeholder="<?php echo htmlspecialchars($personnel['nom_personnels']);?>" class="form-input" x-model="form1.name" />
                                                      <template x-if="isSubmitForm1 && !form1.name">
                                                          <p class="text-danger mt-1">Le champ nom ne peut pas être vide.</p>
                                                      </template>
                                                  </div>
                                                  <div :class="[isSubmitForm1 ? (form1.prenom ? 'has-success' : 'has-error') : '']">
                                                      <label for="prenom">Prénom</label>
                                                      <input id="prenom" type="text" placeholder="<?php echo htmlspecialchars($personnel['prenom_personnels']);?>" class="form-input" x-model="form1.prenom" name="prenom"/>
                                                      <template x-if="isSubmitForm1 && !form1.prenom">
                                                          <p class="text-danger mt-1">Le champ prénom ne peut pas être vide.</p>
                                                      </template>
                                                  </div>
                                                  <div :class="[isSubmitForm1 ? (form1.dateNaissance ? 'has-success' : 'has-error') : '']">
                                                      <label for="dateNaissance">Date de naissance</label>
                                                      <input id="dateNaissance" value="<?php echo htmlspecialchars($personnel['date_de_naissance_personnels']);?>" type="date"  class="form-input"  name="dateNaissance"/>
                                                      <template x-if="isSubmitForm1 && !form1.dateNaissance">
                                                          <p class="text-danger mt-1">Le champ date de naissance ne peut pas être vide.</p>
                                                      </template>
                                                  </div>
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                                    <div :class="[isSubmitForm1 ? (form1.numero ? 'has-success' : 'has-error') : '']">
                                                        <label for="numero">Numéro de téléphone</label>
                                                        <input id="numero" type="number" placeholder="<?php echo htmlspecialchars($personnel['tel_personnels']);?>" class="form-input" x-model="form1.numero" name="numero"/>
                                                        <template x-if="isSubmitForm1 && !form1.numero">
                                                            <p class="text-danger mt-1">Le champ numéro de téléphone ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.email && emailValidate(form1.email)  ? 'has-success' : 'has-error') : '']">
                                                        <label for="Email">Adresse Email</label>
                                                        <input id="Email" type="email" placeholder="<?php echo htmlspecialchars($personnel['email_personnels']);?>" class="form-input" x-model="form1.email" name="email"/>
                                                        <template x-if="isSubmitForm1 && !form1.email">
                                                            <p class="text-danger mt-1">Le champ adresse email ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.poste ? 'has-success' : 'has-error') : '']">
                                                        <label for="poste">Poste</label>
                                                        <select id="poste" class="form-select text-white-dark" x-model="form1.poste" name="poste">
                                                            <option values="" disabled selected>Sélectionnez le poste</option>
                                                            <option values="Propriétaire" <?php echo ($personnel['poste_personnels'] == 'Propriétaire') ? 'selected' : ''; ?>>Propriétaire</option>
                                                            <option values="Vendeur" <?php echo ($personnel['poste_personnels'] == 'Vendeur') ? 'selected' : ''; ?>>Vendeur</option>
                                                        </select>
                                                        <template x-if="isSubmitForm1 && !form1.poste">
                                                            <p class="text-danger mt-1">Le champ poste ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                                    <div :class="[isSubmitForm1 ? (form1.code ? 'has-success' : 'has-error') : '']">
                                                        <label for="code">Code</label>
                                                        <select id="gridState" class="form-select text-white-dark" name="code" x-model="form1.code">
                                                            <option values="" disabled selected>Sélectionnez le code correspondant</option>
                                                            <option values="P"  <?php echo ($personnel['code_personnels'] == 'P') ? 'selected' : ''; ?>>P</option>
                                                            <option values="V" <?php echo ($personnel['code_personnels'] == 'V') ? 'selected' : ''; ?>>V</option> 
                                                        </select>
                                                        <template x-if="isSubmitForm1 && !form1.code">
                                                            <p class="text-danger mt-1">Le champ code ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.residence ? 'has-success' : 'has-error') : '']">
                                                        <label for="residence">Résidence</label>
                                                        <input id="residence" type="text" placeholder="<?php echo htmlspecialchars($personnel['residence_personnels']);?>" class="form-input" x-model="form1.residence" name="residence" />
                                                        <template x-if="isSubmitForm1 && !form1.residence">
                                                            <p class="text-danger mt-1">Le champ résidence ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.sexe ? 'has-success' : 'has-error') : '']">
                                                        <label for="sexe">Sexe</label>
                                                        <select id="gridState" class="form-select text-white-dark" name="sexe" x-model="form1.code">
                                                            <option values="" disabled selected>Sélectionnez le sexe correspondant</optio>
                                                            <option value="Maculin"  <?php echo ($personnel['sexe_personnels'] == 'Maculin') ? 'selected' : ''; ?>>Maculin</option>
                                                            <option value="Feminin"  <?php echo ($personnel['sexe_personnels'] == 'Feminin') ? 'selected' : ''; ?>>Feminin</option>
                                                        </select>
                                                        <template x-if="isSubmitForm1 && !form1.sexe">
                                                            <p class="text-danger mt-1">Le champ sexe ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                                    <div :class="[isSubmitForm1 ? (form1.photo ? 'has-success' : 'has-error') : '']">
                                                        <label for="photo">Photo</label>
                                                        <input id="photo" type="file"  class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" x-model="form1.photo" name="photo" accept=".jpg"/>
                                                        <template x-if="isSubmitForm1 && !form1.photo">
                                                            <p class="text-danger mt-1">Le champ photo ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.cni ? 'has-success' : 'has-error') : '']">
                                                        <label for="cni">Numéro de CNI</label>
                                                        <input id="cni" type="text" placeholder="<?php echo htmlspecialchars($personnel['numero_cni_personnels']);?>" class="form-input" x-model="form1.cni" name="cni"/>
                                                        <template x-if="isSubmitForm1 && !form1.cni">
                                                            <p class="text-danger mt-1">Le champ numéro de CNI ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.verso ? 'has-success' : 'has-error') : '']">
                                                        <label for="verso">Photo verso CNI</label>
                                                        <input id="verso" type="file" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" x-model="form1.verso" name="verso" accept=".jpg"/>
                                                        <template x-if="isSubmitForm1 && !form1.verso">
                                                            <p class="text-danger mt-1">Le champ photo verso CNI ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                                    <div :class="[isSubmitForm1 ? (form1.recto ? 'has-success' : 'has-error') : '']">
                                                        <label for="recto">Photo recto CNI</label>
                                                        <input id="recto" type="file" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" x-model="form1.recto" name="recto" accept=".jpg"/>
                                                        <template x-if="isSubmitForm1 && !form1.recto">
                                                            <p class="text-danger mt-1">Le champ photo recto CNI ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success w-full">Enregistrer</button>
                                            </form>
                                        </div>
                                        <!-- <script>
                                          document.addEventListener("alpine:init", () => {
                                                Alpine.data("form", () => ({
                                                    submitForm1() {
                                                        this.isSubmitForm2 = true;
                                                        if (this.isSubmitForm2) {
                                                            //form validated success
                                                            this.$refs.myForm.submit();
                                                            //this.showMessage('Form submitted successfully.');
                                                        }
                                                    },
                                                }));
                                            });
                                        </script> -->
                                        <script>
                                            document.addEventListener("alpine:init", () => {
                                                Alpine.data("form", () => ({
                                                    form1: {
                                                        name: '',
                                                        prenom: '',
                                                        dateNaissance: '',                     
                                                        email: '',
                                                        numero: '',
                                                        poste: '',
                                                        code: '',
                                                        sexe: '',
                                                        cni: '',
                                                        residence: '',
                                                        verso: '',
                                                        recto: '',
                                                        photo: '',
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- end main content section -->

                     <!-- start footer section -->
                     <?php include 'layouts/footer.php'; ?>
                     <!-- end footer section -->
                </div>
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

                 // theme customization
                 Alpine.data('customizer', () => ({
                    showCustomizer: false,
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
