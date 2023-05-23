<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="{{ asset('assets/css/asdjnc.css') }}"/>
    <script src="https://kit.fontawesome.com/4417c3b731.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <title>gudangsortir</title>
</head>
<body>
<div class="banner">
    <div class="navbar">
        <img src="{{ asset('assets/img/Logo GS.png') }}" alt="" class="logo"/>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#feature">Feature</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>
            Kelola stok barang menjadi<br/>
            lebih <strong>efektif dan efisen!</strong>
        </h1>
        <p>gudangsortir hadir untuk anda yang memiliki bisnis jual beli agar mudah<br/>mengelola ketersediaan produk
            anda dan meminimalkan risiko overstock atau understock.</p>
        <div>
            <a href="/users/login?register=true">
                <button type="button">Daftar<span></span></button>
            </a>
            <a href="/users/login">
                <button type="button">Masuk<span></span></button>
            </a>
        </div>
    </div>
</div>
<section class="about" id="about">
    <div class="main">
        <img src="{{ asset('assets/img/main.jpg') }}" alt=""/>
        <div class="about-text">
            <h1>About us</h1>
            <h5>Gudangsortir</h5>
            <p>
                <strong>gudangsortir</strong> tidak hanya membantu mengelola stok persediaan saja, namun juga menjaga
                privasi dari data
                anda dengan baik, karena kami sangat menghargai privasi dan data anda, sehingga anda tidak perlu
                khawatir saat menggunakan website ini.
                Seluruh pengguna dapat mengakses platform ini dari mana saja dan kapan saja dengan menggunakan perangkat
                yang terhubung ke internet.
            </p>
            <button type="button">Hubungi Kami</button>
        </div>
    </div>
</section>

section

<section>
    <div class="footer">
        <div class="wrap-logo">
            <img src="{{ asset('assets/img/LOGO-black.png') }}" alt="" class="logo"/>
            <a href="/users/login?register=true">Daftar</a>
        </div>
        <div class="wrap">
            <ul>
                <li>Semarang, Central java, Indonesia.</li>
                <li><strong>Contact:</strong> +62 877 001 82426</li>
                <li><strong>Email:</strong> dasihayu1307@gmail,.com</li>
            </ul>
            <ul>
                <li><strong>Useful Links</strong></li>
                <li> &egsdot; Beranda</li>
                <li> &egsdot; Tentang Web Ini</li>
            </ul>
        </div>
    </div>
    <div class="copyright">
        <p> &copy; 2023 <strong>gudangsortir</strong> </p>
    </div>
</section>

</body>
</html>
