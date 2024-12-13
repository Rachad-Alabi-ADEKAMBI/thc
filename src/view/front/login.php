<?php $title = "THC - Connexion";

// $articles

ob_start(); ?>

<main class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="contact-container">
                    <div class="contact-form-container" id="contact">
                        <h2> Connexion 🍒</h2>
                        <form class="contact-form" action="api/script.php?action=login" method="POST">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nom">
                                        <i class="fas fa-user"></i> Email
                                    </label>
                                    <input type="text" id="nom" name="email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="password">
                                        <i class="fas fa-lock"></i> Mot de passe
                                    </label>
                                    <input type="password" id="password" name="password" required>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="submit-btn">
                                <i class="fas fa-sign-in-alt"></i> Connexion
                            </button>
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