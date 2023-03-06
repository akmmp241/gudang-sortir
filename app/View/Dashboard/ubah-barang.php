<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form action="/dashboard/barang/ubah-barang/<?= $model['id_barang'] ?? '' ?>" method="post">
        <input type="text" name="id-barang" value="<?= $model['id_barang'] ?? '' ?>" readonly autocomplete="off">
        <br>
        <input type="text" name="nama-barang" value="<?= $model['nama_barang'] ?? '' ?>" autocomplete="off" placeholder="nama barang">
        <br>
        <input type="text" name="deskripsi" value="<?= $model['deskripsi'] ?? '' ?>" autocomplete="off" placeholder="deskripsi (optional)">
        <br>
        <input type="submit" name="submit">
    </form>
</div>