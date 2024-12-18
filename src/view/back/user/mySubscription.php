<?php 
include 'check_session.php'; 

$title = "THC - Abonnement";
ob_start(); 
?>

<main class="main" id="app">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <br><br><br><br>
                <div class="dashboard">
                    <!-- Inclusion du menu -->
                    <?php include 'menu.php'; ?>

                    <div class="dashboard__content">
                        <!-- En-tête de la page -->
                        <div class="dashboard__content__top">
                            <h2>Abonnement</h2>
                            <?php include 'profile_name.php'; ?>
                        </div>

                        <!-- Contenu principal -->
                        <div class="dashboard__content__main mt-2" v-for="detail in details" :key="detail.id">
                            <div class="top">
                                <h3>Abonnement en cours</h3>
                            </div>

                            <div class="pricing" id="pricing" style='margin-top: -50px;'  v-if="detail.subscription_status === 'active'">    
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

                            <div class="pricing" id="pricing" style='margin-top: -50px;'  v-if="detail.subscription_status === 'inactive'">
                                <p class='mx-auto'>
                                    Vous n'avez aucun abonnement en cours
                                </p> <br>
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
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </section>
</main>

<?php 
$content = ob_get_clean();
require './src/view/layout.php'; 
?>

<script>
const app = Vue.createApp({
    data() {
        return {
            details: [], // Contient les données des abonnements
            currentPage: 1,
            itemsPerPage: 10,
        };
    },
    mounted() {
        this.getUserDatas();
    },
    methods: {
        // Récupération des données utilisateur depuis l'API
        getUserDatas() {
            axios.get('api/script.php?action=getMyDatas')
                .then(response => {
                    this.details = response.data;
                })
                .catch(error => {
                    console.error("Erreur lors de la récupération des données : ", error);
                });
        },
        // Formatage de la date
        formatDate(date) {
            if (!date) return '';
            const [year, month, day] = date.split('-');
            return `${day}-${month}-${year}`;
        },
        capitalize(string) {
            return string ? string.toUpperCase() : '';
        },
        capitalizeFirstLetter(string) {
            return string ? string.charAt(0).toUpperCase() + string.slice(1).toLowerCase() : '';
        },
    },
});

app.mount('#app');
</script>