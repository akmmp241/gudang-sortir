<form action="/dashboard/item/update-item/{{ $item->item_id }}" method="POST">
    @csrf
    @error('error')
    <p>{{ $message }}</p>
    @enderror
    <input type="text" name="item_id" id="id-barang" value="{{ $item->item_id }}" autocomplete="off"
           readonly>
    <br>
    <input type="text" name="name_item" id="nama-barang"
           value="{{ $item->name_item  }}" autocomplete="off"
           placeholder="nama barang">
    <br>
    <input type="text" name="description" id="deskripsi" value="{{ $item->description }}"
           autocomplete="off" placeholder="deskripsi (optional)">
    <br>
    <input type="submit" name="submit">
</form>
