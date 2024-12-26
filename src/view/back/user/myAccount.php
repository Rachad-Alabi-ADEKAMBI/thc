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
                                    <form class="contact-form" @submit.prevent="submitForm()">
                                        <p v-if='message != ""' class='text text-danger mx-auto fw-bold'>
                                            {{ message }}
                                        </p>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="password1">
                                                    <i class="fas fa-lock"></i> Nouveau mot de passe
                                                </label>
                                                <input type="password" id="password1" v-model="form.password1">
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm_password">
                                                    <i class="fas fa-lock"></i> Confirmez le mot de passe
                                                </label>
                                                <input type="password" id="password2" v-model="form.password2">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="adress">
                                                    <i class="fas fa-map-marker-alt"></i> Adresse de livraison
                                                </label>
                                                <input type="text" id="address" v-model="form.address">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">
                                                    <i class="fas fa-phone"></i> Téléphone
                                                </label>
                                                <input type="tel" id="phone"  v-model='form.phone'>
                                            </div>
                                        </div>
                                        <div class="col-6 text-center mx-auto">
                                            <button type="submit" class="submit-btn mx-auto">
                                                <i class="fas fa-check-double"></i> Valider
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
                details: [],
                successMessage: '',
                errorMessage: '',
                form:{
                    password1: '',
                    password2: '',
                    address: '',
                    phone: ''
                }

            };
        },
        mounted() {
            this.getUserDatas();
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
            submitForm() {
    const formData = new FormData();

    // Add data conditionally based on input
    if (this.form.password1) {
        if (!this.form.password2) {
            this.errorMessage = 'Veuillez confirmer le mot de passe !';
            return;
        }
        if (this.form.password1 !== this.form.password2) {
            this.errorMessage = 'Les mots de passe ne correspondent pas !';
            return;
        }
        formData.append('password1', this.form.password1);
        formData.append('password2', this.form.password2);
    }

    if (this.form.phone) {
        formData.append('phone', this.form.phone);
    }

    if (this.form.address) {
        formData.append('address', this.form.address);
    }

    // Ensure at least one field is being updated
    if (!this.form.password1 && !this.form.phone && !this.form.address) {
        this.errorMessage = 'Veuillez remplir au moins un champ pour mettre à jour les informations.';
        return;
    }

    console.log('Données envoyées :', Object.fromEntries(formData));

    // Make the API call
    axios.post('api/script.php?action=updateAccount', formData)
        .then(response => {
            console.log(response.data);
            this.message = 'Mise à jour réussie !';
        })
        .catch(error => {
            console.error('Erreur Axios :', error);
            this.message = 'Erreur lors de la mise à jour.';
        });
}

        },
    });

    app.mount('#app');
</script>