<div class="container">
    <?php if (isset($model['error'])) { ?>
        <p class="error"><?= $model['error'] ?></p>
    <?php } ?>
    <form action="/dashboard/kategori" method="post">
        <input type="text" name="id-kategori" id="id-kategori" value="<?= htmlspecialchars($_POST['id-kategori'] ?? '') ?>" autocomplete="off" placeholder="id kategori">
        <br>
        <input type="text" name="nama-kategori" id="nama-kategori" value="<?= htmlspecialchars($_POST['nama-kategori'] ?? '') ?>" autocomplete="off" placeholder="nama kategori">
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
            <td colspan="4">DAFTAR KATEGORI</td>
        </tr>
        <?php if (!isset($model['kategori']))  { ?>
            <tr>
                <td>data belum ada</td>
            </tr>
        <?php } else { ?>
            <tr>
                <td>ID Kategori</td>
                <td>Nama Kategori</td>
                <td>Deskripsi</td>
                <td>Aksi</td>
            </tr>
            <?php foreach ($model['kategori'] as $item) { ?>

                <tr>
                    <td><?= $item['id_kategori'] ?></td>
                    <td><?= $item['nama_kategori'] ?></td>
                    <td><?= $item['deskripsi']?></td>
                    <td><a href="/dashboard/kategori/hapus/<?= $item['id_kategori'] ?>" onclick="return confirm('apakah anda yakin?');">hapus</a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
</div>