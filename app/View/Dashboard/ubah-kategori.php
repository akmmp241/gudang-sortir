<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form action="/dashboard/kategori/ubah-kategori/<?= $model['id_kategori'] ?? '' ?>" method="post">
        <input type="text" name="id-kategori" readonly id="id-kategori" value="<?= $model['id_kategori'] ?? '' ?>" autocomplete="off" placeholder="id kategori">
        <br>
        <input type="text" name="nama-kategori" id="nama-kategori" value="<?= $model['nama_kategori'] ?? '' ?>" autocomplete="off" placeholder="nama kategori">
        <br>
        <input type="text" name="deskripsi" id="deskripsi" value="<?= $model['deskripsi'] ?? '' ?>" autocomplete="off" placeholder="deskripsi (optional)">
        <br>
        <input type="submit" name="submit" id="submit">
    </form>
</div>