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
                                    <label for="password"><i class="fas fa-lock"></i> Mot de passe</label>
                                    <input type="password" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="password2"><i class="fas fa-lock"></i> Confirmez le mot de passe</label>
                                    <input type="password" id="password2" name="password2" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="address"><i class="fas fa-map-marker-alt"></i> Adresse de livraison</label>
                                    <input type="text" id="adress" name="adress" required>
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
                                </button>
                            </div>
                        </form>
                        <hr>
                        <p>
                            Vous avez déjà un compte ? <a href="index.php?action=loginPage">Connexion</a>
                        </p>
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
    /*
const app = Vue.createApp({
    data() {
        return {
            form: {
                email: '',
                first_name: '',
                last_name: '',
                password: '',
                password2: '',
                address: '',
                phone: '',
                cgu: false
            },
            errors: {}
        };
    },
    methods: {
        // Validation des champs avant soumission
        validateForm() {
            this.errors = {}; // Réinitialiser les erreurs

            // Vérifications des champs obligatoires
            if (!this.form.email) this.errors.email = "L'email est requis.";
            else if (!this.isValidEmail(this.form.email)) this.errors.email = "L'email n'est pas valide.";

            if (!this.form.first_name) this.errors.first_name = "Le prénom est requis.";
            if (!this.form.last_name) this.errors.last_name = "Le nom est requis.";
            if (!this.form.password) this.errors.password = "Le mot de passe est requis.";
            if (!this.form.password2) this.errors.password2 = "La confirmation du mot de passe est requise.";
            else if (this.form.password !== this.form.password2) this.errors.password2 = "Les mots de passe ne correspondent pas.";

            if (!this.form.address) this.errors.address = "L'adresse est requise.";
            if (!this.form.phone) this.errors.phone = "Le téléphone est requis.";
            else if (!this.isValidPhone(this.form.phone)) this.errors.phone = "Le numéro de téléphone n'est pas valide.";

            if (!this.form.cgu) this.errors.cgu = "Vous devez accepter les CGU.";

            // Si aucune erreur, soumettre le formulaire
            if (Object.keys(this.errors).length === 0) {
                this.submitForm();
            }
        },
        // Vérifie si l'email est valide
        isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        },
        // Vérifie si le numéro de téléphone est valide
        isValidPhone(phone) {
            const regex = /^\+?[0-9]{6,15}$/; // Format international ou local
            return regex.test(phone);
        },
        // Envoi du formulaire au backend
        submitForm() {
            const formData = new FormData();
            for (const key in this.form) {
                formData.append(key, this.form[key]);
            }

            fetch("api/script.php?action=register", {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Inscription réussie !");
                    } else {
                        alert("Erreur lors de l'inscription : " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Erreur lors de la soumission :", error);
                });
        },
    },
});
app.mount('#app');
*/
</script>