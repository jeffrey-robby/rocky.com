<?php include 'layouts/control.php'; ?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="accueil";?>

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

                <script>
                    <?php if (isset($_SESSION['notification'])): ?>
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
                            showMessage('Bienvenue, <?php echo addslashes($_SESSION['notification']); ?> !', 'top');
                        };
                        <?php unset($_SESSION['notification']);?>
                    <?php endif; ?>
                </script>

                <!-- end header section -->
                <div class="animate__animated p-6 animate__fadeInDown">
                    <!-- start main content section -->
                    <div x-data="sales">
                        <ul class="flex space-x-2 rtl:space-x-reverse">
                            <li>
                                <a href="javascript:;" class="text-primary hover:underline">Accueil</a>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                                <span>ventes</span>
                            </li>
                        </ul>

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

                        <div class="pt-5">
                            <div  id="result" class="mb-6 grid gap-6 sm:grid-cols-4 xl:grid-cols-4">
                                <div class="border hcm-box border-gray-500/20 rounded-md shadow-[rgb(31_45_61_/_10%)_0px_2px_10px_1px] dark:shadow-[0_2px_11px_0_rgb(6_8_24_/_39%)] p-6 pt-12 mt-8 relative">
                                    <div class="bg-primary absolute text-white-light left-6 -top-8 w-16 h-16 rounded-md flex items-center justify-center mb-5 mx-auto">
                                        <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.5" d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" stroke="currentColor" stroke-width="1.5"></path>
                                        <path opacity="0.5" d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" stroke="currentColor" stroke-width="1.5"></path>
                                        <path d="M2.26121 3.09184L2.50997 2.38429H2.50997L2.26121 3.09184ZM2.24876 2.29246C1.85799 2.15507 1.42984 2.36048 1.29246 2.75124C1.15507 3.14201 1.36048 3.57016 1.75124 3.70754L2.24876 2.29246ZM4.58584 4.32298L5.20507 3.89983V3.89983L4.58584 4.32298ZM5.88772 14.5862L5.34345 15.1022H5.34345L5.88772 14.5862ZM20.6578 9.88275L21.3923 10.0342L21.3933 10.0296L20.6578 9.88275ZM20.158 12.3075L20.8926 12.4589L20.158 12.3075ZM20.7345 6.69708L20.1401 7.15439L20.7345 6.69708ZM19.1336 15.0504L18.6598 14.469L19.1336 15.0504ZM5.70808 9.76V7.03836H4.20808V9.76H5.70808ZM2.50997 2.38429L2.24876 2.29246L1.75124 3.70754L2.01245 3.79938L2.50997 2.38429ZM10.9375 16.25H16.2404V14.75H10.9375V16.25ZM5.70808 7.03836C5.70808 6.3312 5.7091 5.7411 5.65719 5.26157C5.60346 4.76519 5.48705 4.31247 5.20507 3.89983L3.96661 4.74613C4.05687 4.87822 4.12657 5.05964 4.1659 5.42299C4.20706 5.8032 4.20808 6.29841 4.20808 7.03836H5.70808ZM2.01245 3.79938C2.68006 4.0341 3.11881 4.18965 3.44166 4.34806C3.74488 4.49684 3.87855 4.61727 3.96661 4.74613L5.20507 3.89983C4.92089 3.48397 4.54304 3.21763 4.10241 3.00143C3.68139 2.79485 3.14395 2.60719 2.50997 2.38429L2.01245 3.79938ZM4.20808 9.76C4.20808 11.2125 4.22171 12.2599 4.35876 13.0601C4.50508 13.9144 4.79722 14.5261 5.34345 15.1022L6.43198 14.0702C6.11182 13.7325 5.93913 13.4018 5.83723 12.8069C5.72607 12.1578 5.70808 11.249 5.70808 9.76H4.20808ZM10.9375 14.75C9.52069 14.75 8.53763 14.7482 7.79696 14.6432C7.08215 14.5418 6.70452 14.3576 6.43198 14.0702L5.34345 15.1022C5.93731 15.7286 6.69012 16.0013 7.58636 16.1283C8.45674 16.2518 9.56535 16.25 10.9375 16.25V14.75ZM4.95808 6.87H17.0888V5.37H4.95808V6.87ZM19.9232 9.73135L19.4235 12.1561L20.8926 12.4589L21.3923 10.0342L19.9232 9.73135ZM17.0888 6.87C17.9452 6.87 18.6989 6.871 19.2937 6.93749C19.5893 6.97053 19.8105 7.01643 19.9659 7.07105C20.1273 7.12776 20.153 7.17127 20.1401 7.15439L21.329 6.23978C21.094 5.93436 20.7636 5.76145 20.4632 5.65587C20.1567 5.54818 19.8101 5.48587 19.4604 5.44678C18.7646 5.369 17.9174 5.37 17.0888 5.37V6.87ZM21.3933 10.0296C21.5625 9.18167 21.7062 8.47024 21.7414 7.90038C21.7775 7.31418 21.7108 6.73617 21.329 6.23978L20.1401 7.15439C20.2021 7.23508 20.2706 7.38037 20.2442 7.80797C20.2168 8.25191 20.1002 8.84478 19.9223 9.73595L21.3933 10.0296ZM16.2404 16.25C17.0021 16.25 17.6413 16.2513 18.1566 16.1882C18.6923 16.1227 19.1809 15.9794 19.6074 15.6318L18.6598 14.469C18.5346 14.571 18.3571 14.6525 17.9744 14.6994C17.5712 14.7487 17.0397 14.75 16.2404 14.75V16.25ZM19.4235 12.1561C19.2621 12.9389 19.1535 13.4593 19.0238 13.8442C18.9007 14.2095 18.785 14.367 18.6598 14.469L19.6074 15.6318C20.0339 15.2842 20.2729 14.8346 20.4453 14.3232C20.6111 13.8312 20.7388 13.2049 20.8926 12.4589L19.4235 12.1561Z" fill="currentColor"></path>
                                        <path opacity="0.5" d="M9.5 9L10.0282 12.1179" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path opacity="0.5" d="M15.5283 9L15.0001 12.1179" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        </svg>
                                    </div>
                                    <h5 class="text-dark text-lg font-semibold mb-3.5 dark:text-white-light">TOTAL DES VENTES</h5>
                                    <p class="text-white-dark text-[15px]  mb-3.5" style=" font-size: 20px; font-weight: 700;"><span id="totalVentes">0.00</span> FCFA</p>
                                </div>
                                <div class="border hcm-box border-gray-500/20 rounded-md shadow-[rgb(31_45_61_/_10%)_0px_2px_10px_1px] dark:shadow-[0_2px_11px_0_rgb(6_8_24_/_39%)] p-6 pt-12 mt-8 relative">
                                    <div class="bg-primary absolute text-white-light left-6 -top-8 w-16 h-16 rounded-md flex items-center justify-center mb-5 mx-auto">
                                        <svg width="66" height="66" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.5" d="M16 4.00195C18.175 4.01406 19.3529 4.11051 20.1213 4.87889C21 5.75757 21 7.17179 21 10.0002V16.0002C21 18.8286 21 20.2429 20.1213 21.1215C19.2426 22.0002 17.8284 22.0002 15 22.0002H9C6.17157 22.0002 4.75736 22.0002 3.87868 21.1215C3 20.2429 3 18.8286 3 16.0002V10.0002C3 7.17179 3 5.75757 3.87868 4.87889C4.64706 4.11051 5.82497 4.01406 8 4.00195" stroke="currentColor" stroke-width="1.5"></path>
                                        <path d="M8 14H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M7 10.5H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M9 17.5H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M8 3.5C8 2.67157 8.67157 2 9.5 2H14.5C15.3284 2 16 2.67157 16 3.5V4.5C16 5.32843 15.3284 6 14.5 6H9.5C8.67157 6 8 5.32843 8 4.5V3.5Z" stroke="currentColor" stroke-width="1.5"></path>
                                        </svg>
                                    </div>
                                    <h5 class="text-dark text-lg font-semibold mb-3.5 dark:text-white-light">NET</h5>
                                    <p class="text-white-dark text-[15px]  mb-3.5" style=" font-size: 20px; font-weight: 700;"><span id="net">0.00</span> FCFA</p>
                                </div>
                                <div class="border hcm-box border-gray-500/20 rounded-md shadow-[rgb(31_45_61_/_10%)_0px_2px_10px_1px] dark:shadow-[0_2px_11px_0_rgb(6_8_24_/_39%)] p-6 pt-12 mt-8 relative">
                                    <div class="bg-primary absolute text-white-light left-6 -top-8 w-16 h-16 rounded-md flex items-center justify-center mb-5 mx-auto">
                                        <svg class="shrink-0 group-hover:!text-primary" width="66" height="66" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.5" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22Z" fill="currentColor"></path>
                                        <path d="M18.75 8C18.75 8.41421 18.4142 8.75 18 8.75H6C5.58579 8.75 5.25 8.41421 5.25 8C5.25 7.58579 5.58579 7.25 6 7.25H18C18.4142 7.25 18.75 7.58579 18.75 8Z" fill="currentColor"></path>
                                        <path d="M18.75 12C18.75 12.4142 18.4142 12.75 18 12.75H6C5.58579 12.75 5.25 12.4142 5.25 12C5.25 11.5858 5.58579 11.25 6 11.25H18C18.4142 11.25 18.75 11.5858 18.75 12Z" fill="currentColor"></path>
                                        <path d="M18.75 16C18.75 16.4142 18.4142 16.75 18 16.75H6C5.58579 16.75 5.25 16.4142 5.25 16C5.25 15.5858 5.58579 15.25 6 15.25H18C18.4142 15.25 18.75 15.5858 18.75 16Z" fill="currentColor"></path>
                                       </svg>
                                    </div>
                                    <h5 class="text-dark text-lg font-semibold mb-3.5 dark:text-white-light">FACTURES IMPAYÉES</h5>
                                    <p class="text-white-dark text-[15px]  mb-3.5" style=" font-size: 20px; font-weight: 700;"><span id="montantImpaye">0.00</span> FCFA</p>
                                </div>
                                <div class="border hcm-box border-gray-500/20 rounded-md shadow-[rgb(31_45_61_/_10%)_0px_2px_10px_1px] dark:shadow-[0_2px_11px_0_rgb(6_8_24_/_39%)] p-6 pt-12 mt-8 relative">
                                    <div class="bg-primary absolute text-white-light left-6 -top-8 w-16 h-16 rounded-md flex items-center justify-center mb-5 mx-auto">
                                        <svg class="shrink-0 group-hover:!text-primary" width="66" height="66" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 group-hover:!text-primary">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.73167 5.77133L5.66953 9.91436C4.3848 11.6526 3.74244 12.5217 4.09639 13.205C4.10225 13.2164 4.10829 13.2276 4.1145 13.2387C4.48945 13.9117 5.59888 13.9117 7.81775 13.9117C9.05079 13.9117 9.6673 13.9117 10.054 14.2754L10.074 14.2946L13.946 9.72466L13.926 9.70541C13.5474 9.33386 13.5474 8.74151 13.5474 7.55682V7.24712C13.5474 3.96249 13.5474 2.32018 12.6241 2.03721C11.7007 1.75425 10.711 3.09327 8.73167 5.77133Z" fill="currentColor"></path>
                                            <path opacity="0.5" d="M10.4527 16.4432L10.4527 16.7528C10.4527 20.0374 10.4527 21.6798 11.376 21.9627C12.2994 22.2457 13.2891 20.9067 15.2685 18.2286L18.3306 14.0856C19.6154 12.3474 20.2577 11.4783 19.9038 10.7949C19.8979 10.7836 19.8919 10.7724 19.8857 10.7613C19.5107 10.0883 18.4013 10.0883 16.1824 10.0883C14.9494 10.0883 14.3329 10.0883 13.9462 9.72461L10.0742 14.2946C10.4528 14.6661 10.4527 15.2585 10.4527 16.4432Z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <h5 class="text-dark text-lg font-semibold mb-3.5 dark:text-white-light">DÉPENSES</h5>
                                    <p class="text-white-dark text-[15px]  mb-3.5" style=" font-size: 20px; font-weight: 700;"><span id="depenses">0.00</span> FCFA</p>
                                </div>  
                            </div>
                        </div>
                       
                        <div class="pt-5">
                            <div class="mb-6 grid gap-6 xl:grid-cols-3">
                                <div class="panel h-full xl:col-span-2">
                                    <div class="mb-5 flex items-center dark:text-white-light">
                                        <h5 class="text-lg font-semibold">Revenue</h5>
                                        <!-- <div x-data="dropdown" @click.outside="open = false" class="dropdown ltr:ml-auto rtl:mr-auto">
                                            <a href="javascript:;" @click="toggle">
                                                <svg
                                                    class="h-5 w-5 text-black/70 hover:!text-primary dark:text-white/70"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                                    <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                                </svg>
                                            </a>
                                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0">
                                                <li><a href="javascript:;" @click="toggle">Weekly</a></li>
                                                <li><a href="javascript:;" @click="toggle">Monthly</a></li>
                                                <li><a href="javascript:;" @click="toggle">Yearly</a></li>
                                            </ul>
                                        </div> -->
                                    </div>
                                    <p class="text-lg dark:text-white-light/90">Total Profis <span class="ml-2 text-primary">10 000 FCFA</span></p>
                                    <div class="relative overflow-hidden">
                                        <div x-ref="revenueChart" class="rounded-lg bg-white dark:bg-black">
                                            <!-- loader -->
                                            <div class="grid min-h-[325px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                                                <span
                                                    class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"
                                                ></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel h-full">
                                    <div class="mb-5 flex items-center">
                                        <h5 class="text-lg font-semibold dark:text-white-light">Ventes par catégorie</h5>
                                    </div>
                                    <div class="overflow-hidden">
                                        <div x-ref="salesByCategory" class="rounded-lg bg-white dark:bg-black">
                                            <!-- loader -->
                                            <div class="grid min-h-[353px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                                                <span
                                                    class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"
                                                ></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end main content section -->
                </div>

                <!-- start footer section -->
                <?php include 'layouts/footer.php'; ?>
                <!-- end footer section -->
            </div>
        </div>

        <?php include 'layouts/footer_js.php'; ?>

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
                const dateFin = new Date(year, month + 1, 0).toISOString().slice(0, 19); // 0 retourne le dernier jour du mois précédent
            
                $.ajax({
                    url: 'fetch_data.php',
                    type: 'POST',
                    data: {
                        date_debut: dateDebut,
                        date_fin: dateFin
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        $('#totalVentes').text(data.totalVentes);
                        $('#montantImpaye').text(data.montantImpaye);
                        $('#net').text(data.net);
                        $('#depenses').text(data.depenses);
                    }
                });
            }

            loadCurrentMonthData();

            // Événement pour changer la période
            $('#date_debut, #date_fin').change(function() {
                const dateDebut = $('#date_debut').val();
                const dateFin = $('#date_fin').val();

                if (dateDebut && dateFin) {
                    $.ajax({
                        url: 'fetch_data.php',
                        type: 'POST',
                        data: {
                            date_debut: dateDebut,
                            date_fin: dateFin
                        },
                        success: function(response) {
                            const data = JSON.parse(response);
                            $('#totalVentes').text(data.totalVentes);
                            $('#montantImpaye').text(data.montantImpaye);
                            $('#net').text(data.net);
                            $('#depenses').text(data.depenses);
                        }
                    });
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

                // content section
                Alpine.data('sales', () => ({
                    init() {
                        isDark = this.$store.app.theme === 'dark' || this.$store.app.isDarkMode ? true : false;
                        isRtl = this.$store.app.rtlClass === 'rtl' ? true : false;

                        const revenueChart = null;
                        const salesByCategory = null;
                        const dailySales = null;
                        const totalOrders = null;

                        // revenue
                        setTimeout(() => {
                            this.revenueChart = new ApexCharts(this.$refs.revenueChart, this.revenueChartOptions);
                            this.$refs.revenueChart.innerHTML = '';
                            this.revenueChart.render();

                            // sales by category
                            this.salesByCategory = new ApexCharts(this.$refs.salesByCategory, this.salesByCategoryOptions);
                            this.$refs.salesByCategory.innerHTML = '';
                            this.salesByCategory.render();

                        }, 300);

                        this.$watch('$store.app.theme', () => {
                            isDark = this.$store.app.theme === 'dark' || this.$store.app.isDarkMode ? true : false;

                            this.revenueChart.updateOptions(this.revenueChartOptions);
                            this.salesByCategory.updateOptions(this.salesByCategoryOptions);
                            this.dailySales.updateOptions(this.dailySalesOptions);
                            this.totalOrders.updateOptions(this.totalOrdersOptions);
                        });

                        this.$watch('$store.app.rtlClass', () => {
                            isRtl = this.$store.app.rtlClass === 'rtl' ? true : false;
                            this.revenueChart.updateOptions(this.revenueChartOptions);
                        });
                    },

                    // revenue
                    get revenueChartOptions() {
                        return {
                            series: [
                                {
                                    name: 'Ventes',
                                    data: [16800, 16800, 15500, 17800, 15500, 17000, 19000, 16000, 15000, 17000, 14000, 17000],
                                },
                                {
                                    name: 'Dépenses',
                                    data: [16500, 17500, 16200, 17300, 16000, 19500, 16000, 17000, 16000, 19000, 18000, 19000],
                                },
                            ],
                            chart: {
                                height: 325,
                                type: 'area',
                                fontFamily: 'Nunito, sans-serif',
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            stroke: {
                                show: true,
                                curve: 'smooth',
                                width: 2,
                                lineCap: 'square',
                            },
                            dropShadow: {
                                enabled: true,
                                opacity: 0.2,
                                blur: 10,
                                left: -7,
                                top: 22,
                            },
                            colors: isDark ? ['#2196f3', '#e7515a'] : ['#1b55e2', '#e7515a'],
                            markers: {
                                discrete: [
                                    {
                                        seriesIndex: 0,
                                        dataPointIndex: 6,
                                        fillColor: '#1b55e2',
                                        strokeColor: 'transparent',
                                        size: 7,
                                    },
                                    {
                                        seriesIndex: 1,
                                        dataPointIndex: 5,
                                        fillColor: '#e7515a',
                                        strokeColor: 'transparent',
                                        size: 7,
                                    },
                                ],
                            },
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            xaxis: {
                                axisBorder: {
                                    show: false,
                                },
                                axisTicks: {
                                    show: false,
                                },
                                crosshairs: {
                                    show: true,
                                },
                                labels: {
                                    offsetX: isRtl ? 2 : 0,
                                    offsetY: 5,
                                    style: {
                                        fontSize: '12px',
                                        cssClass: 'apexcharts-xaxis-title',
                                    },
                                },
                            },
                            yaxis: {
                                tickAmount: 7,
                                labels: {
                                    formatter: (value) => {
                                        return value / 1000 + 'K';
                                    },
                                    offsetX: isRtl ? -30 : -10,
                                    offsetY: 0,
                                    style: {
                                        fontSize: '12px',
                                        cssClass: 'apexcharts-yaxis-title',
                                    },
                                },
                                opposite: isRtl ? true : false,
                            },
                            grid: {
                                borderColor: isDark ? '#191e3a' : '#e0e6ed',
                                strokeDashArray: 5,
                                xaxis: {
                                    lines: {
                                        show: true,
                                    },
                                },
                                yaxis: {
                                    lines: {
                                        show: false,
                                    },
                                },
                                padding: {
                                    top: 0,
                                    right: 0,
                                    bottom: 0,
                                    left: 0,
                                },
                            },
                            legend: {
                                position: 'top',
                                horizontalAlign: 'right',
                                fontSize: '16px',
                                markers: {
                                    width: 10,
                                    height: 10,
                                    offsetX: -2,
                                },
                                itemMargin: {
                                    horizontal: 10,
                                    vertical: 5,
                                },
                            },
                            tooltip: {
                                marker: {
                                    show: true,
                                },
                                x: {
                                    show: false,
                                },
                            },
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    shadeIntensity: 1,
                                    inverseColors: !1,
                                    opacityFrom: isDark ? 0.19 : 0.28,
                                    opacityTo: 0.05,
                                    stops: isDark ? [100, 100] : [45, 100],
                                },
                            },
                        };
                    },

                    // sales by category
                    get salesByCategoryOptions() {
                        return {
                            series: [985, 737, 270],
                            chart: {
                                type: 'donut',
                                height: 460,
                                fontFamily: 'Nunito, sans-serif',
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            stroke: {
                                show: true,
                                width: 25,
                                colors: isDark ? '#0e1726' : '#fff',
                            },
                            colors: isDark ? ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'] : ['#e2a03f', '#5c1ac3', '#e7515a'],
                            legend: {
                                position: 'bottom',
                                horizontalAlign: 'center',
                                fontSize: '14px',
                                markers: {
                                    width: 10,
                                    height: 10,
                                    offsetX: -2,
                                },
                                height: 50,
                                offsetY: 20,
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        size: '65%',
                                        background: 'transparent',
                                        labels: {
                                            show: true,
                                            name: {
                                                show: true,
                                                fontSize: '29px',
                                                offsetY: -10,
                                            },
                                            value: {
                                                show: true,
                                                fontSize: '26px',
                                                color: isDark ? '#bfc9d4' : undefined,
                                                offsetY: 16,
                                                formatter: (val) => {
                                                    return val;
                                                },
                                            },
                                            total: {
                                                show: true,
                                                label: 'Total',
                                                color: '#888ea8',
                                                fontSize: '29px',
                                                formatter: (w) => {
                                                    return w.globals.seriesTotals.reduce(function (a, b) {
                                                        return a + b;
                                                    }, 0);
                                                },
                                            },
                                        },
                                    },
                                },
                            },
                            labels: ['Cahiers', 'Stylos', 'Livres'],
                            states: {
                                hover: {
                                    filter: {
                                        type: 'none',
                                        value: 0.15,
                                    },
                                },
                                active: {
                                    filter: {
                                        type: 'none',
                                        value: 0.15,
                                    },
                                },
                            },
                        };
                    },
                    
                }));
                
            });
        </script>
    </body>
</html>
