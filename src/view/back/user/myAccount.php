<?php 

 include 'check_session.php'; 

    $title = "THC - Mon compte";

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
                                Paramètres du compte
                            </h2>

                            <?php include 'profile_name.php'; ?>
                        </div>

                        <div class="dashboard__content__main"> 
                            <div class="row">
                                <div class="col-md-10 col-sm-12 mx-auto p-5 mt-3" style="border: 2px solid #000;" >
                                    <form class="contact-form" action="api/script.php?action=updateAccount" method="POST">
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="password">
                                                    <i class="fas fa-lock"></i> Nouveau mot de passe
                                                </label>
                                                <input type="password" id="password" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm_password">
                                                    <i class="fas fa-lock"></i> Confirmez le mot de passe
                                                </label>
                                                <input type="password" id="password2" name="password2" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="adress">
                                                    <i class="fas fa-map-marker-alt"></i> Adresse de livraison
                                                </label>
                                                <input type="text" id="adress" name="adress" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">
                                                    <i class="fas fa-phone"></i> Téléphone
                                                </label>
                                                <input type="tel" id="phone" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-6 text-center mx-auto">
                                            <button type="submit" class="submit-btn mx-auto">
                                                <i class="fas fa-check-plus"></i> Valider
                                            </button>
                                        </div>
                                    </form>
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
                showMyAffiliations: false,
                details: [],
                affiliated: [],
                currentPage: 1,
                itemsPerPage: 10,
                selectedDetail: null,
            };
        },
        mounted() {
            this.getUserDatas();
            this.displayMyAfffiliations();
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
            displayMyAffiliations() {
                this.showNextOrders = false;
                axios.get('api/script.php?action=getMyAffiliations')
                    .then((response) => {
                        console.log(response.data);
                        this.affiliated = response.data;
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