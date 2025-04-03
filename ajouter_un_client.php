<?php 
include 'layouts/control.php'; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){

   $nom = trim($_POST['nom']);
   $prenom = trim($_POST['prenom']);
   $numero = trim( $_POST['numero']);
   $code = trim($_POST['code']);
   $sexe = trim($_POST['sexe']);
   $cni = trim($_POST['cni']);
   $residence = trim($_POST['residence']);

   // Obtenir la connexion à la base de données
   $pdo = getConnection();

   $stmt = $pdo->prepare("INSERT INTO clients (nom_clients, prenom_clients, 	type_clients, tel_clients, sexe_clients, residence_clients, numero_cni_clients )
   values(?, ?, ?, ?, ?, ?, ?)");
   // Exécuter la requête
   if ($stmt->execute([$nom, $prenom, $code, $numero , $sexe,  $residence, $cni])) {
     
        $_SESSION['successMessage'] = "
          document.addEventListener(\"DOMContentLoaded\", function() {
           // Afficher le popup lors du chargement de la page
           new window.Swal({
               icon: 'success',
               title: 'Le client a été enregistré !',
               text: 'Vous pouvez maintenant le consulter dans liste des clients',
               padding: '2em',
           });
       });";
       header("Location: ajouter_un_client.php");
       exit();
    } 
}  
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="ajouter_un_client";?>

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
                                <a href="javascript:;" class="text-primary hover:underline">Clients</a>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                                <span>Nouveau client</span>
                            </li>
                            <?php if (isset($_SESSION['successMessage'])) { echo '<script>' . $_SESSION['successMessage'] . '</script>'; unset($_SESSION['successMessage']); } ?>
                        </ul>
                        <div class="pt-5">
                            <div class="panel">
                                    <div class="mb-5">
                                        <h5 class="font-semibold text-lg dark:text-white-light">Enregistrer un nouveau client</h5>
                                    </div>
                                    <div class="space-y-4">
                                        <!-- basic -->
                                        <div x-data="form">
                                            <form class="space-y-5" @submit.prevent="submitForm1()" x-ref="myForm" action="" method="POST" enctype="multipart/form-data">
                                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                                  <div :class="[isSubmitForm1 ? (form1.name ? 'has-success' : 'has-error') : '']">
                                                      <label for="fullName">Nom</label>
                                                      <input id="fullName" type="text" placeholder="Entrer le nom" class="form-input" x-model="form1.name" name="nom" />
                                                      <template x-if="isSubmitForm1 && !form1.name">
                                                          <p class="text-danger mt-1">Le champ nom ne peut pas être vide.</p>
                                                      </template>
                                                  </div>
                                                  <div :class="[isSubmitForm1 ? (form1.prenom ? 'has-success' : 'has-error') : '']">
                                                      <label for="prenom">Prénom</label>
                                                      <input id="prenom" type="text" placeholder="Entrer le prénom" class="form-input" x-model="form1.prenom" name="prenom" />
                                                      <template x-if="isSubmitForm1 && !form1.prenom">
                                                          <p class="text-danger mt-1">Le champ prénom ne peut pas être vide.</p>
                                                      </template>
                                                  </div>
                                                  <div :class="[isSubmitForm1 ? (form1.numero ? 'has-success' : 'has-error') : '']">
                                                      <label for="numero">Numéro de téléphone</label>
                                                      <input id="numero" type="number" placeholder="Entrer le numéro de téléphone" class="form-input" x-model="form1.numero" name="numero"/>
                                                      <template x-if="isSubmitForm1 && !form1.numero">
                                                          <p class="text-danger mt-1">Le champ numéro de téléphone ne peut pas être vide.</p>
                                                      </template>
                                                  </div>
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                                    <div :class="[isSubmitForm1 ? (form1.sexe ? 'has-success' : 'has-error') : '']">
                                                        <label for="sexe">Sexe</label>
                                                        <select id="gridState" class="form-select text-white-dark" x-model="form1.sexe" name="sexe">
                                                            <option values="" selected>Sélectionnez le sexe correspondant</optio>
                                                            <option value="Maculin">Maculin</option>
                                                            <option value="Feminin">Feminin</option>
                                                        </select>
                                                        <template x-if="isSubmitForm1 && !form1.sexe">
                                                            <p class="text-danger mt-1">Le champ sexe ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.code ? 'has-success' : 'has-error') : '']">
                                                        <label for="code">Type de client</label>
                                                        <select id="gridState" class="form-select text-white-dark" x-model="form1.code" name="code">
                                                            <option values="" selected>Sélectionnez le type de client</option>
                                                            <option values="Grossiste">Grossiste</option>
                                                            <option values="Simple">Simple</option> 
                                                        </select>
                                                        <template x-if="isSubmitForm1 && !form1.code">
                                                            <p class="text-danger mt-1">Le champ type de client ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.residence ? 'has-success' : 'has-error') : '']">
                                                        <label for="residence">Résidence</label>
                                                        <input id="residence" type="text" placeholder="Entrer la résidence" class="form-input" x-model="form1.residence" name="residence" />
                                                        <template x-if="isSubmitForm1 && !form1.residence">
                                                            <p class="text-danger mt-1">Le champ résidence ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                                    <div :class="[isSubmitForm1 ? (form1.cni ? 'has-success' : 'has-error') : '']">
                                                        <label for="cni">Numéro de CNI</label>
                                                        <input id="cni" type="text" placeholder="Entrer le numéro de CNI" class="form-input" x-model="form1.cni" name="cni"/>
                                                        <template x-if="isSubmitForm1 && !form1.cni">
                                                            <p class="text-danger mt-1">Le champ numéro de CNI ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success w-full">Enregistrer</button>
                                            </form>
                                        </div>
                                        <script>
                                          document.addEventListener("alpine:init", () => {
                                                Alpine.data("form", () => ({
                                                    form1: {
                                                        name: '',
                                                        prenom: '',
                                                        numero: '',
                                                        code: '',
                                                        sexe: '',
                                                        cni: '',
                                                        residence: '',
                                                    },
                                                    isSubmitForm1: false,
                                                    submitForm1() {
                                                        this.isSubmitForm1 = true;
                                                        if (this.form1.name && this.form1.prenom && this.form1.numero && this.form1.code && this.form1.sexe  && this.form1.cni && this.form1.residence ) {
                                                            //form validated success
                                                            this.$refs.myForm.submit();
                                                            //this.showMessage('Form submitted successfully.');
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
