<html>
<head>
    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
</head>
<body>
<form action="/dashboard/item" method="post">
    @csrf
    @error('error')
    <p class="error">{{ $message }}</p>
    @enderror
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <input type="text" name="counter" id="id-barang" value="{{ $counter }}" autocomplete="off"
           readonly>
    <br>
    <input type="text" name="name_item" id="nama-barang"
           value="{{ request('name_item') }}" autocomplete="off"
           placeholder="nama barang">
    <br>
    <select name="category_id" id="id-kategori">
        @if($categories->all() != null)
            @foreach($categories as $category)
                <option value="{{ $category->category_id }}">{{ $category->category_id }}</option>
            @endforeach
        @else
            <option value="null">kosong</option>
        @endif

    </select>
    <br>
    <input type="text" name="description" id="deskripsi" value="{{ request('description') }}"
           autocomplete="off" placeholder="deskripsi (optional)">
    <br>
    <input type="submit" name="submit" id="submit">
</form>
<br>
<a href="/dashboard">kembali ke dashboard</a>

<br><br><br>

{{--Select Field--}}
<select name="" id="field">
    <option value="i.id" @if(request()->has('field') && request('field') == 'i.id')
        {{ "selected" }}
        @endif>id
    </option>
    <option value="i.name_item" @if(request()->has('field') && request('field') == 'i.name_item')
        {{ "selected" }}
        @endif>nama item
    </option>
    <option value="i.quantity" @if(request()->has('field') && request('field') == 'i.quantity')
        {{ "selected" }}
        @endif>kuantitas
    </option>
</select>
{{--Select Field End--}}

{{--Select Category--}}
<select name="category" id="category">
    <option
        value="@if(request()->has('category') && request('category') != '') {{ request('category') }} @else {{ "" }} @endif">
        @if(request()->has('category') && request('category') != '')
            {{ request('category') }}
        @else
            {{ "semua" }}
        @endif
    </option>
    @if($categories->all() != null)
        @if(!request()->has('category'))
            @foreach($categories->all() as $category)
                <option value="{{ $category->name_category }}">{{ $category->name_category }} | {{ $category->category_id }}</option>
            @endforeach
        @else
            @foreach($categories->all() as $category)
                @if(request('item') == $category->category_id)
                    @php continue @endphp
                @endif
                <option value="{{ $category->category_id }}">{{ $category->name_category }} | {{ $category->category_id }}</option>
            @endforeach
            @if(request()->has('category') && request('category') != '')
                <option value="">semua</option>
            @endif
        @endif
    @else
        <option value="" selected>kosong</option>
    @endif
</select>
{{--Select Category End--}}

{{--Select Order--}}
<select name="order" id="order">
    <option value="asc" @if(request()->has('order') && request('order') == 'asc') {{ "selected" }} @endif>asc</option>
    <option value="desc" @if(request()->has('order') && request('order') == 'desc') {{ "selected" }} @endif>desc</option>
</select>
{{--Select Order End--}}

<br><br>

<h1>Daftar Barang</h1>
<table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <td>ID Barang</td>
        <td>Nama Barang</td>
        <td>Kuantitas</td>
        <td>Nama Kategori</td>
        <td>Deskripsi</td>
        <td>Aksi</td>
    </tr>
    @if(request()->has('search') || request()->has('order') || request()->has('field') || request()->has('filter'))
        @if($items->all() == null)
            <tr>
                <td colspan="6" align="center">data belum ada</td>
            </tr>
        @else
            @foreach($items->all() as $item)
                <tr>
                    <td>{{ $item->item_id }}</td>
                    <td>{{ $item->name_item }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->name_category }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        <a href="/dashboard/item/delete/{{ $item->item_id }}"
                           onclick="return confirm('Semua data transaksi juga akan terhapus, apakah anda yakin?');">hapus</a>
                        <a href="/dashboard/item/update-item/{{ $item->item_id }}">ubah</a>
                    </td>
                </tr>
            @endforeach
        @endif
    @else
        @if($items->all() == null)
            <tr>
                <td colspan="6" align="center">data belum ada</td>
            </tr>
        @else
            @foreach($items->all() as $item)
                <tr>
                    <td>{{ $item->item_id }}</td>
                    <td>{{ $item->name_item }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->category->name_category }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        <a href="/dashboard/item/delete/{{ $item->item_id }}"
                           onclick="return confirm('Semua data transaksi juga akan terhapus, apakah anda yakin?');">hapus</a>
                        <a href="/dashboard/item/update-item/{{ $item->item_id }}">ubah</a>
                    </td>
                </tr>
            @endforeach
        @endif
    @endif

</table>
<script src="{{ asset('assets/js/item.js') }}"></script>
</body>
</html>
