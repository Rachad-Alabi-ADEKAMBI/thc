<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue Form with Axios</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div id="app">
        <h1>Formulaire de connexion</h1>
        <p>{{ successMsg }}</p>
        <form @submit.prevent="submitForm">
            <label for="email">
                Email: <input type="email" id="email" v-model="form.email" required>
            </label><br>
            <label for="password">
                Mot de passe: <input type="password" id="password" v-model="form.password" required>
            </label><br>
            <button type="submit">Valider</button>
        </form>
    </div>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    successMsg: '',
                    form: {
                        email: '',
                        password: ''
                    }
                };
            },
            methods: {
                submitForm() {
                    const formData = new FormData();

                    // Ajout des données saisies au FormData
                    formData.append('email', this.form.email);
                    formData.append('password', this.form.password);

                    // Debug : Vérifier les données avant l'envoi
                    console.log('Données envoyées :', Object.fromEntries(formData));

                    // Envoi de la requête avec Axios
                    axios.post('api/script.php?action=login', formData)
                        .then(response => {
                            console.log('Réponse de l\'API :', response.data);
                            if (response.data.status === 'success') {
                                this.successMsg = `Connexion réussie en tant que ${response.data.role}!`;

                                // Redirection selon le rôle
                                if (response.data.role === 'user') {
                                    window.location.replace('index.php?action=dashboardPage');
                                } else {
                                    window.location.replace('index.php?action=dashboardPageAdmin');
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Erreur Axios :', error);
                            this.successMsg = 'Erreur lors de la connexion.';
                        });
                }
            }
        });

        app.mount('#app');
    </script>
</body>
</html>
