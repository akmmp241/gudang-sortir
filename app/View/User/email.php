<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form action="/users/profile/update-email" method="post">
        <?php if (isset($_POST['email'])) { ?>
            <input type="email" name="email" value="<?= $_POST['email'] ?? '' ?>" autocomplete="off">
        <?php } else { ?>
            <input type="email" name="email" value="<?= $model['email'] ?? '' ?>" autocomplete="off">
        <?php } ?>
        <br>
        <input type="submit" name="submit">
    </form>
</div>