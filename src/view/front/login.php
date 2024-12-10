<?php $title = "THC - Connexion";

// $articles

ob_start(); ?>
  
    <main class="main">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8 m-auto">
                        <div class="login">
                            login
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