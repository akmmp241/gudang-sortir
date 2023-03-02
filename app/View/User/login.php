<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form method="post" action="/users/login">
        <label for="email"></label><input type="email" name="email" id="email" autocomplete="off" placeholder="masukan email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        <label for="password"></label><input type="password" name="password" id="password" autocomplete="off" placeholder="masukan password" value="<?= htmlspecialchars($_POST['password'] ?? '') ?>">
        <input type="submit" name="submit" id="submit">
    </form>
    <p>Belum punya akun? <a href="/users/register">Register</a></p>
</div>