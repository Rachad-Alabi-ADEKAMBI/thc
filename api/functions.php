<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader if using Composer
require 'vendor/autoload.php';


include 'db.php';

function subscribe()
{
    $pdo = getConnexion();
    $email = verifyInput($_POST['email']);

    try {
        $req = $pdo->prepare('INSERT INTO newsletters (email) VALUES (?)');
        $req->execute([$email]);
?>
<script>
    alert('Email ajouté avec succès');
    window.history.back();
</script>
<?php
    } catch (PDOException $e) {
    ?>
<script>
    alert('Une erreur est survenue, merci de réessayer');
    window.history.back();
</script>
<?php
    }
}


function newSurvey()
{
    // Assuming `getConnexion()` returns a PDO instance connected to your database
    $pdo = getConnexion();

    // Sanitize and retrieve input values
    $last_name = verifyInput($_POST['last_name']);
    $first_name = verifyInput($_POST['first_name']);
    $phone = verifyInput($_POST['phone']);
    $birth_date = verifyInput($_POST['birth_date']);
    $sex = verifyInput($_POST['sex']);
    $category = verifyInput($_POST['category']);
    $status = verifyInput($_POST['status']);
    $area = verifyInput($_POST['area']);
    $household_size = verifyInput($_POST['household_size']);
    $vegetables_in_diet = verifyInput($_POST['vegetables_in_diet']);
    $vegetable_list = verifyInput($_POST['vegetable_list']);
    $land_space = verifyInput($_POST['land_space']);
    $alternative_space = verifyInput($_POST['alternative_space']);
    $space_size = verifyInput($_POST['space_size']);
    $space_observation = verifyInput($_POST['space_observation']);
    $nutritional_importance = verifyInput($_POST['nutritional_importance']);
    $interested_in_production = verifyInput($_POST['interested_in_production']);
    $interested_in_installation = verifyInput($_POST['interested_in_installation']);
    $available_time = verifyInput($_POST['available_time']);
    $waste_management = verifyInput($_POST['waste_management']);
    $gardener_experience = verifyInput($_POST['gardener_experience']);
    $gardening_tools = verifyInput($_POST['gardening_tools']);
    $tools_list = verifyInput($_POST['tools_list']);
    $weekly_hours = verifyInput($_POST['weekly_hours']);
    $objectives = verifyInput($_POST['objectives']);
    $composting = verifyInput($_POST['composting']);
    $cooking_fuel = verifyInput($_POST['cooking_fuel']);
    $cooking_frequency = verifyInput($_POST['cooking_frequency']);
    $monthly_budget = verifyInput($_POST['monthly_budget']);
    $biogas_pack_interest = verifyInput($_POST['biogas_pack_interest']);

    try {
        // Prepare the SQL statement
        $sql = $pdo->prepare('INSERT INTO survey (
            last_name, first_name, birth_date, sex, area, phone, category, status,
            household_size, vegetables_in_diet, vegetable_list, land_space, alternative_space, space_size, space_observation, nutritional_importance,
            interested_in_production, interested_in_installation, available_time, waste_management, gardener_experience, gardening_tools, tools_list, weekly_hours,
            objectives, composting, cooking_fuel, cooking_frequency, monthly_budget, biogas_pack_interest
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?
        );');

        // Execute the statement with parameters
        $sql->execute([
            $last_name,
            $first_name,
            $birth_date,
            $sex,
            $area,
            $phone,
            $category,
            $status,
            $household_size,
            $vegetables_in_diet,
            $vegetable_list,
            $land_space,
            $alternative_space,
            $space_size,
            $space_observation,
            $nutritional_importance,
            $interested_in_production,
            $interested_in_installation,
            $available_time,
            $waste_management,
            $gardener_experience,
            $gardening_tools,
            $tools_list,
            $weekly_hours,
            $objectives,
            $composting,
            $cooking_fuel,
            $cooking_frequency,
            $monthly_budget,
            $biogas_pack_interest
        ]);

        echo '<script>
            alert("Formulaire enregistré avec succès !");
            window.history.back();
        </script>';
    } catch (PDOException $e) {
        echo '<script>
            alert("Une erreur est survenue: ' . addslashes($e->getMessage()) . '");
            window.history.back();
        </script>';
    }
}

function surveys()
{
    $pdo = getConnexion();
    $req = $pdo->prepare("SELECT * FROM survey ORDER BY id DESC");
    $req->execute();
    $datas = $req->fetchAll();
    $req->closeCursor();

    sendJSON($datas);
}

function newsletters()
{
    $pdo = getConnexion();
    $req = $pdo->prepare("SELECT * FROM newsletters ORDER BY id DESC");
    $req->execute();
    $datas = $req->fetchAll();
    $req->closeCursor();

    sendJSON($datas);
}

function login()
{
    // Establish database connection
    $pdo = getConnexion();

    // Retrieve and sanitize the input
    $email = verifyInput($_POST['email']);
    $password = verifyInput($_POST['password']);

    $req = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $req->execute(array($email));
    $user = $req->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify the password using bcrypt
        if (password_verify($password, $user['password'])) {
            session_start();
            // start a session called user
            $_SESSION['user'] = [
                'user_id' => $user['id']
            ];
            header("Location: ../index.php?action=dashboard_adminPage");
            exit();
        } else {
            $_SESSION['login']['email'] = $email;

        ?>
<script>
    alert('Identifiants incorrects !');
    window.history.back();
</script>
<?php
        }
    } else {
        $_SESSION['login']['email'] = $email;
        ?>
<script>
    alert('Identifiants incorrects !');
    window.history.back();
</script>
<?php
    }
}

function register()
{
  
    // Establish database connection
    $pdo = getConnexion();

    // Retrieve and sanitize input
    $email = verifyInput($_POST['email']);
    $password = verifyInput($_POST['password']);
    $confirmPassword = verifyInput($_POST['confirm_password']);


   // echo $email.' '.$password;

    // Check if passwords match
    if ($password !== $confirmPassword) {
        ?>
<script>
    alert('Les mots de passe ne correspondent pas !');
    window.history.back();
</script>
<?php
        exit();
    }

    // Check if the email is already registered
    $req = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $req->execute(array($email));
    $user = $req->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        ?>
<script>
    alert('Cet email est déjà enregistré !');
    window.history.back();
</script>
<?php
        exit();
    }

    // Hash the password using bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert the new user into the database with the default role as 'user'
    $insert = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
    $isInserted = $insert->execute(array($email, $hashedPassword, 'user'));

    if ($isInserted) {
        ?>
<script>
    alert('Inscription réussie ! Veuillez vous connecter.');
    window.location.href = '../index.php?action=loginPage';
</script>
<?php
    } else {
        ?>
<script>
    alert('Une erreur s\'est produite lors de l\'inscription. Veuillez réessayer.');
    window.history.back();
</script>
<?php
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