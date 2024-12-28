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
                        <form class="contact-form"  @submit.prevent="submitForm">
                            
                        <p class="text text-danger  fw-bold" v-if='message != ""'>
                                {{ message }}
                            </p>
                            
                            <?php if (isset($_GET['ref']) && !empty($_GET['ref'])): ?>
                                <input type="hidden"  v-model="form.sponsor_id" :value="">
                                <input type="hidden"  v-model="form.sponsor_first_name" :value="">
                                <input type="hidden" v-model="form.sponsor_last_name" :value="">
                            <?php endif; ?>


                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                    <input type="email" id="email" v-model="form.email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first_name"><i class="fas fa-user"></i> Prénoms</label>
                                    <input type="text" id="first_name" v-model="form.first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name"><i class="fas fa-user"></i> Nom</label>
                                    <input type="text" id="last_name" v-model="form.last_name" required>
                                </div>
                            </div>
                            <div class="form-row">
    <div class="form-group">
        <label for="password1">
            <i class="fas fa-lock"></i> Mot de passe
        </label>
        <div class="password-container">
        <input :type="showPassword1 ? 'text' : 'password'" id="password1" v-model="form.password" required>
        <i @click="togglePassword1Visibility" :class="showPassword1 ? 'fas fa-eye-slash' : 'fas fa-eye'" class="password-icon"></i>
        </div>
    </div>
    <div class="form-group">
        <label for="password2">
            <i class="fas fa-lock"></i> Confirmez le mot de passe
        </label>
       <div class="password-container">
       <input :type="showPassword2 ? 'text' : 'password'" id="password2" v-model="form.password2" required>
       <i @click="togglePassword2Visibility" :class="showPassword2 ? 'fas fa-eye-slash' : 'fas fa-eye'" class="password-icon"></i>
       </div>
    </div>
</div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="address"><i class="fas fa-map-marker-alt"></i> Adresse de livraison</label>
                                    <input type="text" id="address" v-model="form.address" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone"><i class="fas fa-phone"></i> Téléphone</label>
                                    <input type="number" id="phone" v-model="form.phone" required @input="form.phone = form.phone < 0 ? 0 : form.phone" />

                                </div>
                            </div>
                            <div class="form-group checkbox-group">
                                <input type="checkbox" id="cgu" required>
                                <label for="cgu">J'accepte les <a href="index.php?action=terms">conditions générales d'utilisation</a></label>
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
            message: '',
            form: {
                     email: '',
                     frst_name: '',
                     last_name: '',
                    password: '',
                    phone: '',
                    address: '',
                    password2: '',
                    sponsor_id: '<?= htmlspecialchars(json_encode($datas[0]['id'])) ?>',
                    sponsor_first_name: <?= htmlspecialchars_decode(json_encode($datas[0]['first_name'])) ?>,
                    sponsor_last_name: <?= htmlspecialchars_decode(json_encode($datas[0]['last_name'])) ?>,
                }

        };
    },
    methods: {
        togglePassword1Visibility() {
        this.showPassword1 = !this.showPassword1;
    },
    togglePassword2Visibility() {
        this.showPassword2 = !this.showPassword2;
    },
    loginWithGoogle(){
        alert('Api indisponible pour le moment, merci de reéssayer ultérieurement !');
    },
    loginWithFacebook(){
        alert('Api indisponible pour le moment, merci de reéssayer ultérieurement !');
    },

    submitForm(){
                const formData = new FormData();

                    // Ajout des données saisies au FormData
                    formData.append('email', this.form.email);
                    formData.append('first_name', this.form.first_name);
                    formData.append('last_name', this.form.last_name);
                    formData.append('password', this.form.password);
                    formData.append('password2', this.form.password2);
                    formData.append('phone', this.form.phone);
                    formData.append('address', this.form.address);
                    formData.append('sponsor_id', this.form.sponsor_id);
                    formData.append('sponsor_first_name', this.form.sponsor_first_name);
                    formData.append('sponsor_last_name', this.form.sponsor_last_name);

                    // Debug : Vérifier les données avant l'envoi
                    console.log('Données envoyées :', Object.fromEntries(formData));

                    // Envoi de la requête avec Axios
                    axios.post('api/script.php?action=register', formData)
                        .then(response => {
                             console.log(response.data);

                             if(response.data.status === 'success'){
                                    alert("Inscription enregistrée avec succès, veuillez vous connecter");
                                   // window.location.replace('index.php?action=loginPage');
                             } else{
                                this.message = response.data.message
                                window.location.replace('#app')
                             }
                        })
                        .catch(error => {
                            console.error('Erreur Axios :', error);
                            this.message = 'Erreur lors de la connexion.';
                        });
            },
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