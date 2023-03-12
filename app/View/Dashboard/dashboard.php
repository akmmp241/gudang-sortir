<h1>ini halaman dashboard</h1>
<h1>halo <?= $model['user']['name'] ?? '' ?></h1>
<table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <td colspan="3" align="center">DAFTAR KATEGORI</td>
    </tr>
    <?php if ($model['kategori'] == null) { ?>
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

<br><br><br>
<table border="1" cellspacing="0" cellpadding="10" >
    <tr>
        <td colspan="5" align="center">DAFTAR BARANG</td>
    </tr>
    <?php if ($model['barang'] == null)  { ?>
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
        </tr>
        <?php foreach ($model['barang'] as $item) { ?>

            <tr>
                <td><?= $item['id_barang'] ?></td>
                <td><?= $item['nama_barang'] ?></td>
                <td><?= $item['kuantitas'] ?></td>
                <td><?= $item['deskripsi']?></td>
                <td><?= $item['id_kategori']?></td>
            </tr>
        <?php } ?>
    <?php } ?>
</table>

<a href="/dashboard/transaksi">Transaksi</a>
<br>
<a href="/dashboard/kategori">tambah kategori</a>
<br>
<a href="/dashboard/barang">tambah barang</a>
<br>
<a href="/users/profile">Profile</a>
<br>
<a href="/users/logout">logout</a>