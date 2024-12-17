<?php
if (!isset($_SESSION['user'])) {
    ?>
<script>
    alert('Veuillez vous connecter d\'abord');
    window.location.replace('index.php?action=loginPage');
</script>
<?php
        // Exit to stop further execution of the script after the redirect
        exit();
    }