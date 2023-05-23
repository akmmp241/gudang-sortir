{{--<head>--}}
{{--    <title>joko</title>--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<div>--}}
{{--    <form action="/dashboard/category" method="POST">--}}
{{--        @csrf--}}
{{--        @error('error')--}}
{{--        <p class="error">{{ $message }}</p>--}}
{{--        @enderror--}}
{{--        @if(session('message'))--}}
{{--            <p>{{ session('message') }}</p>--}}
{{--        @endif--}}
{{--        <input type="text" name="category_id" id="categoryId" value="{{ request()->old('category_id', '') }}"--}}
{{--               autocomplete="off" placeholder="id kategori">--}}
{{--        <br>--}}
{{--        <input type="text" name="name_category" id="nameCategory" value="{{ request()->old('name_category', '') }}"--}}
{{--               autocomplete="off" placeholder="nama kategori">--}}
{{--        <br>--}}
{{--        <input type="text" name="description" id="description" value="{{ request()->old('description', '') }}"--}}
{{--               autocomplete="off" placeholder="deskripsi (optional)">--}}
{{--        <br>--}}
{{--        <input type="submit" name="submit" id="submit">--}}
{{--    </form>--}}
{{--    <a href="/dashboard">kembali ke dashboard</a>--}}

{{--    <br><br><br>--}}
{{--    <table border="1" cellspacing="0" cellpadding="10">--}}
{{--        <tr>--}}
{{--            <td colspan="4">DAFTAR KATEGORI</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>ID Kategori</td>--}}
{{--            <td>Nama Kategori</td>--}}
{{--            <td>Deskripsi</td>--}}
{{--            <td>Aksi</td>--}}
{{--        </tr>--}}
{{--        @if($category->all() == null)--}}
{{--            <tr>--}}
{{--                <td colspan="4" align="center">data belum ada</td>--}}
{{--            </tr>--}}
{{--        @else--}}
{{--            @foreach($category as $item)--}}
{{--                <tr>--}}
{{--                    <td>{{ $item->category_id }}</td>--}}
{{--                    <td>{{ $item->name_category }}</td>--}}
{{--                    <td>{{ $item->description }}</td>--}}
{{--                    <td><a href="/dashboard/category/delete/{{ $item->category_id }}"--}}
{{--                           onclick="return confirm('apakah anda yakin?')">hapus</a> <a--}}
{{--                            href="/dashboard/category/update-category/{{ $item->category_id }}">edit</a></td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--    </table>--}}
{{--</div>--}}
{{--</body>--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/kategori.css') }}">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
          integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <title>Kategori</title>
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
                <h2>Tambah Kategori</h2>
                <p>Tambah kategori barang dan mulai sortir barang</p>
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
        <a href="/dashboard/category/add">
            <div>
                <img src="{{ asset('assets/img/kategori.png') }}" alt="kategori">
                <p>Tambah kategori</p>
            </div>
        </a>
    </div>
</section>

<section>
    <div class="content">
        @if(session('message'))
            <p>{{ session('message') }}</p>
        @endif
        <table class="pure-table pure-table-bordered">
            <thead>
            <tr>
                <th colspan="4" class="title">Daftar Kategori Barang</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="first">ID Kategori</td>
                <td class="first">Nama Kategori</td>
                <td class="first">Deskripsi</td>
                <td class="first">Aksi</td>
            </tr>
            @if($categories->all() == null)
                <tr>
                    <td colspan="4" align="center">data belum ada</td>
                </tr>
            @else
                @foreach($categories as $item)
                    <tr>
                        <td>{{ $item->category_id }}</td>
                        <td>{{ $item->name_category }}</td>
                        <td>{{ $item->description }}</td>
                        <td><a href="/dashboard/category/delete/{{ $item->category_id }}"
                               onclick="return confirm('apakah anda yakin?')">hapus</a> | <a
                                href="/dashboard/category/update-category/{{ $item->category_id }}">edit</a></td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</section>

<section>
    <div class="pagination">
        <div class="previus">
            @if($categories->currentPage() > 1)
                <a href="?page={{ $categories->currentPage() - 1 }}">previus</a>
            @else
                <p>previus</p>
            @endif
        </div>
        <div class="page">
            @if(!$categories->currentPage() > ((int) ceil($categories->currentPage() / $categories->perPage())) || request('page') == null)
                @for($i = 1; $i <= (int) ceil($categories->total() / $categories->perPage()); $i++)
                    @if($i == $categories->currentPage())
                        <a href="?page={{ $i }}" class="active">{{ $i }}</a>
                    @else
                        <a href="?page={{ $i }}" >{{ $i }}</a>
                    @endif
                @endfor
            @else
                @for($i = 1; $i <= (int) ceil($categories->total() / $categories->perPage()); $i++)
                    @if($i == $categories->currentPage())
                        <a href="?page={{ $i }}" class="active">{{ $i }}</a>
                    @else
                        <a href="?page={{ $i }}" >{{ $i }}</a>
                    @endif
                @endfor
            @endif
        </div>
        <div class="next">
            @if($categories->currentPage() < ceil($categories->total() / $categories->perPage()))
                <a href="?page={{ $categories->currentPage() + 1 }}">next</a>
            @else
                <p>next</p>
            @endif
        </div>
    </div>
</section>

</body>
</html>
