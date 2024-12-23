<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Dynamique</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        #app {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #555;
        }

        .form-line {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #fff;
        }

        button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: #fff;
        }

        button[type="button"] {
            background-color: #007bff;
            color: #fff;
        }

        button:hover {
            opacity: 0.9;
        }

        button.delete {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div id="app">
        <h2>Formulaire de Réservation Dynamique</h2>
        <form @submit.prevent="submitForm">
            <div v-for="(line, index) in formLines" :key="index" class="form-line">
                <h3>Ligne {{ index + 1 }}</h3>
                <!-- Sélection du jour -->
                <div class="form-group">
                    <label :for="'day-' + index">Jour :</label>
                    <select :id="'day-' + index" v-model="line.day" required>
                        <option value="">Choisir un jour</option>
                        <option v-for="(day, idx) in days" :key="idx" :value="day">{{ day }}</option>
                    </select>
                </div>
                <!-- Sélection de la salade -->
                <div class="form-group">
                    <label :for="'salad-' + index">Salade :</label>
                    <select :id="'salad-' + index" v-model="line.salad" required>
                        <option value="">Choisir une salade</option>
                        <option v-for="salad in salads" :key="salad.id" :value="salad.name">
                            {{ salad.name }}
                        </option>
                    </select>
                </div>
                <!-- Sélection de l'heure -->
                <div class="form-group">
                    <label :for="'time-' + index">Heure :</label>
                    <select :id="'time-' + index" v-model="line.time" required>
                        <option value="">Choisir une heure</option>
                        <option v-for="(time, idx) in times" :key="idx" :value="time">{{ time }}</option>
                    </select>
                </div>
                <button type="button" class="delete" @click="removeLine(index)">Supprimer cette ligne</button>
            </div>
            <button type="button" @click="addLine">Ajouter une ligne</button>
            <button type="submit">Soumettre</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: "#app",
            data: {
                days: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"],
                salads: [
                    { id: 1, name: "Tropicale" },
                    { id: 2, name: "César" },
                    { id: 3, name: "Niçoise" },
                ],
                times: ["9h", "10h", "11h", "13h", "15h", "17h"],
                formLines: [
                    { day: "", salad: "", time: "" },
                ],
            },
            methods: {
                addLine() {
                    this.formLines.push({ day: "", salad: "", time: "" });
                },
                removeLine(index) {
                    this.formLines.splice(index, 1);
                },
                submitForm() {
                    const isValid = this.formLines.every(line => line.day && line.salad && line.time);
                    if (!isValid) {
                        alert("Veuillez remplir toutes les lignes correctement.");
                        return;
                    }

                    const formData = this.formLines.map(line => ({
                        day: line.day,
                        salad: line.salad,
                        time: line.time,
                    }));

                    axios.post('/api/submit', { orders: formData })
                        .then(response => {
                            console.log("Formulaire soumis avec succès :", response.data);
                            alert("Réservation enregistrée !");
                        })
                        .catch(error => {
                            console.error("Erreur lors de la soumission :", error);
                            alert("Une erreur est survenue.");
                        });
                },
            },
        });
    </script>
</body>
</html>
