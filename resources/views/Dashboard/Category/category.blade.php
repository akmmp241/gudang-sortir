<head>
    <title>joko</title>
    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
</head>
<body>
<div>
    <form action="/dashboard/category" method="POST">
        @csrf
        @error('error')
        <p class="error">{{ $message }}</p>
        @enderror
        @if(session('message'))
            <p>{{ session('message') }}</p>
        @endif
        <input type="text" name="category_id" id="categoryId" value="{{ request()->old('category_id', '') }}"
               autocomplete="off" placeholder="id kategori">
        <br>
        <input type="text" name="name_category" id="nameCategory" value="{{ request()->old('name_category', '') }}"
               autocomplete="off" placeholder="nama kategori">
        <br>
        <input type="text" name="description" id="description" value="{{ request()->old('description', '') }}"
               autocomplete="off" placeholder="deskripsi (optional)">
        <br>
        <input type="submit" name="submit" id="submit">
    </form>
    <a href="/dashboard">kembali ke dashboard</a>

    <br><br><br>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td colspan="4">DAFTAR KATEGORI</td>
        </tr>
        <tr>
            <td>ID Kategori</td>
            <td>Nama Kategori</td>
            <td>Deskripsi</td>
            <td>Aksi</td>
        </tr>
        @if($category->all() == null)
            <tr>
                <td colspan="4" align="center">data belum ada</td>
            </tr>
        @else
            @foreach($category as $item)
                <tr>
                    <td>{{ $item->category_id }}</td>
                    <td>{{ $item->name_category }}</td>
                    <td>{{ $item->description }}</td>
                    <td><a href="/dashboard/category/delete/{{ $item->category_id }}"
                           onclick="return confirm('apakah anda yakin?')">hapus</a> <a
                            href="/dashboard/category/update-category/{{ $item->category_id }}">edit</a></td>
                </tr>
            @endforeach
        @endif
    </table>
</div>
</body>
