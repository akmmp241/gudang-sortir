{{--<head>--}}
{{--    <title>joko</title>--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/error.css')}}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<h1>this is dashboard</h1>--}}

{{--<h1>selamat datang, {{ $user->name }}</h1>--}}

{{--@if(session('message'))--}}
{{--    <p>{{ session('message') }}</p>--}}
{{--@endif--}}

{{--<a href="/dashboard/category">category</a>--}}
{{--<br>--}}
{{--<a href="/dashboard/item">item</a>--}}
{{--<br>--}}
{{--<a href="/dashboard/transaction">transaction</a>--}}
{{--<br>--}}
{{--<a href="/users/profile">profile</a>--}}
{{--<br>--}}
{{--<a href="/users/logout">logout</a>--}}
{{--</body>--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-circle/css/circle.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <title>Dashboard</title>
</head>
<body>

<section>
    <header class="header">
        <nav class="nav">
            <div>
                <a href="#"><img class="logo" src="{{ asset('assets/img/LOGO.svg') }}" alt="logo"></a>
                <h3 class="profile"><a href="/users/profile">{{ $user->name }}</a></h3>
            </div>
        </nav>
        <div class="header-content">
            <div>
                <h2>Selamat datang, {{ $user->name }}</h2>
                <p>Kelola barang menjadi lebih mudah dan efektif dengan <strong>gudang sortir</strong></p>
            </div>
        </div>
    </header>
</section>

<section>
    <div class="button">
        <a href="/dashboard/category">
            <div>
                <img src="{{ asset('assets/img/kategori.png') }}" alt="kategori">
                <p>Tambah kategori</p>
            </div>
        </a>
        <a href="/dashboard/item">
            <div>
                <img src="{{ asset('assets/img/barang.png') }}" alt="barang">
                <p>Tambah barang</p>
            </div>
        </a>
        <a href="/dashboard/transaction">
            <div>
                <img src="{{ asset('assets/img/transaksi.png') }}" alt="Transakis">
                <p>Transaksi</p>
            </div>
        </a>
    </div>
</section>

<section>
    <div class="static-card">
        <div class="card-jumlah">
            <div class="wrap-title">
                <p class="title">Jumlah Barang Masuk-Keluar</p>
            </div>
            <div class="wrap">
                <div class="growth c100
                @if($item['in'] == 0 && $item['out'] == 0)
                    {{ 'kosong' }}
                @elseif($item['in'] == 0 && $item['out'] != 0)
                    {{ 'p100' }}
                @elseif($item['in'] != 0 && $item['out'] == 0)
                    {{ 'p0' }}
                @else
                    {{ 'p' . (int) ceil(($item['in'] / ($item['in'] + $item['out'])) * 100) }}
                @endif
                center">
                    <span>
                        <img src="{{ asset('assets/img/item.png') }}" alt="item">
                    </span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
                <div class="wrap-content">
                    <div class="content bm">
                        <div class="kotak"></div>
                        <p>Barang Masuk: {{ $item['in'] }}</p>
                    </div>
                    <div class="content bk">
                        <div class="kotak"></div>
                        <p>Barang Keluar: {{ $item['out'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-jumlah">
            <div class="wrap-title">
                <p class="title">Barang Masuk-Keluar Terakhir</p>
            </div>
            <div class="wrap">
                <div class="growth c100 p100 center">
                    <span>
                        <img src="{{ asset("assets/img/time.png") }}" alt="item">
                    </span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
                <div class="wrap-content">
                    <div class="content bm">
                        <p>Barang Masuk: {{ $last['in']->name_item ?? $last['in'] }}</p>
                    </div>
                    <div class="content bk">
                        <p>Barang Keluar: {{ $last['out']->name_item ?? $last['out'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
