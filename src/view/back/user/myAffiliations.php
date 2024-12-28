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
                        <label for="allRadio" class="ml-5">
                                    <input type="radio" id="allRadio" name="options" @click="displayAffiliated()">
                                    Mes affiliés
                                </label>
                                <label for="newRadio" class="ml-5">
                                    <input type="radio" id="newRadio" name="options" @click="displayCashback()">
                                    Historique Cashback
                                </label>
                                
                            </form>
                            
                            
                            <div class="ref">
                            <p class='text text-danger'  v-if="!detail.ref" > Merci de souscrire à un abonnement <br> pour générer votre lien unique  <br>
                            d'affiliation</p>
                                <p  v-if='detail.ref'>Lien d'affiliation: <strong id="link" >{{ detail.ref }}</strong></p>

                                <div class="btns" v-if='detail.ref'>
                                    <div class="copy-btn" id="copyBtn" @click="copyLink">
                                        <i class="fa fa-copy"></i>
                                    </div>
                                    <div class="share-btn" data-platform="whatsapp" style="background: #50AF47;" @click="shareByWhatsapp">
                                        <i class="fa fa-whatsapp"></i>
                                    </div>
                                    <div class="share-btn" data-platform="facebook" style="background: #0866FF;" @click="shareByFacebook">
                                        <i class="fa fa-facebook"></i>
                                    </div>
                                    <div class="share-btn" data-platform="email" style="background: #F99401;" @click="shareByMail">
                                        <i class="fa fa-envelope"></i>
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

                            <div class="table-container" v-if='cashback.length > 0'>

                                <table class="orders-table">

                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Nom et prénoms</th>
                                            <th>Montant</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="detail in cashback" :key="detail.id">
                                            <td>{{ formatDate(detail.date_of_insertion) }}</td>
                                            <td><i data-lucide="apple" aria-hidden="true"></i> {{ detail.sponsored_first_name }}
                                             {{ capitalize(detail.sponsored_last_name) }} </td>
                                            <td><span class="status">{{ formatNumber(detail.amount) }} XOF</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p v-if='cashback.length === 0'>
                                Aucun historique pour l'instant
                            </p>
                        </div>

                        <div class="dashboard__content__main mt-2" v-if='showAffiliated'>
                            <div class="top">
                                <h3>
                                   Mes affiliés
                                </h3>
                            </div>

                            <div class="table-container" v-if="affiliated.length > 0">

                                <table class="orders-table">

                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Nom et prénoms</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="detail in affiliated" :key="detail.id">
                                            <td>{{ formatDate(detail.date_of_insertion) }}</td>
                                            <td><i data-lucide="apple" aria-hidden="true"></i> {{ capitalizeFirstLetter(detail.sponsored_first_name)  }}
                                             {{ capitalize(detail.sponsored_last_name) }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p v-if='affiliated.length === 0'> 
                                Vous n'avez aucun affilié pour l'instant
                            </p>

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
                details: [],
                cashback: [],
                affiliated: [],
                currentPage: 1,
                itemsPerPage: 10,
                selectedDetail: null,
                showCashback: false,
                showAffiliated: false,
                ref: ''
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
                        this.details = response.data;

                        this.detailss = response.data[0]; // Access the first object in the array
                         this.ref = this.detailss.ref;
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
                        this.cashback = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            displayAffiliated() {
                this.showCashback = false;
                this.showAffiliated = true;
                axios.get('api/script.php?action=getMyAffiliated')
                    .then((response) => {
                        this.affiliated = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            formatDate(date) {
    const daysOfWeek = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
    
    // Split the date and time parts
    const [datePart, timePart] = date.split(' ');
    const [year, month, day] = datePart.split('-');
    const [hours, minutes] = timePart.split(':');
    
    // Create a Date object to find the day of the week
    const dateObj = new Date(`${year}-${month}-${day}`);
    const dayOfWeek = daysOfWeek[dateObj.getDay()];
    
    // Format the result
    return ` ${String(Number(day) + 1).padStart(2, '0')}/${month}/${year.slice(-2)}`;
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
            copyLink() {
                const link = 'https://www.thehealthychoice.com?ref='+this.ref;
                navigator.clipboard.writeText(link).then(() => {
                    alert("Lien copié dans le presse-papiers !");
                }).catch(err => {
                    console.error("Erreur lors de la copie du lien :", err);
                });
            },

    // Share the referral link via email
    shareByMail() {
        const link = 'https://www.thehealthychoice.com?ref='+this.ref;
        const subject = encodeURIComponent("Voici mon lien d'affiliation !");
        const body = encodeURIComponent(`Bonjour,\n\nJe voulais partager ce lien avec vous :\n${link}\n\nCordialement.`);
        window.location.href = `mailto:?subject=${subject}&body=${body}`;
    },

    // Share the referral link via WhatsApp
    shareByWhatsapp() {
        const link = 'https://www.thehealthychoice.com?ref='+this.ref;
        const message = encodeURIComponent(`Bonjour, voici mon lien d'affiliation Healthy Choice : ${link}`);
        const whatsappUrl = `https://wa.me/?text=${message}`;
        window.open(whatsappUrl, "_blank");
    },

    // Share the referral link via Facebook
    shareByFacebook() {
        const link = 'https://www.thehealthychoice.com?ref='+this.ref;
        const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(link)}`;
        window.open(facebookUrl, "_blank");
    }
        },
    });

    app.mount('#app');
</script>