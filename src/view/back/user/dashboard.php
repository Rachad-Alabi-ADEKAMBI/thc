<?php $title = "THC - Connexion";

// $articles

ob_start(); ?>

<main class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="contact-container">
                    <div class="contact-form-container" id="contact">
                        <h2>Tableau de bord 🍒</h2>
                        tableau de board user
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