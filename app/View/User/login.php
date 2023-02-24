<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form method="post" action="/users/login">
        <label for="email"></label><input type="text" name="email" id="email" autocomplete="off" placeholder="masukan email" value="<?= $_POST['email'] ?? '' ?>">
        <label for="password"></label><input type="password" name="password" id="password" autocomplete="off" placeholder="masukan password" value="<?= $_POST['password'] ?? '' ?>">
        <input type="submit" name="submit" id="submit">
    </form>
</div>