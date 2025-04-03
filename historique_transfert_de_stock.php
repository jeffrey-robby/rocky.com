<?php 
include 'layouts/control.php'; 
// Connexion à la base de données
$pdo = getConnection();

?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="historique_transfert_de_stock";?>

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
                                <a href="javascript:;" class="text-primary hover:underline">Gestion des stocks</a>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                                <span>Historique Transfert de stock</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-5">
                        <div class="mb-6 grid gap-6 xl:grid-cols-1">
                            <div class="panel h-full">  
                                <div class="overflow-hidden">
                                    <form id="dateForm" class="mb-4">
                                        <div class="flex gap-10" style="justify-content: space-around;">
                                            <div class="grid">
                                                <label for="date_debut" class="block mb-2">Date de début :</label>
                                                <input style="width: 400px;" type="datetime-local" id="date_debut" name="date_debut" class="border rounded p-2 mb-4" required>
                                            </div>
                                            <div class="grid">
                                                <label for="date_fin" class="block mb-2">Date de fin :</label>
                                                <input style="width: 400px;" type="datetime-local" id="date_fin" name="date_fin" class="border rounded p-2 mb-4" required>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-data="multipleTable">
                        <div class="panel mt-6">
                            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Liste des utilisateurs</h5>
                            <?php if (isset($_SESSION['successMessage'])) { echo '<script>' . $_SESSION['successMessage'] . '</script>'; unset($_SESSION['successMessage']); } ?>
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns" id="abId0.3250869166938237">
                                <div class="dataTable-top" id="abId0.397956039698075">
                                    <div class="dataTable-search" id="abId0.5122031502181841" abineguid="A0E97C7BBC3449D6B75C6991A1BD54CB">
                                        <input class="dataTable-input" id="search" placeholder="Recherche..." type="text">
                                    </div>
                                </div>
                                <div class="dataTable-container">
                                    <table id="productsTable" class="whitespace-nowrap dataTable-table">
                                        <thead>
                                            <tr>
                                                <th data-sortable="" style="width: 22.4881%;">Nom</th>
                                                <th data-sortable="" style="width: 18.8532%;">Unité</th>
                                                <th data-sortable="" style="width: 20.4881%;">Du stock</th>
                                                <th data-sortable="" style="width: 20.4881%;">Au stock</th>
                                                <th data-sortable="" style="width: 20.4881%;">Quantité transféré</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    <script>
        $(document).ready(function() {
            // Fonction pour charger les résultats du mois en cours
            function loadCurrentMonthData() {
                const today = new Date();
                const year = today.getFullYear();
                const month = today.getMonth();

                // Date de début : premier jour du mois en cours
                const dateDebut = new Date(year, month, 1).toISOString().slice(0, 19);
                
                // Date de fin : dernier jour du mois en cours
                const dateFin = new Date(year, month + 1, 0).toISOString().slice(0, 19);

                fetchData(dateDebut, dateFin);
            }

            loadCurrentMonthData();

            // Événement pour changer la période
            $('#date_debut, #date_fin').change(function() {
                const dateDebut = $('#date_debut').val();
                const dateFin = $('#date_fin').val();

                if (dateDebut && dateFin) {
                    fetchData(dateDebut, dateFin);
                }
            });

            // Fonction pour récupérer les données
            function fetchData(dateDebut, dateFin) {
                $.ajax({
                    url: 'fetch_transfert_de_stock.php',
                    type: 'POST',
                    data: {
                        date_debut: dateDebut,
                        date_fin: dateFin
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        updateTable(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Erreur AJAX : ", textStatus, errorThrown);
                    }
                });
            }

            // Fonction pour mettre à jour le tableau
            function updateTable(data) {
                const tbody = $('#productsTable tbody');
                tbody.empty(); // Vider le tableau avant d'ajouter de nouvelles données

                if (data.length > 0) {
                    data.forEach(item => {
                        const row = `<tr>
                            <td class="border">${item.nom_produits}</td>
                            <td class="border">${item.unite_produits}</td>
                            <td class="border">${item.nom_stocks}</td>
                            <td class="border">${item.nom_stocks}</td>
                            <td class="border">${item.quantite_historique_transfert}</td>
                        </tr>`;
                        tbody.append(row);
                    });
                } else {
                    tbody.append('<tr><td colspan="5" class="border">Aucune donnée disponible pour cette période.</td></tr>');
                }
            }
        });
    </script>
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
                    $('#productsTable tbody tr').each(function() {
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
                document.addEventListener("DOMContentLoaded", function(e) {
                    // seachable 
                    var options = {
                        searchable: true
                    };
                    NiceSelect.bind(document.getElementById("to_stock"), options);
                    NiceSelect.bind(document.getElementById("fromStock"), options);
                });
            });
        </script>
    </body>
</html>
