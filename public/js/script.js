// Vérifier que le DOM est entièrement chargé avant d'exécuter le script
document.addEventListener("DOMContentLoaded", function() {
    // Sélectionner les éléments
    const open = document.getElementById('open');
    const close = document.getElementById('close');
    const menu_mobile = document.getElementById('menu_mobile');

    // Vérifier si les éléments existent avant d'essayer de manipuler leur style
    if (open && close && menu_mobile) {
        // Fonction pour ouvrir le menu
        function openMenu() {
            open.style.display = 'none';
            close.style.display = 'block';
            menu_mobile.style.display = 'block';
        }

        // Fonction pour fermer le menu
        function closeMenu() {
            open.style.display = 'block';
            close.style.display = 'none';
            menu_mobile.style.display = 'none';
        }

        // Assurez-vous d'attacher l'événement au bon moment
        open.onclick = openMenu;
        close.onclick = closeMenu;
    } else {
        console.error("Un ou plusieurs éléments sont manquants.");
    }
});