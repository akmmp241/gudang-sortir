<form action="/dashboard/item" method="post">
    @csrf
    @error('error')
    <p>{{ $message }}</p>
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
</table>
