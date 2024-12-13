<div class="bg-light mt-5">
    <h2>
        Please check the errors
    </h2>
    <ul>
        <?php foreach ($errors as $error): ?>
        <li style="color: red"><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
</div>