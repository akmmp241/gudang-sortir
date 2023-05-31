{{--<head>--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<h1>Data Transaksi</h1>--}}

{{--<br><br>--}}

{{--@if(session('message'))--}}
{{--    <p>{{ session('message') }}</p>--}}
{{--@endif--}}

{{--<form action="/dashboard/transaction">--}}
{{--    <input type="text" name="search" id="search" placeholder="cari..." autofocus autocomplete="">--}}
{{--    <button type="submit">cari</button>--}}
{{--</form>--}}

{{--Select Field End--}}
{{--<select name="field" id="field">--}}
{{--    <option value="t.id" @if(request()->has('field') && request('field') == 't.id')--}}
{{--        {{ "selected" }}--}}
{{--        @endif >--}}
{{--        id transaksi--}}
{{--    </option>--}}
{{--    <option--}}
{{--        value="t.transaction_date" @if(request()->has('field') && request('field') == 't.transaction_date')--}}
{{--        {{ "selected" }}--}}
{{--        @endif>--}}
{{--        tanggal transaksi--}}
{{--    </option>--}}
{{--</select>--}}
{{--Select Field End--}}

{{--Select Item--}}
{{--<select name="item" id="item">--}}
{{--    <option--}}
{{--        value="@if(request()->has('item') && request('item') != '') {{ request('item') }} @else {{ "" }} @endif">--}}
{{--        @if(request()->has('item') && request('item') != '')--}}
{{--            {{ request('item') }}--}}
{{--        @else--}}
{{--            {{ "semua" }}--}}
{{--        @endif--}}
{{--    </option>--}}
{{--    @if($items->all() != null)--}}
{{--        @if(!request()->has('item'))--}}
{{--            @foreach($items->all() as $item)--}}
{{--                <option value="{{ $item->item_id }}">{{ $item->name_item }} | {{ $item->item_id }}</option>--}}
{{--            @endforeach--}}
{{--        @else--}}
{{--            @foreach($items->all() as $item)--}}
{{--                @if(request('item') == $item->item_id)--}}
{{--                    @php continue @endphp--}}
{{--                @endif--}}
{{--                <option value="{{ $item->item_id }}">{{ $item->name_item }} | {{ $item->item_id }}</option>--}}
{{--            @endforeach--}}
{{--            @if(request()->has('item') && request('item') != '')--}}
{{--                <option value="">semua</option>--}}
{{--            @endif--}}
{{--        @endif--}}
{{--    @else--}}
{{--        <option value="" selected>kosong</option>--}}
{{--    @endif--}}
{{--</select>--}}
{{--Select Item End--}}

{{--Select Type--}}
{{--<select name="type" id="type">--}}
{{--    <option value="" @if(request()->has('type') && request('type') == '')--}}
{{--        {{ "selected" }}--}}
{{--        @endif>Semua--}}
{{--    </option>--}}
{{--    <option value="bm" @if(request()->has('type') && request('type') == 'bm')--}}
{{--        {{ "selected" }}--}}
{{--        @endif>BM--}}
{{--    </option>--}}
{{--    <option value="bk" @if(request()->has('type') && request('type') == 'bk')--}}
{{--        {{ "selected" }}--}}
{{--        @endif>BK--}}
{{--    </option>--}}
{{--</select>--}}
{{--Select Type End--}}

{{--Select Order--}}
{{--<select name="order" id="order">--}}
{{--    <option value="asc" @if(request()->has('order') && request('order') == 'asc')--}}
{{--        {{ "selected" }}--}}
{{--        @endif>Ascending--}}
{{--    </option>--}}
{{--    <option value="desc" @if(request()->has('order') && request('order') == 'desc')--}}
{{--        {{ "selected" }}--}}
{{--        @endif>Descending--}}
{{--    </option>--}}
{{--</select>--}}
{{--Select Order End--}}

{{--<table border="1" cellpadding="5" cellspacing="0">--}}
{{--    <tr>--}}
{{--        <th>ID transaksi</th>--}}
{{--        <th>Jenis transaksi</th>--}}
{{--        <th>Tanggal transaksi</th>--}}
{{--        <th>Jumlah</th>--}}
{{--        <th>ID barang</th>--}}
{{--        <th>Nama barang</th>--}}
{{--        <th>deskripsi</th>--}}
{{--    </tr>--}}
{{--    @if((request()->has('search') && request('search') != null) || request()->has('order') || request()->has('field') || request()->has('type') || request()->has('filter'))--}}
{{--        @if($transactions->all() == null)--}}
{{--            <tr>--}}
{{--                <td colspan="7" align="center">data belum ada</td>--}}
{{--            </tr>--}}
{{--        @else--}}
{{--            @foreach($transactions as $transaction)--}}
{{--                <tr>--}}
{{--                    <td>{{ $transaction->transaction_id }}</td>--}}
{{--                    <td>{{ $transaction->transaction_name }}</td>--}}
{{--                    <td>{{ $transaction->transaction_date }}</td>--}}
{{--                    <td>{{ $transaction->quantity }}</td>--}}
{{--                    <td>{{ $transaction->item_id }}</td>--}}
{{--                    <td>{{ $transaction->name_item }}</td>--}}
{{--                    <td>{{ $transaction->description }}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--    @else--}}
{{--        @if($transactions->all() == null)--}}
{{--            <tr>--}}
{{--                <td colspan="7" align="center">data belum ada</td>--}}
{{--            </tr>--}}
{{--        @else--}}
{{--            @foreach($transactions as $transaction)--}}
{{--                <tr>--}}
{{--                    <td>{{ $transaction->transaction->transaction_id }}</td>--}}
{{--                    <td>{{ $transaction->transaction->transaction_type->transaction_name }}</td>--}}
{{--                    <td>{{ $transaction->transaction->transaction_date }}</td>--}}
{{--                    <td>{{ $transaction->quantity }}</td>--}}
{{--                    <td>{{ $transaction->item->item_id }}</td>--}}
{{--                    <td>{{ $transaction->item->name_item }}</td>--}}
{{--                    <td>{{ $transaction->description }}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--    @endif--}}
{{--</table>--}}
{{--<br>--}}
{{--<a href="/dashboard/transaction/masuk">barang masuk</a>--}}
{{--<br>--}}
{{--<a href="/dashboard/transaction/keluar">barang keluar</a>--}}
{{--<script src="{{ asset('assets/js/transaction.js') }}"></script>--}}
{{--</body>--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
          integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/transaksi.css') }}">
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
        <div class="header-content">
            <div>
                <h2>Transaksi</h2>
                <p>Cek semua transaksi yang telah anda lakukan disini</p>
                <a href="/dashboard">
                    <div class="kembali">
                        <p>Dashboard</p>
                        <img src="{{ asset('assets/img/panah.png') }}" alt="kembali">
                    </div>
                </a>
            </div>
        </div>
    </header>
</section>

<section>
    <div class="button">
        <a href="/dashboard/transaction/masuk">
            <div>
                <img src="{{ asset('assets/img/barang-masuk.png') }}" alt="masuk">
                <p>Barang Masuk</p>
            </div>
        </a>
        <a href="/dashboard/transaction/keluar">
            <div>
                <img src="{{ asset('assets/img/keluar.png') }}" alt="keluar">
                <p>Barang Keluar</p>
            </div>
        </a>
    </div>
</section>

<section>
    <div class="content">
        <div class="filtering">
            <form action="/dashboard/transaction" class="pure-form">
                <fieldset>
                    <div>
                        <input class="pure-input-rounded " type="text" name="search" id="search" placeholder="cari..."
                               autofocus autocomplete="">
                        <button type="submit" class="pure-button">cari</button>
                    </div>
                </fieldset>
            </form>
            <form class="pure-form">
                <fieldset>
                    <div class="select">
                        {{-- Select Field--}}
                        <select name="field" id="field">
                            <option value="t.id" @if(request()->has('field') && request('field') == 't.id')
                                {{ "selected" }}
                                @endif >
                                id transaksi
                            </option>
                            <option
                                value="t.transaction_date" @if(request()->has('field') && request('field') == 't.transaction_date')
                                {{ "selected" }}
                                @endif>
                                tanggal transaksi
                            </option>
                        </select>
                        {{-- Select Field End --}}

                        {{-- Select Item --}}
                        <select name="item" id="item">
                            <option
                                value="@if(request()->has('item') && request('item') != '') {{ request('item') }} @else {{ "" }} @endif">
                                @if(request()->has('item') && request('item') != '')
                                    {{ request('item') }}
                                @else
                                    {{ "semua" }}
                                @endif
                            </option>
                            @if($items->all() != null)
                                @if(!request()->has('item'))
                                    @foreach($items->all() as $item)
                                        <option value="{{ $item->item_id }}">{{ $item->name_item }}
                                            | {{ $item->item_id }}</option>
                                    @endforeach
                                @else
                                    @foreach($items->all() as $item)
                                        @if(request('item') == $item->item_id)
                                            @php continue @endphp
                                        @endif
                                        <option value="{{ $item->item_id }}">{{ $item->name_item }}
                                            | {{ $item->item_id }}</option>
                                    @endforeach
                                    @if(request()->has('item') && request('item') != '')
                                        <option value="">semua</option>
                                    @endif
                                @endif
                            @else
                                <option value="" selected>kosong</option>
                            @endif
                        </select>
                        {{-- Select Item End --}}

                        {{--Select Type--}}
                        <select name="type" id="type">
                            <option value="" @if(request()->has('type') && request('type') == '')
                                {{ "selected" }}
                                @endif>Semua
                            </option>
                            <option value="bm" @if(request()->has('type') && request('type') == 'bm')
                                {{ "selected" }}
                                @endif>BM
                            </option>
                            <option value="bk" @if(request()->has('type') && request('type') == 'bk')
                                {{ "selected" }}
                                @endif>BK
                            </option>
                        </select>
                        {{-- Select Type End --}}

                        <select name="order" id="order">
                            <option value="asc" @if(request()->has('order') && request('order') == 'asc')
                                {{ "selected" }}
                                @endif>Ascending
                            </option>
                            <option value="desc" @if(request()->has('order') && request('order') == 'desc')
                                {{ "selected" }}
                                @endif>Descending
                            </option>
                        </select>
                    </div>
                </fieldset>
            </form>
        </div>
        @if(session('message'))
            <p>{{ session('message') }}</p>
        @endif
        <table class="pure-table pure-table-bordered">
            <thead>
            <tr>
                <th colspan="7  " class="title">Data Transaksi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="first">ID Transaksi</td>
                <td class="first">Jenis Transaksi</td>
                <td class="first">Tanggal Transaksi</td>
                <td class="first">Jumlah</td>
                <td class="first">ID Barang</td>
                <td class="first">Nama Barang</td>
                <td class="first">Deskripsi</td>
            </tr>
            @if((request()->has('search') && request('search') != null) || request()->has('order') || request()->has('field') || request()->has('type') || request()->has('item'))
                @if($transactions->all() == null)
                    <tr>
                        <td colspan="7" align="center">data belum ada</td>
                    </tr>
                @else
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_id }}</td>
                            <td>{{ $transaction->transaction_name }}</td>
                            <td>{{ $transaction->transaction_date }}</td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>{{ $transaction->item_id }}</td>
                            <td>{{ $transaction->name_item }}</td>
                            <td>{{ $transaction->description }}</td>
                        </tr>
                    @endforeach
                @endif
            @else
                @if($transactions->all() == null)
                    <tr>
                        <td colspan="7" align="center">data belum ada</td>
                    </tr>
                @else
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction->transaction_id }}</td>
                            <td>{{ $transaction->transaction->transaction_type->transaction_name }}</td>
                            <td>{{ $transaction->transaction->transaction_date }}</td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>{{ $transaction->item->item_id }}</td>
                            <td>{{ $transaction->item->name_item }}</td>
                            <td>{{ $transaction->description }}</td>
                        </tr>
                    @endforeach
                @endif
            @endif
            </tbody>
        </table>
    </div>
</section>

<section>
    <div class="pagination">
        <div class="previus">
            @if($transactions->currentPage() > 1)
                <a href="?page={{ $transactions->currentPage() - 1 }}">previus</a>
            @else
                <p>previus</p>
            @endif
        </div>
        <div class="page">
            @if(!$transactions->currentPage() > ((int) ceil($transactions->currentPage() / $transactions->perPage())) || request('page') == null)
                @for($i = 1; $i <= (int) ceil($transactions->total() / $transactions->perPage()); $i++)
                    @if($i == $transactions->currentPage())
                        <a href="?page={{ $i }}" class="active">{{ $i }}</a>
                    @else
                        <a href="?page={{ $i }}" >{{ $i }}</a>
                    @endif
                @endfor
            @else
                @for($i = 1; $i <= (int) ceil($transactions->total() / $transactions->perPage()); $i++)
                    @if($i == $transactions->currentPage())
                        <a href="?page={{ $i }}" class="active">{{ $i }}</a>
                    @else
                        <a href="?page={{ $i }}" >{{ $i }}</a>
                    @endif
                @endfor
            @endif
        </div>
        <div class="next">
            @if($transactions->currentPage() < ceil($transactions->total() / $transactions->perPage()))
                <a href="?page={{ $transactions->currentPage() + 1 }}">next</a>
            @else
                <p>next</p>
            @endif
        </div>
    </div>
</section>

<script src="{{ asset('assets/js/transaction.js') }}"></script>
</body>
</html>
