<h1>ini halaman dashboard</h1>
<h1>halo <?= $model['user']['name'] ?? '' ?></h1>
<table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <td colspan="3">DAFTAR KATEGORI</td>
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
        </tr>
        <?php foreach ($model['kategori'] as $item) { ?>

            <tr>
                <td><?= $item['id_kategori'] ?></td>
                <td><?= $item['nama_kategori'] ?></td>
                <td><?= $item['deskripsi']?></td>
            </tr>
        <?php } ?>
    <?php } ?>
</table>
<br>
<a href="/dashboard/kategori">tambah kategori</a>
<br>
<a href="/users/logout">logout</a>