<?php 
include 'layouts/control.php'; 
// Établir la connexion à la base de données
$db = getConnection();

// Récupérer les clients, catégories, fournisseurs et produits
$clients = $db->query("SELECT * FROM clients")->fetchAll(PDO::FETCH_ASSOC);
$categories = $db->query("SELECT * FROM categorie_produits")->fetchAll(PDO::FETCH_ASSOC);
$fournisseurs = $db->query("SELECT * FROM fournisseurs")->fetchAll(PDO::FETCH_ASSOC);
$stocks = $db->query("SELECT * FROM stocks")->fetchAll(PDO::FETCH_ASSOC);
$produits = $db->query("SELECT 
        produits.*, 
        quantite_en_stocks.quantite_quantite_en_stocks, 
        quantite_en_stocks.id_stocks, 
        categorie_produits.nom_categorie_produits 
    FROM 
        produits 
    JOIN 
        quantite_en_stocks ON produits.id_produits = quantite_en_stocks.id_produits 
    JOIN 
        categorie_produits ON produits.id_categorie_produits = categorie_produits.id_categorie_produits 
")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="faire_une_vente"; ?>

    <body
        x-data="main"
        class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased vertical full ltr toggle-sidebar"
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
                        <div class="xl:flex gap-4" style="margin-bottom:24px;">
                            <div class="grow space-y-5">
                                <div class="panel p-0">
                                    <div class="flex items-center justify-between p-4 border-b dark:border-[#191e3a]">
                                    <?php if ( $code === 'P') {
                                      echo "
                                      <button onclick=\"window.location.href='ajouter_un_client.php'\" type=\"button\" class=\"btn btn-success\">
                                          <svg class=\"shrink-0 group-hover:!text-primary\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                              <circle opacity=\"0.5\" cx=\"15\" cy=\"6\" r=\"3\" fill=\"currentColor\"></circle>
                                              <ellipse opacity=\"0.5\" cx=\"16\" cy=\"17\" rx=\"5\" ry=\"3\" fill=\"currentColor\"></ellipse>
                                              <circle cx=\"9.00098\" cy=\"6\" r=\"4\" fill=\"currentColor\"></circle>
                                              <ellipse cx=\"9.00098\" cy=\"17.001\" rx=\"7\" ry=\"4\" fill=\"currentColor\"></ellipse>
                                          </svg> Nouveau Client
                                      </button>
                                      ";
                                    }?>
                                        <div class="relative" style="width: 80%; top: 5px;">
                                            <select id="clientSelect">
                                                <option value="" selected>Veuillez Sélectionner un client</option>
                                                <?php foreach ($clients as $client): ?>
                                                <option value="<?= $client['id_clients'] ?>" data-type="<?= $client['type_clients'] ?>"><?= $client['nom_clients'] . ' ' . $client['prenom_clients'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <select id="id_personnel" style="display:none;">
                                                    <option value="<?php echo $id_perso ;?>"></option>
                                            </select>
                                            <div style="display: none;" class="relative border border-white-dark/20" >
                                                <input type="text" id="clientSearch" placeholder="Rechercher un client..." class="form-input border-0 border-l rounded-none bg-white  focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none py-3" />
                                            </div>
                                            <div style="display: none;" id="clientResults" style="display: none; border: 1px solid #ccc; max-height: 150px; overflow-y: auto; background: white;"></div>
                                            <div style="display: none;" id="selectedClientMessage" class="font-bold" style="margin-top: 10px;"></div>
                                        </div>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table id="venteTable" class="w-[800px] md:w-full">
                                            <thead>
                                                <tr>
                                                    <th class="font-bold">Désignation</th>
                                                    <th class="font-bold">Unité</th>
                                                    <th class="font-bold">Prix</th>
                                                    <th class="font-bold">Quantité</th>
                                                    <th class="font-bold">Total</th>
                                                    <th class="font-bold">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="flex justify-end px-4">
                                        <div class="w-full md:w-80 font-semibold">
                                            <div class="flex items-center justify-between py-2">
                                                <span>Total :</span>
                                                <span id="totalAmount">0</span>
                                            </div>
                                            <div class="flex items-center justify-between py-2" style="display:none">
                                                <div>Réduction :</div>
                                                <input class="border-0 border-l rounded-none focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" type="number" id="discount" placeholder="Pourcentage de réduction" value="" style="padding-bottom: 10px;padding-left: 6px; padding-top: 10px;background-color: #f1f1f1;">
                                            </div>
                                            <div class="flex items-center justify-between font-bold py-4 border-t dark:border-t-dark border-dashed">
                                                <span>Total à payer :</span>
                                                <span id="totalAfterDiscount">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel" style="width: max-content">
                                    <div style="padding: 16px;"> 
                                        <label class="inline-flex" style="margin-bottom: 18px;">
                                            <input type="checkbox" id="generateInvoice" class="form-checkbox text-success" />
                                            <span class="font-bold">Générer une facture</span>
                                        </label>
                                        <div id="invoiceFormat" style="display:none;">
                                            <label class="inline-flex" style="margin-right: 20px;">
                                                <input type="radio" name="format" value="A4" class="form-radio peer"/>
                                                <span class="peer-checked:text-primary"> A4</span>
                                            </label>
                                            <label class="inline-flex" style="margin-right: 20px;">
                                                <input type="radio" name="format" value="A5" class="form-radio text-success peer" />
                                                <span class="peer-checked:text-success"> A5</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div style="padding: 16px; padding-top:0px; gap:16px;justify-content: flex-start;" class="flex">
                                        <button id="venteACredit" type="button" class="btn btn-primary">
                                        <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.5" d="M3 10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3 19.6569 3 17.7712 3 14V10Z" fill="currentColor"></path>
                                            <path d="M16.5189 16.5013C16.6939 16.3648 16.8526 16.2061 17.1701 15.8886L21.1275 11.9312C21.2231 11.8356 21.1793 11.6708 21.0515 11.6264C20.5844 11.4644 19.9767 11.1601 19.4083 10.5917C18.8399 10.0233 18.5356 9.41561 18.3736 8.94849C18.3292 8.82066 18.1644 8.77687 18.0688 8.87254L14.1114 12.8299C13.7939 13.1474 13.6352 13.3061 13.4987 13.4811C13.3377 13.6876 13.1996 13.9109 13.087 14.1473C12.9915 14.3476 12.9205 14.5606 12.7786 14.9865L12.5951 15.5368L12.3034 16.4118L12.0299 17.2323C11.9601 17.4419 12.0146 17.6729 12.1708 17.8292C12.3271 17.9854 12.5581 18.0399 12.7677 17.9701L13.5882 17.6966L14.4632 17.4049L15.0135 17.2214L15.0136 17.2214C15.4394 17.0795 15.6524 17.0085 15.8527 16.913C16.0891 16.8004 16.3124 16.6623 16.5189 16.5013Z" fill="currentColor"></path>
                                            <path d="M22.3665 10.6922C23.2112 9.84754 23.2112 8.47812 22.3665 7.63348C21.5219 6.78884 20.1525 6.78884 19.3078 7.63348L19.1806 7.76071C19.0578 7.88348 19.0022 8.05496 19.0329 8.22586C19.0522 8.33336 19.0879 8.49053 19.153 8.67807C19.2831 9.05314 19.5288 9.54549 19.9917 10.0083C20.4545 10.4712 20.9469 10.7169 21.3219 10.847C21.5095 10.9121 21.6666 10.9478 21.7741 10.9671C21.945 10.9978 22.1165 10.9422 22.2393 10.8194L22.3665 10.6922Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25 9C7.25 8.58579 7.58579 8.25 8 8.25H14.5C14.9142 8.25 15.25 8.58579 15.25 9C15.25 9.41421 14.9142 9.75 14.5 9.75H8C7.58579 9.75 7.25 9.41421 7.25 9ZM7.25 13C7.25 12.5858 7.58579 12.25 8 12.25H11C11.4142 12.25 11.75 12.5858 11.75 13C11.75 13.4142 11.4142 13.75 11 13.75H8C7.58579 13.75 7.25 13.4142 7.25 13ZM7.25 17C7.25 16.5858 7.58579 16.25 8 16.25H9.5C9.91421 16.25 10.25 16.5858 10.25 17C10.25 17.4142 9.91421 17.75 9.5 17.75H8C7.58579 17.75 7.25 17.4142 7.25 17Z" fill="currentColor"></path>
                                        </svg> Vendre à crédit
                                        </button>
                                        <button id="devis" type="button" class="btn btn-warning">
                                            <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V10C2 6.22876 2 4.34315 3.17157 3.17157C4.34315 2 6.23869 2 10.0298 2C10.6358 2 11.1214 2 11.53 2.01666C11.5166 2.09659 11.5095 2.17813 11.5092 2.26057L11.5 5.09497C11.4999 6.19207 11.4998 7.16164 11.6049 7.94316C11.7188 8.79028 11.9803 9.63726 12.6716 10.3285C13.3628 11.0198 14.2098 11.2813 15.0569 11.3952C15.8385 11.5003 16.808 11.5002 17.9051 11.5001L18 11.5001H21.9574C22 12.0344 22 12.6901 22 13.5629V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22Z" fill="currentColor"></path>
                                            <path d="M6 13.75C5.58579 13.75 5.25 14.0858 5.25 14.5C5.25 14.9142 5.58579 15.25 6 15.25H14C14.4142 15.25 14.75 14.9142 14.75 14.5C14.75 14.0858 14.4142 13.75 14 13.75H6Z" fill="currentColor"></path>
                                            <path d="M6 17.25C5.58579 17.25 5.25 17.5858 5.25 18C5.25 18.4142 5.58579 18.75 6 18.75H11.5C11.9142 18.75 12.25 18.4142 12.25 18C12.25 17.5858 11.9142 17.25 11.5 17.25H6Z" fill="currentColor"></path>
                                            <path d="M11.5092 2.2601L11.5 5.0945C11.4999 6.1916 11.4998 7.16117 11.6049 7.94269C11.7188 8.78981 11.9803 9.6368 12.6716 10.3281C13.3629 11.0193 14.2098 11.2808 15.057 11.3947C15.8385 11.4998 16.808 11.4997 17.9051 11.4996L21.9574 11.4996C21.9698 11.6552 21.9786 11.821 21.9848 11.9995H22C22 11.732 22 11.5983 21.9901 11.4408C21.9335 10.5463 21.5617 9.52125 21.0315 8.79853C20.9382 8.6713 20.8743 8.59493 20.7467 8.44218C19.9542 7.49359 18.911 6.31193 18 5.49953C17.1892 4.77645 16.0787 3.98536 15.1101 3.3385C14.2781 2.78275 13.862 2.50487 13.2915 2.29834C13.1403 2.24359 12.9408 2.18311 12.7846 2.14466C12.4006 2.05013 12.0268 2.01725 11.5 2.00586L11.5092 2.2601Z" fill="currentColor"></path>
                                            </svg> Devis
                                        </button>
                                        <button id="multiple" type="button" class="btn btn-secondary">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ltr:mr-2 rtl:ml-2">
                                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                                            <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5"></ellipse>
                                            </svg> Paiement multiple
                                        </button>
                                        <button id="conlcureLaVente" type="button" class="btn btn-success">
                                             <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="currentColor"></path>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M12 5.25C12.4142 5.25 12.75 5.58579 12.75 6V6.31673C14.3804 6.60867 15.75 7.83361 15.75 9.5C15.75 9.91421 15.4142 10.25 15 10.25C14.5858 10.25 14.25 9.91421 14.25 9.5C14.25 8.82154 13.6859 8.10339 12.75 7.84748V11.3167C14.3804 11.6087 15.75 12.8336 15.75 14.5C15.75 16.1664 14.3804 17.3913 12.75 17.6833V18C12.75 18.4142 12.4142 18.75 12 18.75C11.5858 18.75 11.25 18.4142 11.25 18V17.6833C9.61957 17.3913 8.25 16.1664 8.25 14.5C8.25 14.0858 8.58579 13.75 9 13.75C9.41421 13.75 9.75 14.0858 9.75 14.5C9.75 15.1785 10.3141 15.8966 11.25 16.1525V12.6833C9.61957 12.3913 8.25 11.1664 8.25 9.5C8.25 7.83361 9.61957 6.60867 11.25 6.31673V6C11.25 5.58579 11.5858 5.25 12 5.25ZM11.25 7.84748C10.3141 8.10339 9.75 8.82154 9.75 9.5C9.75 10.1785 10.3141 10.8966 11.25 11.1525V7.84748ZM14.25 14.5C14.25 13.8215 13.6859 13.1034 12.75 12.8475V16.1525C13.6859 15.8966 14.25 15.1785 14.25 14.5Z" fill="currentColor"></path>
                                             </svg>Conclure la vente
                                        </button>
                                        <button onclick="window.location.href='faire_une_vente.php'" id="cancelButton" type="button" class="btn btn-danger">
                                            <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg> Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal vente à credit -->
                            <div id="venteACreditMobal" class="modal" style="display:none;">
                                <div class="modal-content">
                                    <span class="close" id="closeVenteACreditMobal" style="color: red; background: none; border: none; cursor: pointer; font-size: 34px;padding: 10px;">&times;</span>
                                    <h2 class="font-bold" style="font-size: 20px; color: red;">Confirmation de la vente à crédit</h2>
                                    <table class="w-[800px] md:w-full">
                                        <thead>
                                            <tr>
                                                <th class="font-bold">Désignation</th>
                                                <th class="font-bold">Unité</th>
                                                <th class="font-bold">Prix</th>
                                                <th class="font-bold">Quantité</th>
                                                <th class="font-bold">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                                        <span class="font-bold">Note</span>
                                        <textarea id="note" placeholder="Entrer une note" rows="4" class="form-textarea" required></textarea>
                                    </div>
                                    <div class="flex justify-end px-4">
                                        <div class="w-full md:w-80 font-semibold">
                                            <div class="flex items-center justify-between py-2">
                                                <span>Total Général :</span>
                                                <span id="totalGeneralVenteACredit">0 FCFA</span>
                                            </div>
                                            <div class="flex items-center justify-between py-2">
                                                <label for="globalDiscountVenteACredit">Réduction (%):</label>
                                                <input class="border-0 border-l rounded-none focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" type="number" id="globalDiscountVenteACredit" value="0" min="0" max="100" placeholder="Pourcentage de réduction" style="padding-bottom: 10px;padding-left: 6px; padding-top: 10px;background-color: #f1f1f1;">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding: 16px; gap:16px;justify-content: space-around;" class="flex">
                                        <button id="confirmVenteACredit" type="button" class="btn btn-success">
                                        <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V10C2 6.22876 2 4.34315 3.17157 3.17157C4.34315 2 6.23869 2 10.0298 2C10.6358 2 11.1214 2 11.53 2.01666C11.5166 2.09659 11.5095 2.17813 11.5092 2.26057L11.5 5.09497C11.4999 6.19207 11.4998 7.16164 11.6049 7.94316C11.7188 8.79028 11.9803 9.63726 12.6716 10.3285C13.3628 11.0198 14.2098 11.2813 15.0569 11.3952C15.8385 11.5003 16.808 11.5002 17.9051 11.5001L18 11.5001H21.9574C22 12.0344 22 12.6901 22 13.5629V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22Z" fill="currentColor"></path>
                                            <path d="M6 13.75C5.58579 13.75 5.25 14.0858 5.25 14.5C5.25 14.9142 5.58579 15.25 6 15.25H14C14.4142 15.25 14.75 14.9142 14.75 14.5C14.75 14.0858 14.4142 13.75 14 13.75H6Z" fill="currentColor"></path>
                                            <path d="M6 17.25C5.58579 17.25 5.25 17.5858 5.25 18C5.25 18.4142 5.58579 18.75 6 18.75H11.5C11.9142 18.75 12.25 18.4142 12.25 18C12.25 17.5858 11.9142 17.25 11.5 17.25H6Z" fill="currentColor"></path>
                                            <path d="M11.5092 2.2601L11.5 5.0945C11.4999 6.1916 11.4998 7.16117 11.6049 7.94269C11.7188 8.78981 11.9803 9.6368 12.6716 10.3281C13.3629 11.0193 14.2098 11.2808 15.057 11.3947C15.8385 11.4998 16.808 11.4997 17.9051 11.4996L21.9574 11.4996C21.9698 11.6552 21.9786 11.821 21.9848 11.9995H22C22 11.732 22 11.5983 21.9901 11.4408C21.9335 10.5463 21.5617 9.52125 21.0315 8.79853C20.9382 8.6713 20.8743 8.59493 20.7467 8.44218C19.9542 7.49359 18.911 6.31193 18 5.49953C17.1892 4.77645 16.0787 3.98536 15.1101 3.3385C14.2781 2.78275 13.862 2.50487 13.2915 2.29834C13.1403 2.24359 12.9408 2.18311 12.7846 2.14466C12.4006 2.05013 12.0268 2.01725 11.5 2.00586L11.5092 2.2601Z" fill="currentColor"></path>
                                            </svg>Confirmer la vente à crédit
                                        </button>
                                        <button onclick="window.location.href='faire_une_vente.php'" id="cancelButton" type="button" class="btn btn-danger">
                                            <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg> Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal devis -->
                            <div id="devisMobal" class="modal" style="display:none;">
                                <div class="modal-content">
                                    <span class="close" id="closeDevisMobal" style="color: red; background: none; border: none; cursor: pointer; font-size: 34px;padding: 10px;">&times;</span>
                                    <h2 class="font-bold" style="font-size: 20px; color: red;">Confirmation de devis</h2>
                                    <table class="w-[800px] md:w-full">
                                        <thead>
                                            <tr>
                                                <th class="font-bold">Désignation</th>
                                                <th class="font-bold">Unité</th>
                                                <th class="font-bold">Prix</th>
                                                <th class="font-bold">Quantité</th>
                                                <th class="font-bold">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="flex justify-end px-4">
                                        <div class="w-full md:w-80 font-semibold">
                                            <div class="flex items-center justify-between py-2">
                                                <span>Total Général :</span>
                                                <span id="totalGeneralDevis">0 FCFA</span>
                                            </div>
                                            <div class="flex items-center justify-between py-2">
                                                <label for="globalDiscountDevis">Réduction (%):</label>
                                                <input class="border-0 border-l rounded-none focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" type="number" id="globalDiscountDevis" value="0" min="0" max="100" placeholder="Pourcentage de réduction" style="padding-bottom: 10px;padding-left: 6px; padding-top: 10px;background-color: #f1f1f1;">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding: 16px; gap:16px;justify-content: space-around;" class="flex">
                                        <button id="confirmDevis" type="button" class="btn btn-success">
                                            <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 5.25C12.4142 5.25 12.75 5.58579 12.75 6V6.31673C14.3804 6.60867 15.75 7.83361 15.75 9.5C15.75 9.91421 15.4142 10.25 15 10.25C14.5858 10.25 14.25 9.91421 14.25 9.5C14.25 8.82154 13.6859 8.10339 12.75 7.84748V11.3167C14.3804 11.6087 15.75 12.8336 15.75 14.5C15.75 16.1664 14.3804 17.3913 12.75 17.6833V18C12.75 18.4142 12.4142 18.75 12 18.75C11.5858 18.75 11.25 18.4142 11.25 18V17.6833C9.61957 17.3913 8.25 16.1664 8.25 14.5C8.25 14.0858 8.58579 13.75 9 13.75C9.41421 13.75 9.75 14.0858 9.75 14.5C9.75 15.1785 10.3141 15.8966 11.25 16.1525V12.6833C9.61957 12.3913 8.25 11.1664 8.25 9.5C8.25 7.83361 9.61957 6.60867 11.25 6.31673V6C11.25 5.58579 11.5858 5.25 12 5.25ZM11.25 7.84748C10.3141 8.10339 9.75 8.82154 9.75 9.5C9.75 10.1785 10.3141 10.8966 11.25 11.1525V7.84748ZM14.25 14.5C14.25 13.8215 13.6859 13.1034 12.75 12.8475V16.1525C13.6859 15.8966 14.25 15.1785 14.25 14.5Z" fill="currentColor"></path>
                                            </svg>Confirmer la vente
                                        </button>
                                        <button onclick="window.location.href='faire_une_vente.php'" id="cancelButton" type="button" class="btn btn-danger">
                                            <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg> Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal paiement multiple -->
                            <div id="multipleMobal" class="modal" style="display:none;">
                                <div class="modal-content">
                                    <span class="close" id="closeMultipleMobal" style="color: red; background: none; border: none; cursor: pointer; font-size: 34px;padding: 10px;">&times;</span>
                                    <h2 class="font-bold" style="font-size: 20px; color: red;">Confirmation de paiement multiple</h2>
                                    <table class="w-[800px] md:w-full">
                                        <thead>
                                            <tr>
                                                <th class="font-bold">Désignation</th>
                                                <th class="font-bold">Unité</th>
                                                <th class="font-bold">Prix</th>
                                                <th class="font-bold">Quantité</th>
                                                <th class="font-bold">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody> 
                                    </table>
                                    <br> 
                                    <div class="flex justify-end px-4">
                                        <div class="flex items-center justify-between py-2" >
                                            <span>Montant de l'avance :</span>
                                            <input class="border-0 border-l rounded-none focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" type="number" id="avance" placeholder="Montant de l'avance" value="" style="background-color: #f1f1f1; margin: 14px; padding: 10px;">
                                        </div>
                                        <div class="w-full md:w-80 font-semibold">
                                            <div class="flex items-center justify-between py-2">
                                                <span>Total Général :</span>
                                                <span id="totalGeneralMultiple">0 FCFA</span>
                                            </div>
                                            <div class="flex items-center justify-between py-2">
                                                <label for="globalDiscountMultiple">Réduction (%):</label>
                                                <input class="border-0 border-l rounded-none focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" type="number" id="globalDiscountMultiple" value="0" min="0" max="100" placeholder="Pourcentage de réduction" style="padding-bottom: 10px;padding-left: 6px; padding-top: 10px;background-color: #f1f1f1;">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding: 16px; gap:16px;justify-content: space-around;" class="flex">
                                        <button id="confirmMultiple" type="button" class="btn btn-success">
                                            <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 5.25C12.4142 5.25 12.75 5.58579 12.75 6V6.31673C14.3804 6.60867 15.75 7.83361 15.75 9.5C15.75 9.91421 15.4142 10.25 15 10.25C14.5858 10.25 14.25 9.91421 14.25 9.5C14.25 8.82154 13.6859 8.10339 12.75 7.84748V11.3167C14.3804 11.6087 15.75 12.8336 15.75 14.5C15.75 16.1664 14.3804 17.3913 12.75 17.6833V18C12.75 18.4142 12.4142 18.75 12 18.75C11.5858 18.75 11.25 18.4142 11.25 18V17.6833C9.61957 17.3913 8.25 16.1664 8.25 14.5C8.25 14.0858 8.58579 13.75 9 13.75C9.41421 13.75 9.75 14.0858 9.75 14.5C9.75 15.1785 10.3141 15.8966 11.25 16.1525V12.6833C9.61957 12.3913 8.25 11.1664 8.25 9.5C8.25 7.83361 9.61957 6.60867 11.25 6.31673V6C11.25 5.58579 11.5858 5.25 12 5.25ZM11.25 7.84748C10.3141 8.10339 9.75 8.82154 9.75 9.5C9.75 10.1785 10.3141 10.8966 11.25 11.1525V7.84748ZM14.25 14.5C14.25 13.8215 13.6859 13.1034 12.75 12.8475V16.1525C13.6859 15.8966 14.25 15.1785 14.25 14.5Z" fill="currentColor"></path>
                                            </svg>Confirmer la vente
                                        </button>
                                        <button onclick="window.location.href='faire_une_vente.php'" id="cancelButton" type="button" class="btn btn-danger">
                                            <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg> Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal conclure une vente -->
                            <div id="cloclureLaVenteModal" class="modal" style="display:none;">
                                <div class="modal-content">
                                    <span class="close" id="closeCloclureLaVenteModal" style="color: red; background: none; border: none; cursor: pointer; font-size: 34px;padding: 10px;">&times;</span>
                                    <h2 class="font-bold" style="font-size: 20px; color: red;">Confirmation de la Vente</h2>
                                    <table class="w-[800px] md:w-full">
                                        <thead>
                                            <tr>
                                                <th class="font-bold">Désignation</th>
                                                <th class="font-bold">Unité</th>
                                                <th class="font-bold">Prix</th>
                                                <th class="font-bold">Quantité</th>
                                                <th class="font-bold">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="flex justify-end px-4">
                                        <div id="insertArea">
                                        </div>
                                        <div class="w-full md:w-80 font-semibold">
                                            <div class="flex items-center justify-between py-2">
                                                <span>Total Général :</span>
                                                <span id="totalGeneral">0 FCFA</span>
                                            </div>
                                            <div class="flex items-center justify-between py-2">
                                                <label for="globalDiscount">Réduction (%):</label>
                                                <input class="border-0 border-l rounded-none focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" type="number" id="globalDiscount" value="0" min="0" max="100" placeholder="Pourcentage de réduction" style="padding-bottom: 10px;padding-left: 6px; padding-top: 10px;background-color: #f1f1f1;">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding: 16px; gap:16px;justify-content: space-around;" class="flex">
                                        <button id="confirmConlcureLaVente" type="button" class="btn btn-success">
                                            <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 5.25C12.4142 5.25 12.75 5.58579 12.75 6V6.31673C14.3804 6.60867 15.75 7.83361 15.75 9.5C15.75 9.91421 15.4142 10.25 15 10.25C14.5858 10.25 14.25 9.91421 14.25 9.5C14.25 8.82154 13.6859 8.10339 12.75 7.84748V11.3167C14.3804 11.6087 15.75 12.8336 15.75 14.5C15.75 16.1664 14.3804 17.3913 12.75 17.6833V18C12.75 18.4142 12.4142 18.75 12 18.75C11.5858 18.75 11.25 18.4142 11.25 18V17.6833C9.61957 17.3913 8.25 16.1664 8.25 14.5C8.25 14.0858 8.58579 13.75 9 13.75C9.41421 13.75 9.75 14.0858 9.75 14.5C9.75 15.1785 10.3141 15.8966 11.25 16.1525V12.6833C9.61957 12.3913 8.25 11.1664 8.25 9.5C8.25 7.83361 9.61957 6.60867 11.25 6.31673V6C11.25 5.58579 11.5858 5.25 12 5.25ZM11.25 7.84748C10.3141 8.10339 9.75 8.82154 9.75 9.5C9.75 10.1785 10.3141 10.8966 11.25 11.1525V7.84748ZM14.25 14.5C14.25 13.8215 13.6859 13.1034 12.75 12.8475V16.1525C13.6859 15.8966 14.25 15.1785 14.25 14.5Z" fill="currentColor"></path>
                                            </svg>Confirmer la vente
                                        </button>
                                        <button onclick="window.location.href='faire_une_vente.php'" id="cancelButton" type="button" class="btn btn-danger">
                                            <svg class="h-5 w-5 ltr:mr-2 rtl:ml-2" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg> Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="w-full xl:space-y-5 xl:mt-0 grid sm:grid-cols-2 gap-5 xl:block" style="max-width: 540px;">
                                <div class="panel p-0">
                                    <div class="relative border border-white-dark/20">
                                       <!-- Affichage du type de client -->
                                      <input type="text" id="searchProduct" placeholder="Rechercher un produit..." class="form-input border-0 border-l rounded-none bg-white  focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" />
                                    </div>
                                    <div class="flex items-center justify-between p-4 border-b dark:border-[#191e3a]">
                                        <div class="grid">
                                            <span class="font-bold" style="text-align: center;padding-bottom: 4px;">Catégorie</span>
                                            <select id="categorySelect">
                                                <option value="">Tout lister</option>
                                                <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category['id_categorie_produits'] ?>"><?= $category['nom_categorie_produits'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="grid">
                                            <span class="font-bold" style="text-align: center;padding-bottom: 4px;">Fournisseur</span>
                                            <select id="fournisseurSelect">
                                                <option value="">Tout lister</option>
                                                <?php foreach ($fournisseurs as $fournisseur): ?>
                                                <option value="<?= $fournisseur['id_fournisseurs'] ?>"><?= $fournisseur['nom_fournisseurs'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <select id="stockSelect" style="display: none;">
                                            <option value="">Sélectionner un stock</option>
                                            <?php foreach ($stocks as $stock): ?>
                                                <option value="<?= $stock['id_stocks'] ?>"><?= $stock['nom_stocks'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div id="produitGrid" class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4">
                                        <?php foreach ($produits as $produit): ?>
                                            <div class="p-2">
                                                <div class="produit-card grid items-center gap-1" style="min-height: 170px;text-align: center;padding: 10px;background: #f1f1f1;" data-id="<?= $produit['id_produits'] ?>"  data-nom="<?= $produit['nom_produits'] ?>" data-unite="<?= $produit['unite_produits'] ?>" data-image="<?= $produit['photo_produits1'] ?>" data-prix-simple="<?= $produit['prix_produits'] ?>" data-prix-grossiste="<?= $produit['prix_produits1'] ?>" data-categories="<?= $produit['nom_categorie_produits']?>" data-categorie="<?= $produit['id_categorie_produits'] ?>" data-fournisseur="<?= $produit['id_fournisseurs'] ?>" data-stock="<?= $produit['id_stocks'] ?>">
                                                    <img src="<?=$produit['photo_produits1'] ?>"  class="w-12 h-12 rounded" style="height: 100px;width: 110px;" alt="<?= $produit['nom_produits'] ?>">
                                                    <div>
                                                        <div class="font-semibold text-base"><?= $produit['nom_produits'] ?></div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="assets/js/conclure_la_vente.js"></script>
                    <!-- end main content section -->
                     <br>
                     <!-- start footer section -->
                     <?php include 'layouts/footer.php'; ?>
                     <!-- end footer section -->
                </div>
            </div>
        </div>
        <?php include 'layouts/footer_js.php'; ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

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
            showMessage1 = (msg = 'Example notification text.', position = 'bottom-start', showCloseButton = true, closeButtonHtml = '', duration = 3000) => {
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
            showMessage2 = (msg = 'Example notification text.', position = 'bottom-start', showCloseButton = true, closeButtonHtml = '', duration = 4000) => {
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
            showMessage3 = (msg = 'Example notification text.', position = 'bottom-start', showCloseButton = true, closeButtonHtml = '', duration = 4000) => {
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
        </script>

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

                document.addEventListener("DOMContentLoaded", function(e) {
                    // seachable 
                    var options = {
                        searchable: true
                    };
                    NiceSelect.bind(document.getElementById("categorySelect"), options);
                    NiceSelect.bind(document.getElementById("clientSelect"), options);
                    NiceSelect.bind(document.getElementById("fournisseurSelect"), options);
                });
            });
        </script>
    </body>
</html>
