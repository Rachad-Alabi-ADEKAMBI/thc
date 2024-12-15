<?php $title = "THC - Politique de Confidentialité";

// $articles

ob_start(); ?>

<style>
    .section {
        text-align: left;
        padding-left: 10px;
        padding-right: 10px;
    }

    ul {
        margin: auto 0px;
        text-align: left;
    }

    li {
        text-align: left;
        list-style: circle;
    }

    h1 {
        text-align: center;
    }

    h2 {
        color: #FD4F65;
    }

    a,
    strong {
        color: #F99401;
    }

    span {
        color: #50AF47;
    }
</style>

<main class="main">
    <section class="section">
        <div class="row">
            <div class="col-12"> <br><br> <br><br>
                <div>
                    <h1>Politique de Confidentialité</h1>
                    <h2>The Healthy Choice - THC</h2>
                    <p><strong>Date de dernière mise à jour :</strong> 01/12/2024</p>
                </div>

                <main>
                    <section>
                        <h2>1. Introduction</h2>
                        <p>Cette Politique de Confidentialité décrit comment <strong>The Lazy Company</strong> collecte,
                            utilise et protège vos données personnelles lorsque vous utilisez le site web THC.</p>
                        <p>En utilisant ce site, vous acceptez les termes de cette Politique de Confidentialité.</p>
                    </section>

                    <section>
                        <h2>2. Données collectées</h2>
                        <p>Nous collectons les données personnelles suivantes :</p>
                        <ul>
                            <li><strong>Informations d'inscription :</strong> nom, email, adresse, numéro de téléphone.
                            </li>
                            <li><strong>Informations de paiement :</strong> données nécessaires au traitement des
                                transactions.</li>
                            <li><strong>Données de navigation :</strong> adresse IP, type de navigateur, pages visitées.
                            </li>
                        </ul>
                    </section>

                    <section>
                        <h2>3. Utilisation des données</h2>
                        <p>Vos données personnelles sont utilisées pour :</p>
                        <ul>
                            <li>Fournir nos services, y compris la gestion des abonnements et des livraisons.</li>
                            <li>Améliorer l'expérience utilisateur et optimiser le fonctionnement du site.</li>
                            <li>Envoyer des communications marketing si vous y avez consenti.</li>
                        </ul>
                    </section>

                    <section>
                        <h2>4. Partage des données</h2>
                        <p>Nous pouvons partager vos données personnelles avec :</p>
                        <ul>
                            <li><strong>Prestataires de services :</strong> partenaires logistiques et fournisseurs de
                                paiement.</li>
                            <li><strong>Autorités légales :</strong> si requis par la loi ou pour protéger nos droits.
                            </li>
                        </ul>
                    </section>

                    <section>
                        <h2>5. Sécurité des données</h2>
                        <p>Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles pour protéger
                            vos données contre les accès non autorisés, les pertes ou les altérations.</p>
                    </section>

                    <section>
                        <h2>6. Cookies</h2>
                        <p>Le site utilise des cookies pour améliorer votre expérience utilisateur. Vous pouvez gérer
                            vos préférences de cookies dans les paramètres de votre navigateur.</p>
                    </section>

                    <section>
                        <h2>7. Vos droits</h2>
                        <p>Vous disposez des droits suivants concernant vos données personnelles :</p>
                        <ul>
                            <li>Droit d'accès, de rectification et de suppression.</li>
                            <li>Droit d'opposition au traitement à des fins marketing.</li>
                            <li>Droit à la portabilité des données.</li>
                        </ul>
                        <p>Pour exercer vos droits, contactez-nous à l'adresse suivante : <a
                                href="mailto:support@thehealthychoice.com">support@thehealthychoice.com</a>.</p>
                    </section>

                    <section>
                        <h2>8. Modifications de la Politique de Confidentialité</h2>
                        <p>Nous nous réservons le droit de modifier cette Politique de Confidentialité à tout moment.
                            Les modifications seront publiées sur cette page avec une date de mise à jour.</p>
                    </section>

                    <section>
                        <h2>9. Contact</h2>
                        <p>Pour toute question concernant cette Politique de Confidentialité, veuillez nous contacter à
                            :</p>
                        <ul>
                            <li><strong>Email :</strong> support@thehealthychoice.com</li>
                            <li><strong>Téléphone :</strong> +229 41 59 76 42</li>
                        </ul>
                    </section>
                </main>
            </div>
        </div>
    </section>
</main> <br>

<?php $content = ob_get_clean(); ?>

<?php require './src/view/layout.php'; ?>