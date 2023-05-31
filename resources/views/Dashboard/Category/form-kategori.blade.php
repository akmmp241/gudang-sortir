<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/form-kategori.css') }}">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
          integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <title>Tambah Kategori</title>
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
    </header>
</section>

<section>
    <div class="wrap">
        <div class="form">
            <h1>Tambah kategori barang</h1>
            <p>Silahkan isi form dibawah untuk manmbahkan kategori barang yang akan anda sortir</p>
            <form action="/dashboard/category/add" method="POST" class="pure-form">
                @csrf
                @error('error')
                    <p class="error">{{ $message }}</p>
                @enderror
                <fieldset>
                    <div>
                        <label for="">ID Kategori</label>
                        <input type="text" placeholder="ID Kategori" name="category_id" id="categoryId"
                               value="{{ request('category_id', '') }}" autocomplete="off">
                    </div>
                    <div>
                        <label for="">Nama Kategori</label>
                        <input type="text" placeholder="Nama Kategori" name="name_category" id="nameCategory"
                               value="{{ request('name_category', '') }}" autocomplete="off">
                    </div>
                    <div>
                        <label for="">Deskripsi</label>
                        <input type="text" placeholder="Deskripsi (optional)" name="description" id="description"
                               value="{{ request('description', '') }}" autocomplete="off">
                    </div>
                    <div class="batal">
                        <a href="/dashboard/category">batal</a>
                        <button type="submit" name="submit" id="submit">Tambah</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="image">
            <div class="picture">
                <img src="{{ asset('assets/img/Oreti.png') }}" alt="">
            </div>
        </div>
    </div>
</section>

</body>
</html>
