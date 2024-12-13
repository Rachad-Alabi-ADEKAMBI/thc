<?php
session_start();

// Configure le niveau de rapport des erreurs pour exclure les avertissements
error_reporting(E_ALL & ~E_WARNING);

// Désactive l'affichage des erreurs
ini_set('display_errors', 0);

// Inclusion des contrôleurs nécessaires
require_once 'src/controller/front/home.php';
require_once 'src/controller/front/login.php';
require_once 'src/controller/front/register.php';

require_once 'src/controller/back/user/dashboard.php';
require_once 'src/controller/back/admin/dashboard.php';

// Vérifie si une action est définie dans l'URL
if (isset($_GET['action']) && !empty($_GET['action'])) {
    switch ($_GET['action']) {
        case 'loginPage':
            loginPage();
            break;
        case 'registerPage':
            registerPage();
            break;
        case 'homePage':
            homePage();
            break;
        default:
            echo '<script>
                alert("Page introuvable, veuillez vérifier cette URL !");
                window.history.back();
            </script>';
            exit();
    }
} else {
    // Page d'accueil par défaut
    homePage();
}
?>