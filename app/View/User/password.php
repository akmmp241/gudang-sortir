<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form action="/users/profile/update-password" method="post">
        <input type="password" name="old-password" autocomplete="off" placeholder="old password" value="<?= $_POST['old-password'] ?? '' ?>">
        <br>
        <input type="password" name="new-password" autocomplete="off" placeholder="new password" value="<?= $_POST['new-password'] ?? '' ?>">
        <br>
        <input type="submit" name="submit">
    </form>
</div>