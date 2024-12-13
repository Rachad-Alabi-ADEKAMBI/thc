<?php $title = "THC - Page introuvable";

// $articles

ob_start(); ?>

<main class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="page">
                    introuvable
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