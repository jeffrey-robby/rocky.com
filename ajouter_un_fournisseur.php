<?php 
include 'layouts/control.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $tel = $_POST['tel'];
    $residence = $_POST['residence'];
   
    $pdo = getConnection();

    try {
        // Récupérer les informations du fournisseur correspondant
        $query = "SELECT id_fournisseurs FROM fournisseurs WHERE nom_fournisseurs = :nom ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();

        $fournisseurs = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$fournisseurs) {
            // Aucune correspondance trouvée
            $query = "INSERT INTO fournisseurs (nom_fournisseurs, tel_fournisseurs, residence_fournisseurs) VALUES (:nom, :tel, :residence)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':tel', $tel);
            $stmt->bindParam(':residence', $residence);
            $stmt->execute();

            $_SESSION['successMessage'] = "
            document.addEventListener(\"DOMContentLoaded\", function() {
            // Afficher le popup lors du chargement de la page
            new window.Swal({
            icon: 'success',
            title: 'Nouveau fournisseurs créer avec succès !',
            text: 'Vous pouvez le consulter dans la liste des fournisseurs.',
            padding: '2em',
             });
          });";
          header("Location: ajouter_un_fournisseur.php");
          exit();
        } else {

            $_SESSION['errorMessage'] = "
            const showMessage = (msg = 'Example notification text.', position = 'bottom-start', showCloseButton = true, closeButtonHtml = '', duration = 3000) => {
                const toast = window.Swal.mixin({
                    toast: true,
                    position: position,
                    showConfirmButton: false,
                    timer: duration,
                    showCloseButton: showCloseButton,
                });
                toast.fire({
                    title: msg,
                });
             };
             window.onload = () => {
                showMessage('Ce nom de fournisseur est déjà utiliser !', 'top');
             };
            ";
            header("Location: ajouter_un_fournisseur.php");
            exit();
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="ajouter_un_fournisseur";?>

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
                                <a href="javascript:;" class="text-primary hover:underline">Fournisseurs</a>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                                <span>Nouveau fournisseur</span>
                            </li>
                            <?php if (isset($_SESSION['errorMessage'])) { echo '<script>' . $_SESSION['errorMessage'] . '</script>'; unset($_SESSION['errorMessage']); } ?>                                 
                            <?php if (isset($_SESSION['successMessage'])) { echo '<script>' . $_SESSION['successMessage'] . '</script>'; unset($_SESSION['successMessage']); } ?>
                        </ul>
                        <div class="pt-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="panel">
                                        <div class="mb-5">
                                            <h5 class="font-semibold text-lg dark:text-white-light">Créer un nouveau fournisseur</h5>
                                        </div>
                                        <div class="space-y-4">
                                            <!-- basic -->
                                            <div x-data="form">
                                                <form class="space-y-5" @submit.prevent="submitForm1()" x-ref="myForm" action="" method="POST">
                                                    <div :class="[isSubmitForm1 ? (form1.name ? 'has-success' : 'has-error') : '']">
                                                        <label for="fullName">Nom</label>
                                                        <input id="fullName" type="text" placeholder="Entrer le nom du fournisseur" class="form-input" x-model="form1.name" name="nom" />
                                                        <template x-if="isSubmitForm1 && !form1.name">
                                                            <p class="text-danger mt-1">Le champ nom fournisseur ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.prenom ? 'has-success' : 'has-error') : '']">
                                                        <label for="prenom">Numéro de téléphone</label>
                                                        <input id="prenom" type="number" placeholder="Entrer le numéro de téléphone du fournisseur" class="form-input" x-model="form1.prenom" name="tel" />
                                                        <template x-if="isSubmitForm1 && !form1.prenom">
                                                            <p class="text-danger mt-1">Le champ numéro de téléphone ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.userName ? 'has-success' : 'has-error') : '']">
                                                        <label for="userName">Résidence</label>
                                                        <input id="userName" type="text" placeholder="Entrer la résidence du fournisseur" class="form-input" x-model="form1.userName" name="residence"/>
                                                        <template x-if="isSubmitForm1 && !form1.prenom">
                                                            <p class="text-danger mt-1">Le champ résidence ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <button type="submit" class="btn btn-success w-full">Enregistrer</button>
                                                </form>
                                            </div>
                                        </div>
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
                Alpine.data("form", () => ({
                    form1: {
                        name: '',
                        prenom: '',
                        userName: '',
                    },
                    isSubmitForm1: false,
                    submitForm1() {
                        this.isSubmitForm1 = true;
                        if (this.form1.name && this.form1.prenom && this.form1.userName) {
                            //form validated success
                            this.$refs.myForm.submit();
                            //this.showMessage('Form submitted successfully.');
                        }
                    },
                }));
                    
            });
        </script>
    </body>
</html>
