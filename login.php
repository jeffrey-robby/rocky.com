<?php
session_start();
require 'layouts/db_connection.php'; // Inclut le fichier de connexion

$pdo = getConnection(); // Récupère la connexion à la base de données

// Variables pour les messages d'erreur
$error_message = '';

// Initialiser $nom_utilisateur
$nom_utilisateur = '';

// Vérifie si le cookie "utilisateur" existe
if (isset($_COOKIE['utilisateur'])) {
    $nom_utilisateur = $_COOKIE['utilisateur'];
} else {
    $nom_utilisateur = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = trim($_POST['nom_utilisateur']);
    $mot_de_passe = trim($_POST['mot_de_passe']);
    $se_souvenir = isset($_POST['se_souvenir']); // Vérifie si la case est cochée

    // Vérifie si les champs sont vides
    if (empty($nom_utilisateur)) {
        $error_message = "Veuillez saisir votre nom d'utilisateur.";
    } elseif (empty($mot_de_passe)) {
        $error_message = "Veuillez saisir votre mot de passe.";
    } else {
        // Vérifie les informations d'identification
        $stmt = $pdo->prepare("SELECT utilisateurs.id_utilisateurs, utilisateurs.id_personnels, utilisateurs.username, utilisateurs.password, personnels.code_personnels, personnels.nom_personnels, personnels.prenom_personnels  
                                FROM utilisateurs 
                                JOIN personnels ON utilisateurs.id_personnels = personnels.id_personnels 
                                WHERE utilisateurs.username = ?");
        $stmt->execute([$nom_utilisateur]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur) {
            // Vérifie le mot de passe
            if (password_verify($mot_de_passe, hash: $utilisateur['password'])) {
                // Authentification réussie

                if ($utilisateur['session_id'] !== null) {
                    // Détruire la session existante
                    $ancien_session_id = $utilisateur['session_id'];
                    $stmt = $pdo->prepare("UPDATE utilisateurs SET session_id = NULL WHERE session_id = ?");
                    $stmt->execute([$ancien_session_id]);
                }
    
                // Créer un nouvel identifiant de session
                $nouvelle_session_id = session_id();
                $stmt = $pdo->prepare("UPDATE utilisateurs SET session_id = ? WHERE id_utilisateurs = ?");
                $stmt->execute([$nouvelle_session_id, $utilisateur['id_utilisateurs']]);
    
                // Authentifier l'utilisateur

                $_SESSION['id_utilisateurs'] = $utilisateur['id_utilisateurs'];
                $_SESSION['id_personnels'] = $utilisateur['id_personnels'];
                $_SESSION['code_personnels'] = $utilisateur['code_personnels'];
                $_SESSION['derniere_action'] = time(); // Timestamp de la dernière action
                $_SESSION['session_id'] = $nouvelle_session_id; // Stocke l'ID de session
                
                $nom_personnel = $utilisateur['nom_personnels'];
                $prenom_personnel = $utilisateur['prenom_personnels'];
                // Stocker le nom complet dans la session
                $_SESSION['nom_personnel'] = $nom_personnel . ' ' . $prenom_personnel;
                
                // Créer un message de bienvenue
                $_SESSION['notification'] =  $_SESSION['nom_personnel'] ;

                // Si "Se souvenir de moi" est coché, créer un cookie
                if ($se_souvenir) {
                    setcookie('utilisateur', $nom_utilisateur, time() + (86400 * 30), "/"); // 30 jours
                } else {
                    setcookie('utilisateur', '', time() - 3600, "/"); // Supprime le cookie
                }
                
                if ( $_SESSION['code_personnels'] === 'V') {
                    header('Location: faire_une_vente.php');
                    exit();
                } else {
                    header('Location: index.php');
                    exit();
                }

            } else {
                $error_message = "Le mot de passe que vous avez entré n’est pas valide.";
            }
        } else {
            $error_message = "Aucun compte trouvé avec ce nom d'utilisateur.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>

    <body
        x-data="main"
        class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased"
        :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]"
    >
        <!-- screen loader -->
        <?php include 'layouts/loader.php'; ?>

        <!-- scroll to top button -->
        <?php include 'layouts/scroll_top.php'; ?>

        <div class="main-container min-h-screen text-black dark:text-white-dark">
            <div x-data="auth">
                <div class="absolute inset-0">
                    <img src="assets/images/auth/bg-gradient.png" alt="image" class="h-full w-full object-cover" />
                </div>

                <div
                    class="relative flex min-h-screen items-center justify-center bg-[url(../images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16"
                >
                    <img src="assets/images/auth/coming-soon-object1.png" alt="image" class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
                    <img src="assets/images/auth/coming-soon-object3.png" alt="image" class="absolute right-0 top-0 h-[300px]" />
                    <div
                        class="relative w-full max-w-[870px] rounded-md bg-[linear-gradient(45deg,#fff9f9_0%,rgba(255,255,255,0)_25%,rgba(255,255,255,0)_75%,_#fff9f9_100%)] p-2 dark:bg-[linear-gradient(52.22deg,#0E1726_0%,rgba(14,23,38,0)_18.66%,rgba(14,23,38,0)_51.04%,rgba(14,23,38,0)_80.07%,#0E1726_100%)]"
                    >
                        <div
                            class="relative flex flex-col justify-center rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 px-6 lg:min-h-[758px] py-20"
                        >
                            <div class="mx-auto w-full max-w-[440px]">
                                <div class="mb-10" style="text-align: center;" >
                                    <h1 class="text-3xl font-extrabold uppercase !leading-snug text-primary md:text-4xl">Librairie Rocky</h1>
                                    <p class="text-base font-bold leading-normal text-white-dark">Connectez-vous pour continuer vers la boutique</p>
                                </div>
                                <form class="space-y-5 dark:text-white" action="login.php" method="POST">
                                    <div>
                                        <label for="username">Nom d'utilisateur</label>
                                        <div class="relative text-white-dark">
                                            <input id="username" type="text" name="nom_utilisateur" placeholder="Entrer votre nom d'utilisateur" class="form-input ps-10 placeholder:text-white-dark" value="<?php echo htmlspecialchars($nom_utilisateur); ?>"/>
                                            <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                    <path
                                                        opacity="0.5"
                                                        d="M10.65 2.25H7.35C4.23873 2.25 2.6831 2.25 1.71655 3.23851C0.75 4.22703 0.75 5.81802 0.75 9C0.75 12.182 0.75 13.773 1.71655 14.7615C2.6831 15.75 4.23873 15.75 7.35 15.75H10.65C13.7613 15.75 15.3169 15.75 16.2835 14.7615C17.25 13.773 17.25 12.182 17.25 9C17.25 5.81802 17.25 4.22703 16.2835 3.23851C15.3169 2.25 13.7613 2.25 10.65 2.25Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M14.3465 6.02574C14.609 5.80698 14.6445 5.41681 14.4257 5.15429C14.207 4.89177 13.8168 4.8563 13.5543 5.07507L11.7732 6.55931C11.0035 7.20072 10.4691 7.6446 10.018 7.93476C9.58125 8.21564 9.28509 8.30993 9.00041 8.30993C8.71572 8.30993 8.41956 8.21564 7.98284 7.93476C7.53168 7.6446 6.9973 7.20072 6.22761 6.55931L4.44652 5.07507C4.184 4.8563 3.79384 4.89177 3.57507 5.15429C3.3563 5.41681 3.39177 5.80698 3.65429 6.02574L5.4664 7.53583C6.19764 8.14522 6.79033 8.63914 7.31343 8.97558C7.85834 9.32604 8.38902 9.54743 9.00041 9.54743C9.6118 9.54743 10.1425 9.32604 10.6874 8.97558C11.2105 8.63914 11.8032 8.14522 12.5344 7.53582L14.3465 6.02574Z"
                                                        fill="currentColor"
                                                    />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="Password">Mot de passe</label>
                                        <div class="relative text-white-dark">
                                            <input id="Password" type="password" placeholder="Entrer votre mot de passe" class="form-input ps-10 placeholder:text-white-dark" name="mot_de_passe"/>
                                            <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                    <path
                                                        opacity="0.5"
                                                        d="M1.5 12C1.5 9.87868 1.5 8.81802 2.15901 8.15901C2.81802 7.5 3.87868 7.5 6 7.5H12C14.1213 7.5 15.182 7.5 15.841 8.15901C16.5 8.81802 16.5 9.87868 16.5 12C16.5 14.1213 16.5 15.182 15.841 15.841C15.182 16.5 14.1213 16.5 12 16.5H6C3.87868 16.5 2.81802 16.5 2.15901 15.841C1.5 15.182 1.5 14.1213 1.5 12Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M6 12.75C6.41421 12.75 6.75 12.4142 6.75 12C6.75 11.5858 6.41421 11.25 6 11.25C5.58579 11.25 5.25 11.5858 5.25 12C5.25 12.4142 5.58579 12.75 6 12.75Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M9 12.75C9.41421 12.75 9.75 12.4142 9.75 12C9.75 11.5858 9.41421 11.25 9 11.25C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M12.75 12C12.75 12.4142 12.4142 12.75 12 12.75C11.5858 12.75 11.25 12.4142 11.25 12C11.25 11.5858 11.5858 11.25 12 11.25C12.4142 11.25 12.75 11.5858 12.75 12Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M5.0625 6C5.0625 3.82538 6.82538 2.0625 9 2.0625C11.1746 2.0625 12.9375 3.82538 12.9375 6V7.50268C13.363 7.50665 13.7351 7.51651 14.0625 7.54096V6C14.0625 3.20406 11.7959 0.9375 9 0.9375C6.20406 0.9375 3.9375 3.20406 3.9375 6V7.54096C4.26488 7.51651 4.63698 7.50665 5.0625 7.50268V6Z"
                                                        fill="currentColor"
                                                    />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="flex cursor-pointer items-center">
                                            <input type="checkbox" class="form-checkbox bg-white dark:bg-black" name="se_souvenir"/>
                                            <span class="text-white">Se souvenir</span>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                        Connectez-vous
                                    </button>
                                </form>
                                <?php if ($error_message): ?>
                                    <div style="color: red; margin-top: 10px;"><?php echo htmlspecialchars($error_message); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'layouts/footer_js.php'; ?>

        <script>
            // main section
            document.addEventListener('alpine:init', () => {
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

            });
        </script>
    </body>
</html>
