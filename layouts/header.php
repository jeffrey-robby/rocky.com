                
              <?php
              // Préparer la requête
              $stmt = $pdo->prepare("SELECT * FROM personnels WHERE id_personnels = ?");
              $stmt->execute([$personnels]); // Assurez-vous que $id_personnel est défini et contient l'ID recherché
              
              // Récupérer le résultat
              $personnelData = $stmt->fetch(PDO::FETCH_ASSOC); // Renommez la variable ici
              ?>
                <header class="z-40" :class="{'dark' : $store.app.semidark && $store.app.menu === 'horizontal'}">
                    <div class="shadow-sm">
                        <div class="relative flex w-full items-center bg-white px-5 py-2.5 dark:bg-[#0e1726]">
                            <div class="horizontal-logo flex items-center justify-between ltr:mr-2 rtl:ml-2 lg:hidden">
                                <a href="index.php" class="main-logo flex shrink-0 items-center">
                                    <img class="inline w-8 ltr:-ml-1 rtl:-mr-1" src="favicon.png" alt="image" />
                                    <span
                                        class="hidden align-middle text-2xl font-semibold transition-all duration-300 ltr:ml-1.5 rtl:mr-1.5 dark:text-white-light md:inline"
                                        >ETS ROCKY</span
                                    >
                                </a>

                                <a
                                    href="javascript:;"
                                    class="collapse-icon flex flex-none rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary ltr:ml-2 rtl:mr-2 dark:bg-dark/40 dark:text-[#d0d2d6] dark:hover:bg-dark/60 dark:hover:text-primary lg:hidden"
                                    @click="$store.app.toggleSidebar()"
                                >
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </a>
                            </div>
                            <div class="hidden ltr:mr-2 rtl:ml-2 sm:block">
                                <ul class="flex items-center space-x-2 rtl:space-x-reverse dark:text-[#d0d2d6]">
                               <?php if ($code === 'P') {
                                   echo "
                                   <li>
                                       <a
                                           href=\"index.php\" x-tooltip=\"Accueil\" 
                                           class=\"block rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60\"
                                       >
                                           <svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                               <path opacity=\"0.5\" d=\"M2.5 6.5C2.5 4.29086 4.29086 2.5 6.5 2.5C8.70914 2.5 10.5 4.29086 10.5 6.5V9.16667C10.5 9.47666 10.5 9.63165 10.4659 9.75882C10.3735 10.1039 10.1039 10.3735 9.75882 10.4659C9.63165 10.5 9.47666 10.5 9.16667 10.5H6.5C4.29086 10.5 2.5 8.70914 2.5 6.5Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                               <path opacity=\"0.5\" d=\"M13.5 14.8333C13.5 14.5233 13.5 14.3683 13.5341 14.2412C13.6265 13.8961 13.8961 13.6265 14.2412 13.5341C14.3683 13.5 14.5233 13.5 14.8333 13.5H17.5C19.7091 13.5 21.5 15.2909 21.5 17.5C21.5 19.7091 19.7091 21.5 17.5 21.5C15.2909 21.5 13.5 19.7091 13.5 17.5V14.8333Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                               <path d=\"M2.5 17.5C2.5 15.2909 4.29086 13.5 6.5 13.5H8.9C9.46005 13.5 9.74008 13.5 9.95399 13.609C10.1422 13.7049 10.2951 13.8578 10.391 14.046C10.5 14.2599 10.5 14.5399 10.5 15.1V17.5C10.5 19.7091 8.70914 21.5 6.5 21.5C4.29086 21.5 2.5 19.7091 2.5 17.5Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                               <path d=\"M13.5 6.5C13.5 4.29086 15.2909 2.5 17.5 2.5C19.7091 2.5 21.5 4.29086 21.5 6.5C21.5 8.70914 19.7091 10.5 17.5 10.5H14.6429C14.5102 10.5 14.4438 10.5 14.388 10.4937C13.9244 10.4415 13.5585 10.0756 13.5063 9.61196C13.5 9.55616 13.5 9.48982 13.5 9.35714V6.5Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                           </svg>
                                       </a>
                                   </li>
                                    ";
                                  } 
                                  if ($code === 'P') {
                                    echo "
                                    <li>
                                        <a
                                            href=\"faire_une_vente.php\" x-tooltip=\"Faire une vente\"
                                            class=\"block rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60\"
                                        >
                                            <svg  width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                <path opacity=\"0.5\" d=\"M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                                <path opacity=\"0.5\" d=\"M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z\" stroke=\"currentColor\" stroke-width=\"1.5\"></path>
                                                <path d=\"M2.26121 3.09184L2.50997 2.38429H2.50997L2.26121 3.09184ZM2.24876 2.29246C1.85799 2.15507 1.42984 2.36048 1.29246 2.75124C1.15507 3.14201 1.36048 3.57016 1.75124 3.70754L2.24876 2.29246ZM4.58584 4.32298L5.20507 3.89983V3.89983L4.58584 4.32298ZM5.88772 14.5862L5.34345 15.1022H5.34345L5.88772 14.5862ZM20.6578 9.88275L21.3923 10.0342L21.3933 10.0296L20.6578 9.88275ZM20.158 12.3075L20.8926 12.4589L20.158 12.3075ZM20.7345 6.69708L20.1401 7.15439L20.7345 6.69708ZM19.1336 15.0504L18.6598 14.469L19.1336 15.0504ZM5.70808 9.76V7.03836H4.20808V9.76H5.70808ZM2.50997 2.38429L2.24876 2.29246L1.75124 3.70754L2.01245 3.79938L2.50997 2.38429ZM10.9375 16.25H16.2404V14.75H10.9375V16.25ZM5.70808 7.03836C5.70808 6.3312 5.7091 5.7411 5.65719 5.26157C5.60346 4.76519 5.48705 4.31247 5.20507 3.89983L3.96661 4.74613C4.05687 4.87822 4.12657 5.05964 4.1659 5.42299C4.20706 5.8032 4.20808 6.29841 4.20808 7.03836H5.70808ZM2.01245 3.79938C2.68006 4.0341 3.11881 4.18965 3.44166 4.34806C3.74488 4.49684 3.87855 4.61727 3.96661 4.74613L5.20507 3.89983C4.92089 3.48397 4.54304 3.21763 4.10241 3.00143C3.68139 2.79485 3.14395 2.60719 2.50997 2.38429L2.01245 3.79938ZM4.20808 9.76C4.20808 11.2125 4.22171 12.2599 4.35876 13.0601C4.50508 13.9144 4.79722 14.5261 5.34345 15.1022L6.43198 14.0702C6.11182 13.7325 5.93913 13.4018 5.83723 12.8069C5.72607 12.1578 5.70808 11.249 5.70808 9.76H4.20808ZM10.9375 14.75C9.52069 14.75 8.53763 14.7482 7.79696 14.6432C7.08215 14.5418 6.70452 14.3576 6.43198 14.0702L5.34345 15.1022C5.93731 15.7286 6.69012 16.0013 7.58636 16.1283C8.45674 16.2518 9.56535 16.25 10.9375 16.25V14.75ZM4.95808 6.87H17.0888V5.37H4.95808V6.87ZM19.9232 9.73135L19.4235 12.1561L20.8926 12.4589L21.3923 10.0342L19.9232 9.73135ZM17.0888 6.87C17.9452 6.87 18.6989 6.871 19.2937 6.93749C19.5893 6.97053 19.8105 7.01643 19.9659 7.07105C20.1273 7.12776 20.153 7.17127 20.1401 7.15439L21.329 6.23978C21.094 5.93436 20.7636 5.76145 20.4632 5.65587C20.1567 5.54818 19.8101 5.48587 19.4604 5.44678C18.7646 5.369 17.9174 5.37 17.0888 5.37V6.87ZM21.3933 10.0296C21.5625 9.18167 21.7062 8.47024 21.7414 7.90038C21.7775 7.31418 21.7108 6.73617 21.329 6.23978L20.1401 7.15439C20.2021 7.23508 20.2706 7.38037 20.2442 7.80797C20.2168 8.25191 20.1002 8.84478 19.9223 9.73595L21.3933 10.0296ZM16.2404 16.25C17.0021 16.25 17.6413 16.2513 18.1566 16.1882C18.6923 16.1227 19.1809 15.9794 19.6074 15.6318L18.6598 14.469C18.5346 14.571 18.3571 14.6525 17.9744 14.6994C17.5712 14.7487 17.0397 14.75 16.2404 14.75V16.25ZM19.4235 12.1561C19.2621 12.9389 19.1535 13.4593 19.0238 13.8442C18.9007 14.2095 18.785 14.367 18.6598 14.469L19.6074 15.6318C20.0339 15.2842 20.2729 14.8346 20.4453 14.3232C20.6111 13.8312 20.7388 13.2049 20.8926 12.4589L19.4235 12.1561Z\" fill=\"currentColor\"></path>
                                                <path opacity=\"0.5\" d=\"M9.5 9L10.0282 12.1179\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                <path opacity=\"0.5\" d=\"M15.5283 9L15.0001 12.1179\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    ";
                                  } 
                                  if ($code === 'P') {
                                    echo "
                                    <li>
                                        <a
                                            href=\"liste_de_vente.php\"  x-tooltip=\"Liste de vente\"
                                            class=\"block rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60\"
                                        >
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
                                        </a>
                                    </li>
                                    ";
                                  } 
                                  if ($code === 'P') {
                                    echo "
                                    <li>
                                        <a
                                            href=\"ajouter_un_produit.php\" x-tooltip=\"Ajouter un nouveau produit\"
                                            class=\"block rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60\"
                                        >
                                            <svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                <path d=\"M8 22.0002H16C18.8284 22.0002 20.2426 22.0002 21.1213 21.1215C22 20.2429 22 18.8286 22 16.0002V15.0002C22 12.1718 22 10.7576 21.1213 9.8789C20.3529 9.11051 19.175 9.01406 17 9.00195M7 9.00195C4.82497 9.01406 3.64706 9.11051 2.87868 9.87889C2 10.7576 2 12.1718 2 15.0002L2 16.0002C2 18.8286 2 20.2429 2.87868 21.1215C3.17848 21.4213 3.54062 21.6188 4 21.749\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\"></path>
                                                <path d=\"M12 2L12 15M12 15L9 11.5M12 15L15 11.5\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    ";
                                  } 
                                  if ($code === 'P') {
                                    echo "
                                    <li>
                                        <a
                                            href=\"ajouter_un_client.php\" x-tooltip=\"Ajouter un nouveau client\"
                                            class=\"block rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60\"
                                        >
                                            <svg class=\"shrink-0 group-hover:!text-primary\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\"> 
                                            <circle opacity=\"0.5\" cx=\"15\" cy=\"6\" r=\"3\" fill=\"currentColor\">
                                            </circle> <ellipse opacity=\"0.5\" cx=\"16\" cy=\"17\" rx=\"5\" ry=\"3\" fill=\"currentColor\"></ellipse> 
                                            <circle cx=\"9.00098\" cy=\"6\" r=\"4\" fill=\"currentColor\"></circle> 
                                            <ellipse cx=\"9.00098\" cy=\"17.001\" rx=\"7\" ry=\"4\" fill=\"currentColor\"></ellipse> </svg>
                                        </a>
                                    </li>
                                    ";
                                  } 
                                ?>
                                </ul>
                            </div>
                            <div
                                x-data="header"
                                class="flex items-center space-x-1.5 ltr:ml-auto rtl:mr-auto rtl:space-x-reverse dark:text-[#d0d2d6] sm:flex-1 ltr:sm:ml-0 sm:rtl:mr-0 lg:space-x-2"
                            >
                                <div class="sm:ltr:mr-auto sm:rtl:ml-auto" x-data="{ search: false }" @click.outside="search = false">
                                </div>
                                <?php if ($code === 'P') {
                                echo "
                                <div class=\"dropdown\" x-data=\"dropdown\" @click.outside=\"open = false\">
                                    <a
                                        href=\"javascript:;\"
                                        class=\"relative block rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60\"
                                        @click=\"toggle\"
                                    >
                                        <svg  width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                            <path
                                                d=\"M19.0001 9.7041V9C19.0001 5.13401 15.8661 2 12.0001 2C8.13407 2 5.00006 5.13401 5.00006 9V9.7041C5.00006 10.5491 4.74995 11.3752 4.28123 12.0783L3.13263 13.8012C2.08349 15.3749 2.88442 17.5139 4.70913 18.0116C9.48258 19.3134 14.5175 19.3134 19.291 18.0116C21.1157 17.5139 21.9166 15.3749 20.8675 13.8012L19.7189 12.0783C19.2502 11.3752 19.0001 10.5491 19.0001 9.7041Z\"
                                                stroke=\"currentColor\"
                                                stroke-width=\"1.5\"
                                            />
                                            <path
                                                d=\"M7.5 19C8.15503 20.7478 9.92246 22 12 22C14.0775 22 15.845 20.7478 16.5 19\"
                                                stroke=\"currentColor\"
                                                stroke-width=\"1.5\"
                                                stroke-linecap=\"round\"
                                            />
                                            <path d=\"M12 6V10\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\" />
                                        </svg>

                                        <span class=\"absolute top-0 flex h-3 w-3 ltr:right-0 rtl:left-0\">
                                            <span
                                                class=\"absolute -top-[3px] inline-flex h-full w-full animate-ping rounded-full bg-success/50 opacity-75 ltr:-left-[3px] rtl:-right-[3px]\"
                                            ></span>
                                            <span class=\"relative inline-flex h-[6px] w-[6px] rounded-full bg-success\"></span>
                                        </span>
                                    </a>
                                    
                                    <ul
                                        x-cloak
                                        x-show=\"open\"
                                        x-transition
                                        x-transition.duration.300ms
                                        class=\"top-11 w-[300px] divide-y !py-0 text-dark ltr:-right-2 rtl:-left-2 dark:divide-white/10 dark:text-white-dark sm:w-[350px]\"
                                    >
                                        <li>
                                            <div class=\"flex items-center justify-between px-4 py-2 font-semibold hover:!bg-transparent\">
                                                <h4 class=\"text-lg\">Notifications</h4>
                                                <template x-if=\"notifications.length\">
                                                    <span class=\"badge bg-primary/80\" x-text=\"notifications.length + 'New'\"></span>
                                                </template>
                                            </div>
                                        </li>
                                        <template x-for=\"notification in notifications\">
                                            <li class=\"dark:text-white-light/90\">
                                                <div class=\"group flex items-center px-4 py-2\" @click.self=\"toggle\">
                                                    <div class=\"grid place-content-center rounded\">
                                                        <div class=\"relative h-12 w-12\">
                                                            <img
                                                                class=\"h-12 w-12 rounded-full object-cover\"
                                                                :src=\"`assets/images/`\"
                                                                alt=\"image\"
                                                            />
                                                            <span class=\"absolute bottom-0 right-[6px] block h-2 w-2 rounded-full bg-success\"></span>
                                                        </div>
                                                    </div>
                                                    <div class=\"flex flex-auto ltr:pl-3 rtl:pr-3\">
                                                        <div class=\"ltr:pr-3 rtl:pl-3\">
                                                            <h6 x-html=\"notification.message\"></h6>
                                                            <span class=\"block text-xs font-normal dark:text-gray-500\" x-text=\"notification.time\"></span>
                                                        </div>
                                                        <button
                                                            type=\"button\"
                                                            class=\"text-neutral-300 opacity-0 hover:text-danger group-hover:opacity-100 ltr:ml-auto rtl:mr-auto\"
                                                            @click=\"removeNotification(notification.id)\"
                                                        >
                                                            <svg width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                                <circle opacity=\"0.5\" cx=\"12\" cy=\"12\" r=\"10\" stroke=\"currentColor\" stroke-width=\"1.5\" />
                                                                <path
                                                                    d=\"M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5\"
                                                                    stroke=\"currentColor\"
                                                                    stroke-width=\"1.5\"
                                                                    stroke-linecap=\"round\"
                                                                />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        </template>
                                        <template x-if=\"notifications.length\">
                                            <li>
                                                <div class=\"p-4\">
                                                    <button class=\"btn btn-primary btn-small block w-full\" @click=\"toggle\">Lire toutes les notifications</button>
                                                </div>
                                            </li>
                                        </template>
                                        <template x-if=\"!notifications.length\">
                                            <li>
                                                <div class=\"!grid min-h-[200px] place-content-center text-lg hover:!bg-transparent\">
                                                    <div class=\"mx-auto mb-4 rounded-full text-primary ring-4 ring-primary/30\">
                                                        <svg width=\"40\" height=\"40\" viewBox=\"0 0 20 20\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                            <path
                                                                opacity=\"0.5\"
                                                                d=\"M20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10C0 15.5228 4.47715 20 10 20C15.5228 20 20 15.5228 20 10Z\"
                                                                fill=\"currentColor\"
                                                            />
                                                            <path
                                                                d=\"M10 4.25C10.4142 4.25 10.75 4.58579 10.75 5V11C10.75 11.4142 10.4142 11.75 10 11.75C9.58579 11.75 9.25 11.4142 9.25 11V5C9.25 4.58579 9.58579 4.25 10 4.25Z\"
                                                                fill=\"currentColor\"
                                                            />
                                                            <path
                                                                d=\"M10 15C10.5523 15 11 14.5523 11 14C11 13.4477 10.5523 13 10 13C9.44772 13 9 13.4477 9 14C9 14.5523 9.44772 15 10 15Z\"
                                                                fill=\"currentColor\"
                                                            />
                                                        </svg>
                                                    </div>
                                                    Pas de notifications.
                                                </div>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                                ";
                                } 
                             ?>
                                <div class="dropdown flex-shrink-0" x-data="dropdown" @click.outside="open = false">
                                    <a href="javascript:;" class="group relative" @click="toggle()">
                                        <span
                                            ><img
                                                class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100"
                                                src="<?php echo $personnelData["image_personnels"]; ?>"
                                                alt="image"
                                        /></span>
                                    </a>
                                    <ul
                                        x-cloak
                                        x-show="open"
                                        x-transition
                                        x-transition.duration.300ms
                                        class="top-11 w-[230px] !py-0 font-semibold text-dark ltr:right-0 rtl:left-0 dark:text-white-dark dark:text-white-light/90"
                                    >
                                        <li>
                                            <div class="flex items-center px-4 py-4">
                                                <div class="flex-none">
                                                    <img class="h-10 w-10 rounded-md object-cover" src="<?php echo $personnelData["image_personnels"]; ?>" alt="image" />
                                                </div>
                                                <div class="truncate ltr:pl-4 rtl:pr-4">
                                                    <h4 class="text-base">
                                                     <?php 
                                                     echo $personnelData["nom_personnels"]; 
                                                     $id_perso = $personnelData["id_personnels"];
                                                     ?>
                                                    </h4>
                                                    <a
                                                        class="text-black/60 hover:text-primary dark:text-dark-light/60 dark:hover:text-white"
                                                        href="javascript:;"
                                                        ><?php echo $personnelData["poste_personnels"]; ?></a
                                                    >
                                                </div>
                                            </div>
                                        </li>
                                        <?php 
                                           if ($code === 'P') {
                                            echo "
                                            <li>
                                                <a href=\"voir_un_personnel.php?id=$personnelData[id_personnels]\" class=\"dark:hover:text-white\" @click=\"toggle\">
                                                    <svg
                                                        class=\"h-4.5 w-4.5 shrink-0 ltr:mr-2 rtl:ml-2\"
                                                        width=\"18\"
                                                        height=\"18\"
                                                        viewBox=\"0 0 24 24\"
                                                        fill=\"none\"
                                                        xmlns=\"http://www.w3.org/2000/svg\"
                                                    >
                                                        <circle cx=\"12\" cy=\"6\" r=\"4\" stroke=\"currentColor\" stroke-width=\"1.5\" />
                                                        <path
                                                            opacity=\"0.5\"
                                                            d=\"M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z\"
                                                            stroke=\"currentColor\"
                                                            stroke-width=\"1.5\"
                                                        />
                                                    </svg>
                                                    Profile</a
                                                >
                                            </li>
                                            ";
                                           }
                                        ?>
                                        <li class="border-t border-white-light dark:border-white-light/10">
                                            <a href="logout.php" class="!py-3 text-danger" @click="toggle">
                                                <svg
                                                    class="h-4.5 w-4.5 shrink-0 rotate-90 ltr:mr-2 rtl:ml-2"
                                                    width="18"
                                                    height="18"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        opacity="0.5"
                                                        d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                        stroke-linecap="round"
                                                    />
                                                    <path
                                                        d="M12 15L12 2M12 2L15 5.5M12 2L9 5.5"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    />
                                                </svg>
                                                Se déconnecter
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>