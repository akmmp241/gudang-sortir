<div class="container">
    <form action="/users/profile/update-nama" method="post">
        <input type="text" name="nama" value="<?= $model['nama'] ?? '' ?>" autocomplete="off">
        <br>
        <input type="submit" name="submit">
    </form>
</div>