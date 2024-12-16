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

                            <div class="profil">
                                <p>
                                    Bonjour
                                    <span>
                                        <?php echo ucfirst($_SESSION['user']['first_name']); ?>

                                        <?php echo strtoupper($_SESSION['user']['last_name']); ?>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="dashboard__content__main mt-2" v-if='showAffiliated'>
                            <div class="top">
                                <h3>
                                    Abonnement en cours
                                </h3>
                            </div>

                            <div class="table-container">

                                <table class="orders-table">

                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Abonnement</th>
                                            <th>Date d'expiration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>15/06/2023</td>
                                            <td><i data-lucide="apple" aria-hidden="true"></i> Pack starter</td>
                                            <td><span class="status delivered">Actif</span></td>
                                            <td><span class="status">600 XOF</span></td>
                                        </tr>
                                        <tr>
                                            <td>15/06/2023</td>
                                            <td><i data-lucide="apple" aria-hidden="true"></i> hjjj Doe</td>
                                            <td><span class="status delivered">Actif</span></td>
                                            <td><span class="status">1600 XOF</span></td>
                                            <td><span class="status delivered">
                                                Transféré
                                            </span></td>
                                        </tr>
                                        <tr>
                                            <td>15/06/2023</td>
                                            <td><i data-lucide="apple" aria-hidden="true"></i> John Doe</td>
                                            <td><span class="status delivered">Actif</span></td>
                                            <td><span class="status ">1200 XOF</span></td>
                                            <td><span class="status delivered">
                                                Transféré
                                            </span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                <button class="btn btn-icon">
                                    Precedent
                                </button>
                                <span>Page 1 sur 3</span>
                                <button class="btn btn-icon">
                                    Suivant
                                </button>
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