<?php 

// Check if the user is not logged in (i.e., if $_SESSION['login'] does not exist)
if (!isset($_SESSION['user'])) {
    ?>
<script>
    alert('Veuillez vous connecter d\'abord');
    window.location.replace('index.php?action=loginPage');
</script>
<?php
        // Exit to stop further execution of the script after the redirect
        exit();
    }
    $title = "THC - Tableau de bord";

ob_start(); ?>

<main class="main">
    <section class="section">
        <div class="row ">
            <div class="col-12"> <br><br><br><br>
                <div class="dashboard">
                    <div class="dashboard__menu">
                        <div class="dashboard__menu__content">
                            <a class="link btn btn-primary">
                                <i data-lucide="shopping-bag" aria-hidden="true"></i>
                                Mes commandes
                            </a>

                            <a class="link btn btn-primary">
                                <i data-lucide="shopping-bag" aria-hidden="true"></i>
                                Affiliation
                            </a>

                            <a class="link btn btn-primary">
                                <i data-lucide="shopping-bag" aria-hidden="true"></i>
                                Mon abonnement
                            </a>

                        </div>
                    </div>

                    <div class="dashboard__content">
                        <div class="dashboard__content__top">
                            <h2>
                                Tableau de bord
                            </h2>

                            <div class="profil">
                                <p>
                                    Bonjour <?=  $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']?>
                                </p>
                            </div>
                        </div>

                        <div class="dashboard__content__menu">
                            <form class="form">
                                <label for="newRadio" class="ml-5">
                                    <input type="radio" id="newRadio" name="options" @click="displayNewsletters()">
                                    Prochaine commande
                                </label>
                                <label for="allRadio" class="ml-5">
                                    <input type="radio" id="allRadio" name="options" @click="displaySurveys()">
                                    Mes commandes
                                </label>
                            </form>
                        </div>

                        <div class="dashboard__content__main">
                            <h3>
                                Commande à venir
                            </h3>

                            <div class="next-orders">
                                <div class="flex-between">
                                    <div>
                                        <h4>Salade Tropicale</h3>
                                            <p>Livraison prévue le <strong>lundi 18/06/2023</strong>
                                                a <strong>10 h</strong></p>
                                    </div>
                                </div>
                                <hr>

                                <div class="flex-between">
                                    <div>
                                        <h4>Salade Tropicale</h3>
                                            <p>Livraison prévue le <strong>lundi 18/06/2023</strong>
                                                a <strong>10 h</strong></p>
                                    </div>

                                    <div>
                                        <button class="btn btn-secondary">Modifier</button>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="dashboard__content__main">
                            <div class="top">
                                <h3>
                                    Mes commandes
                                </h3>
                            </div>

                            <div class="table-container">
                                <table class="orders-table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Salade</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>15/06/2023</td>
                                            <td><i data-lucide="apple" aria-hidden="true"></i> Salade Tropicale</td>
                                            <td><span class="status delivered">Livrée</span></td>
                                        </tr>
                                        <tr>
                                            <td>12/06/2023</td>
                                            <td><i data-lucide="banana" aria-hidden="true"></i> Salade Vitaminée</td>
                                            <td><span class="status delivered">Livrée</span></td>
                                        </tr>
                                        <tr>
                                            <td>09/06/2023</td>
                                            <td><i data-lucide="cherry" aria-hidden="true"></i> Salade Gourmande</td>
                                            <td><span class="status delivered">Livrée</span></td>
                                        </tr>
                                        <tr>
                                            <td>06/06/2023</td>
                                            <td><i data-lucide="grape" aria-hidden="true"></i> Salade Exotique</td>
                                            <td><span class="status delivered">Livrée</span></td>
                                        </tr>
                                        <tr>
                                            <td>03/06/2023</td>
                                            <td><i data-lucide="lemon" aria-hidden="true"></i> Salade Agrumes</td>
                                            <td><span class="status delivered">Livrée</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                <button class="btn btn-icon"><i data-lucide="chevron-left"
                                        aria-hidden="true"></i></button>
                                <span>Page 1 sur 3</span>
                                <button class="btn btn-icon"><i data-lucide="chevron-right"
                                        aria-hidden="true"></i></button>
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

<?php include 'parts/footer.php'; ?>
</body>

</html>