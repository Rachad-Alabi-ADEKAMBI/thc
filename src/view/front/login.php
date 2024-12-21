<?php $title = "THC - Connexion";

// $articles

ob_start(); ?>

<br><br><br>
<main class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="contact-container">
                    <div class="contact-form-container" id="contact">
                        <h2> Connexion 🍒</h2>
                        <form class="contact-form " action="api/script.php?action=login" method="POST">
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
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 mx-auto">
                                    <div class="form-group">
                                        <label for="password">
                                            <i class="fas fa-lock"></i> Mot de passe
                                        </label>
                                        <input type="password" id="password" name="password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-center mx-auto">
                            <label for="">
                               <input type="checkbox"> Se souvenir de moi
                               </label> <br>
                                <button type="submit" class="submit-btn mt-2">
                                    <i class="fas fa-sign-in-alt"></i> Connexion
                                </button> <br>
                                <hr>
                        <p>
                            Mot de passe oublié ? <a href="index.php?action=resetPasswordPage">Réinitialiser le mot de passe</a> <br>
                            Pas encore de compte ? <span><a href="index.php?action=registerPage">Inscription</a></span>
                        </p>
                        
                                <hr>
                              
                                <p class='mt-3 fw-bold'>
                                    Ou
                                </p>
                                    <p>Se connecter avec :</p>
                                    <div class="social-buttons">
                                        <!-- Gmail Button -->
                                        <a href="#" class="btn gmail-btn mx-auto">
                                            <i class="fa fa-google"></i> Gmail
                                        </a>
                                        <!-- Facebook Button -->
                                        <a href="#" class="btn facebook-btn mx-auto">
                                            <i class="fa fa-facebook"></i> Facebook
                                        </a>
                                    </div>

                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php $content = ob_get_clean(); ?>

<?php require './src/view/layout.php'; ?>

<style>

    .social-buttons{
        display: inline;
        width: 100%;
    }

    .fcbk{
        background-color: blue;
    }

    a{
        color: #50AF47;
        color: #F99401;
    }
    
    

    .gmail-btn{
        margin: 10px;
    }

    .facebook-btn{
        margin: 10px;
    }
</style>