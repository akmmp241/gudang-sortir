<div class="container">
    <form action="/dashboard/kategori" method="post">
        <input type="text" name="id-kategori" id="id-kategori" autocomplete="off" placeholder="id kategori">
        <input type="text" name="nama-kategori" id="nama-kategori" autocomplete="off" placeholder="nama kategori">
        <br>
        <input type="text" name="deskripsi" id="deskripsi" autocomplete="off" placeholder="deskripsi (optional)">
        <br>
        <input type="submit" name="submit" id="submit">
    </form>
    <br><br><br>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td colspan="3">DAFTAR KATEGORI</td>
        </tr>
        <?php if (!isset($model['data']))  { ?>
            <tr>
                <td>data belum ada</td>
            </tr>
        <?php } ?>
    </table>
</div>