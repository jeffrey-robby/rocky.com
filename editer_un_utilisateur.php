<?php 
include 'layouts/control.php'; 

$id = $_REQUEST['id'];
if($_SERVER['REQUEST_METHOD'] === 'POST'){

   $username = $_POST['username'];
   $password = $_POST['password'];
 
   // Obtenir la connexion à la base de données
   $pdo = getConnection();

   // Initialiser la requête de mise à jour
   $query = "UPDATE utilisateurs SET ";
   $params = [];
   
    if ($username !== '') {
        $query .= "username = :username, ";
        $params[':username'] = $username;
    }
    if ($password !== '') {
        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query .= "password = :password, ";
        $params[':password'] = $hashedPassword;
    }

    // Mettre à jour l'horodatage
    $query .= "updated_at_utilisateurs = NOW() ";
    $query .= "WHERE id_utilisateurs = :id";
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
               text: 'Vous pouvez le consulter dans la liste des utilisateurs.',
               padding: '2em',
           });
       });";
       header("Location: liste_utilisateur.php");
       exit();
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour des données : " . $e->getMessage());
    }
}  
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="editer_un_utilisateur";?>

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
                                <span>Modification d'un utilisateur</span>
                            </li>
                            <?php if (isset($_SESSION['successMessage'])) { echo '<script>' . $_SESSION['successMessage'] . '</script>'; unset($_SESSION['successMessage']); } ?>
                        </ul>
                        <div class="pt-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="panel">
                                        <?php
                                          function getUtilisateurById($id) {
                                            $pdo = getConnection();
                                            $query = "SELECT * FROM utilisateurs WHERE id_utilisateurs = :id";
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
                                         $utilisateur = getUtilisateurById($id);
                                        ?>
                                        <div class="mb-5">
                                            <h5 class="font-semibold text-lg dark:text-white-light">Vous modifier l'utilisateur qui a pour username <b><?php echo htmlspecialchars($utilisateur['username']);?></b> </h5>
                                        </div>
                                        <div class="space-y-4">
                                            <!-- basic -->
                                            <div x-data="form">
                                                <form class="space-y-5" @submit.prevent="submitForm1()" x-ref="myForm" action="" method="POST">
                                                    <div :class="[isSubmitForm1 ? (form1.userName ? 'has-success' : 'has-error') : '']">
                                                        <label for="userName">Nom d'utilisateur</label>
                                                        <input id="userName" type="text" placeholder="Entrer votre nom d'utilisateur" class="form-input" x-model="form1.userName" name="username"/>
                                                        <template x-if="isSubmitForm1 && !form1.userName">
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
                                                            userName: '',
                                                            mDp: '',
                                                            cMdp: '',
                                                        },
                                                        isSubmitForm1: false,
                                                        submitForm1() {
                                                            this.isSubmitForm1 = true;
                                                            if (this.form1.userName && this.form1.mDp && this.form1.cMdp && this.form1.mDp == this.form1.cMdp) {
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
