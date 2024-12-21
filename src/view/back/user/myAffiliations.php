<?php 

    include 'check_session.php';

    $title = "THC - Affiliation";

ob_start(); ?>

<main class="main" id='app'>
    <section class="section">
        <div class="row ">
            <div class="col-12"> <br><br><br><br>
                <div class="dashboard">
                    <?php include 'menu.php'; ?>

                    <div class="dashboard__content" V-for='detail in details' :key='detail.id'>
                        <div class="dashboard__content__top">
                            <h2>
                                Affiliation
                            </h2>

                            <?php include 'profile_name.php'; ?>
                        </div>

                        <div class="dashboard__content__menu">
                        <form class="form">
                                <label for="newRadio" class="ml-5">
                                    <input type="radio" id="newRadio" name="options" @click="displayCashback()">
                                    Historique Cashback
                                </label>
                                <label for="allRadio" class="ml-5">
                                    <input type="radio" id="allRadio" name="options" @click="displayAffiliated()">
                                    Mes affiliés
                                </label>
                            </form>

                            <div class="newOrder mr-0" >
                                <p>
                                   {{detail.ref}}
                                </p> <br>
                                <div class="btns">
                                    <div class="share-btn">
                                    <i class="fa fa-google"></i> Gmail
                                    </div>

                                    <div class="share-btn">
                                    <i class="fa fa-facebook"></i>Facebook
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dashboard__content__main mt-2" v-if='showCashback'>
                            <div class="top">
                                <h3>
                                   Historique Cashback
                                </h3>
                            </div>

                            <div class="table-container">

                                <table class="orders-table">

                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Nom et prenoms</th>
                                            <th>Cashback</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="detail in cashback" :key="detail.id">
                                            <td>{{ formatDate(detail.date_of_insertion) }}</td>
                                            <td><i data-lucide="apple" aria-hidden="true"></i> {{ detail.first_name }} {{ detail.last_name }} </td>
                                            <td><span class="status">{{ formatNumber(detail.amount) }} XOF</span></td>
                                            <td><span class="status delivered">
                                                {{ detail.status}}
                                            </span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="dashboard__content__main mt-2" v-if='showAffiliated'>
                            <div class="top">
                                <h3>
                                   Mes affiliés
                                </h3>
                            </div>

                            <div class="table-container">

                                <table class="orders-table">

                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Nom et prenoms</th>
                                            <th>Abonnement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="detail in affiliated" :key="detail.id">
                                            <td>{{ formatDate(detail.date_of_insertion) }}</td>
                                            <td><i data-lucide="apple" aria-hidden="true"></i> {{ detail.first_name }} {{ detail.last_name }} </td>
                                            <td><span class="status delivered">{{ detail.subscription_status }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
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
                showCashback: false,
                details: [],
                cashback: [],
                affiliated: [],
                currentPage: 1,
                itemsPerPage: 10,
                selectedDetail: null,
                showCashback: false,
                showAffiliated: true
            };
        },
        mounted() {
            this.getUserDatas();
            this.displayCashback();
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
                        this.details = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });

            },
            displayCashback() {
                this.showCashback = true;
                this.showAffiliated = false;
                axios.get('api/script.php?action=getMyCashback')
                    .then((response) => {
                        console.log(response.data);
                        this.cashback = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            displayAffiliated() {
                this.showCashback = false;
                this.showAffiliated = true;
                axios.get('api/script.php?action=myAffiliated')
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
            formatNumber(number) {
      if (isNaN(number)) {
        return '';
      }
      // Convert the number to a string and add thousand separators
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
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