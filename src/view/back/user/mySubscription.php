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
                        <div class="dashboard__content__main mt-2">
                            <div class="" v-if="showSubscription">
                                <div class="top">
                                    <h3>Abonnement en cours</h3>
                                </div>

                               <div class="" >
                               <div class="pricing" id="pricing" style='margin-top: -50px;'  v-if="details.length > 0">    
                                    <div class="pricing__content" v-for='detail in details' :key='detail.id'>
                                        <div class="pricing__content__item">
                                            <strong class="offer-name">
                                                <i class="fas fa-leaf"></i> {{ detail.name }}
                                            </strong>
                                            <ul>
                                                <li><i class="fas fa-check"></i> {{ detail.days }} livraisons / semaine</li>
                                            </ul>
                                            <strong class="price">
                                                <i class="fas fa-coins"></i> {{ formatNumber(detail.price) }} XOF
                                            </strong>

                                            <strong>
                                                Expiration: <strong>
                                                    {{ formatDate(detail.date_of_expiration) }}
                                                </strong>
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="pricing" id="pricing" style='margin-top: -50px;'   v-if="details.length === 0">
                                    <p class='mx-auto'>
                                        Vous n'avez aucun abonnement en cours
                                    </p> <br>
                                    <div class="pricing__content">
                                        <div 
                                            class="pricing__content__item" 
                                            v-for="detail in offers" 
                                            :key="detail.id"
                                        >
                                            <strong class="offer-name">
                                                <i class="fas fa-leaf"></i> {{ detail.name }}
                                            </strong>
                                            <p>
                                                Jours de livraison ({{ detail.number_of_days }})
                                            </p>
                                            <ul>
                                                <li v-for="day in detail.days" :key="day">
                                                    <i class="fas fa-check"></i> {{ day }}
                                                </li>
                                            </ul>
                                            <strong class="price">
                                                <i class="fas fa-coins"></i> {{ formatNumber(detail.price) }} XOF
                                            </strong>
                                            <p class="small">
                                            Validité: 30 jours
                                            </p>
                                            <button class="btn-select" @click="displayPayment(detail)">Choisir</button>
                                        </div>
                                    </div>

                                </div>
                               </div>
                            </div>

                           <div class="" v-if="showPayment">
                               <div class="top">
                                   <h3>Choisir un nouvel abonnement</h3>
                               </div>
                               <div class="pricing">
                                    <div class="pricing__content" >
                                        <div class="pricing__content__item subscription ml-0">
                                            <p>
                                                Abonnement choisi: <strong>{{ selectedOffer.name }}</strong> <br>
                                                Montant: <strong>{{ formatNumber(selectedOffer.price) }} XOF</strong>
                                            </p> <br>

                                            <div class="options" v-if="showPaymentOptions">
                                                Payer par: 
                                                <div class="options__payment">
                                                    <!-- Mobile Money -->
                                                    <button type="button" class="btn btn-Mobile" @click="payWithMobile">
                                                        <i class="fas fa-credit-card"></i> Mobile Money (Mtn, Moov, Celtiis)
                                                    </button>

                                                     <!-- THC Wallet -->
                                                     <button type="button" class="btn btn-wallet" @click="payWithWallet">
                                                        <i class="fas fa-wallet"></i> THC Wallet
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pricing__content__item subscription ml-0" v-if="showPayWithMobile">
                                            <form class="contact-form" @submit.prevent="pay">
                                                <div class="form-row">
                                                    <div class="form-group">
                                                        <label for="network">
                                                            <i class="fas fa-signal"></i> Réseau mobile
                                                        </label>
                                                        <select v-model="form.network" id="network" required>
                                                            <option value="Mtn">MTN</option>
                                                            <option value="Moov">Moov</option>
                                                            <option value="Celtiis">Celtiis</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="phone">
                                                        <i class="fas fa-phone"></i> Numéro
                                                    </label>
                                                    <input type="number" id="phone" v-model="form.phone" required>
                                                </div>

                                                <div class="col-6 text-center mx-auto">
                                                <input type="hidden" v-model="form.day" value='Monday'>
                                                <input type="hidden" v-model="form.offer_id">
                                                <input type="hidden" v-model="form.offer_name">
                                                <input type="hidden" v-model="form.offer_price">

                                                <button type="submit" class="submit-btn mx-auto">
                                                    <i class="fas fa-money-check-alt"></i> Payer
                                                </button>
                                                </div>

                                            </form>
                                        </div>

                                        <div class="pricing__content__item subscription ml-0" v-if="showPayWithWallet">
                                            <form class="contact-form" action="api/script.php?action=register" method="POST">
                                                

                                                <div class="form-group">
                                                    <p v-for="detail in details" :key="detail.id">
                                                        Solde: <strong> {{ formatNumber(detail.wallet) }} XOF</strong>
                                                    </p>
                                                </div>

                                                <div class="col-6 text-center mx-auto">
                                                   <p class="text text-danger">
                                                    Solde insuffisant
                                                   </p>
                                                </div>
                                            </form>

                                        </div>
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

<style>
    .options_payments{
        display: flex();
        flex-direction: row;
    }
</style>


<?php 
$content = ob_get_clean();
require './src/view/layout.php'; 
?>

<script>
const app = Vue.createApp({
    data() {
            return {
                details: [], 
                offers: [
                    { id: 1, name: 'Starter', price: 7000, days: ['Mardi', 'Jeudi'], number_of_days: 2, featured: 'no' },
                    { id: 2, name: 'Premium', price: 9000, days: ['Lundi', 'Mercredi', 'Vendredi'], number_of_days: 3, featured: 'yes' },
                    { id: 3, name: 'Gold', price: 15000, days: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'], number_of_days: 5, featured: 'no' }
                ],

                selectedOffer: null,  // Store the selected offer
                showPayment: false,
                showPaymentOptions: false,
                showPayWithMobile: false,
                showPayWithWallet: false,
                showSubscription: false,
                form: {
                network: '',
                phone: '',
                offer_id: '',
                offer_name: '',
                offer_price: '',
                day: ''
            }
            };
    },
    mounted() {
        this.getUserDatas();
    },
    methods: {
        getUserDatas() {
            this.showSubscription = true;
            this.showPayment = false;
            axios.get('api/script.php?action=getMySubscription')
                .then(response => {
                    this.details = response.data;
                    console.log(details.length)
                })
                .catch(error => {
                    console.error("Erreur lors de la récupération des données : ", error);
                });
        },
        displayPayment(selectedOffer) {
            this.selectedOffer = selectedOffer; // Set the selected offer
            this.showSubscription = false;
            this.showPayment = true;
            this.showPayWithMobile = false;
            this.showPayWithWallet = false;
            this.showPaymentOptions = true;

            // Populate the form object with the selected offer details
            this.form.offer_id = selectedOffer.id;
            this.form.offer_name = selectedOffer.name;
            this.form.offer_price = selectedOffer.price;
        },
        payWithWallet() {
            this.showPayWithWallet = true;
            this.showPayWithMobile = false;
        },
        payWithMobile() {
            this.showPayWithMobile = true;
            this.showPayWithWallet = false;
        }, 
        pay() {
            const formData = new FormData();

            formData.append('network', this.form.network);
            formData.append('phone', this.form.phone);
            formData.append('day', this.form.day);
            formData.append('offer_id', this.form.offer_id);
            formData.append('offer_name', this.form.offer_name);
            formData.append('offer_price', this.form.offer_price);

            console.log('Données envoyées :', Object.fromEntries(formData));

            axios.post('api/script.php?action=payWithMobile', formData)
                        .then(response => {
                             console.log(response.data);
                             alert('Votre abonnment a été activé avec succès');
                             window.location.replace('index.php?action=mySubscriptionPage');
                        })
                        .catch(error => {
                            console.error('Erreur Axios :', error);
                            this.successMsg = 'Erreur lors de la connexion.';
                        });
},

        selectOffer(offer) {
            this.form.offer_id = offer.id;
            this.form.offer_name = offer.name;
            this.form.offer_price = offer.price;
        },
        resetForm() {
            this.form = {
                network: '',
                phone: '',
                offer_id: '',
                offer_name: '',
                offer_price: ''
            };
        },
        formatNumber(number) {
            if (number === undefined || number === null) {
                return '';
            }
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
        formatDate(date) {
    const [year, month, day] = date.split('-');
    return `${day}-${month}-${year}`;
  }

    }
});

app.mount('#app');
</script>
