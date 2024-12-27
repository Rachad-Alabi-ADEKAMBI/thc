<?php
include 'api/db.php';

function verifyInput($inputContent)
{
    $inputContent = htmlspecialchars(trim($inputContent));
    return $inputContent;
}

$ref = null;
$datas = [];

if (isset($_GET['ref'])) {
    $ref = verifyInput($_GET['ref']);

    try {
        $pdo = getConnexion();
        $req = $pdo->prepare("SELECT * FROM users WHERE ref = ?");
        $req->execute([$ref]);
        $datas = $req->fetchAll(PDO::FETCH_ASSOC); 
        $req->closeCursor();
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

if (isset($_SESSION['user'])) {
    header("Location: index.php?action=registerPage&ref=" . urlencode($ref));
    exit();
}

$title = "THC - Inscription";
ob_start();
?>
<br><br><br>

<main class="main" id="app">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="contact-container">
                    <div class="contact-form-container" id="contact">
                        <h2>Inscription 🍋</h2>
                        <?php if (isset($ref)) : ?>
                            <?php if (!empty($datas)) : ?>
                                <p>
                                    Vous avez été invité par <strong>
                                        <?= htmlspecialchars(ucfirst(strtolower($datas[0]['first_name'])) . ' ' . strtoupper($datas[0]['last_name'])); ?>
                                    </strong>
                                </p>

                            <?php else : ?>
                                <p class="text text-warning">
                                    Ce lien d'affiliation n'est pas reconnu, merci de le vérifier.
                                </p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <hr>
                        <form class="contact-form" action="api/script.php?action=register" 
                        method="POST">
                        <?php
                        if (isset($_GET['ref']) && !empty($_GET['ref'])) { ?>
                            <input type="hidden" name="ref" value="<?= htmlspecialchars($ref) ?>"> 
                            <input type="hidden" name="sponsor_id" value="<?= htmlspecialchars($datas[0]['id']) ?>">
                            <input type="hidden" name="sponsor_first_name" value="<?= htmlspecialchars($datas[0]['first_name']) ?>">
                            <input type="hidden" name="sponsor_last_name" value="<?= htmlspecialchars($datas[0]['last_name']) ?>">
                        <?php } ?>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first_name"><i class="fas fa-user"></i> Prénoms</label>
                                    <input type="text" id="first_name" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name"><i class="fas fa-user"></i> Nom</label>
                                    <input type="text" id="last_name" name="last_name" required>
                                </div>
                            </div>
                            <div class="form-row">
    <div class="form-group">
        <label for="password1">
            <i class="fas fa-lock"></i> Mot de passe
        </label>
        <div class="password-container">
        <input :type="showPassword1 ? 'text' : 'password'" id="password1" name="password" required>
        <i @click="togglePassword1Visibility" :class="showPassword1 ? 'fas fa-eye-slash' : 'fas fa-eye'" class="password-icon"></i>
        </div>
    </div>
    <div class="form-group">
        <label for="password2">
            <i class="fas fa-lock"></i> Confirmez le mot de passe
        </label>
       <div class="password-container">
       <input :type="showPassword2 ? 'text' : 'password'" id="password2" name="password2" required>
       <i @click="togglePassword2Visibility" :class="showPassword2 ? 'fas fa-eye-slash' : 'fas fa-eye'" class="password-icon"></i>
       </div>
    </div>
</div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="address"><i class="fas fa-map-marker-alt"></i> Adresse de livraison</label>
                                    <input type="text" id="address" name="address" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone"><i class="fas fa-phone"></i> Téléphone</label>
                                    <input type="tel" id="phone" name="phone" required>
                                </div>
                            </div>
                            <div class="form-group checkbox-group">
                                <input type="checkbox" id="cgu" name="cgu" required>
                                <label for="cgu">J'accepte les <a href="#">conditions générales d'utilisation</a></label>
                            </div>
                            <div class="col-6 text-center mx-auto">
                                <button type="submit" class="submit-btn mx-auto">
                                    <i class="fas fa-user-plus"></i> Inscription
                                </button> <br>
                                
                        <hr>
                                <div class="socials">
                                    <!-- Gmail Button -->
                                    <button @click.prevent="loginWithGoogle" class="connect-btn gmail-btn mx-auto">
                                        <i class="fa fa-google"></i>
                                    </button>
                                    <!-- Facebook Button -->
                                    <button @click.prevent="loginWithFacebook" class="connect-btn facebook-btn mx-auto">
                                        <i class="fa fa-facebook"></i>
                                    </button>
                                </div>
                        <p>
                            Vous avez déjà un compte ? <a href="index.php?action=loginPage">Connexion</a>
                        </p> 
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<style>
    strong, a{
        color: #50AF47;
        font-weight: bold;
    }
</style>
<?php $content = ob_get_clean(); ?>

<?php require './src/view/layout.php'; ?>

<script>
const app = Vue.createApp({
    data() {
        return {
            showPassword1: false,
            showPassword2: false,

        };
    },
    methods: {
        togglePassword1Visibility() {
        this.showPassword1 = !this.showPassword1;
    },
    togglePassword2Visibility() {
        this.showPassword2 = !this.showPassword2;
    },
            loginWithGoogle() {
                console.log('Google login initiated.');
                // Implémentez ici l'intégration avec l'API de Google
            },
            loginWithFacebook() {
                console.log('Facebook login initiated.');
                // Implémentez ici l'intégration avec l'API de Facebook
            }
    },
});
app.mount('#app');
</script>

<style>
    .socials{
        display: flex;
        flex-direction: row;
        width: 120px;
        gap: 20px;
        margin: 20px auto;
    }

    .gmail-btn {
        background-color: #DB4437;
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    .facebook-btn {
        background-color: #3b5998;
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    .connect-btn:hover{
        background-color: #50AF47;
    }

    .password-container {
        position: relative;
    }

    .password-container input {
        width: 100%;
        padding-right: 30px;
    }

    .password-icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }

    p span a{
        color: #F99401;
        font-weight: bold;
    }
</style>