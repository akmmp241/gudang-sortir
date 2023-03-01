<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form action="/users/profile/update-email" method="post">
        <input type="email" name="email" value="<?= $model['email'] ?? '' ?>" autocomplete="off">
        <br>
        <input type="submit" name="submit">
    </form>
</div>