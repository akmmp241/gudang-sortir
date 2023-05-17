<head>
    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
</head>
<body>
<h1>Data Transaksi</h1>

<br><br>

@if(session('message'))
    <p>{{ session('message') }}</p>
@endif

<form action="/dashboard/transaction">
    <input type="text" name="search" id="search" placeholder="cari..." autofocus autocomplete="">
    <button type="submit">cari</button>
</form>

{{--Select Field End--}}
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
{{--Select Field End--}}

{{--Select Item--}}
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
                <option value="{{ $item->item_id }}">{{ $item->name_item }} | {{ $item->item_id }}</option>
            @endforeach
        @else
            @foreach($items->all() as $item)
                @if(request('item') == $item->item_id)
                    @php continue @endphp
                @endif
                <option value="{{ $item->item_id }}">{{ $item->name_item }} | {{ $item->item_id }}</option>
            @endforeach
            @if(request()->has('item') && request('item') != '')
                <option value="">semua</option>
            @endif
        @endif
    @else
        <option value="" selected>kosong</option>
    @endif
</select>
{{--Select Item End--}}

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
{{--Select Type End--}}

{{--Select Order--}}
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
{{--Select Order End--}}

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID transaksi</th>
        <th>Jenis transaksi</th>
        <th>Tanggal transaksi</th>
        <th>Jumlah</th>
        <th>ID barang</th>
        <th>Nama barang</th>
        <th>deskripsi</th>
    </tr>
    @if((request()->has('search') && request('search') != null) || request()->has('order') || request()->has('field') || request()->has('type') || request()->has('filter'))
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
                    <td>{{ $transaction->item->transaction_id }}</td>
                    <td>{{ $transaction->item->name_item }}</td>
                    <td>{{ $transaction->description }}</td>
                </tr>
            @endforeach
        @endif
    @endif
</table>
<br>
<a href="/dashboard/transaction/masuk">barang masuk</a>
<br>
<a href="/dashboard/transaction/keluar">barang keluar</a>
<script src="{{ asset('assets/js/transaction.js') }}"></script>
</body>
