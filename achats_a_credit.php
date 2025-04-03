<?php 
include 'layouts/control.php'; 
// Connexion à la base de données
$pdo = getConnection();

// Charger les emplacements de stock
$stmtStocks = $pdo->query("SELECT id_stocks, nom_stocks FROM stocks");
$stocks = $stmtStocks->fetchAll(PDO::FETCH_ASSOC);

// Charger les produits et leurs quantités disponibles
$stmtProducts = $pdo->query("SELECT 

produits.id_produits,
fournisseurs.nom_fournisseurs, 
categorie_produits.nom_categorie_produits, 
produits.nom_produits, 
produits.unite_produits,
produits.photo_produits1, 
quantite_en_stocks.quantite_quantite_en_stocks,
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

");

$products = $stmtProducts->fetchAll(PDO::FETCH_ASSOC)
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="achats_a_credit";?>

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
                                <a href="javascript:;" class="text-primary hover:underline">Achats</a>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                                <span>Achats à credit</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Modal -->
                    <div id="transferModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2 class="font-semibold text-lg dark:text-white-light flex gap-2" style="padding-bottom:10px; ">Confirmer le transfert des produits sélectionnés</h2>
                            <table id="modalProductsTable">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Unité</th>
                                        <th>Catégorie</th>
                                        <th>Fournisseur</th>
                                        <th>Stock</th>
                                        <th>Quantité</th>
                                        <th>Prix d'achat</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <br>
                            <div class="flex justify-end px-4">
                                <div id="insertArea">
                                </div>
                                <div class="w-full md:w-80 font-semibold">
                                    <div class="flex items-center justify-between py-2">
                                        <span>Total Général :</span>
                                        <span id="totalGeneral">0.00</span> 
                                    </div>
                                </div>
                            </div>
                            <div style=" padding-top:26px; justify-content: end;" class="flex">
                                <button id="finalizeTransferButton" class="btn btn-success">
                                 Confirmer la vente
                            </div>
                        </div>
                    </div>

                    <div x-data="multipleTable">
                        <div class="panel mt-6">
                            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Liste de produit en stock</h5>
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
                                               <th data-sortable="" style="width: 2.4881%;"><span></span></th> 
                                               <th data-sortable="" style="width: 22.4881%;">Nom</th>
                                               <th data-sortable="" style="width: 18.8532%;">Unité</th>
                                               <th data-sortable="" style="width: 22.2901%;">Catégorie</th>
                                               <th data-sortable="" style="width: 20.4881%;">Fournisseur</th>
                                               <th data-sortable="" style="width: 20.4881%;">Stock</th>
                                               <th data-sortable="" style="width: 20.4881%;">Quantité en Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($products as $product): ?>
                                                <tr>
                                                    <td><input type="checkbox" class="form-checkbox text-success" data-id="<?php echo $product['id_produits']; ?>" data-stock="<?php echo $product['quantite_quantite_en_stocks']; ?>"></td>
                                                    <td>
                                                        <div class="flex items-center font-semibold">
                                                            <div class="p-0.5 bg-white-dark/30 rounded-full w-max ltr:mr-2 rtl:ml-2">
                                                                <img class="h-8 w-8 rounded-full object-cover" src="<?php echo $product["photo_produits1"]; ?>">
                                                            </div><?php echo $product["nom_produits"]; ?>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $product['unite_produits']; ?></td>
                                                    <td><?php echo $product['nom_categorie_produits']; ?></td>
                                                    <td><?php echo $product['nom_fournisseurs']; ?></td>
                                                    <td><?php echo $product['nom_stocks']; ?></td>
                                                    <td><?php echo $product['quantite_quantite_en_stocks']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>  
                                        </tbody>
                                    </table>
                                    <div style=" padding-top:26px; justify-content: end;" class="flex">
                                        <button id="confirmTransferButton" class="btn btn-success">
                                         Valider l'achat
                                        </button>
                                    </div>
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
            showMessage = (msg = 'Example notification text.', position = 'bottom-start', showCloseButton = true, closeButtonHtml = '', duration = 3000) => {
               const toast = window.Swal.mixin({
                   toast: true,
                   position: position || 'bottom-start',
                   showConfirmButton: false,
                   timer: duration,
                   showCloseButton: showCloseButton,
                   customClass: {
                       popup: `color-danger`
                   },
               });
               toast.fire({
                   title: msg,
               });
           };
           showMessage1 = (msg = 'Example notification text.', position = 'bottom-start', showCloseButton = true, closeButtonHtml = '', duration = 4000) => {
               const toast = window.Swal.mixin({
                   toast: true,
                   position: position || 'bottom-start',
                   showConfirmButton: false,
                   timer: duration,
                   showCloseButton: showCloseButton,
                   customClass: {
                       popup: `color-success`
                   },
               });
               toast.fire({
                   title: msg,
               });
           };
            document.getElementById('confirmTransferButton').addEventListener('click', function() {
                const modal = document.getElementById('transferModal');
                const modalBody = document.getElementById('modalProductsTable').getElementsByTagName('tbody')[0];
                modalBody.innerHTML = ''; // Réinitialiser le contenu du modal

            
                const checkboxes = document.querySelectorAll('.form-checkbox:checked');
                if (checkboxes.length === 0) {
                    showMessage("Veuillez sélectionner au moins un produit à transférer.", 'top');
                    return;
                }
            
                    checkboxes.forEach(checkbox => {
                    const productRow = checkbox.closest('tr');
                    const productId = checkbox.getAttribute('data-id');
                    const productName = productRow.cells[1].textContent;
                    const productUnite = productRow.cells[2].textContent;
                    const productCategorie = productRow.cells[3].textContent;
                    const productFournisseur = productRow.cells[4].textContent;
                    const productStock = productRow.cells[5].textContent;
                    
                    
                    const transferQuantityInput = document.createElement('input');
                    const prixAchatInput = document.createElement('input');
                    transferQuantityInput.type = 'number';
                    transferQuantityInput.min = '1';
                    transferQuantityInput.value = '1';
                    transferQuantityInput.classList.add('transfer-quantity');
                    prixAchatInput.type = 'number';
                    prixAchatInput.min = '1';
                    prixAchatInput.value = '0';
                    prixAchatInput.classList.add('prix-achat');
            
                    const modalRow = modalBody.insertRow();
                    modalRow.insertCell(0).textContent = productName;
                    modalRow.insertCell(1).textContent = productUnite;
                    modalRow.insertCell(2).textContent = productCategorie;
                    modalRow.insertCell(3).textContent = productFournisseur;
                    modalRow.insertCell(4).textContent = productStock;
                    modalRow.insertCell(5).appendChild(transferQuantityInput);
                    modalRow.insertCell(6).appendChild(prixAchatInput);

                   const idCell = modalRow.insertCell(7);
                   idCell.setAttribute('data-product-id', productId); 
                   idCell.style.display = 'none'; 
                   function calculateTotal() {
                       let total = 0;
                       const quantities = document.querySelectorAll('.transfer-quantity');
                       const prices = document.querySelectorAll('.prix-achat');
               
                       quantities.forEach((quantityInput, index) => {
                           const quantity = parseInt(quantityInput.value) || 0;
                           const price = parseInt(prices[index].value) || 0;
                           total += quantity * price;
                       });
               
                       document.getElementById('totalGeneral').textContent = total.toFixed(2) +' FCFA';
                   }
                    // Ajoutez des écouteurs d'événements pour recalculer le total
                   transferQuantityInput.addEventListener('input', calculateTotal);
                   prixAchatInput.addEventListener('input', calculateTotal);
                });
                
                modal.style.display = "block"; // Afficher le modal
            });
            
            // Gérer la fermetu*re du modal
            document.querySelector('.close').onclick = function() {
                document.getElementById('transferModal').style.display = "none";
            }
            
            // Gérer la confirmation du transfert
            document.getElementById('finalizeTransferButton').addEventListener('click', function() {
                const transfers = [];
            
                const modalRows = document.querySelectorAll('#modalProductsTable tbody tr');
                modalRows.forEach(row => {
                    //const productId = row.cells[6].textContent;
                    const productId = row.cells[7].getAttribute('data-product-id');
                    const quantityInput = row.cells[5].querySelector('input[type="number"]');
                    const prixInput = row.cells[6].querySelector('input[type="number"]');
                    const quantity = quantityInput.value ;
                    const prix = prixInput.value ;
            
                    if (quantity > 0) {
                        transfers.push({ id: productId, quantity: quantity, prix: prix });
                    }
                    console.log(transfers); // Vérifiez le contenu du tableau
                });
            
                fetch('confirmationAchatCredit.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({transfers: transfers }),
                })
                .then(response => response.json())
                .then(data => {
                    showMessage(data.message, 'top');   
                    if (data.success) {
                        showMessage1(data.message, 'top');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                })
                .catch(error => console.error('Erreur:', error));
            
                // Fermer le modal après la confirmation
                document.getElementById('transferModal').style.display = "none";
            });
            
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
            });
        </script>
    </body>
</html>
