<?php 
include 'layouts/control.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash du mot de passe

    $pdo = getConnection();

    try {
        // Récupérer les informations du personnel correspondant
        $query = "SELECT id_personnels FROM personnels WHERE nom_personnels = :nom AND prenom_personnels = :prenom";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->execute();

        $personnel = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$personnel) {
            // Aucune correspondance trouvée
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
                showMessage('Ses informations ne correspondent à aucun personnel !', 'top');
             };
            ";
            header("Location: ajouter_un_utilisateur.php");
            exit();
        } else {
            // Vérifier si le personnel est déjà lié à un utilisateur
            $id_personnel = $personnel['id_personnels'];

            $query = "SELECT * FROM utilisateurs WHERE id_personnels = :id_personnels";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_personnels', $id_personnel);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Aucune correspondance trouvée
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
                    showMessage('Ce personnel est déjà lié à un utilisateur.', 'top');
                 };
                ";
                header("Location: ajouter_un_utilisateur.php");
                exit();
            } else {
                // Insérer le nouvel utilisateur
                $query = "INSERT INTO utilisateurs (id_personnels, username, password) VALUES (:id_personnels, :username, :password)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_personnels', $id_personnel);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                $_SESSION['successMessage'] = "
                document.addEventListener(\"DOMContentLoaded\", function() {
                // Afficher le popup lors du chargement de la page
                new window.Swal({
                icon: 'success',
                title: 'Utilisateur créé avec succès !',
                text: 'Vous pouvez maintenant vous connecter avec vos identifiants.',
                padding: '2em',
                 });
              });";
              header("Location: ajouter_un_utilisateur.php");
              exit();
             
            }
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="ajouter_un_utilisateur";?>

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
                                <a href="javascript:;" class="text-primary hover:underline">Utilisateurs</a>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                                <span>Nouvel utilisateur</span>
                            </li>
                            <?php if (isset($_SESSION['errorMessage'])) { echo '<script>' . $_SESSION['errorMessage'] . '</script>'; unset($_SESSION['errorMessage']); } ?>                                 
                            <?php if (isset($_SESSION['successMessage'])) { echo '<script>' . $_SESSION['successMessage'] . '</script>'; unset($_SESSION['successMessage']); } ?>
                        </ul>
                        <div class="pt-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="panel">
                                        <div class="mb-5">
                                            <h5 class="font-semibold text-lg dark:text-white-light">Creer un compte utilisateur</h5>
                                        </div>
                                        <div class="space-y-4">
                                            <!-- basic -->
                                            <div x-data="form">
                                                <form class="space-y-5" @submit.prevent="submitForm1()" x-ref="myForm" action="" method="POST">
                                                    <div :class="[isSubmitForm1 ? (form1.name ? 'has-success' : 'has-error') : '']">
                                                        <label for="fullName">Nom</label>
                                                        <input id="fullName" type="text" placeholder="Entrer votre nom" class="form-input" x-model="form1.name" name="nom" />
                                                        <template x-if="isSubmitForm1 && !form1.name">
                                                            <p class="text-danger mt-1">Le champ nom ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.prenom ? 'has-success' : 'has-error') : '']">
                                                        <label for="prenom">Prénom</label>
                                                        <input id="prenom" type="text" placeholder="Entrer votre prénom" class="form-input" x-model="form1.prenom" name="prenom" />
                                                        <template x-if="isSubmitForm1 && !form1.prenom">
                                                            <p class="text-danger mt-1">Le champ prénom ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.userName ? 'has-success' : 'has-error') : '']">
                                                        <label for="userName">Nom d'utilisateur</label>
                                                        <input id="userName" type="text" placeholder="Entrer votre nom d'utilisateur" class="form-input" x-model="form1.userName" name="username"/>
                                                        <template x-if="isSubmitForm1 && !form1.prenom">
                                                            <p class="text-danger mt-1">Le champ nom utilisateur ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.mDp ? 'has-success' : 'has-error') : '']">
                                                        <label for="mDp">Mot de passe</label>
                                                        <input id="mDp" type="password" placeholder="Entrer votre mot de passe" class="form-input" x-model="form1.mDp" name="password"/>
                                                        <template x-if="isSubmitForm1 && !form1.mDp">
                                                            <p class="text-danger mt-1">Le champ mot de passe ne peut pas être vide.</p>
                                                        </template>
                                                    </div>
                                                    <div :class="[isSubmitForm1 ? (form1.cMdp ? 'has-success' : 'has-error') : '']">
                                                        <label for="cMdp">Confirmation mot de passe</label>
                                                        <input id="cMdp" type="password" placeholder="Entrer à nouveau votre mot de passe " class="form-input" x-model="form1.cMdp" />
                                                        <template x-if="isSubmitForm1 && !form1.cMdp">
                                                            <p class="text-danger mt-1">Le champ confirmation mot de passe ne peut pas être vide.</p>
                                                        </template>
                                                        <template x-if="form1.mDp !== form1.cMdp">
                                                            <p class="text-danger mt-1">Les mots de passe ne correspondent pas.</p>
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
                        mDp: '',
                        cMdp: '',
                    },
                    isSubmitForm1: false,
                    submitForm1() {
                        this.isSubmitForm1 = true;
                        if (this.form1.name && this.form1.prenom && this.form1.userName && this.form1.mDp && this.form1.cMdp && this.form1.mDp == this.form1.cMdp) {
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
