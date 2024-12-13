<?php $title = "THC - Inscription";

// $articles

ob_start(); ?>

<main class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="contact-container">
                    <div class="contact-form-container" id="contact">
                        <h2> Inscription 🍋 </h2>
                        <form class="contact-form" action="api/script.php?action=register" method="POST">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">
                                        <i class="fas fa-envelope"></i> Email
                                    </label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nom">
                                        <i class="fas fa-user"></i> Prenoms
                                    </label>
                                    <input type="text" id="nom" name="first_name" required>
                                </div>

                                <div class="form-group">
                                    <label for="prenom">
                                        <i class="fas fa-user"></i> Nom
                                    </label>
                                    <input type="text" id="prenom" name="last_name" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="password">
                                        <i class="fas fa-lock"></i> Mot de passe
                                    </label>
                                    <input type="password" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">
                                        <i class="fas fa-lock"></i> Confirmez le mot de passe
                                    </label>
                                    <input type="password" id="password2" name="password2" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="adress">
                                        <i class="fas fa-map-marker-alt"></i> Adresse de livraison
                                    </label>
                                    <input type="text" id="adress" name="adress" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">
                                        <i class="fas fa-phone"></i> Téléphone
                                    </label>
                                    <input type="tel" id="phone" name="phone" required>
                                </div>
                            </div>
                            <div class="form-group checkbox-group">
                                <input type="checkbox" id="cgu" name="cgu" required>
                                <label for="cgu">
                                    J'accepte les <a href="#">conditions générales d'utilisation</a>
                                </label>
                            </div>
                            <div class="col-6 text-center mx-auto">
                                <button type="submit" class="submit-btn mx-auto">
                                    <i class="fas fa-user-plus"></i> Inscription
                                </button>
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

<?php include 'parts/footer.php'; ?>
</body>

</html>