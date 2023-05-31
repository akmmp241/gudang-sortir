<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/form-barang.css') }}">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
          integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <title>Tambah Barang</title>
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
            <h1>Tambah barang</h1>
            <p>Silahkan isi form dibawah untuk menambahkan barang-barang yang akan anda sortir</p>
            <form action="/dashboard/item/add" method="post" class="pure-form">
                @csrf
                @error('error')
                    <p class="error">{{ $message }}</p>
                @enderror
                <fieldset>
                    <div class="first">
                        <label for="">ID Barang</label>
                        <input type="text" placeholder="0001" name="counter" id="id-barang" value="{{ $counter }}"
                               autocomplete="off" readonly>
                    </div>
                    <div class="first">
                        <label for="">Nama Barang</label>
                        <input type="text" placeholder="Nama Barang" name="name_item" id="nama-barang"
                               value="{{ request('name_item', '') }}" autocomplete="off">
                    </div>
                    <div class="first-to">
                        <div class="second">
                            <label for="">Kategori Barang</label>
                            <select name="category_id" id="kategori">
                                @if($categories->all() != null)
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->category_id }}</option>
                                    @endforeach
                                @else
                                    <option value="null">kosong</option>
                                @endif
                            </select>
                        </div>
                        <div class="second">
                            <label for="">Deskripsi</label>
                            <input type="text" placeholder="(opsional)">
                        </div>
                    </div>
                    <div class="batal">
                        <a href="/dashboard/item">Batal</a>
                        <button type="submit">Tambah</button>
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
