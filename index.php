<?php
session_start();

// Set the error reporting level to exclude warnings
error_reporting(E_ALL & ~E_WARNING);

// Disable displaying errors
ini_set('display_errors', 0);

require_once 'src/controller/front/home.php';
require_once 'src/controller/front/login.php';
require_once 'src/controller/front/register.php';


if (isset($_GET['action']) && $_GET['action'] !== '') {

  if ($_GET['action'] === 'loginPage') {
    /* if (isset($_SESSION['user'])) {
      dashboard_adminPage();
    } else {
      loginPage();
    }
      */
    loginPage();
  } elseif ($_GET['action'] === 'registerPage') {
    registerPage();
  } elseif ($_GET['action'] === 'homePage') {
    homePage();
  } else {
?>
    <script>
      alert('Page introuvable, veuillez vérifier cette url !');
      window.history.back();
      exit();
    </script>
<?php
  }
} else {
  homePage();
}
