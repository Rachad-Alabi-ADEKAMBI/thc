<?php 

include 'check_session.php'; 

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

                           <?php include 'profile_name.php'; ?>
                        </div>

                        <div class="dashboard__content__menu">
                            <form class="form">
                                <label for="newRadio" class="ml-5">
                                    <input type="radio" id="newRadio" name="options" @click="displayNextOrders()">
                                    Mes futures commandes
                                </label>
                                <label for="allRadio" class="ml-5">
                                    <input type="radio" id="allRadio" name="options" @click="displayOrders()">
                                    Toutes mes commandes
                                </label>
                            </form>

                            <div class="newOrder" v-if="showNewOrderBtn">
                                <btn class="btn btn-secondary" @click='displayNewOrder()'>
                                    <i class="fas fa-plus-circle"></i> Programmer
                                </btn>
                            </div>
                        </div>

                        <div class="dashboard__content__main" v-if='showNextOrders'>
                            <h3>
                                Mes futures commandes
                            </h3>

                            <table class="orders-table"  v-if='nextOrders.length > 0'>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Heure</th>
                                        <th>Salade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for='detail in nextOrders' :key='detail.id'>
                                        <td>{{ formatDate(detail.day) }}</td>
                                        <td>{{ detail.time }}</td>
                                        <td><i data-lucide="apple" aria-hidden="true"></i> {{ detail.salad_name }}</td>
                                    </tr>
                                </tbody>
                                </table>
                        </div>

                        <div class="dashboard__content__main" v-if='showOrders'>
                            <div class="top">
                                <h3>
                                    Toutes mes commandes 
                                </h3>
                            </div>

                                <div class="table-container" v-if="orders.length > 0" >

                                    <table class="orders-table">

                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Heure</th>
                                                <th>Salade</th>
                                                <th>Statut</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='detail in orders' :key='detail.id'>
                                                <td>{{ formatDate(detail.day) }}</td>
                                                <td>{{ detail.time }}</td>
                                                <td><i data-lucide="apple" aria-hidden="true"></i> {{ detail.salad_name }}</td>
                                                <td>
                                                    <span :class="{'status': true, 'delivered': detail.status === 'Livrée', 'to-deliver': detail.status === 'A livrer'}">
                                                        {{ detail.status }}
                                                    </span>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>

                                    
                                <p v-if="orders.length === 0">
                                    Aucune commande à afficher pour l'instant,  <br>programmez vos commandes avec le bouton "Progarammer" 
                                </p>
                            </div>
                           


                        </div>
               
                        <div class="dashboard__content__main" v-if='showNewOrder'>
                            <br>
                            <div class="reservation-component">
                                <div class="close-btn" @click='closeNewOrder()'>
                                    <i class="fas fa-times"></i>

                                </div>
                                <h2 class="title">Programmez vos livraisons</h2>
                                


                                <div class="reservation">
                                <div class="monday"> 
                                    <form @submit.prevent="orderForMonday" 
                                       >
                                        <div class="day-item">
                                            <h3 class="day-title">Lundi</h3>
                                            <div class="form-group">
                                                <label for="salade-0">Salade</label>
                                                <select id="salade-0" class="salade-select" v-model="form.salad_name" required>
                                                    <option value="">Choisir</option>
                                                    <option value="Pack Tropical">Pack Tropical</option>
                                                    <option value="Pack Vitaminé">Pack Vitaminé</option>
                                                    <option value="Pack Croquant">Pack Croquant</option>
                                                </select>
                                                
                                                <label for="heure-0">Heure</label>
                                                <select id="heure-0" class="heure-select" v-model="form.time" required>
                                                    <option value="">Heure</option>
                                                    <option value="9h">9h</option>
                                                    <option value="11h">11h</option>
                                                    <option value="13h">13h</option>
                                                    <option value="15h">15h</option>
                                                    <option value="17h">17h</option>
                                                </select>
                                                
                                                <button type="submit" 
                                                        class="btn btn-secondary" 
                                                        :disabled="!form.salad_name || !form.time">
                                                    Confirmer
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <br>


                                    <form @submit.prevent="orderForMonday">
                                        <div class="day-item">
                                            <h3 class="day-title">Mercredi</h3>
                                            <div class="form-group">
                                                <label for="salade-0">Salade</label>
                                                <select id="salade-0" class="salade-select" v-model="mondaySalad" name="salad_name">
                                                    <option value="">Choisir</option>
                                                    <option value="Pack Tropical">Pack Tropical</option>
                                                    <option value="Pack Vitaminé">Pack Vitaminé</option>
                                                    <option value="Pack Croquant">Pack Croquant</option>
                                                </select>
                                                <select id="heure-0" class="heure-select" v-model="mondayTime" name="time">
                                                    <option value="">Heure</option>
                                                    <option value="9h">9h</option>
                                                    <option value="11h">11h</option>
                                                    <option value="13h">13h</option>
                                                    <option value="15h">15h</option>
                                                    <option value="17h">17h</option>
                                                </select>
                                                <button type="submit" class="btn btn-secondary">Confirmer</button>
                                            </div>
                                        </div>
                                    </form> <br>

                                    <form @submit.prevent="orderForMonday">
                                        <div class="day-item">
                                            <h3 class="day-title">Vendredi</h3>
                                            <div class="form-group">
                                                <label for="salade-0">Salade</label>
                                                <select id="salade-0" class="salade-select" v-model="mondaySalad" name="salad_name">
                                                    <option value="">Choisir</option>
                                                    <option value="Pack Tropical">Pack Tropical</option>
                                                    <option value="Pack Vitaminé">Pack Vitaminé</option>
                                                    <option value="Pack Croquant">Pack Croquant</option>
                                                </select>
                                                <select id="heure-0" class="heure-select" v-model="mondayTime" name="time">
                                                    <option value="">Heure</option>
                                                    <option value="9h">9h</option>
                                                    <option value="11h">11h</option>
                                                    <option value="13h">13h</option>
                                                    <option value="15h">15h</option>
                                                    <option value="17h">17h</option>
                                                </select>
                                                <button type="submit" class="btn btn-secondary">Confirmer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                               
                            </div> <br><br>
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
                showNewOrderBtn: false,
                details: [],
                orders: [],
                nextOrders: [],
                currentPage: 1,
                itemsPerPage: 10,
                selectedDetail: null,
                offer_id: '',
                monday: '',
                tuesday: '',
                wednesday: '',
                thursday: '',
                friday: '',
                salads: [],
                times: ['9h', '10h', '11h', '13h', '15h', '17h'],
                form:{
                    salad_name: '',
                    day: '',
                    time: ''
                }
            };
        },
        mounted() {
            this.getUserDatas();
            this.displayNewOrder();
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
                        if (Array.isArray(response.data) && response.data.length > 0) {
                            this.details = response.data;
                            console.log(this.details)

                            this.datas = response.data[0];
                            this.offer_id = this.datas.offer_id || null;
                            this.monday = this.datas.monday || null;


                            console.log(this.monday); // Logs the offer_id value
                        } else {
                            console.warn('No data found in API response.');
                        }
                    })
                    .catch((error) => {
                        console.error('Error fetching user data:', error);
                    });
            },
            displayNextOrders() {
                this.showNextOrders = true;
                this.showOrders = false;
                this.showBooking = false;
                this.showEdit = false;
                this.showNewOrder = false;
                this.showNewOrderBtn = true;
                axios.get('api/script.php?action=getMyNextOrders')
                    .then((response) => {
                        console.log(response.data);
                        this.nextOrders = response.data;
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
                this.showNewOrderBtn = true;
                axios.get('api/script.php?action=getMyOrders')
                    .then((response) => {
                        console.log(response.data);
                        this.orders = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            displayNewOrder() {
                axios.get('api/script.php?action=getSalads')
                    .then((response) => {
                        this.salads = response.data;
                        console.log(response.data);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
                this.showNextOrders = false;
                this.showOrders = false;
                this.showBooking = false;
                this.showEdit = false;
                this.showNewOrder = true;
                this.showNewOrderBtn = false;
            },
            closeNewOrder() {
                axios.get('api/script.php?action=getMyNextOrders')
                    .then((response) => {
                        console.log(response.data);
                        this.nextOrders = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
                this.showNextOrders = true;
                this.showOrders = false;
                this.showBooking = false;
                this.showEdit = false;
                this.showNewOrder = false;
                this.showNewOrderBtn = true;
            },
            displayEditOrder() {
                this.showNextOrders = false;
                this.showOrders = false;
                this.showBooking = false;
                this.showEditOrder = true;
                this.showNewOrder = false;
            },
            formatDate(date) {
    // Create a new Date object from the date string
    const [year, month, day] = date.split('-');
    const formattedDate = new Date(year, month - 1, day); // month - 1 because months are zero-based

    // List of days of the week in French
    const daysOfWeek = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    
    // List of months in French
    const monthsOfYear = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];

    // Get the day of the week and month in French
    const dayOfWeek = daysOfWeek[formattedDate.getDay()];
    const monthName = monthsOfYear[formattedDate.getMonth()];

    // Return the formatted date
    return `${dayOfWeek} ${formattedDate.getDate()} ${monthName} ${year}`;
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
            getImage(pic) {
                return `public/images/${pic}`;
            },
            orderForMonday() {
                axios.post('api/script.php?action=orderForDay', {
            salad_name: this.mondaySalad,
            day: 'lundi',
            time: this.mondayTime
                })
            .then(response => {
                if (response.data && response.data.success) {
                    alert('Commande effectuée avec succès');
                    this.resetFormMonday();
                } else {
                    // Loguez et affichez l'erreur spécifique
                    const message = response.data || 'Erreur inconnue';
                    console.error('Erreur API :', message);
                    alert(message);
                }
            })
            .catch(error => {
                // Gérer les erreurs réseau ou autres erreurs axios
                console.error('Une erreur technique est survenue :', error);

                if (error.response) {
                    // Loggez l'erreur retournée par le backend
                    console.error('Erreur backend :', error.response.data.details || error.response.data.message);
                    alert(error.response.data.details || 'Une erreur est survenue.');
                } else if (error.request) {
                    // Pas de réponse du serveur
                    console.error('Pas de réponse reçue du serveur :', error.request);
                    alert('Impossible de contacter le serveur.');
                } else {
                    // Erreur lors de la configuration de la requête
                    console.error('Erreur dans la configuration de la requête :', error.message);
                    alert('Erreur technique.');
                }
            });
        }  
        },
    });

    app.mount('#app');
</script>

<style>
    /* Styling the select element */
.salade-select {
    background-color: #333; /* Dark background */
    color: #fff; /* White text for contrast */
    border: 1px solid #555; /* Optional border color */
    padding: 10px; /* Add padding for better spacing */
    border-radius: 5px; /* Rounded corners */
}

/* Styling individual dropdown items */
.salade-select option {
    background-color: #444; /* Darker background for options */
    color: #fff; /* White text */
}

/* Add hover effect for dropdown items */
.salade-select option:hover {
    background-color: #555; /* Highlight on hover */
    color: #fff; /* Ensure text remains visible */
}

.status {
    padding: 5px 10px;
    border-radius: 5px;
    color: white;
}

.to-deliver {
    background-color:  #F99401;;
    color: black; /* Optional: for better readability */
}

.delivered {
    background-color: #50AF47;
}


</style>