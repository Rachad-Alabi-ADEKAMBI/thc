<!DOCTYPE html>
<html>

<head>
    <?php include 'meta.php'; ?>
    
    <title><?= $title ?></title>
</head>


<body>
    <div class="app">
    <?php include 'header.php'; ?><br>

        <div class="main" id='main'>
            <?= $content ?>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</body>

</html>