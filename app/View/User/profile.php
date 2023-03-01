<div class="container">
    <h1>Nama: <?= $model['nama'] ?? '' ?></h1>
    <h1>Email: <?= $model['email'] ?? '' ?></h1>
    <a href="/users/profile/update-password">Ganti password</a>
    <br>
    <a href="/users/profile/update-email">Ganti email</a>
    <br>
    <a href="/users/profile/update-nama">Ganti nama</a>
    <br>
    <a href="/dashboard">kembali ke dashboard</a>
</div>