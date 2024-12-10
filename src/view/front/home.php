<?php $title = "THC - Service de livraison de salade de fruits au Bénin";

// $articles

ob_start(); ?>
  
    <main class="main">
        <div class="hero">
            <div class="hero__content">
                <div class="hero__content__text">
                   <h1> The Healthy <br> Choice 
                     (THC)
                   </h1> 
                   <p>La solution pour des salades <br> 
                   de fruits livrées à domicile  <br> <p>

                   <p> <span class="star">*</span>Une livraison régulière et simplifiée <br>
                   <span class="star">*</span>Choix de vos fruits préférés <br>
                   <span class="star">*</span>Un abonnement sur mesure
                   </p>
                
                <p class="call">
                    Laissez-nous un message sur whatsapp au : <span>+ 229 41 59 76 42</span>
                </p>
                   
                   
                   <button class="btn">
                        C'est parti !
                   </button>
                  
                </div>

                <div class="hero__content__image">
                    <img src="public/images/logo-carre.webp" alt="logo thc">
                </div>
            </div>
        </div>

        <div class="process">
            <div class="process__title">
                <h2>
                Comment ça marche ?
                </h2>

                <p>
                Choisissez vos fruits préférés, créez un mélange unique, et programmez vos livraisons.
                 Nous nous occupons du reste.
                </p>
            </div>

            <div class="process__content">
                <div class="process__content__item">
                    <span class="number">
                        1
                    </span>

                    <span class="action">
                    Créez un compte
                    </span>

                    <span class="easy">
                    Simple et <br> rapide.
                    </span>
                </div>

                <div class="process__content__item">
                    <span class="number">
                        2
                    </span>

                    <span class="action">
                    Sélectionnez vos fruits
                    </span>

                    <span class="easy">
                    Ananas, pastèques, papaye, etc.
                    </span>
                </div>

                <div class="process__content__item">
                    <span class="number">
                        3
                    </span>

                    <span class="action">
                    Recevez vos livraisons
                    </span>

                    <span class="easy">
                    Fraîcheur <br>garantie.
                    </span>
                </div>
            </div>
        </div>

        <div class="reason">
            <div class="reason__content">
                <div class="reason__content__text">
                    <h2>
                        Comme vous le voulez
                    </h2>
                    
                    <p>
                    Parce que nous adapter à vos besoins 
                    est une priorité pour nous, vous avez la 
                    possibilité de choisir vos fruits et vous faire
                    livrer au lieu de votre choix, deux ou trois fois 
                    par semaine selon vos besoins.
                    </p>

                    <ul>
                        <li>
                            <i></i>Choix de vos fruits préféreés
                        </li>
                        <li>
                            <i></i> Livraisons simples au lieu de votre choix
                        </li>

                        <li>
                            <i></i> Cash back de 10% reversés chaque mois pour chaque nouveau filleul
                        </li>
                    </ul>

                    <button class="btn btn-primary">
                        En savoir plus
                    </button>
                </div>

                <div class="reason__content__image">
                    <img src="./public/images/logo-carre.webp" alt="">
                </div>
            </div>
        </div>

        <div class="fruits">
            <div class="fruits__slider">

            </div>
        </div>

        <div class="cashback">
            <div class="cashback__content">
                <div class="cashback__content__image">
                    <img src="./public/images/logo-carre.webp" alt="">
                </div>

                <div class="cashback__content__text">
                    <h2>
                        Notre programme de parrainage
                    </h2>

                    <p>
                        Lorem ipsum dolor sit, amet consectetur 
                        adipisicing elit. Eveniet eius suscipit nesciunt 
                        consectetur, aperiam odit maiores facere numquam ad!
                         Nam delectus porro explicabo atque quisquam quasi
                          maxime reiciendis ipsa in?
                    </p>

                    <ul>
                        <li>
                            <i></i> Le programme ne vous engage en rien
                        </li>
                        <li>
                            <i></i> Les retraits se font chaque Lundi
                        </li>
                        <li>
                            <i></i> Possibilité de renouveller votre abonnment directement avec votre cashback
                        </li>
                    </ul>

                    <button class="btn btn-primary">
                        En savoir plus
                    </button>
                </div>
            </div>
        </div>

        <div class="pricing">
            <div class="pricing__content">
                <div class="pricing__Content___item">
                    <span>
                        Offre 1
                    </span>

                    <p>
                        <ul>
                            <li>1 pot * 2 livraisons / semaine</li>
                        </ul>
                    </p>

                    <strong>
                        6.000 XOF
                    </strong>
                </div>
                <div class="pricing__Content___item">
                    <span>
                        Offre 2
                    </span>

                    <p>
                        <ul>
                            <li>2 pots * 2 livraisons / semaine</li>
                        </ul>
                    </p>

                    <strong>
                        9.000 XOF
                    </strong>
                </div>
                <div class="pricing__Content___item">
                    <span>
                        Offre 3
                    </span>

                    <p>
                        <ul>
                            <li>3 pots * livraisons / semaine</li>
                        </ul>
                    </p>

                    <strong>
                        11.000 XOF
                    </strong>
                </div>

            </div>
        </div>

        <div class="testimonies">
            <div class="testimonies__content">
                <div class="testimony">

                </div>
            </div>
        </div>

        <div class="contact">
            
        </div>

    </main>



<?php $content = ob_get_clean(); ?>

<?php require './src/view/layout.php'; ?>

    <?php include 'parts/footer.php'; ?>
</body>

</html>