<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader if using Composer
require 'vendor/autoload.php';

//include db file
include 'db.php';



function orderForDay()
{
    $pdo = getConnexion();  
    $salad_name = verifyInput($_POST['mon']);
    $time = verifyInput($_POST['time']);
    
    $user_id = $_SESSION['user']['id'];

    $dayOfWeek = 'monday'; // Specify the day of the week you want to find
    $today = new DateTime(); // Get today's date
    
    // Function to get the next occurrence of a specific day
    function getNextDay($dayOfWeek)
    {
        $today = new DateTime(); // Get the current date
        $today->modify("next $dayOfWeek"); // Move to the next specified day
        return $today->format('Y-m-d'); // Return the date in YYYY-MM-DD format
    }
    
    // Get the next Monday
    $nextDay = getNextDay($dayOfWeek);

    try {
        // Insert the order into the database
        $req = $pdo->prepare('INSERT INTO orders (user_id, salad_name, day, time, status) VALUES (?, ?, ?, ?, ?)');
        $req->execute([$user_id, $salad_name, $nextDay, $time, 'A livrer']);
    
        // Update user's delivery day status to "yes"
        $req = $pdo->prepare("UPDATE users SET $column = ? WHERE id = ?");
        $req->execute(['yes', $user_id]);
    
        // Return a success message to the front end
        $datas = ['success' => true, 'message' => "Order successfully placed for next $dayOfWeek!"];
       // sendJSON($datas);
       return $datas;
    } catch (PDOException $e) {
        // Handle database errors
        http_response_code(500); // Internal server error HTTP status code
      return  ['error' => true, 'message' => 'An error occurred', 'details' => $e->getMessage()];
      $datas = ['success' => false, 'message' => 'An error occurred', 'details' => $e->getMessage()];
      return $datas;
    }
    
}


function getMyDatas()
{
    // Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
    if (!isset($_SESSION['user']['id'])) {
        header("Location: index.php?action=loginPage");
        exit();
    }

    try {
        $pdo = getConnexion();
        $req = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        
        // Assurez-vous de transmettre un tableau pour le paramètre
        $req->execute([$_SESSION['user']['id']]);
        $datas = $req->fetchAll(); 
        $req->closeCursor();

        
        sendJSON($datas);
    } catch (PDOException $e) {
        // Gérer les erreurs de la base de données
        http_response_code(500); // Code HTTP d'erreur interne
        sendJSON(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
    }
}

function getMyOrders()
{
    // Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
    if (!isset($_SESSION['user']['id'])) {
        header("Location: index.php?action=loginPage");
        exit();
    }

    try {
        $pdo = getConnexion();
        $req = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESc");
        
        // Assurez-vous de transmettre un tableau pour le paramètre
        $req->execute([$_SESSION['user']['id']]);
        $datas = $req->fetchAll(); 
        $req->closeCursor();

        
        sendJSON($datas);
    } catch (PDOException $e) {
        // Gérer les erreurs de la base de données
        http_response_code(500); // Code HTTP d'erreur interne
        sendJSON(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
    }
}

function getMyNextOrders()
{
    // Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
    if (!isset($_SESSION['user']['id'])) {
        header("Location: index.php?action=loginPage");
        exit();
    }

    try {
        $pdo = getConnexion();
        $req = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? AND status = 'A Livrer' ORDER BY id DESC");
        
        // Assurez-vous de transmettre un tableau pour le paramètre
        $req->execute([$_SESSION['user']['id']]);
        $datas = $req->fetchAll(); 
        $req->closeCursor();

        
        sendJSON($datas);
    } catch (PDOException $e) {
        // Gérer les erreurs de la base de données
        http_response_code(500); // Code HTTP d'erreur interne
        sendJSON(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
    }
}

function getSalads()
{
    // Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
    if (!isset($_SESSION['user']['id'])) {
        header("Location: index.php?action=loginPage");
        exit();
    }

    try {
        $pdo = getConnexion();
        $req = $pdo->prepare("SELECT * FROM salads");
        $req->execute();
        $datas = $req->fetchAll(); 
        $req->closeCursor();
        sendJSON($datas);
    } 
    catch (PDOException $e) {
        http_response_code(500); 
        sendJSON(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
    }
}

function getMyCashback()
{
    // Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
    if (!isset($_SESSION['user']['user_id'])) {
        header("Location: index.php?action=loginPage");
        exit();
    }

    try {
        $pdo = getConnexion();
        $req = $pdo->prepare("SELECT * 
        FROM cashback
        WHERE sponsor_id = ?");
    
        // Assurez-vous de transmettre un tableau pour le paramètre
        $req->execute([$_SESSION['user']['user_id']]);
        $datas = $req->fetchAll(); 
        $req->closeCursor();

        
        sendJSON($datas);
    } catch (PDOException $e) {
        // Gérer les erreurs de la base de données
        http_response_code(500); // Code HTTP d'erreur interne
        sendJSON(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
    }
}

function getMyAffiliated()
{
    // Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
    if (!isset($_SESSION['user']['id'])) {
        header("Location: ../index.php?action=loginPage");
        exit();
    }

    try {
        $pdo = getConnexion();
        $req = $pdo->prepare("SELECT * 
        FROM sponsorships 
        INNER JOIN users 
        ON sponsorships.sponsored_id = users.id 
        WHERE sponsorships.sponsor_id = ?");
    
        // Assurez-vous de transmettre un tableau pour le paramètre
        $req->execute([$_SESSION['user']['id']]);
        $datas = $req->fetchAll(); 
        $req->closeCursor();

        
        sendJSON($datas);
    } catch (PDOException $e) {
        // Gérer les erreurs de la base de données
        http_response_code(500); // Code HTTP d'erreur interne
        sendJSON(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
    }
}

function getOffer(){
    $id = verifyInput($_GET['id']);
   
    try {
        $pdo = getConnexion();
        $req = $pdo->prepare("SELECT * FROM offers WHERE id = ?");
        $req->execute([$id]);
        $datas = $req->fetchAll();
        $req->closeCursor();

        sendJSON($datas);
    } catch (PDOException $e) {
        http_response_code(500); 
        sendJSON(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
    }
}

function login() {

    try {
        // Connexion à la base de données
        $pdo = getConnexion();

        // Récupération et sécurisation des entrées
        $email = verifyInput($_POST['email']); // Correspond au champ 'email' envoyé
        $password = verifyInput($_POST['password']); // Correspond au champ 'password' envoyé

        // Recherche de l'utilisateur par email
        $req = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $req->execute([$email]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérification du mot de passe
            if (password_verify($password, $user['password'])) {
                $role = $user['role'];
                
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'role' => $user['role'],
                    'sponsor_id' => $user['sponsor_id']
                ];

               sendJSON($user);
            } else {
                // Mot de passe incorrect
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Identifiants incorrects'
                ]);
                exit();
            }
        } else {
            // Utilisateur non trouvé
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Identifiants incorrects'
            ]);
            exit();
        }
    } catch (Exception $e) {
        // Gestion des exceptions
        echo json_encode([
            'status' => 'error',
            'message' => 'Une erreur est survenue : ' . $e->getMessage()
        ]);
        exit();
    }
}

function register()
    {
        // Establish database connection
        $pdo = getConnexion();

        // Check if all required fields are filled
    // List of required fields
    $requiredFields = ['email', 'first_name', 'last_name', 'password', 'password2', 'address', 'phone'];

    // Check if any required field is empty or if terms (cgu) are not accepted
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            showErrorAndGoBack();
                }
        }

        if (!isset($_POST['cgu'])) {
            showErrorAndGoBack();
        }

        // Function to display an error message and go back to the previous page
        function showErrorAndGoBack() {
            echo "<script>
                alert('Tous les champs doivent être remplis, et les conditions générales doivent être acceptées !');
                window.history.back();
            </script>";
            exit();
        }


    // Retrieve and sanitize input
    $email = verifyInput($_POST['email']);
    $first_name = verifyInput($_POST['first_name']);
    $last_name = verifyInput($_POST['last_name']);
    $password = verifyInput($_POST['password']);
    $password2 = verifyInput($_POST['password2']);
    $address = verifyInput($_POST['address']);
    $phone = verifyInput($_POST['phone']);
    $sponsor_id = verifyInput($_POST['sponsor_id']);

    // Check if passwords match
    if ($password !== $password2) {
        echo "<script>
            alert('Les mots de passe ne correspondent pas !');
            window.history.back();
        </script>";
        exit();
    }

    // Check if the email is already registered
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo "<script>
            alert('Cet email est déjà enregistré !');
            window.history.back();
        </script>";
        exit();
    }

    //check if ref exists
    if (isset($ref)){
        $ref = verifyInput($_POST['ref']);
        $sponsor_id =  verifyInput($_POST['sponsor_id']);
    }


    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user into the database
   $insert = $pdo->prepare("INSERT INTO users (email, first_name, last_name, password, address, phone, subscription_status, wallet, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($insert->execute([$email, $first_name, $last_name, $hashedPassword, $address, $phone, 'Inactive', 0, 'user'])) {

        $user_id = $pdo->lastInsertId();

        if (isset($sponsor_id)) {
            // Update the user's sponsor_id in the users table
            $req = $pdo->prepare('UPDATE users SET sponsor_id = ? WHERE id = ?');
            $req->execute([$sponsor_id, $user_id]);
        
            // Insert the sponsorship relationship into the sponsorships table
            $req = $pdo->prepare('INSERT INTO sponsorships (sponsor_id, sponsored_id) VALUES (?, ?)');
            $req->execute([$sponsor_id, $user_id]);
        }


        echo "<script>
            alert('Inscription réussie ! Veuillez vous connecter.');
            window.location.href = '../index.php?action=loginPage';
        </script>";
    } else {
        echo "<script>
            alert('Une erreur s\'est produite lors de l\'inscription. Veuillez réessayer.');
            window.history.back();
        </script>";
    }

   
  

}

function payWithMobile()
{
    try {
        $pdo = getConnexion();

        $user_id = $_SESSION['user']['id'];
        $offer_id = verifyInput($_POST['offer_id']);
        $offer_name = verifyInput($_POST['offer_name']);
        $offer_price = verifyInput($_POST['offer_price']);
        $user_first_name = $_SESSION['user']['first_name'];
        $user_last_name = $_SESSION['user']['last_name'];
        $sponsor_id = $_SESSION['user']['sponsor_id'] ?? null; 
        $date_of_expiration = date('Y-m-d', strtotime('+30 days'));

        // Insert into subscriptions table
        $req = $pdo->prepare(   
            'INSERT INTO subscriptions (user_id, user_first_name, user_last_name, offer_id, offer_name, 
            offer_price, date_of_expiration, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $req->execute([ 
            $user_id, $user_first_name, $user_last_name, $offer_id, $offer_name, 
            $offer_price, $date_of_expiration, 'Active'
        ]);

        $subscription_id = $pdo->lastInsertId(); // Get the last inserted subscription ID

         // Update user's subscription status
         $req = $pdo->prepare(
            'UPDATE users SET subscription_status = ?, subscription_id = ?, offer_id = ? WHERE id = ?'
        );
        $req->execute(['Active', $subscription_id, $offer_id, $user_id]);

        // If user was sponsored, insert into cashback table and update sponsor wallet
        if (!empty($sponsor_id)) {
            // Insert into cashback table
            $req = $pdo->prepare(
                'INSERT INTO cashback (sponsor_id, sponsored_id, sponsored_first_name, sponsored_last_name, 
                subscription_id, offer_id, amount) VALUES (?, ?, ?, ?, ?, ?, ?)'
            );
        /*    $req->execute([
                $sponsor_id, $user_id, $user_first_name, $user_last_name, 
                $subscription_id, $offer_id, $amount
            ]);
            */

            // Update sponsor wallet
            $req = $pdo->prepare('SELECT wallet FROM users WHERE id = ?');
            $req->execute([$sponsor_id]);
            $old_wallet = $req->fetchColumn();

            $new_wallet = $old_wallet + $amount;
            $req = $pdo->prepare('UPDATE users SET wallet = ? WHERE id = ?');
         //   $req->execute([$new_wallet, $sponsor_id]);
        }

       

        // Return a success message
        echo json_encode([
            'status' => 'success',
            'message' => 'Abonnement effectif'
        ]);
    } catch (Exception $e) {
        // Log the error in the PHP error log (visible in the console)
        error_log('An error occurred: ' . $e->getMessage());

        // Return an error message with detailed explanation
        return [
            'status' => 'error',
            'message' => 'Une erreur est survenue lors du traitement de l\'abonnement : ' . $e->getMessage(),
            'details' => 'Veillez à vérifier les informations saisies et réessayer. Si le problème persiste, contactez le support technique.'
        ];
    }
}

function updateAccount() {
    try {
        $pdo = getConnexion();

        // Récupération et sécurisation des entrées
        $password1 = isset($_POST['password1']) ? verifyInput($_POST['password1']) : null;
        $password2 = isset($_POST['password2']) ? verifyInput($_POST['password2']) : null;
        $address = verifyInput($_POST['address']);
        $phone = verifyInput($_POST['phone']);

        $old_phone = $_SESSION['user']['phone'];
        $old_address = $_SESSION['user']['address'];
        $user_id = $_SESSION['user']['id'];

        // Mise à jour du mot de passe
        if (!empty($password1) && !empty($password2)) {
            if ($password1 !== $password2) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Les mots de passe ne correspondent pas'
                ]);
                exit();
            } else {
                $hashedPassword = password_hash($password1, PASSWORD_BCRYPT);
                $req = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
                $req->execute([$hashedPassword, $user_id]);
            }
        }

        // Mise à jour du téléphone
        if ($phone !== $old_phone) {
            $req = $pdo->prepare('UPDATE users SET phone = ? WHERE id = ?');
            $req->execute([$phone, $user_id]);
        }

        // Mise à jour de l'adresse
        if ($address !== $old_address) {
            $req = $pdo->prepare('UPDATE users SET address = ? WHERE id = ?');
            $req->execute([$address, $user_id]);
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Les changements ont bien été enregistrés !'
        ]);

    } catch (Exception $e) {
        // Gestion des exceptions
        echo json_encode([
            'status' => 'error',
            'message' => 'Une erreur est survenue : ' . $e->getMessage()
        ]);
        exit();
    }
}




function contact()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'contact') {
            // Sanitize input to prevent XSS and other security issues
            $fullname = htmlspecialchars(trim($_POST['fullname']));
            $email = htmlspecialchars(trim($_POST['email']));
            $subject = htmlspecialchars(trim($_POST['subject']));
            $message = htmlspecialchars(trim($_POST['message']));

            // Validate required fields
            if (empty($fullname) || empty($email) || empty($subject) || empty($message)) {
                echo 'Tous les champs avec une * sont obligatoires.';
                return;
            }

            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo 'Veuillez entrer une adresse email valide.';
                return;
            }

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                      // Send using SMTP
                $mail->Host = 'smtp.example.com';                     // Set the SMTP server to send through
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'your_smtp_username';               // SMTP username
                $mail->Password = 'your_smtp_password';               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom($email, $fullname);                    // Sender's email and name
                $mail->addAddress('adekambirachad@gmail.com');             // Add the recipient

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Contact Form - ' . $subject;
                $mail->Body    = "
                <h3>Vous avez reçu un nouveau message via le formulaire de contact.</h3>
                <p><strong>Nom:</strong> $fullname</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Objet:</strong> $subject</p>
                <p><strong>Message:</strong><br>$message</p>
            ";
                $mail->AltBody = "
                Vous avez reçu un nouveau message via le formulaire de contact.\n
                Nom: $fullname\n
                Email: $email\n
                Objet: $subject\n
                Message:\n$message
            ";

                // Send the email
                if ($mail->send()) {
            ?>
    <script>
        alert("Votre message a bien été envoyé.");
        //  window.history.back();
    </script>
    <?php
            } else {
            ?>
        <script>
            alert("Erreur lors de l\'envoi du message. Merci de réessayer plus tard.");
            // window.history.back();
        </script>
        <?php
            }
        } catch (Exception $e) {
            ?>
    <script>
        alert("Erreur lors de l\'envoi du message. Veuillez réessayer plus tard.");
        // window.history.back();
    </script>
    <?php
            }
        }
}

function logout()
{
    unset($_SESSION['user']);

    header('Location: ../index.php');
}


function sendJSON($infos)
{
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    echo json_encode($infos, JSON_UNESCAPED_UNICODE);
}

function verifyInput($inputContent)
{
    $inputContent = htmlspecialchars($inputContent);
    $inputContent = trim($inputContent);
    return $inputContent;
}