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
    $title = "THC - Tableau de bord";

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
                                Tableau de bord
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

                        <div class="dashboard__content__menu">
                            <form class="form">
                                <label for="newRadio" class="ml-5">
                                    <input type="radio" id="newRadio" name="options" @click="displayNextOrders()">
                                    Prochaines commandes
                                </label>
                                <label for="allRadio" class="ml-5">
                                    <input type="radio" id="allRadio" name="options" @click="displayOrders()">
                                    Mes commandes
                                </label>
                            </form>

                            <div class="newOrder">
                                <btn class="btn btn-secondary" @click='displayNewOrder()'>
                                    <i class="fas fa-plus-circle"></i> Programmer
                                </btn>
                            </div>
                        </div>

                        <div class="dashboard__content__main" v-if='showNextOrders'>
                            <h3>
                                Commandes à venir
                            </h3>

                            <div class="next-orders">
                                <div class="flex-between">
                                    <div>
                                        <h4>Salade Tropicale</h3>
                                            <p>Livraison prévue le <strong>lundi 18/06/2023</strong>
                                                a <strong>10 h</strong></p>
                                    </div>
                                </div>
                                <hr>

                                <div class="flex-between">
                                    <div>
                                        <h4>Salade Tropicale</h3>
                                            <p>Livraison prévue le <strong>lundi 18/06/2023</strong>
                                                a <strong>10 h</strong></p>
                                    </div>

                                    <div>
                                        <button class="btn btn-primary" @click="displayEditOrder">
                                            <i class="fas fa-edit"></i> Modifier
                                        </button>

                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="dashboard__content__main" v-if='showOrders'>
                            <div class="top">
                                <h3>
                                    Mes commandes
                                </h3>
                            </div>

                            <div class="table-container">

                                <table class="orders-table">

                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Salade</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>15/06/2023</td>
                                            <td><i data-lucide="apple" aria-hidden="true"></i> Salade Tropicale</td>
                                            <td><span class="status delivered">Livrée</span></td>
                                        </tr>
                                        <tr>
                                            <td>12/06/2023</td>
                                            <td><i data-lucide="banana" aria-hidden="true"></i> Salade Vitaminée
                                            </td>
                                            <td><span class="status delivered">Livrée</span></td>
                                        </tr>
                                        <tr>
                                            <td>09/06/2023</td>
                                            <td><i data-lucide="cherry" aria-hidden="true"></i> Salade Gourmande
                                            </td>
                                            <td><span class="status delivered">Livrée</span></td>
                                        </tr>
                                        <tr>
                                            <td>06/06/2023</td>
                                            <td><i data-lucide="grape" aria-hidden="true"></i> Salade Exotique</td>
                                            <td><span class="status delivered">Livrée</span></td>
                                        </tr>
                                        <tr>
                                            <td>03/06/2023</td>
                                            <td><i data-lucide="lemon" aria-hidden="true"></i> Salade Agrumes</td>
                                            <td><span class="status delivered">Livrée</span></td>
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

                        <div class="dashboard__content__main" v-if='showNewOrder'>
                            new order
                        </div>

                        <div class="dashboard__content__main" v-if='showEditOrder'>
                            option en cours
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
                showOrders: false,
                showNextOrders: false,
                showBooking: false,
                showEditOrder: false,
                showNewOrder: false,
                details: [],
                currentPage: 1,
                itemsPerPage: 10,
                selectedDetail: null,
            };
        },
        mounted() {
            this.getUserDatas();
            this.displayOrders();
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
            displayNextOrders() {
                this.showNextOrders = true;
                this.showOrders = false;
                this.showBooking = false;
                this.showEdit = false;
                this.showNewOrder = false;
                axios.get('api/script.php?action=nextOrders')
                    .then((response) => {
                        console.log(response.data);
                        this.details = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            displayOrders() {
                this.showNextOrders = false;
                this.showOrders = true;
                this.showBooking = false;
                this.showEdit = false;
                this.showNewOrder = false;
                axios.get('api/script.php?action=nextOrders')
                    .then((response) => {
                        console.log(response.data);
                        this.details = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            displayNewOrder() {
                this.showNextOrders = false;
                this.showOrders = false;
                this.showBooking = false;
                this.showEdit = false;
                this.showNewOrder = true;
            },
            displayEditOrder() {
                this.showNextOrders = false;
                this.showOrders = false;
                this.showBooking = false;
                this.showEditOrder = true;
                this.showNewOrder = false;
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