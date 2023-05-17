<head>
    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
</head>
<body>
<h1>Barang {{ $type }}</h1>
<br><br>
@error('error')
<p class="error">{{ $message }}</p>
@enderror
<form action="/dashboard/transaction/{{ $type }}" method="POST">
    @csrf
    <input type="text" name="transactionId" value="{{ $transactionId }}" readonly>
    <br>
    <input type="datetime-local" name="date" value="{{ $date }}">
    <br>
    <select name="itemId" id="itemId">
        @if($items->all() != null)
            @foreach($items->all() as $item)
                <option value="{{ $item->item_id }}">{{ $item->item_id }} | {{ $item->name_item }}</option>
            @endforeach
        @else
            <option value="null">kosong</option>
        @endif
    </select>
    <br>
    <input type="number" name="quantity" autocomplete="off" value="{{ old('quantity', 0) }}">
    <br>
    <input type="text" name="description" value="{{ old('description', '') }}" autocomplete="off" placeholder="deskripsi (optional)">
    <br>
    <input type="submit" name="submit" id="submit">
</form>
</body>
