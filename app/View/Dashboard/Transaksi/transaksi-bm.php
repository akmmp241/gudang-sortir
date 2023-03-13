<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form action="/dashboard/transaksi/barang-masuk" method="post">
        <input type="text" name="id-transaksi" value="<?= $model['id_transaksi'] ?>" readonly>
        <br>
        <input type="datetime-local" name="tanggal" value="<?= $model['tanggal'] ?? '' ?>">
        <br>
        <select name="id-barang" id="id-barang">
            <?php if (isset($model['barang'])) { ?>
                <?php foreach ($model['barang'] as $item) { ?>
                    <option value="<?= $item['id_barang'] ?>"><?= $item['id_barang'] . " | " . $item['nama_barang'] ?></option>
                <?php } ?>
            <?php } else { ?>
                <option value="">kosong</option>
            <?php } ?>
        </select>
        <br>
        <input type="number" name="masuk" autocomplete="off" value="<?= $_POST['masuk'] ?? '0' ?>">
        <br>
        <input type="text" name="deskripsi" value="<?= htmlspecialchars($_POST['deskripsi'] ?? '') ?>" autocomplete="off" placeholder="deskripsi (optional)">
        <br>
        <input type="submit" name="submit" id="submit">
    </form>
</div>