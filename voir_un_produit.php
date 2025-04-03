<?php include 'layouts/control.php';
$id = $_REQUEST['id'];
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="editer_un_produit";?>

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
                        <?php
                        // Récupérer les données de la table personnels
                        function getProduits($id) {
                            $pdo = getConnection();
                        
                            // Correction de la requête SQL : le JOIN doit être avant le WHERE
                            $query = "SELECT 
                                    produits.id_produits,
                                    produits.id_fournisseurs, 
                                    fournisseurs.nom_fournisseurs, 
                                    produits.id_categorie_produits, 
                                    categorie_produits.nom_categorie_produits, 
                                    produits.nom_produits, 
                                    produits.prix_produits, 
                                    produits.prix_produits1,
                                    produits.photo_produits1, 
                                    produits.photo_produits2,
                                    produits.created_at_produits, 
                                    produits.updated_at_produits,
                                    produits.description_produits, 
                                    quantite_en_stocks.quantite_quantite_en_stocks,
                                    quantite_en_stocks.seuil_quantite_en_stocks,
                                    stocks.nom_stocks 
                                FROM 
                                    produits 
                                JOIN 
                                    fournisseurs ON produits.id_fournisseurs = fournisseurs.id_fournisseurs 
                                JOIN 
                                    categorie_produits ON produits.id_categorie_produits = categorie_produits.id_categorie_produits 
                                JOIN 
                                    quantite_en_stocks ON produits.id_produits = quantite_en_stocks.id_produits 
                                JOIN 
                                    stocks ON quantite_en_stocks.id_stocks = stocks.id_stocks
                                WHERE 
                                    produits.id_produits = :id
                            ";
                        
                            $stmt = $pdo->prepare($query);
                        
                            try {
                                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                                $stmt->execute();
                                return $stmt->fetch(PDO::FETCH_ASSOC); // Récupérer une seule ligne
                            } catch (PDOException $e) {
                                die("Erreur lors de la récupération des données : " . $e->getMessage());
                            }
                        }
                        
                        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                        // Utilisation de la fonction pour récupérer les données
                        $row = getProduits($id);
                        ?>
                                                        
                        <div class="panel gap-10 lg:flex" x-data="carousel">
                            <div class="mx-auto sm:w-1/2 lg:w-1/3">
                                <div class="sticky top-20 z-[1]">
                                    <!-- basic -->
                                    <div class="swiper mx-auto mb-5 max-w-3xl" id="slider1">
                                        <div class="swiper-wrapper">
                                            <template x-for="item in items">
                                                <div class="swiper-slide">
                                                    <img :src="`${item}`" class="max-h-80 w-full object-cover" alt="image" style="min-height: 400px;" />
                                                </div>
                                            </template>
                                        </div>
                                        <a
                                            href="javascript:;"
                                            class="swiper-button-prev-ex1 absolute top-1/2 z-[999] grid -translate-y-1/2 place-content-center rounded-full border border-primary p-1 text-primary transition hover:border-primary hover:bg-primary hover:text-white ltr:left-2 rtl:right-2"
                                        >
                                            <svg
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 rtl:rotate-180"
                                            >
                                                <path
                                                    d="M15 5L9 12L15 19"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                        </a>
                                        <a
                                            href="javascript:;"
                                            class="swiper-button-next-ex1 absolute top-1/2 z-[999] grid -translate-y-1/2 place-content-center rounded-full border border-primary p-1 text-primary transition hover:border-primary hover:bg-primary hover:text-white ltr:right-2 rtl:left-2"
                                        >
                                            <svg
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 ltr:rotate-180"
                                            >
                                                <path
                                                    d="M15 5L9 12L15 19"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                        </a>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-10 lg:mt-0 lg:w-2/3">
                                
                                <h2 class="mb-3 text-lg font-bold text-dark dark:text-white md:text-xl"><?php echo htmlspecialchars($row["nom_produits"]); ?></h2>
                                <div class="flex flex-wrap gap-4">
                                <?php 
                                    $createdAt = $row['created_at_produits'];
                                    $createdAtU = $row['updated_at_produits'];
                                    // Convertir en timestamp
                                    $timestamp = strtotime($createdAt);
                                    $timestampU = strtotime($createdAtU);
                                    
                                    // Formater la date et l'heure
                                    $date = date('d/m/Y', $timestamp); // Format : jour/mois/année
                                    $time = date('H:i', $timestamp); // Format : heure
                                    $dateU = date('d/m/Y', $timestampU); // Format : jour/mois/année
                                    $timeU = date('H:i', $timestampU); // Format : heure
                                ?>
                                    <div class="">Enregistrer le : <b><?php echo $date; ?></b> à <b><?php echo $time; ?></div>
                                    <div class="">Date de mise à jour : <b><?php echo $dateU; ?></b> à <b><?php echo $timeU; ?></div>
                                </div>
                                <div class="my-4">
                                    <div class="flex" style="gap: 60px;">
                                        <div class="grid">
                                            <div class="mb-1 font-bold text-success">Prix de détail</div>
                                            <span class="text-xl" style="text-align: center;"><b><?php echo htmlspecialchars($row["prix_produits"]); ?> FCFA</b></span>
                                        </div>
                                        <div class="grid">
                                            <div class="mb-1 font-bold text-success">Prix de gros</div>
                                            <span class="text-xl" style="text-align: center;"><b><?php echo htmlspecialchars($row["prix_produits1"]); ?> FCFA</b></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="flex" style="gap: 60px;">
                                        <div class="grid">
                                            <div class="mb-1 font-bold text-success">Quantité en stock</div>
                                            <span class="text-xl" style="text-align: center;"><b><?php echo htmlspecialchars($row["quantite_quantite_en_stocks"]); ?></b></span>
                                        </div>
                                        <div class="grid">
                                            <div class="mb-1 font-bold text-success">Seuil</div>
                                            <span class="text-xl" style="text-align: center;"><b><?php echo htmlspecialchars($row["seuil_quantite_en_stocks"]); ?></b></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <h5 class="mb-3 font-bold">Description :</h5>
                                    <p>
                                    <?php echo htmlspecialchars($row["description_produits"]); ?>
                                    </p>
                                </div>
                                <div class="mt-8">
                                    <div class="mb-5" x-data="{ tab: 'specification'}">
                                        <div>
                                            <ul class="mt-3 mb-5 flex flex-wrap border-b border-white-light dark:border-[#191e3a]">
                                                <li>
                                                    <a
                                                        href="javascript:"
                                                        class="relative -mb-[1px] flex items-center p-5 py-3 font-bold before:absolute before:bottom-0 before:left-0 before:right-0 before:m-auto before:h-[1px] before:w-0 before:bg-primary before:transition-all before:duration-700 hover:text-primary hover:before:w-full"
                                                        :class="{'before:w-full text-primary bg-primary/10' : tab === 'specification'}"
                                                        @click="tab='specification'"
                                                        >Spécifications</a
                                                    >
                                                </li>
                                                <!-- <li>
                                                    <a
                                                        href="javascript:"
                                                        class="relative -mb-[1px] flex items-center p-5 py-3 font-bold before:absolute before:bottom-0 before:left-0 before:right-0 before:m-auto before:h-[1px] before:w-0 before:bg-primary before:transition-all before:duration-700 hover:text-primary hover:before:w-full"
                                                        :class="{'before:w-full text-primary bg-primary/10' : tab === 'details'}"
                                                        @click="tab='details'"
                                                        >Details</a
                                                    >
                                                </li> -->
                                            </ul>
                                        </div>

                                        <div class="flex-1 text-sm">
                                            <template x-if="tab === 'specification'">
                                                <div class="table-responsive mt-5 overflow-x-auto">
                                                    <table class="table-striped table-hover text-left 2xl:w-1/2">
                                                        <tr>
                                                            <td class="font-bold">Catégorie :</td>
                                                            <td><?php echo htmlspecialchars($row["nom_categorie_produits"]); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-bold">Fournisseur :</td>
                                                            <td><?php echo htmlspecialchars($row["nom_fournisseurs"]); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-bold">Stock :</td>
                                                            <td><?php echo htmlspecialchars($row["nom_stocks"]); ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </template>
                                            <!-- <template x-if="tab === 'details'">
                                                <div>
                                                    <h3 class="mb-3 text-lg font-bold md:text-xl">Tommy Hilfiger Sweatshirt for Men (Pink)</h3>
                                                    <p>
                                                        Tommy Hilfiger men striped pink sweatshirt. Crafted with cotton. Material composition is 100% organic
                                                        cotton. This is one of the world’s leading designer lifestyle brands and is internationally recognized
                                                        for celebrating the essence of classic American cool style, featuring preppy with a twist designs.
                                                    </p>
                                                    <ul class="mt-4 list-inside list-disc space-y-2">
                                                        <li>Machine Wash</li>
                                                        <li>Fit Type: Regular</li>
                                                        <li>100% Cotton</li>
                                                        <li>Long sleeve</li>
                                                    </ul>
                                                </div>
                                            </template> -->
                                        </div>
                                    </div>
                                </div>
                                <script>
                                 document.addEventListener('alpine:init', () => {
                                    //Carousel
                                    Alpine.data('carousel', () => ({
                                       items: ['<?php echo htmlspecialchars($row["photo_produits1"]); ?>', '<?php echo htmlspecialchars($row["photo_produits2"]); ?>'],
                   
                                       init() {
                                           // basic
                                           const swiper1 = new Swiper('#slider1', {
                                               navigation: {
                                                   nextEl: '.swiper-button-next-ex1',
                                                   prevEl: '.swiper-button-prev-ex1',
                                               },
                                               pagination: {
                                                   el: '.swiper-pagination',
                                                   clickable: true,
                                               },
                                           });
                                       },
                                   }));
                                 });
                                </script>
                            </div>
                        </div>
                        <!-- autopaly -->

                    </div>
                    <!-- end main content section -->
                </div>

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
