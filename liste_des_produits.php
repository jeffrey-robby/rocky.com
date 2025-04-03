<?php 
include 'layouts/control.php'; 
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
                    <div>
                        <ul class="flex space-x-2 rtl:space-x-reverse">
                            <li>
                                <a href="javascript:;" class="text-primary hover:underline">Produits</a>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                                <span>Liste produit</span>
                            </li>
                        </ul>
                        
                    </div>
                    <div x-data="multipleTable">
                        <div class="panel mt-6">
                            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Liste des Produits</h5>
                            <?php if (isset($_SESSION['successMessage'])) { echo '<script>' . $_SESSION['successMessage'] . '</script>'; unset($_SESSION['successMessage']); } ?>
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns" id="abId0.3250869166938237">
                                <div class="dataTable-top" id="abId0.397956039698075">
                                    <div class="dataTable-search" id="abId0.5122031502181841" abineguid="A0E97C7BBC3449D6B75C6991A1BD54CB">
                                        <input class="dataTable-input" id="search" placeholder="Recherche..." type="text">
                                    </div>
                                </div>
                                <div class="dataTable-container scroll-bar">
                                    <?php
                                        // Récupérer les données de la table personnels
                                        function getProduits() {
                                            $pdo = getConnection();
                                        
                                            $query = "SELECT 
                                                produits.id_produits,
                                                produits.id_fournisseurs, 
                                                fournisseurs.nom_fournisseurs, 
                                                produits.id_categorie_produits, 
                                                categorie_produits.nom_categorie_produits, 
                                                produits.nom_produits, 
                                                produits.unite_produits,
                                                produits.prix_produits, 
                                                produits.prix_produits1,
                                                produits.photo_produits1, 
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
                                        ";
                                            $stmt = $pdo->prepare($query);
                                            
                                            try {
                                                $stmt->execute();
                                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer toutes les données dans un tableau associatif
                                                return $data;
                                            } catch (PDOException $e) {
                                                die("Erreur lors de la récupération des données : " . $e->getMessage());
                                            }
                                        }
                                        // Utilisation de la fonction pour récupérer les données
                                        $produits = getProduits();
                                    ?>
                                    <table id="myTable2" class="whitespace-nowrap dataTable-table">
                                        <thead>
                                            <tr>
                                               <th data-sortable="" style="width: 20.4881%;">Nom</th>
                                               <th data-sortable="" style="width: 20.4881%;">Quantité</th>
                                               <th data-sortable="" style="width: 22.8532%;">Seuil</th>
                                               <th data-sortable="" style="width: 22.8532%;">Unité</th>
                                               <th data-sortable="" style="width: 22.2901%;">Prix de détail</th>
                                               <th data-sortable="" style="width: 22.2901%;">Prix de gros</th>
                                               <th data-sortable="" style="width: 22.2901%;">Catégorie</th>
                                               <th data-sortable="" style="width: 20.4881%;">Fournisseur</th>
                                               <th data-sortable="" style="width: 20.4881%;">Stock</th>
                                               <th data-sortable="false" style="width: 26.6212%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($produits as $row): ?>
                                                <tr>
                                                    <td>
                                                        <div class="flex items-center font-semibold">
                                                            <div class="p-0.5 bg-white-dark/30 rounded-full w-max ltr:mr-2 rtl:ml-2">
                                                                <img class="h-8 w-8 rounded-full object-cover" src="<?php echo htmlspecialchars($row["photo_produits1"]); ?>">
                                                            </div><?php echo htmlspecialchars($row["nom_produits"]); ?>
                                                        </div>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($row["quantite_quantite_en_stocks"]); ?></td>
                                                    <td><?php echo htmlspecialchars($row["seuil_quantite_en_stocks"]); ?></td>
                                                    <td><?php echo htmlspecialchars($row["unite_produits"]); ?></td>
                                                    <td><?php echo htmlspecialchars($row["prix_produits"]); ?> <b>FCFA</b></td>
                                                    <td><?php echo htmlspecialchars($row["prix_produits1"]); ?> <b>FCFA</b></td>
                                                    <td><?php echo htmlspecialchars($row["nom_categorie_produits"]); ?></td>
                                                    <td><?php echo htmlspecialchars($row["nom_fournisseurs"]); ?></td>
                                                    <td><?php echo htmlspecialchars($row["nom_stocks"]); ?></td>
                                                    <td><?php  echo "<div class=\"flex items-center\">
                                                    <button type=\"button\" class=\"ltr:mr-2 rtl:ml-2\" x-tooltip=\"Modifier\">
                                                        <a href=\"editer_un_produit.php?id=$row[id_produits]\">
                                                        <svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"h-4.5 w-4.5 text-success\">
                                                            <path d=\"M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                                            <path opacity=\"0.5\" d=\"M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                                        </svg></a>
                                                    </button>
                                                    <button type=\"button\" class=\"ltr:mr-2 rtl:ml-2\" x-tooltip=\"Voir\">
                                                        <a href=\"voir_un_produit.php?id=$row[id_produits]\">
                                                        <svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"w-5 h-5 text-primary\">
                                                             <path opacity=\"0.5\" d=\"M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                                             <path d=\"M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                                        </svg></a>
                                                    </button>
                      
                                                    <button type=\"button\" x-tooltip=\"Supprimer\" onClick=\"showAlert$row[id_produits]()\">
                                                    <script>
                                                    async function showAlert$row[id_produits]() {
                                                        new window.Swal({
                                                            icon: 'warning',
                                                            title: 'Êtes-vous sûr de vous?',
                                                            text: \"Cette action est irréversible !\",
                                                            showCancelButton: true,
                                                            confirmButtonText: 'Oui',
                                                            padding: '2em',
                                                        }).then((result) => {
                                                            if (result.value) {
                                                                new window.Swal('Supprimer !', 'Le personnel a été supprimé.', 'success');
                                                                setTimeout(function() {
                                                                    window.location.href = \"supprimer_un_produit.php?id=$row[id_produits]\";
                                                                  }, 1000);
                                                            }
                                                        });
                                                    }
                                                </script>       
                                                        <svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5 text-danger\">
                                                            <path opacity=\"0.5\" d=\"M9.17065 4C9.58249 2.83481 10.6937 2 11.9999 2C13.3062 2 14.4174 2.83481 14.8292 4\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                            <path d=\"M20.5001 6H3.5\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                            <path d=\"M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                            <path opacity=\"0.5\" d=\"M9.5 11L10 16\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                            <path opacity=\"0.5\" d=\"M14.5 11L14 16\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                        </svg>
                                                    </button>   
                                                   </div>"; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- Message d'erreur -->
                                    <p id="error-message" style="display: none; margin: 10px;">Aucun résultat trouvé.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- end main content section -->
                     <br>
                     <!-- start footer section -->
                     <?php include 'layouts/footer.php'; ?>
                     <!-- end footer section -->
                </div>
            </div>
        </div>

        <?php include 'layouts/footer_js.php'; ?>

        <script>
            $(document).ready(function() {
                // Détecter les changements dans le champ de recherche
                $('#search').on('input', function() {
                    var searchText = $(this).val().toLowerCase();
                    var found = false; // Variable pour suivre si un résultat a été trouvé
                    
                    // Filtrer les lignes du tableau qui correspondent à la recherche
                    $('#myTable2 tbody tr').each(function() {
                        var rowData = $(this).text().toLowerCase();
                        if (rowData.indexOf(searchText) === -1) {
                            $(this).hide();
                        } else {
                            $(this).show();
                            found = true; // Un résultat a été trouvé
                        }
                    });
                    
                    // Afficher ou masquer le message d'erreur en fonction du résultat de recherche
                    if (found) {
                        $('#error-message').hide();
                    } else {
                        $('#error-message').show();
                    }
                });
            });
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

                document.addEventListener("alpine:init", () => {
                    Alpine.data("multipleTable", () => ({
                        datatable2: null,
                        init() {
                            this.datatable2 = new simpleDatatables.DataTable('#myTable2', {
                                
                                searchable: true,
                                perPage: 10,
                                perPageSelect: [10, 20, 30],
                                columns: [
                                    {
                                        select: 4,
                                        render: (data, cell, row) => {
                                            return this.formatDate(data);
                                        },
                                    },
                                    {
                                        select: 4,
                                        sortable: false,
                                        render: (data, cell, row) => {
                                            return `
                                                        <div class="flex items-center">
                                                        <button type="button" class="ltr:mr-2 rtl:ml-2" x-tooltip="Modifier">
                                                            <a href="editer_utilisateur.php?">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
                                                                <path d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z" stroke="currentColor" stroke-width="1.5" />
                                                                <path opacity="0.5" d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015" stroke="currentColor" stroke-width="1.5" />
                                                            </svg></a>
                                                        </button>
                
                                                        <button type="button" x-tooltip="Supprimer">
                                                           <a href="supprimer_utilisateur.php">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                                                <path opacity="0.5" d="M9.17065 4C9.58249 2.83481 10.6937 2 11.9999 2C13.3062 2 14.4174 2.83481 14.8292 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                                <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                                <path d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                                <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                                <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                            </svg></a>
                                                        </button>          
                                                    </div>`;
                                        },
                                    }
                                ],
                                firstLast: true,
                                firstText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                                lastText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                                prevText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                                nextText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                                labels: {
                                    perPage: "{select}"
                                },
                                layout: {
                                    top: "{search}",
                                    bottom: "{info}{select}{pager}",
                                },
                            });
                        },
                        formatDate(date) {
                            if (date) {
                                const dt = new Date(date);
                                const month = dt.getMonth() + 1 < 10 ? '0' + (dt.getMonth() + 1) : dt.getMonth() + 1;
                                const day = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
                                return day + '/' + month + '/' + dt.getFullYear();
                            }
                            return '';
                        },
                    }));
                });
            });
        </script>
    </body>
</html>
