<script src="https://accounts.google.com/gsi/client" async defer></script>

<?php $title = "THC - Connexion";

// $articles

ob_start(); ?>

<br><br><br>
<main class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="contact-container">
                    <div class="contact-form-container" id="app">
                        <h2> Connexion 🍒</h2>
                        <form class="contact-form"  @submit.prevent="submitForm">
                            <p class="text text-danger  fw-bold" v-if='message != ""'>
                                {{ message }}
                            </p>
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 mx-auto">
                                    <div class="form-group">
                                        <label for="email">
                                            <i class="fas fa-user"></i> Email
                                        </label>
                                        <input type="text" id="email" v-model="form.email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 mx-auto">
                                    <div class="form-group">
                                        <label for="password">
                                            <i class="fas fa-lock"></i> Mot de passe
                                        </label>
                                        <div class="password-container">
                                            <input :type="showPassword ? 'text' : 'password'" id="password" v-model="form.password" required>
                                            <i @click="togglePasswordVisibility" :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'" class="password-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-center mx-auto">
                                <label for="">
                                    <input type="checkbox"> Se souvenir de moi
                                </label> <br>
                                <button type="submit" class="submit-btn mt-2">
                                    <i class="fas fa-sign-in-alt"></i> Connexion
                                </button> <hr>
                                <div class="socials">
                                    <!-- Gmail Button -->
                                    <button @click.prevent="loginWithGoogle" class="connect-btn gmail-btn mx-auto">
                                        <i class="fa fa-google"></i>
                                    </button>


                                    <!-- Facebook Button -->
                                    <button @click.prevent="loginWithFacebook" class="connect-btn facebook-btn mx-auto">
                                        <i class="fa fa-facebook"></i>
                                    </button>
                                </div>
                                <hr>
                                <p>
                                    Mot de passe oublié ? <span><a href="index.php?action=resetPasswordPage">Réinitialiser le mot de passe</a></span> <br>
                                    Pas encore de compte ? <span><a href="index.php?action=registerPage">Inscription</a></span>
                                </p>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                showPassword: false,
                message: '',
                role: '',
                form: {
                     email: '',
                        password: ''
                }
            };
        },
        methods: {
            submitForm(){
                const formData = new FormData();

                    // Ajout des données saisies au FormData
                    formData.append('email', this.form.email);
                    formData.append('password', this.form.password);

                    // Debug : Vérifier les données avant l'envoi
                    console.log('Données envoyées :', Object.fromEntries(formData));

                    // Envoi de la requête avec Axios
                    axios.post('api/script.php?action=login', formData)
                        .then(response => {
                             // Redirection selon le rôle
                             console.log(response.data.role);
                             this.role=(response.data.role);

                             const role= response.data.role;

                             if(role === 'user'){
                                window.location.replace('index.php?action=dashboardPage');
                             } else if(role === 'admin' ){
                                window.location.replace('index.php?action=dashboardAdminPage');
                             } else{
                                this.message = 'Identifiants incorrects';
                             }
                        })
                        .catch(error => {
                            console.error('Erreur Axios :', error);
                            this.message = 'Erreur lors de la connexion.';
                        });
            },
            togglePasswordVisibility() {
                this.showPassword = !this.showPassword;
            },
            loginWithGoogle(){
        alert('Api indisponible pour le moment, merci de reéssayer ultérieurement !');
    },
    loginWithFacebook(){
        alert('Api indisponible pour le moment, merci de reéssayer ultérieurement !');
    },
            handleGoogleCredentialResponse(response) {
        console.log('Google ID Token:', response.credential);

        // Envoyer le token Google ID au serveur pour validation
        const formData = new FormData();
        formData.append('token', response.credential);

        axios.post('api/script.php?action=google-login', formData)
            .then(res => {
                console.log(response.data.role);
                             this.role=(response.data.role);

                             const role= response.data.role;

                             if(role === 'user'){
                                window.location.replace('index.php?action=dashboardPage');
                             } else if(role === 'admin' ){
                                window.location.replace('index.php?action=dashboardAdminPage');
                             } else{
                                this.message = 'Identifiants incorrects';
                             }
            })
            .catch(err => {
                console.error('Erreur Google Login:', err);
            });
    }
        }
    }).mount('#app');
</script>

<?php $content = ob_get_clean(); ?>

<?php require './src/view/layout.php'; ?>

<style>
    .socials{
        display: flex;
        flex-direction: row;
        width: 120px;
        gap: 20px;
        margin: 20px auto;
    }

    .gmail-btn {
        background-color: #DB4437;
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    .facebook-btn {
        background-color: #3b5998;
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    .connect-btn:hover{
        background-color: #50AF47;
    }

    .password-container {
        position: relative;
    }

    .password-container input {
        width: 100%;
        padding-right: 30px;
    }

    .password-icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }

    p span a{
        color: #F99401;
        font-weight: bold;
    }
</style>
