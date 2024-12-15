<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="calendar.css">
    </head>

    <body>
        <div class="reservation-component">
            <h2 class="title">Réservez vos livraisons de salades de fruits</h2>
            <div class="reservation-layout">
                <div class="days-selection">
                    <div class="day-item">
                        <h3 class="day-title">Lundi</h3>
                        <div class="form-group">
                            <label for="salade-0">Salade :</label>
                            <select id="salade-0" class="salade-select">
                                <option value="">Choisir</option>
                                <option value="Salade Tropicale" data-image="/placeholder.svg?height=30&width=30">
                                    Tropicale</option>
                                <option value="Salade Estivale" data-image="/placeholder.svg?height=30&width=30">
                                    Estivale</option>
                                <option value="Salade Exotique" data-image="/placeholder.svg?height=30&width=30">
                                    Exotique</option>
                                <option value="Salade Vitaminée" data-image="/placeholder.svg?height=30&width=30">
                                    Vitaminée</option>
                            </select>
                            <select id="heure-0" class="heure-select">
                                <option value="">Heure</option>
                                <option value="10:00">10h</option>
                                <option value="12:00">12h</option>
                                <option value="14:00">14h</option>
                                <option value="16:00">16h</option>
                                <option value="18:00">18h</option>
                            </select>
                        </div>
                    </div>
                    <div class="day-item">
                        <h3 class="day-title">Mardi</h3>
                        <div class="form-group">
                            <label for="salade-1">Salade :</label>
                            <select id="salade-1" class="salade-select">
                                <option value="">Choisir</option>
                                <option value="Salade Tropicale" data-image="/placeholder.svg?height=30&width=30">
                                    Tropicale</option>
                                <option value="Salade Estivale" data-image="/placeholder.svg?height=30&width=30">
                                    Estivale</option>
                                <option value="Salade Exotique" data-image="/placeholder.svg?height=30&width=30">
                                    Exotique</option>
                                <option value="Salade Vitaminée" data-image="/placeholder.svg?height=30&width=30">
                                    Vitaminée</option>
                            </select>
                            <select id="heure-1" class="heure-select">
                                <option value="">Heure</option>
                                <option value="10:00">10h</option>
                                <option value="12:00">12h</option>
                                <option value="14:00">14h</option>
                                <option value="16:00">16h</option>
                                <option value="18:00">18h</option>
                            </select>
                        </div>
                    </div>
                    <div class="day-item">
                        <h3 class="day-title">Mercredi</h3>
                        <div class="form-group">
                            <label for="salade-2">Salade :</label>
                            <select id="salade-2" class="salade-select">
                                <option value="">Choisir</option>
                                <option value="Salade Tropicale" data-image="/placeholder.svg?height=30&width=30">
                                    Tropicale</option>
                                <option value="Salade Estivale" data-image="/placeholder.svg?height=30&width=30">
                                    Estivale</option>
                                <option value="Salade Exotique" data-image="/placeholder.svg?height=30&width=30">
                                    Exotique</option>
                                <option value="Salade Vitaminée" data-image="/placeholder.svg?height=30&width=30">
                                    Vitaminée</option>
                            </select>
                            <select id="heure-2" class="heure-select">
                                <option value="">Heure</option>
                                <option value="10:00">10h</option>
                                <option value="12:00">12h</option>
                                <option value="14:00">14h</option>
                                <option value="16:00">16h</option>
                                <option value="18:00">18h</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="recap">
                    <h3>Récapitulatif de vos réservations</h3>
                    <p id="recap-lundi">Lundi : Aucune salade sélectionnée</p>
                    <p id="recap-mardi">Mardi : Aucune salade sélectionnée</p>
                    <p id="recap-mercredi">Mercredi : Aucune salade sélectionnée</p>
                </div>
            </div>
            <button class="submit-btn">Confirmer les réservations</button>
        </div>
    </body>

</html>