<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form method="post" action="/users/login">
        <input type="text" name="email" id="email" placeholder="masukan email" value="<?= $_POST['email'] ?? '' ?>">
        <input type="password" name="password" id="password" placeholder="masukan password" value="<?= $_POST['password'] ?? '' ?>">
        <input type="submit" name="submit" id="submit">
    </form>
</div>