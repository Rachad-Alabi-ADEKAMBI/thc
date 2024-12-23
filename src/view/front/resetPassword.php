<?php $title = "THC - Mot de passe oublié";

// $articles

ob_start(); ?>

<br><br><br>
<main class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="contact-container">
                    <div class="contact-form-container" id="app">
                        <h2> Mot de passe oublié 🍒</h2>
                        <form class="contact-form" action="api/script.php?action=login" method="POST">
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 mx-auto">
                                    <div class="form-group">
                                        <label for="email">
                                            <i class="fas fa-user"></i> Email
                                        </label>
                                        <input type="text" id="email" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-center mx-auto">
                                <button type="submit" class="submit-btn mt-2">
                                    <i class="fas fa-sign-in-alt"></i> Réinitialiser
                                </button> 
                                <hr>
                                <p>
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
                showPassword: false
            };
        },
        methods: {
            togglePasswordVisibility() {
                this.showPassword = !this.showPassword;
            },
            loginWithGoogle() {
                console.log('Google login initiated.');
                // Implémentez ici l'intégration avec l'API de Google
            },
            loginWithFacebook() {
                console.log('Facebook login initiated.');
                // Implémentez ici l'intégration avec l'API de Facebook
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
