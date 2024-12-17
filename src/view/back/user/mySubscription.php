<?php 

// Check if the user is not logged in (i.e., if $_SESSION['login'] does not exist)
if (!isset($_SESSION['user'])) {
    ?>
<script>
    alert('Veuillez vous connecter d\'abord');
    window.location.replace('index.php?action=loginPage');
</script>
<?php
        // Exit to stop further execution of the script after the redirect
        exit();
    }
    $title = "THC - Abonnement";

ob_start(); ?>

<main class="main" id='app'>
    <section class="section">
        <div class="row ">
            <div class="col-12"> <br><br><br><br>
                <div class="dashboard">
                    <?php include 'menu.php'; ?>

                    <div class="dashboard__content">
                        <div class="dashboard__content__top">
                            <h2>
                                Abonnement
                            </h2>

                            <?php include 'profile_name.php'; ?>
                        </div>

                        <div class="dashboard__content__main mt-2">
                            <div class="top">
                                <h3>
                                    Abonnement en cours
                                </h3>
                            </div>

                            <div class="pricing" id="pricing" style="margin-top: -20px;">
                                <div class="pricing__content">
                                <div class="pricing__content__item">
                                    <span class="offer-name">
                                    <i class="fas fa-leaf"></i> Starter
                                    </span>
                                    <ul>
                                    <li><i class="fas fa-check"></i> 2 livraisons / semaine</li>
                                    </ul>
                                    <strong class="price">
                                    <i class="fas fa-coins"></i> 6.000 XOF
                                    </strong>

                                    <span>
                                        Expiration: <strong>
                                            15/01/2025
                                        </strong>
                                    </span>
                                </div>
                                </div>
                            </div>

                            <h3>
                                Choisir un abonnement
                            </h3>

                            <div class="pricing" id="pricing" style="margin-top: -20px;">
                                <div class="pricing__content">
                                <div class="pricing__content__item">
                                    <span class="offer-name">
                                    <i class="fas fa-leaf"></i> Starter
                                    </span>
                                    <ul>
                                    <li><i class="fas fa-check"></i> 2 livraisons / semaine</li>
                                    </ul>
                                    <strong class="price">
                                    <i class="fas fa-coins"></i> 6.000 XOF
                                    </strong>
                                    <a href="index.php?action=registerPage" class="btn-select">Choisir</a>
                                </div>
                                <div class="pricing__content__item featured">
                                    <span class="offer-name">
                                    <i class="fas fa-star"></i> Premium
                                    </span>
                                    <ul>
                                    <li><i class="fas fa-check"></i> 3 livraisons / semaine</li>
                                    </ul>
                                    <strong class="price">
                                    <i class="fas fa-coins"></i> 7.000 XOF
                                    </strong>
                                    <a href="index.php?action=registerPage" class="btn-select">Choisir</a>
                                </div>
                                <div class="pricing__content__item">
                                    <span class="offer-name">
                                    <i class="fas fa-gem"></i> Gold
                                    </span>
                                    <ul>
                                    <li><i class="fas fa-check"></i> 5 livraisons / semaine</li>
                                    </ul>
                                    <strong class="price">
                                    <i class="fas fa-coins"></i> 10.000 XOF
                                    </strong>
                                    <a href="index.php?action=registerPage" class="btn-select">Choisir</a>
                                </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>




<?php $content = ob_get_clean(); ?>

<?php require './src/view/layout.php'; ?>

<script>
    const app = Vue.createApp({
        data() {
            return {
                showAffiliated: false,
                details: [],
                currentPage: 1,
                itemsPerPage: 10,
                selectedDetail: null,
            };
        },
        mounted() {
            this.getUserDatas();
            this.displayAffiliated();
        },
        computed: {
            totalPages() {
                return Math.ceil(this.details.length / this.itemsPerPage);
            },
            paginatedData() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                return this.details.slice(start, end);
            },
        },
        methods: {
            getUserDatas() {
                axios.get('api/script.php?action=getMyDatas')
                    .then((response) => {
                        console.log(response.data.first_name);
                        this.details = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });

            },
            displayAffiliated() {
                this.showAffiliated = true;
                axios.get('api/script.php?action=myAffiliated')
                    .then((response) => {
                        console.log(response.data);
                        this.details = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            formatDate(date) {
                const [year, month, day] = date.split('-');
                return `${day}-${month}-${year}`;
            },
            capitalize(string) {
                return string.toUpperCase();
            },
            capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
            },
            previousPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                }
            },
            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                }
            },
            gotoPage(page) {
                this.currentPage = page;
            },
        },
    });

    app.mount('#app');
</script>