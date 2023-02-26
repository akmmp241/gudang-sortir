<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form action="/dashboard/barang" method="post">
        <input type="text" name="id-barang" id="id-barang" value="<?= $model['id'] ?? '' ?>" autocomplete="off" placeholder="id barang" readonly>
        <br>
        <input type="text" name="nama-barang" id="nama-barang" value="<?= htmlspecialchars($_POST['nama-barang'] ?? '') ?>" autocomplete="off" placeholder="nama barang">
        <br>
        <select name="id-kategori" id="id-kategori">
            <?php if (isset($model['kategori'])) { ?>
                <?php foreach ($model['kategori'] as $item) { ?>
                    <option value="<?= $item['id_kategori'] ?>"><?= $item['id_kategori'] ?></option>
                <?php } ?>
            <?php } else { ?>
                <option value="">kosong</option>
            <?php } ?>
        </select>
        <br>
        <input type="text" name="deskripsi" id="deskripsi" value="<?= htmlspecialchars($_POST['deskripsi'] ?? '') ?>" autocomplete="off" placeholder="deskripsi (optional)">
        <br>
        <input type="submit" name="submit" id="submit">
    </form>
    <br>
    <a href="/dashboard">kembali ke dashboard</a>

    <br><br><br>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td colspan="6">DAFTAR BARANG</td>
        </tr>
        <?php if (!isset($model['barang']))  { ?>
            <tr>
                <td>data belum ada</td>
            </tr>
        <?php } else { ?>
            <tr>
                <td>ID Barang</td>
                <td>Nama Barang</td>
                <td>Kuantitas</td>
                <td>Deskripsi</td>
                <td>ID Kategori</td>
                <td>Aksi</td>
            </tr>
            <?php foreach ($model['barang'] as $item) { ?>

                <tr>
                    <td><?= $item['id_barang'] ?></td>
                    <td><?= $item['nama_barang'] ?></td>
                    <td><?= $item['kuantitas'] ?></td>
                    <td><?= $item['deskripsi']?></td>
                    <td><?= $item['id_kategori']?></td>
                    <td><a href="/dashboard/barang/hapus/<?= $item['id_barang'] ?>" onclick="return confirm('apakah anda yakin?');">hapus</a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
</div>