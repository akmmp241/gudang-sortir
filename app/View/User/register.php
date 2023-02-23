<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form action="/users/register" method="post">
        <label for="email"></label><input type="text" name="email" id="email" placeholder="masukan email" value="<?= $_POST['email'] ?? '' ?>">
        <br>
        <label for="nama"></label><input type="text" name="nama" id="nama" placeholder="masukan nama lengkap" value="<?= $_POST['nama'] ?? '' ?>">
        <br>
        <label for="password"></label><input type="password" name="password" id="password" placeholder="masukan password" value="<?= $_POST['password'] ?? '' ?>">
        <br>
        <label for="konfirmasi-password"></label><input type="password" name="konfirmasi-password" id="konfirmasi-password" placeholder="konfirmasi password" value="<?= $_POST['konfirmasi-password'] ?? '' ?>">
        <br>
        <input type="submit" name="submit">
    </form>
</div>