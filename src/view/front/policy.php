<?php $title = "THC - Politique de confidentialite";

// $articles

ob_start(); ?>

<main class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
                policy
            </div>

        </div>
    </section>
</main>


<?php $content = ob_get_clean(); ?>

<?php require './src/view/layout.php'; ?>

<?php include 'parts/footer.php'; ?>
</body>

</html>