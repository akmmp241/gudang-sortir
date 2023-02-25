<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form action="/users/register" method="post">
        <label for="email"></label><input type="text" name="email" id="email" autocomplete="off" placeholder="masukan email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        <br>
        <label for="nama"></label><input type="text" name="nama" id="nama" autocomplete="off" placeholder="masukan nama lengkap" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
        <br>
        <label for="password"></label><input type="password" name="password" id="password" autocomplete="off" placeholder="masukan password" value="<?= htmlspecialchars($_POST['password'] ?? '') ?>">
        <br>
        <label for="konfirmasi-password"></label><input type="password" name="konfirmasi-password" id="konfirmasi-password" autocomplete="off" placeholder="konfirmasi password" value="<?= htmlspecialchars($_POST['konfirmasi-password'] ?? '') ?>">
        <br>
        <input type="submit" name="submit">
    </form>
    <p>Sudah punya akun? <a href="/users/login">Login</a></p>
</div>