{{--<head>--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<form action="/dashboard/item/update-item/{{ $item->item_id }}" method="POST">--}}
{{--    @csrf--}}
{{--    @error('error')--}}
{{--    <p class="error">{{ $message }}</p>--}}
{{--    @enderror--}}
{{--    <input type="text" name="item_id" id="id-barang" value="{{ $item->item_id }}" autocomplete="off"--}}
{{--           readonly>--}}
{{--    <br>--}}
{{--    <input type="text" name="name_item" id="nama-barang"--}}
{{--           value="{{ $item->name_item  }}" autocomplete="off"--}}
{{--           placeholder="nama barang">--}}
{{--    <br>--}}
{{--<input type="text" name="description" id="deskripsi" value="{{ $item->description }}"--}}
{{--       autocomplete="off" placeholder="deskripsi (optional)">--}}
{{--    <br>--}}
{{--    <input type="submit" name="submit">--}}
{{--</form>--}}
{{--</body>--}}

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
    <title>Edit Barang</title>
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
            <h1>Edit daftar barang</h1>
            <p>Silahkan isi form dibawah untuk mengedit daftar barang anda.</p>
            <form action="/dashboard/item/update-item/{{ $item->item_id }}" method="POST" class="pure-form">
                @csrf
                @error('error')
                    <p class="error">{{ $message }}</p>
                @enderror
                <fieldset>
                    <div class="first">
                        <label for="">ID Barang</label>
                        <input type="text" placeholder="id" name="item_id" value="{{ $item->item_id }}" readonly>
                    </div>
                    <div class="first">
                        <label for="">Nama Barang</label>
                        <input type="text" placeholder="Nama Barang" name="name_item" id="nama-barang"
                               value="{{ $item->name_item  }}" autocomplete="off">
                    </div>
                    <div class="first-to">
                        <div class="second">
                            <label for="">Kategori Barang</label>
                            <input type="text" placeholder="Kategori Barang" value="{{ $item->category->category_id }}" readonly>
                        </div>
                        <div class="second">
                            <label for="">Deskripsi</label>
                            <input type="text" placeholder="(opsional)" name="description" id="deskripsi"
                                   value="{{ $item->description }}" autocomplete="off">
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
