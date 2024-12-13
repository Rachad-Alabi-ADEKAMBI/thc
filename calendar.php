<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire de Réservation</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>

    <body>
        <div class="container">
            <h1><i class="fas fa-calendar-alt"></i> Réservation de Livraison</h1>
            <div class="reservation-layout">
                <div class="calendar-container">
                    <div id="calendar"></div>
                </div>
                <div class="reservation-details">
                    <div id="time-slots" class="hidden">
                        <h2><i class="fas fa-clock"></i> Choisissez une heure de livraison</h2>
                        <div class="time-slot-buttons">
                            <button class="time-slot"><i class="fas fa-truck"></i> 9h</button>
                            <button class="time-slot"><i class="fas fa-truck"></i> 11h</button>
                            <button class="time-slot"><i class="fas fa-truck"></i> 13h</button>
                            <button class="time-slot"><i class="fas fa-truck"></i> 15h</button>
                            <button class="time-slot"><i class="fas fa-truck"></i> 17h</button>
                            <button class="time-slot"><i class="fas fa-truck"></i> 19h</button>
                        </div>
                    </div>
                    <div id="selected-dates">
                        <h2><i class="fas fa-list-ul"></i> Dates sélectionnées</h2>
                        <ul id="selected-dates-list"></ul>
                    </div>
                    <button id="submit-btn" class="hidden"><i class="fas fa-check"></i> Confirmer la
                        réservation</button>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
    </body>

</html>