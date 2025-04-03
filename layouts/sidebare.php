            <div :class="{'dark text-white-dark' : $store.app.semidark}">
                <nav
                    x-data="sidebar"
                    class="sidebar fixed bottom-0 top-0 z-50 h-full min-h-screen w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] transition-all duration-300"
                >
                    <div class="h-full bg-white dark:bg-[#0e1726]">
                        <div class="flex items-center justify-between px-4 py-3">
                            <a href="index.php" class="main-logo flex shrink-0 items-center">
                                <img class="ml-[5px] w-8 flex-none" src="favicon.png" alt="image" />
                                <span class="align-middle text-2xl font-semibold ltr:ml-1.5 rtl:mr-1.5 dark:text-white-light lg:inline">ETS ROCKY</span>
                            </a>
                            <a
                                href="javascript:;"
                                class="collapse-icon flex h-8 w-8 items-center rounded-full transition duration-300 hover:bg-gray-500/10 rtl:rotate-180 dark:text-white-light dark:hover:bg-dark-light/10 "
                                @click="$store.app.toggleSidebar()"
                            >
                                <svg class="m-auto h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        opacity="0.5"
                                        d="M16.9998 19L10.9998 12L16.9998 5"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </a>
                        </div>
                        <ul
                            class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold"
                            x-data="{ activeDropdown: 'dashboard' }"
                        >  
                          <?php  $accueil =""; if ($valeur === "accueil" ) { $accueil = "active"; } ?>
                          <?php  $ajouter_personnel =""; if ($valeur === "personnel" ) { $ajouter_personnel = "active"; } ?>
                          <?php  $liste_personnel =""; if ($valeur === "liste_personnel" ) { $liste_personnel = "active"; } ?>
                          <?php  $editer_un_personnel =""; if ($valeur === "editer_un_personnel" ) { $editer_un_personnel = "active"; } ?>
                          <?php  $ajouter_un_utilisateur =""; if ($valeur === "ajouter_un_utilisateur" ) { $ajouter_un_utilisateur = "active"; } ?>
                          <?php  $liste_utilisateur =""; if ($valeur === "liste_utilisateur" ) { $liste_utilisateur = "active"; } ?>
                          <?php  $editer_un_utilisateur =""; if ($valeur === "editer_un_utilisateur" ) { $editer_un_utilisateur = "active"; } ?>
                          <?php  $ajouter_un_stock =""; if ($valeur === "ajouter_un_stock" ) { $ajouter_un_stock = "active"; } ?>
                          <?php  $liste_des_stocks =""; if ($valeur === "liste_des_stocks" ) { $liste_des_stocks = "active"; } ?>
                          <?php  $ajouter_un_fournisseur =""; if ($valeur === "ajouter_un_fournisseur" ) { $ajouter_un_fournisseur = "active"; } ?>
                          <?php  $liste_des_fournisseurs =""; if ($valeur === "liste_des_fournisseurs" ) { $liste_des_fournisseurs = "active"; } ?>
                          <?php  $editer_un_fournisseur =""; if ($valeur === "editer_un_fournisseur" ) { $editer_un_fournisseur = "active"; } ?>
                          <?php  $ajouter_un_produit =""; if ($valeur === "ajouter_un_produit" ) { $ajouter_un_produit = "active"; } ?>
                          <?php  $liste_des_produits =""; if ($valeur === "liste_des_produits" ) { $liste_des_produits = "active"; } ?>
                          <?php  $categorie_de_produit =""; if ($valeur === "categorie_de_produit" ) { $categorie_de_produit = "active"; } ?>
                          <?php  $editer_un_produit =""; if ($valeur === "editer_un_produit" ) { $editer_un_produit = "active"; } ?>
                          <?php  $ajouter_un_client =""; if ($valeur === "ajouter_un_client" ) { $ajouter_un_client = "active"; } ?>
                          <?php  $liste_des_clients =""; if ($valeur === "liste_des_clients" ) { $liste_des_clients = "active"; } ?>
                          <?php  $editer_un_client =""; if ($valeur === "editer_un_client" ) { $editer_un_client = "active"; } ?>
                          <?php  $dettes_des_clients =""; if ($valeur === "dettes_des_clients" ) { $dettes_des_clients = "active"; } ?>
                          <?php  $faire_une_vente =""; if ($valeur === "faire_une_vente" ) { $faire_une_vente = "active"; } ?>
                          <?php  $liste_de_vente =""; if ($valeur === "liste_de_vente" ) { $liste_de_vente = "active"; } ?>
                          <?php  $transfert_de_stock =""; if ($valeur === "transfert_de_stock" ) { $transfert_de_stock = "active"; } ?>
                          <?php  $ajustement_de_stock =""; if ($valeur === "ajustement_de_stock" ) { $ajustement_de_stock = "active"; } ?>
                          <?php  $historique_transfert_de_stock =""; if ($valeur === "historique_transfert_de_stock" ) { $historique_transfert_de_stock = "active"; } ?>
                          <?php  $historique_ajustement_de_stock =""; if ($valeur === "historique_ajustement_de_stock" ) { $historique_ajustement_de_stock = "active"; } ?>
                          <?php  $achats_simple =""; if ($valeur === "achats_simple" ) { $achats_simple = "active"; } ?>
                          <?php  $achats_a_credit =""; if ($valeur === "achats_a_credit" ) { $achats_a_credit = "active"; } ?>
                          <?php  $liste_achats =""; if ($valeur === "liste_achats" ) { $liste_achats = "active"; } ?>
                          <?php  
                             if ($code === 'P') {
                               echo "
                               <li class=\"nav-item\">
                                   <a href=\"index.php\" class=\"group $accueil\">
                                       <div class=\"flex items-center\">
                                           <svg
                                           class=\"shrink-0 group-hover:!text-primary\"
                                           width=\"20\"
                                           height=\"20\"
                                           viewBox=\"0 0 24 24\"
                                           fill=\"none\"
                                           xmlns=\"http://www.w3.org/2000/svg\"
                                       >
                                           <path
                                               opacity=\"0.5\"
                                               d=\"M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z\"
                                               fill=\"currentColor\"
                                           />
                                           <path
                                               d=\"M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z\"
                                               fill=\"currentColor\"
                                           />
                                       </svg>
                                           <span class=\"text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark\">Accueil</span>
                                       </div>
                                   </a>
                               </li>
                                   ";
                             } 
                          ?>  

                            <li class="nav-item">
                            <ul>
                               <?php  
                                 if ($code === 'P') {
                                   echo "
                                   <li class=\"nav-item\">
                                       <a href=\"Liste_de_vente.php\" class=\"$liste_de_vente\") { echo \"active\"; } \">
                                           <div class=\"flex items-center\">
                                           <svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                <path d=\"M21 12C21 16.714 21 19.0711 19.682 20.5355C18.364 22 16.2426 22 12 22C7.75736 22 5.63604 22 4.31802 20.5355C3 19.0711 3 16.714 3 12C3 7.28595 3 4.92893 4.31802 3.46447C5.63604 2 7.75736 2 12 2C16.2426 2 18.364 2 19.682 3.46447C20.5583 4.43821 20.852 5.80655 20.9504 8\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                <path d=\"M7 8C7 7.53501 7 7.30252 7.05111 7.11177C7.18981 6.59413 7.59413 6.18981 8.11177 6.05111C8.30252 6 8.53501 6 9 6H15C15.465 6 15.6975 6 15.8882 6.05111C16.4059 6.18981 16.8102 6.59413 16.9489 7.11177C17 7.30252 17 7.53501 17 8C17 8.46499 17 8.69748 16.9489 8.88823C16.8102 9.40587 16.4059 9.81019 15.8882 9.94889C15.6975 10 15.465 10 15 10H9C8.53501 10 8.30252 10 8.11177 9.94889C7.59413 9.81019 7.18981 9.40587 7.05111 8.88823C7 8.69748 7 8.46499 7 8Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                                <circle cx=\"8\" cy=\"13\" r=\"1\" fill=\"currentColor\"></circle>
                                                <circle cx=\"8\" cy=\"17\" r=\"1\" fill=\"currentColor\"></circle>
                                                <circle cx=\"12\" cy=\"13\" r=\"1\" fill=\"currentColor\"></circle>
                                                <circle cx=\"12\" cy=\"17\" r=\"1\" fill=\"currentColor\"></circle>
                                                <circle cx=\"16\" cy=\"13\" r=\"1\" fill=\"currentColor\"></circle>
                                                <circle cx=\"16\" cy=\"17\" r=\"1\" fill=\"currentColor\"></circle>
                                            </svg>
                                               <span class=\"text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark\">Ventes</span>
                                           </div>
                                       </a>
                                   </li>
                                        ";
                                  } 
                                ?>
                                 <?php  
                                   if ($code === 'P') {
                                     echo "
                                     <li class=\"menu nav-item\">
                                         <button
                                             type=\"button\"
                                             class=\"nav-link group $ajouter_personnel $liste_personnel $editer_un_personnel\"
                                             :class=\"{'' : activeDropdown === 'personnel'}\"
                                             @click=\"activeDropdown === 'personnel' ? activeDropdown = null : activeDropdown = 'personnel'\"
                                         >
                                         <div class=\"flex items-center\">
                                                 <svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"shrink-0 group-hover:!text-primary\">
                                                     <circle cx=\"12\" cy=\"6\" r=\"4\" stroke=\"currentColor\" stroke-width=\"1.5\"></circle>
                                                     <path opacity=\"0.5\" d=\"M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                     <path opacity=\"0.5\" d=\"M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                     <ellipse cx=\"12\" cy=\"17\" rx=\"6\" ry=\"4\" stroke=\"currentColor\" stroke-width=\"1.5\"></ellipse>
                                                     <path opacity=\"0.5\" d=\"M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                     <path opacity=\"0.5\" d=\"M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                 </svg>
                                                 <span class=\"text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark\">Gestion du personnel</span>
                                             </div>
                                             <div class=\"rtl:rotate-180\" :class=\"{'!rotate-90' : activeDropdown === 'personnel'}\">
                                                 <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                     <path
                                                         d=\"M9 5L15 12L9 19\"
                                                         stroke=\"currentColor\"
                                                         stroke-width=\"1.5\"
                                                         stroke-linecap=\"round\"
                                                         stroke-linejoin=\"round\"
                                                     />
                                                 </svg>
                                             </div>
                                         </button>
                                         <ul x-cloak x-show=\"activeDropdown === 'personnel'\" x-collapse class=\"sub-menu text-gray-500\">
                                             <li>
                                                 <a href=\"ajouter_un_personnel.php\" class=\"$ajouter_personnel\">Nouveau personnel</a>
                                             </li>
                                             <li>
                                                 <a href=\"liste_du_personnel.php\" class=\"$liste_personnel\">Liste du personnel</a>
                                             </li>
                                         </ul>
                                     </li>
                                       ";
                                     } 
                                  ?>
                                    <?php  
                                     if ($code === 'P') {
                                         echo "
                                         <li class=\"menu nav-item\">
                                             <button
                                                 type=\"button\"
                                                 class=\"nav-link group $ajouter_un_utilisateur $liste_utilisateur $editer_un_utilisateur\"
                                                 :class=\"{'' : activeDropdown === 'users'}\"
                                                 @click=\"activeDropdown === 'users' ? activeDropdown = null : activeDropdown = 'users'\"
                                             >
                                                 <div class=\"flex items-center\">
                                                     <svg
                                                         class=\"shrink-0 group-hover:!text-primary\"
                                                         width=\"20\"
                                                         height=\"20\"
                                                         viewBox=\"0 0 24 24\"
                                                         fill=\"none\"
                                                         xmlns=\"http://www.w3.org/2000/svg\"
                                                     >
                                                         <circle opacity=\"0.5\" cx=\"15\" cy=\"6\" r=\"3\" fill=\"currentColor\" />
                                                         <ellipse opacity=\"0.5\" cx=\"16\" cy=\"17\" rx=\"5\" ry=\"3\" fill=\"currentColor\" />
                                                         <circle cx=\"9.00098\" cy=\"6\" r=\"4\" fill=\"currentColor\" />
                                                         <ellipse cx=\"9.00098\" cy=\"17.001\" rx=\"7\" ry=\"4\" fill=\"currentColor\" />
                                                     </svg>
                                                     <span class=\"text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark\">Gestion des utilisateurs</span>
                                                 </div>
                                                 <div class=\"rtl:rotate-180\" :class=\"{'!rotate-90' : activeDropdown === 'users'}\">
                                                     <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                         <path d=\"M9 5L15 12L9 19\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\" />
                                                     </svg>
                                                 </div>
                                             </button>
                                             <ul x-cloak x-show=\"activeDropdown === 'users'\" x-collapse class=\"sub-menu text-gray-500\">
                                                 <li>
                                                     <a href=\"ajouter_un_utilisateur.php\" class=\"$ajouter_un_utilisateur\">Nouvel utilisateur</a>
                                                 </li>
                                                 <li>
                                                     <a href=\"liste_utilisateur.php\" class=\"$liste_utilisateur\">Liste des utilisateurs</a>
                                                 </li>
                                             </ul>
                                         </li>
                                         ";
                                       } 
                                     ?>
                                    <?php  
                                      if ($code === 'P') {
                                          echo "
                                          <li class=\"menu nav-item\">
                                            <button
                                            type=\"button\"
                                            class=\"nav-link group $ajouter_un_stock $liste_des_stocks $transfert_de_stock $ajustement_de_stock $historique_transfert_de_stock $historique_ajustement_de_stock\"
                                            :class=\"{'' : activeDropdown === 'stocks'}\"
                                            @click=\"activeDropdown === 'stocks' ? activeDropdown = null : activeDropdown = 'stocks'\"
                                            >
                                            <div class=\"flex items-center\">
                                            <svg class=\"shrink-0 group-hover:!text-primary\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                               <path d=\"M4.97883 9.68508C2.99294 8.89073 2 8.49355 2 8C2 7.50645 2.99294 7.10927 4.97883 6.31492L7.7873 5.19153C9.77318 4.39718 10.7661 4 12 4C13.2339 4 14.2268 4.39718 16.2127 5.19153L19.0212 6.31492C21.0071 7.10927 22 7.50645 22 8C22 8.49355 21.0071 8.89073 19.0212 9.68508L16.2127 10.8085C14.2268 11.6028 13.2339 12 12 12C10.7661 12 9.77318 11.6028 7.7873 10.8085L4.97883 9.68508Z\" fill=\"currentColor\"></path>
                                               <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M2 8C2 8.49355 2.99294 8.89073 4.97883 9.68508L7.7873 10.8085C9.77318 11.6028 10.7661 12 12 12C13.2339 12 14.2268 11.6028 16.2127 10.8085L19.0212 9.68508C21.0071 8.89073 22 8.49355 22 8C22 7.50645 21.0071 7.10927 19.0212 6.31492L16.2127 5.19153C14.2268 4.39718 13.2339 4 12 4C10.7661 4 9.77318 4.39718 7.7873 5.19153L4.97883 6.31492C2.99294 7.10927 2 7.50645 2 8Z\" fill=\"currentColor\"></path>
                                               <path opacity=\"0.7\" d=\"M5.76613 10L4.97883 10.3149C2.99294 11.1093 2 11.5065 2 12C2 12.4935 2.99294 12.8907 4.97883 13.6851L7.7873 14.8085C9.77318 15.6028 10.7661 16 12 16C13.2339 16 14.2268 15.6028 16.2127 14.8085L19.0212 13.6851C21.0071 12.8907 22 12.4935 22 12C22 11.5065 21.0071 11.1093 19.0212 10.3149L18.2339 10L16.2127 10.8085C14.2268 11.6028 13.2339 12 12 12C10.7661 12 9.77318 11.6028 7.7873 10.8085L5.76613 10Z\" fill=\"currentColor\"></path>
                                               <path opacity=\"0.4\" d=\"M5.76613 14L4.97883 14.3149C2.99294 15.1093 2 15.5065 2 16C2 16.4935 2.99294 16.8907 4.97883 17.6851L7.7873 18.8085C9.77318 19.6028 10.7661 20 12 20C13.2339 20 14.2268 19.6028 16.2127 18.8085L19.0212 17.6851C21.0071 16.8907 22 16.4935 22 16C22 15.5065 21.0071 15.1093 19.0212 14.3149L18.2339 14L16.2127 14.8085C14.2268 15.6028 13.2339 16 12 16C10.7661 16 9.77318 15.6028 7.7873 14.8085L5.76613 14Z\" fill=\"currentColor\"></path>
                                            </svg>
                                                <span class=\"text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark\">Gestion des stocks</span>
                                            </div>
                                            <div class=\"rtl:rotate-180\" :class=\"{'!rotate-90' : activeDropdown === 'stocks'}\">
                                                <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                    <path
                                                    d=\"M9 5L15 12L9 19\"
                                                    stroke=\"currentColor\"
                                                    stroke-width=\"1.5\"
                                                    stroke-linecap=\"round\"
                                                    stroke-linejoin=\"round\"
                                                    />
                                                </svg>
                                            </div>
                                        </button>
                                        <ul x-cloak x-show=\"activeDropdown === 'stocks'\" x-collapse class=\"sub-menu text-gray-500\">
                                            <li>
                                                <a href=\"ajouter_un_stock.php\" class=\"$ajouter_un_stock\">Ajouter un stock</a>
                                            </li>
                                            <li>
                                                <a href=\"liste_des_stocks.php\" class=\"$liste_des_stocks\">Liste des stocks</a>
                                            </li>
                                            <li>
                                                <a href=\"transfert_de_stock.php\" class=\"$transfert_de_stock\">Tranfert de stock</a>
                                            </li>
                                            <li>
                                                <a href=\"historique_transfert_de_stock.php\" class=\"$historique_transfert_de_stock\">Historiques de tranfert de stock</a>
                                            </li>
                                            <li>
                                                <a href=\"ajustement_de_stock.php\" class=\"$ajustement_de_stock\">Ajustements stocks</a>
                                            </li>
                                            <li>
                                                <a href=\"historique_ajustement_de_stock.php\" class=\"$historique_ajustement_de_stock\">Historique d'ajustement de stock</a>
                                            </li>
                                        </ul>
                                    </li>
                                    ";
                                } 
                                ?>
                                <?php  
                                      if ($code === 'P') {
                                          echo "
                                          <li class=\"menu nav-item\">
                                            <button
                                            type=\"button\"
                                            class=\"nav-link group $ajouter_un_fournisseur $liste_des_fournisseurs $editer_un_fournisseur\"
                                            :class=\"{'' : activeDropdown === 'fournisseur'}\"
                                            @click=\"activeDropdown === 'fournisseur' ? activeDropdown = null : activeDropdown = 'fournisseur'\"
                                            >
                                            <div class=\"flex items-center\">
                                                <svg class=\"shrink-0 group-hover:!text-primary\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                 <path opacity=\"0.5\" d=\"M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22Z\" fill=\"currentColor\"></path>
                                                 <path d=\"M18.75 8C18.75 8.41421 18.4142 8.75 18 8.75H6C5.58579 8.75 5.25 8.41421 5.25 8C5.25 7.58579 5.58579 7.25 6 7.25H18C18.4142 7.25 18.75 7.58579 18.75 8Z\" fill=\"currentColor\"></path>
                                                 <path d=\"M18.75 12C18.75 12.4142 18.4142 12.75 18 12.75H6C5.58579 12.75 5.25 12.4142 5.25 12C5.25 11.5858 5.58579 11.25 6 11.25H18C18.4142 11.25 18.75 11.5858 18.75 12Z\" fill=\"currentColor\"></path>
                                                 <path d=\"M18.75 16C18.75 16.4142 18.4142 16.75 18 16.75H6C5.58579 16.75 5.25 16.4142 5.25 16C5.25 15.5858 5.58579 15.25 6 15.25H18C18.4142 15.25 18.75 15.5858 18.75 16Z\" fill=\"currentColor\"></path>
                                                </svg>
                                                <span class=\"text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark\">Gestion des fournisseurs</span>
                                            </div>
                                            <div class=\"rtl:rotate-180\" :class=\"{'!rotate-90' : activeDropdown === 'fournisseur'}\">
                                                <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                    <path
                                                    d=\"M9 5L15 12L9 19\"
                                                    stroke=\"currentColor\"
                                                    stroke-width=\"1.5\"
                                                    stroke-linecap=\"round\"
                                                    stroke-linejoin=\"round\"
                                                    />
                                                </svg>
                                            </div>
                                        </button>
                                        <ul x-cloak x-show=\"activeDropdown === 'fournisseur'\" x-collapse class=\"sub-menu text-gray-500\">
                                            <li>
                                                <a href=\"ajouter_un_fournisseur.php\" class=\"$ajouter_un_fournisseur\">Ajouter fournisseur</a>
                                            </li>
                                            <li>
                                                <a href=\"liste_des_fournisseurs.php\" class=\"$liste_des_fournisseurs\">Liste des fournisseurs</a>
                                            </li>
                                        </ul>
                                    </li>
                                    ";
                                } 
                                ?>

                                <?php 
                                    if ($code === 'P') {
                                      echo "
                                      <li class=\"menu nav-item\">
                                          <button
                                              type=\"button\"
                                              class=\"nav-link group $achats_a_credit $achats_simple $liste_achats\"
                                              :class=\"{'' : activeDropdown === 'achat'}\"
                                              @click=\"activeDropdown === 'achat' ? activeDropdown = null : activeDropdown = 'achat'\"
                                          >
                                          <div class=\"flex items-center\">
                                                  <svg class=\"shrink-0 group-hover:!text-primary\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                  <path opacity=\"0.5\" d=\"M13 15.4C13 13.3258 13 12.2887 13.659 11.6444C14.318 11 15.3787 11 17.5 11C19.6213 11 20.682 11 21.341 11.6444C22 12.2887 22 13.3258 22 15.4V17.6C22 19.6742 22 20.7113 21.341 21.3556C20.682 22 19.6213 22 17.5 22C15.3787 22 14.318 22 13.659 21.3556C13 20.7113 13 19.6742 13 17.6V15.4Z\" fill=\"currentColor\"></path>
                                                  <path d=\"M2 8.6C2 10.6742 2 11.7113 2.65901 12.3556C3.31802 13 4.37868 13 6.5 13C8.62132 13 9.68198 13 10.341 12.3556C11 11.7113 11 10.6742 11 8.6V6.4C11 4.32582 11 3.28873 10.341 2.64437C9.68198 2 8.62132 2 6.5 2C4.37868 2 3.31802 2 2.65901 2.64437C2 3.28873 2 4.32582 2 6.4V8.6Z\" fill=\"currentColor\"></path>
                                                  <path d=\"M13 5.5C13 4.4128 13 3.8692 13.1713 3.44041C13.3996 2.86867 13.8376 2.41443 14.389 2.17761C14.8024 2 15.3266 2 16.375 2H18.625C19.6734 2 20.1976 2 20.611 2.17761C21.1624 2.41443 21.6004 2.86867 21.8287 3.44041C22 3.8692 22 4.4128 22 5.5C22 6.5872 22 7.1308 21.8287 7.55959C21.6004 8.13133 21.1624 8.58557 20.611 8.82239C20.1976 9 19.6734 9 18.625 9H16.375C15.3266 9 14.8024 9 14.389 8.82239C13.8376 8.58557 13.3996 8.13133 13.1713 7.55959C13 7.1308 13 6.5872 13 5.5Z\" fill=\"currentColor\"></path>
                                                  <path opacity=\"0.5\" d=\"M2 18.5C2 19.5872 2 20.1308 2.17127 20.5596C2.39963 21.1313 2.83765 21.5856 3.38896 21.8224C3.80245 22 4.32663 22 5.375 22H7.625C8.67337 22 9.19755 22 9.61104 21.8224C10.1624 21.5856 10.6004 21.1313 10.8287 20.5596C11 20.1308 11 19.5872 11 18.5C11 17.4128 11 16.8692 10.8287 16.4404C10.6004 15.8687 10.1624 15.4144 9.61104 15.1776C9.19755 15 8.67337 15 7.625 15H5.375C4.32663 15 3.80245 15 3.38896 15.1776C2.83765 15.4144 2.39963 15.8687 2.17127 16.4404C2 16.8692 2 17.4128 2 18.5Z\" fill=\"currentColor\"></path>
                                                  </svg>
                                                  <span class=\"text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark\">Achats</span>
                                              </div>
                                              <div class=\"rtl:rotate-180\" :class=\"{'!rotate-90' : activeDropdown === 'achat'}\">
                                                  <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                      <path
                                                          d=\"M9 5L15 12L9 19\"
                                                          stroke=\"currentColor\"
                                                          stroke-width=\"1.5\"
                                                          stroke-linecap=\"round\"
                                                          stroke-linejoin=\"round\"
                                                      />
                                                  </svg>
                                              </div>
                                          </button>
                                          <ul x-cloak x-show=\"activeDropdown === 'achat'\" x-collapse class=\"sub-menu text-gray-500\">
                                              <li>
                                                  <a href=\"liste_achats.php\" class=\"$liste_achats\">Liste des achats</a>
                                              </li>
                                              <li>
                                                  <a href=\"achats_simple.php\" class=\"$achats_simple\">Achats simple</a>
                                              </li>
                                              <li>
                                                  <a href=\"achats_a_credit.php\" class=\"$achats_a_credit\">Achats à credit</a>
                                              </li>
                                          </ul>
                                      </li>
                                        ";
                                   } 
                                ?>

                                <?php  
                                      if ($code === 'P') {
                                          echo "
                                          <li class=\"menu nav-item\">
                                            <button
                                            type=\"button\"
                                            class=\"nav-link group  $ajouter_un_client $liste_des_clients $editer_un_client\"
                                            :class=\"{'' : activeDropdown === 'client'}\"
                                            @click=\"activeDropdown === 'client' ? activeDropdown = null : activeDropdown = 'client'\"
                                            >
                                            <div class=\"flex items-center\">
                                                <svg class=\"shrink-0 group-hover:!text-primary\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\"> 
                                                <circle opacity=\"0.5\" cx=\"15\" cy=\"6\" r=\"3\" fill=\"currentColor\">
                                                </circle> <ellipse opacity=\"0.5\" cx=\"16\" cy=\"17\" rx=\"5\" ry=\"3\" fill=\"currentColor\"></ellipse> 
                                                <circle cx=\"9.00098\" cy=\"6\" r=\"4\" fill=\"currentColor\"></circle> 
                                                <ellipse cx=\"9.00098\" cy=\"17.001\" rx=\"7\" ry=\"4\" fill=\"currentColor\"></ellipse> </svg>
                                                <span class=\"text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark\">Gestion des clients</span>
                                            </div>
                                            <div class=\"rtl:rotate-180\" :class=\"{'!rotate-90' : activeDropdown === 'client'}\">
                                                <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                    <path
                                                    d=\"M9 5L15 12L9 19\"
                                                    stroke=\"currentColor\"
                                                    stroke-width=\"1.5\"
                                                    stroke-linecap=\"round\"
                                                    stroke-linejoin=\"round\"
                                                    />
                                                </svg>
                                            </div>
                                        </button>
                                        <ul x-cloak x-show=\"activeDropdown === 'client'\" x-collapse class=\"sub-menu text-gray-500\">
                                            <li>
                                                <a href=\"ajouter_un_client.php\" class=\"$ajouter_un_client\">Ajouter un client</a>
                                            </li>
                                            <li>
                                                <a href=\"liste_des_clients.php\" class=\"$liste_des_clients\">Liste des clients</a>
                                            </li>
                                            <li>
                                                <a href=\"dettes_des_clients.php\" class=\"$dettes_des_clients\">Dettes des clients</a>
                                            </li>
                                        </ul>
                                    </li>
                                    ";
                                } 
                                ?>
                                
                                 <?php  
                                      if ($code === 'P') {
                                          echo "
                                          <li class=\"menu nav-item\">
                                            <button
                                            type=\"button\"
                                            class=\"nav-link group $ajouter_un_produit $liste_des_produits $categorie_de_produit $editer_un_produit\"
                                            :class=\"{'' : activeDropdown === 'produit'}\"
                                            @click=\"activeDropdown === 'produit' ? activeDropdown = null : activeDropdown = 'produit'\"
                                            >
                                            <div class=\"flex items-center\">
                                            <svg class=\"shrink-0 group-hover:!text-primary\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                               <path d=\"M8.42229 20.6181C10.1779 21.5395 11.0557 22.0001 12 22.0001V12.0001L2.63802 7.07275C2.62423 7.09491 2.6107 7.11727 2.5974 7.13986C2 8.15436 2 9.41678 2 11.9416V12.0586C2 14.5834 2 15.8459 2.5974 16.8604C3.19479 17.8749 4.27063 18.4395 6.42229 19.5686L8.42229 20.6181Z\" fill=\"currentColor\"></path>
                                               <path opacity=\"0.7\" d=\"M17.5774 4.43152L15.5774 3.38197C13.8218 2.46066 12.944 2 11.9997 2C11.0554 2 10.1776 2.46066 8.42197 3.38197L6.42197 4.43152C4.31821 5.53552 3.24291 6.09982 2.6377 7.07264L11.9997 12L21.3617 7.07264C20.7564 6.09982 19.6811 5.53552 17.5774 4.43152Z\" fill=\"currentColor\"></path>
                                               <path opacity=\"0.5\" d=\"M21.4026 7.13986C21.3893 7.11727 21.3758 7.09491 21.362 7.07275L12 12.0001V22.0001C12.9443 22.0001 13.8221 21.5395 15.5777 20.6181L17.5777 19.5686C19.7294 18.4395 20.8052 17.8749 21.4026 16.8604C22 15.8459 22 14.5834 22 12.0586V11.9416C22 9.41678 22 8.15436 21.4026 7.13986Z\" fill=\"currentColor\"></path>
                                            </svg>
                                                <span class=\"text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark\">Gestion des produits</span>
                                            </div>
                                            <div class=\"rtl:rotate-180\" :class=\"{'!rotate-90' : activeDropdown === 'produit'}\">
                                                <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                    <path
                                                    d=\"M9 5L15 12L9 19\"
                                                    stroke=\"currentColor\"
                                                    stroke-width=\"1.5\"
                                                    stroke-linecap=\"round\"
                                                    stroke-linejoin=\"round\"
                                                    />
                                                </svg>
                                            </div>
                                        </button>
                                        <ul x-cloak x-show=\"activeDropdown === 'produit'\" x-collapse class=\"sub-menu text-gray-500\">
                                            <li>
                                                <a href=\"ajouter_un_produit.php\" class=\"$ajouter_un_produit\">Ajouter un produit</a>
                                            </li>
                                            <li>
                                                <a href=\"liste_des_produits.php\" class=\"$liste_des_produits $editer_un_produit\">Liste des produits</a>
                                            </li>
                                            <li>
                                                <a href=\"categorie_de_produit.php\" class=\"$categorie_de_produit\">Catégorie de produit</a>
                                            </li>
                                        </ul>
                                    </li>
                                    ";
                                } 
                                ?>
                                <?php  
                                 if ($code === 'P' || $code === 'V') {
                                   echo "
                                   <li class=\"nav-item\">
                                       <a href=\"faire_une_vente.php\" class=\"$faire_une_vente\") { echo \"active\"; } \">
                                           <div class=\"flex items-center\">
                                           <svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                           <path opacity=\"0.5\" d=\"M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                           <path opacity=\"0.5\" d=\"M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                           <path d=\"M2.26121 3.09184L2.50997 2.38429H2.50997L2.26121 3.09184ZM2.24876 2.29246C1.85799 2.15507 1.42984 2.36048 1.29246 2.75124C1.15507 3.14201 1.36048 3.57016 1.75124 3.70754L2.24876 2.29246ZM4.58584 4.32298L5.20507 3.89983V3.89983L4.58584 4.32298ZM5.88772 14.5862L5.34345 15.1022H5.34345L5.88772 14.5862ZM20.6578 9.88275L21.3923 10.0342L21.3933 10.0296L20.6578 9.88275ZM20.158 12.3075L20.8926 12.4589L20.158 12.3075ZM20.7345 6.69708L20.1401 7.15439L20.7345 6.69708ZM19.1336 15.0504L18.6598 14.469L19.1336 15.0504ZM5.70808 9.76V7.03836H4.20808V9.76H5.70808ZM2.50997 2.38429L2.24876 2.29246L1.75124 3.70754L2.01245 3.79938L2.50997 2.38429ZM10.9375 16.25H16.2404V14.75H10.9375V16.25ZM5.70808 7.03836C5.70808 6.3312 5.7091 5.7411 5.65719 5.26157C5.60346 4.76519 5.48705 4.31247 5.20507 3.89983L3.96661 4.74613C4.05687 4.87822 4.12657 5.05964 4.1659 5.42299C4.20706 5.8032 4.20808 6.29841 4.20808 7.03836H5.70808ZM2.01245 3.79938C2.68006 4.0341 3.11881 4.18965 3.44166 4.34806C3.74488 4.49684 3.87855 4.61727 3.96661 4.74613L5.20507 3.89983C4.92089 3.48397 4.54304 3.21763 4.10241 3.00143C3.68139 2.79485 3.14395 2.60719 2.50997 2.38429L2.01245 3.79938ZM4.20808 9.76C4.20808 11.2125 4.22171 12.2599 4.35876 13.0601C4.50508 13.9144 4.79722 14.5261 5.34345 15.1022L6.43198 14.0702C6.11182 13.7325 5.93913 13.4018 5.83723 12.8069C5.72607 12.1578 5.70808 11.249 5.70808 9.76H4.20808ZM10.9375 14.75C9.52069 14.75 8.53763 14.7482 7.79696 14.6432C7.08215 14.5418 6.70452 14.3576 6.43198 14.0702L5.34345 15.1022C5.93731 15.7286 6.69012 16.0013 7.58636 16.1283C8.45674 16.2518 9.56535 16.25 10.9375 16.25V14.75ZM4.95808 6.87H17.0888V5.37H4.95808V6.87ZM19.9232 9.73135L19.4235 12.1561L20.8926 12.4589L21.3923 10.0342L19.9232 9.73135ZM17.0888 6.87C17.9452 6.87 18.6989 6.871 19.2937 6.93749C19.5893 6.97053 19.8105 7.01643 19.9659 7.07105C20.1273 7.12776 20.153 7.17127 20.1401 7.15439L21.329 6.23978C21.094 5.93436 20.7636 5.76145 20.4632 5.65587C20.1567 5.54818 19.8101 5.48587 19.4604 5.44678C18.7646 5.369 17.9174 5.37 17.0888 5.37V6.87ZM21.3933 10.0296C21.5625 9.18167 21.7062 8.47024 21.7414 7.90038C21.7775 7.31418 21.7108 6.73617 21.329 6.23978L20.1401 7.15439C20.2021 7.23508 20.2706 7.38037 20.2442 7.80797C20.2168 8.25191 20.1002 8.84478 19.9223 9.73595L21.3933 10.0296ZM16.2404 16.25C17.0021 16.25 17.6413 16.2513 18.1566 16.1882C18.6923 16.1227 19.1809 15.9794 19.6074 15.6318L18.6598 14.469C18.5346 14.571 18.3571 14.6525 17.9744 14.6994C17.5712 14.7487 17.0397 14.75 16.2404 14.75V16.25ZM19.4235 12.1561C19.2621 12.9389 19.1535 13.4593 19.0238 13.8442C18.9007 14.2095 18.785 14.367 18.6598 14.469L19.6074 15.6318C20.0339 15.2842 20.2729 14.8346 20.4453 14.3232C20.6111 13.8312 20.7388 13.2049 20.8926 12.4589L19.4235 12.1561Z\" fill=\"currentColor\"></path>
                                           <path opacity=\"0.5\" d=\"M9.5 9L10.0282 12.1179\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                           <path opacity=\"0.5\" d=\"M15.5283 9L15.0001 12.1179\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                           </svg>
                                               <span class=\"text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark\">Faire une vente</span>
                                           </div>
                                       </a>
                                   </li>
                                        ";
                                } 
                            ?>  
                        </ul>
                    </div>
                </nav>
            </div>