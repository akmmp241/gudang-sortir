<div class="container">
    <h1>Data transaksi</h1>
    <br>
    <a href="/dashboard">Kembali ke dashboard</a>
    <br><br>
    <select name="field" id="field-select">
        <option value="t.id" <?php if(!isset($_GET['field']) || $_GET['field']=='t.id'){echo "selected";} ?> >Id Transaksi</option>
        <option value="t.tanggal_transaksi" <?php if(isset($_GET['field']) && $_GET['field']=='t.tanggal_transaksi'){echo "selected";} ?>>Tanggal</option>
    </select>
    <select name="order" id="order-select">
        <option value="ASC" <?php if(!isset($_GET['order']) || $_GET['order']=='ASC'){echo "selected";} ?> >ASC</option>
        <option value="DESC" <?php if(isset($_GET['order']) && $_GET['order']=='DESC'){echo "selected";} ?> >DESC</option>
    </select>
    <br><br><br>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID transaksi</th>
            <th>Jenis transaksi</th>
            <th>Tanggal transaksi</th>
            <th>Jumlah masuk</th>
            <th>ID barang</th>
            <th>Nama barang</th>
            <th>deskripsi</th>
        </tr>
        <?php if (!isset($model['data_transaksi'])) { ?>
            <tr>
                <td colspan="7" align="center">data belum ada</td>
            </tr>
        <?php } else { ?>
            <?php foreach ($model['data_transaksi'] as $item) { ?>
                <tr>
                    <td><?= $item['id_transaksi'] ?></td>
                    <td><?= $item['jenis_transaksi'] ?></td>
                    <td><?= $item['tanggal_transaksi'] ?></td>
                    <td><?= $item['barang_masuk'] ?></td>
                    <td><?= $item['id_barang'] ?></td>
                    <td><?= $item['nama_barang'] ?></td>
                    <td><?= $item['deskripsi'] ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
    <br>
    <a href="/dashboard/transaksi/barang-masuk">barang masuk</a>
    <br>
    <a href="/dashboard/transaksi/barang-keluar">barang keluar</a>
</div>
<script src="/ass"></script>