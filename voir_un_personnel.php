<?php include 'layouts/control.php';
$id = $_REQUEST['id'];
?>
<!DOCTYPE html>
<html lang="fr-CM">

    <?php include 'layouts/head.php'; ?>
    <?php $valeur ="editer_un_personnel";?>

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
                                <a href="javascript:;" class="text-primary hover:underline">Personnel</a>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                                <span>Profile</span>
                            </li>
                            <?php if (isset($_SESSION['successMessage'])) { echo '<script>' . $_SESSION['successMessage'] . '</script>'; unset($_SESSION['successMessage']); } ?>
                        </ul>
                        <div class="pt-5">
                            <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-3 xl:grid-cols-4">
                                <div class="panel">
                                    <div class="mb-5 flex items-center justify-between">
                                        <h5 class="text-lg font-semibold dark:text-white-light">Profile</h5>
                                        <a href="editer_un_personnel.php?id=<?php echo $id; ?>" class="btn btn-primary rounded-full p-2 ltr:ml-auto rtl:mr-auto">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                                <path opacity="0.5" d="M4 22H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                <path
                                                    d="M14.6296 2.92142L13.8881 3.66293L7.07106 10.4799C6.60933 10.9416 6.37846 11.1725 6.17992 11.4271C5.94571 11.7273 5.74491 12.0522 5.58107 12.396C5.44219 12.6874 5.33894 12.9972 5.13245 13.6167L4.25745 16.2417L4.04356 16.8833C3.94194 17.1882 4.02128 17.5243 4.2485 17.7515C4.47573 17.9787 4.81182 18.0581 5.11667 17.9564L5.75834 17.7426L8.38334 16.8675L8.3834 16.8675C9.00284 16.6611 9.31256 16.5578 9.60398 16.4189C9.94775 16.2551 10.2727 16.0543 10.5729 15.8201C10.8275 15.6215 11.0583 15.3907 11.5201 14.929L11.5201 14.9289L18.3371 8.11195L19.0786 7.37044C20.3071 6.14188 20.3071 4.14999 19.0786 2.92142C17.85 1.69286 15.8581 1.69286 14.6296 2.92142Z"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                />
                                                <path
                                                    opacity="0.5"
                                                    d="M13.8879 3.66406C13.8879 3.66406 13.9806 5.23976 15.3709 6.63008C16.7613 8.0204 18.337 8.11308 18.337 8.11308M5.75821 17.7437L4.25732 16.2428"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="mb-5">
                                    <?php
                                      function getPersonnelById($id) {
                                        $pdo = getConnection();
                                        $query = "SELECT * FROM personnels WHERE id_personnels = :id";
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
                                     $personnel = getPersonnelById($id);
                                    ?>
                                        <div class="flex flex-col items-center justify-center">
                                            <img src="<?php echo $personnel["image_personnels"]; ?>" alt="image" class="mb-5 h-24 w-24 rounded-full object-cover" />
                                            <p class="text-xl font-semibold text-primary"><?php echo $personnel["nom_personnels"]; ?> <?php echo $personnel["prenom_personnels"]; ?></p>
                                        </div>
                                        <ul class="m-auto mt-5 flex max-w-[160px] flex-col space-y-4 font-semibold text-white-dark">
                                            <li class="flex items-center gap-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                                                    <path d="M15 20.6151C14.0907 20.8619 13.0736 21 12 21C8.13401 21 5 19.2091 5 17C5 14.7909 8.13401 13 12 13C15.866 13 19 14.7909 19 17C19 17.3453 18.9234 17.6804 18.7795 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                </svg>
                                                <?php echo $personnel["poste_personnels"]; ?>
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.6807 14.5869C19.1708 14.5869 22 11.7692 22 8.29344C22 4.81767 19.1708 2 15.6807 2C12.1907 2 9.3615 4.81767 9.3615 8.29344C9.3615 9.90338 10.0963 11.0743 10.0963 11.0743L2.45441 18.6849C2.1115 19.0264 1.63143 19.9143 2.45441 20.7339L3.33616 21.6121C3.67905 21.9048 4.54119 22.3146 5.2466 21.6121L6.27531 20.5876C7.30403 21.6121 8.4797 21.0267 8.92058 20.4412C9.65538 19.4167 8.77362 18.3922 8.77362 18.3922L9.06754 18.0995C10.4783 19.5045 11.7128 18.6849 12.1537 18.0995C12.8885 17.075 12.1537 16.0505 12.1537 16.0505C11.8598 15.465 11.272 15.465 12.0067 14.7333L12.8885 13.8551C13.5939 14.4405 15.0439 14.5869 15.6807 14.5869Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                                    <path d="M17.8853 8.29353C17.8853 9.50601 16.8984 10.4889 15.681 10.4889C14.4635 10.4889 13.4766 9.50601 13.4766 8.29353C13.4766 7.08105 14.4635 6.09814 15.681 6.09814C16.8984 6.09814 17.8853 7.08105 17.8853 8.29353Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                                <?php echo $personnel["code_personnels"]; ?>
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <svg
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 shrink-0"
                                                >
                                                    <path
                                                        d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12Z"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    />
                                                    <path opacity="0.5" d="M7 4V2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path opacity="0.5" d="M17 4V2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path opacity="0.5" d="M2 9H22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                </svg>
                                                <?php echo $personnel["date_de_naissance_personnels"]; ?>
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <svg
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 shrink-0"
                                                >
                                                    <path
                                                        opacity="0.5"
                                                        d="M4 10.1433C4 5.64588 7.58172 2 12 2C16.4183 2 20 5.64588 20 10.1433C20 14.6055 17.4467 19.8124 13.4629 21.6744C12.5343 22.1085 11.4657 22.1085 10.5371 21.6744C6.55332 19.8124 4 14.6055 4 10.1433Z"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    />
                                                    <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.5" />
                                                </svg>
                                                <?php echo $personnel["residence_personnels"]; ?>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="flex items-center gap-2">
                                                    <svg
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 shrink-0"
                                                    >
                                                        <path
                                                            opacity="0.5"
                                                            d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                        />
                                                        <path
                                                            d="M6 8L8.1589 9.79908C9.99553 11.3296 10.9139 12.0949 12 12.0949C13.0861 12.0949 14.0045 11.3296 15.8411 9.79908L18 8"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                        />
                                                    </svg>
                                                    <span class="truncate text-primary"><?php echo $personnel["email_personnels"]; ?></span></a
                                                >
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                                    <path
                                                        d="M16.1007 13.359L16.5562 12.9062C17.1858 12.2801 18.1672 12.1515 18.9728 12.5894L20.8833 13.628C22.1102 14.2949 22.3806 15.9295 21.4217 16.883L20.0011 18.2954C19.6399 18.6546 19.1917 18.9171 18.6763 18.9651M4.00289 5.74561C3.96765 5.12559 4.25823 4.56668 4.69185 4.13552L6.26145 2.57483C7.13596 1.70529 8.61028 1.83992 9.37326 2.85908L10.6342 4.54348C11.2507 5.36691 11.1841 6.49484 10.4775 7.19738L10.1907 7.48257"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    />
                                                    <path
                                                        opacity="0.5"
                                                        d="M18.6763 18.9651C17.0469 19.117 13.0622 18.9492 8.8154 14.7266C4.81076 10.7447 4.09308 7.33182 4.00293 5.74561"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    />
                                                    <path
                                                        opacity="0.5"
                                                        d="M16.1007 13.3589C16.1007 13.3589 15.0181 14.4353 12.0631 11.4971C9.10807 8.55886 10.1907 7.48242 10.1907 7.48242"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                        stroke-linecap="round"
                                                    />
                                                </svg>
                                                <span class="whitespace-nowrap" dir="ltr"><?php echo $personnel["tel_personnels"]; ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel lg:col-span-2 xl:col-span-3">
                                    <div class="mb-5">
                                        <h5 class="text-lg font-semibold dark:text-white-light">Statistique du compte de <b><?php echo htmlspecialchars($personnel['nom_personnels']);?> <?php echo htmlspecialchars($personnel['prenom_personnels']);?></b></h5>
                                    </div>
                                    <div class="mb-5">
                                        <div class="table-responsive font-semibold text-[#515365] dark:text-white-light">
                                            <table class="whitespace-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre de transaction</th>
                                                        <th>Historique des ventes</th>
                                                        <th>Total des ventes</th>
                                                        <th class="text-center">Fréquences de connexion</th>
                                                    </tr>
                                                </thead>
                                                <!-- <tbody class="dark:text-white-dark">
                                                    <tr>
                                                        <td>Figma Design</td>
                                                        <td class="text-danger">29.56%</td>
                                                        <td class="text-danger">29.56%</td>
                                                        <td class="text-center">2 mins ago</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Vue Migration</td>
                                                        <td class="text-danger">29.56%</td>
                                                        <td class="text-success">50%</td>
                                                        <td class="text-center">4 hrs ago</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Flutter App</td>
                                                        <td class="text-danger">29.56%</td>
                                                        <td class="text-danger">39%</td>
                                                        <td class="text-center">a min ago</td>
                                                    </tr>
                                                    <tr>
                                                        <td>API Integration</td>
                                                        <td class="text-danger">29.56%</td>
                                                        <td class="text-success">78.03%</td>
                                                        <td class="text-center">2 weeks ago</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Blog Update</td>
                                                        <td class="text-danger">29.56%</td>
                                                        <td class="text-success">100%</td>
                                                        <td class="text-center">18 hrs ago</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Landing Page</td>
                                                        <td class="text-danger">29.56%</td>
                                                        <td class="text-danger">19.15%</td>
                                                        <td class="text-center">5 days ago</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shopify Dev</td>
                                                        <td class="text-danger">29.56%</td>
                                                        <td class="text-success">60.55%</td>
                                                        <td class="text-center">8 days ago</td>
                                                    </tr>
                                                </tbody> -->
                                            </table>
                                        </div>
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
