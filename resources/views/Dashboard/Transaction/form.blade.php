{{--<head>--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<h1>Barang {{ $type }}</h1>--}}
{{--<br><br>--}}
{{--@error('error')--}}
{{--<p class="error">{{ $message }}</p>--}}
{{--@enderror--}}
{{--<form action="/dashboard/transaction/{{ $type }}" method="POST">--}}
{{--    @csrf--}}
{{--    <input type="text" name="transactionId" value="{{ $transactionId }}" readonly>--}}
{{--    <br>--}}
{{--    <input type="datetime-local" name="date" value="{{ $date }}">--}}
{{--    <br>--}}
{{--    <select name="itemId" id="itemId">--}}
{{--        @if($items->all() != null)--}}
{{--            @foreach($items->all() as $item)--}}
{{--                <option value="{{ $item->item_id }}">{{ $item->item_id }} | {{ $item->name_item }}</option>--}}
{{--            @endforeach--}}
{{--        @else--}}
{{--            <option value="null">kosong</option>--}}
{{--        @endif--}}
{{--    </select>--}}
{{--    <br>--}}
{{--    <input type="number" name="quantity" autocomplete="off" value="{{ old('quantity', 0) }}">--}}
{{--    <br>--}}
{{--    <input type="text" name="description" value="{{ old('description', '') }}" autocomplete="off" placeholder="deskripsi (optional)">--}}
{{--    <br>--}}
{{--    <input type="submit" name="submit" id="submit">--}}
{{--</form>--}}
{{--</body>--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/form-transaksi.css') }}">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
          integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <title>Transaksi</title>
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
            <h1>Barang {{ $type }}</h1>
            <p>Silahkan isi form dibawah untuk melakukan transaksi barang.</p>
            <form action="/dashboard/transaction/{{ $type }}" method="POST" class="pure-form">
                @csrf
                @error('error')
                <p class="error">{{ $message }}</p>
                @enderror
                <fieldset>
                    <div class="first">
                        <label for="">ID Transaksi</label>
                        <input type="text" name="transactionId" value="{{ $transactionId }}" readonly>
                    </div>
                    <div class="first first-second">
                        <div class="second">
                            <label for="">Tanggal</label>
                            <input type="datetime-local" name="date" value="{{ $date }}">
                        </div>
                        <div class="second">
                            <label for="">Barang</label>
                            <select name="itemId" id="itemId">
                                @if($items->all() != null)
                                    @foreach($items->all() as $item)
                                        <option value="{{ $item->item_id }}">{{ $item->item_id }} | {{ $item->name_item }}</option>
                                    @endforeach
                                @else
                                    <option value="null">kosong</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="first first-second">
                        <div class="second">
                            <label for="">Jumlah</label>
                            <input type="number" min="1" name="quantity" autocomplete="off" value="{{ old('quantity', 0) }}">
                        </div>
                        <div class="second">
                            <label for="">Deskripsi</label>
                            <input type="text" placeholder="(opsional)" name="description" value="{{ old('description', '') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="batal">
                        <a href="/dashboard/transaction">Batal</a>
                        <button type="submit" name="submit">Tambah</button>
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
