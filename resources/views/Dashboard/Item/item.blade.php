{{--<html>--}}
{{--<head>--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<form action="/dashboard/item" method="post">--}}
{{--    @csrf--}}
{{--    @error('error')--}}
{{--    <p class="error">{{ $message }}</p>--}}
{{--    @enderror--}}
{{--    @if(session('message'))--}}
{{--        <p>{{ session('message') }}</p>--}}
{{--    @endif--}}
{{--    <input type="text" name="counter" id="id-barang" value="{{ $counter }}" autocomplete="off"--}}
{{--           readonly>--}}
{{--    <br>--}}
{{--    <input type="text" name="name_item" id="nama-barang"--}}
{{--           value="{{ request('name_item') }}" autocomplete="off"--}}
{{--           placeholder="nama barang">--}}
{{--    <br>--}}
{{--    <select name="category_id" id="id-kategori">--}}
{{--        @if($categories->all() != null)--}}
{{--            @foreach($categories as $category)--}}
{{--                <option value="{{ $category->category_id }}">{{ $category->category_id }}</option>--}}
{{--            @endforeach--}}
{{--        @else--}}
{{--            <option value="null">kosong</option>--}}
{{--        @endif--}}

{{--    </select>--}}
{{--    <br>--}}
{{--    <input type="text" name="description" id="deskripsi" value="{{ request('description') }}"--}}
{{--           autocomplete="off" placeholder="deskripsi (optional)">--}}
{{--    <br>--}}
{{--    <input type="submit" name="submit" id="submit">--}}
{{--</form>--}}
{{--<br>--}}
{{--<a href="/dashboard">kembali ke dashboard</a>--}}

{{--<br><br><br>--}}

{{--Select Field--}}
{{--<select name="" id="field">--}}
{{--    <option value="i.id" @if(request()->has('field') && request('field') == 'i.id')--}}
{{--        {{ "selected" }}--}}
{{--        @endif>id--}}
{{--    </option>--}}
{{--    <option value="i.name_item" @if(request()->has('field') && request('field') == 'i.name_item')--}}
{{--        {{ "selected" }}--}}
{{--        @endif>nama item--}}
{{--    </option>--}}
{{--    <option value="i.quantity" @if(request()->has('field') && request('field') == 'i.quantity')--}}
{{--        {{ "selected" }}--}}
{{--        @endif>kuantitas--}}
{{--    </option>--}}
{{--</select>--}}
{{--Select Field End--}}

{{--Select Category--}}
{{--<select name="category" id="category">--}}
{{--    <option--}}
{{--        value="@if(request()->has('category') && request('category') != '') {{ request('category') }} @else {{ "" }} @endif">--}}
{{--        @if(request()->has('category') && request('category') != '')--}}
{{--            {{ request('category') }}--}}
{{--        @else--}}
{{--            {{ "semua" }}--}}
{{--        @endif--}}
{{--    </option>--}}
{{--    @if($categories->all() != null)--}}
{{--        @if(!request()->has('category'))--}}
{{--            @foreach($categories->all() as $category)--}}
{{--                <option value="{{ $category->name_category }}">{{ $category->name_category }} | {{ $category->category_id }}</option>--}}
{{--            @endforeach--}}
{{--        @else--}}
{{--            @foreach($categories->all() as $category)--}}
{{--                @if(request('item') == $category->category_id)--}}
{{--                    @php continue @endphp--}}
{{--                @endif--}}
{{--                <option value="{{ $category->category_id }}">{{ $category->name_category }} | {{ $category->category_id }}</option>--}}
{{--            @endforeach--}}
{{--            @if(request()->has('category') && request('category') != '')--}}
{{--                <option value="">semua</option>--}}
{{--            @endif--}}
{{--        @endif--}}
{{--    @else--}}
{{--        <option value="" selected>kosong</option>--}}
{{--    @endif--}}
{{--</select>--}}
{{--Select Category End--}}

{{--Select Order--}}
{{--<select name="order" id="order">--}}
{{--    <option value="asc" @if(request()->has('order') && request('order') == 'asc') {{ "selected" }} @endif>asc</option>--}}
{{--    <option value="desc" @if(request()->has('order') && request('order') == 'desc') {{ "selected" }} @endif>desc</option>--}}
{{--</select>--}}
{{--Select Order End--}}

{{--<br><br>--}}

{{--<h1>Daftar Barang</h1>--}}
{{--<table border="1" cellspacing="0" cellpadding="10">--}}
{{--    <tr>--}}
{{--        <td>ID Barang</td>--}}
{{--        <td>Nama Barang</td>--}}
{{--        <td>Kuantitas</td>--}}
{{--        <td>Nama Kategori</td>--}}
{{--        <td>Deskripsi</td>--}}
{{--        <td>Aksi</td>--}}
{{--    </tr>--}}
{{--    @if(request()->has('search') || request()->has('order') || request()->has('field') || request()->has('filter'))--}}
{{--        @if($items->all() == null)--}}
{{--            <tr>--}}
{{--                <td colspan="6" align="center">data belum ada</td>--}}
{{--            </tr>--}}
{{--        @else--}}
{{--            @foreach($items->all() as $item)--}}
{{--                <tr>--}}
{{--                    <td>{{ $item->item_id }}</td>--}}
{{--                    <td>{{ $item->name_item }}</td>--}}
{{--                    <td>{{ $item->quantity }}</td>--}}
{{--                    <td>{{ $item->name_category }}</td>--}}
{{--                    <td>{{ $item->description }}</td>--}}
{{--                    <td>--}}
{{--                        <a href="/dashboard/item/delete/{{ $item->item_id }}"--}}
{{--                           onclick="return confirm('Semua data transaksi juga akan terhapus, apakah anda yakin?');">hapus</a>--}}
{{--                        <a href="/dashboard/item/update-item/{{ $item->item_id }}">ubah</a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--    @else--}}
{{--        @if($items->all() == null)--}}
{{--            <tr>--}}
{{--                <td colspan="6" align="center">data belum ada</td>--}}
{{--            </tr>--}}
{{--        @else--}}
{{--            @foreach($items->all() as $item)--}}
{{--                <tr>--}}
{{--                    <td>{{ $item->item_id }}</td>--}}
{{--                    <td>{{ $item->name_item }}</td>--}}
{{--                    <td>{{ $item->quantity }}</td>--}}
{{--                    <td>{{ $item->category->name_category }}</td>--}}
{{--                    <td>{{ $item->description }}</td>--}}
{{--                    <td>--}}
{{--                        <a href="/dashboard/item/delete/{{ $item->item_id }}"--}}
{{--                           onclick="return confirm('Semua data transaksi juga akan terhapus, apakah anda yakin?');">hapus</a>--}}
{{--                        <a href="/dashboard/item/update-item/{{ $item->item_id }}">ubah</a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--    @endif--}}

{{--</table>--}}
{{--<script src="{{ asset('assets/js/item.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/barang.css') }}">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
          integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <title>Barang</title>
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
                <h2>Tambah Barang</h2>
                <p>Tambah barang sesuia yang anda inginkan</p>
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
        <a href="/dashboard/item/add">
            <div>
                <img src="{{ asset('assets/img/barang.png') }}" alt="barang">
                <p>Tambah barang</p>
            </div>
        </a>
    </div>
</section>

<section>
    <div class="content">
        <div class="filtering select">
            <form class="pure-form">
                <fieldset>
                    <div class="select">
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
                        <select name="order" id="order">
                            <option value="asc" @if(request()->has('order') && request('order') == 'asc') {{ "selected" }} @endif>asc</option>
                            <option value="desc" @if(request()->has('order') && request('order') == 'desc') {{ "selected" }} @endif>desc</option>
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
                <th colspan="6" class="title">Daftar Barang</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="first">ID Barang</td>
                <td class="first">Nama Barang</td>
                <td class="first">Kuantitas</td>
                <td class="first">Nama Kategori</td>
                <td class="first">Deskripsi</td>
                <td class="first">Aksi</td>
            </tr>
            @if(request()->has('search') || request()->has('order') || request()->has('field') || request()->has('category'))
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
                                <a href="/dashboard/item/delete/{{ $item->item_id }}" onclick="return confirm('Semua data transaksi juga akan terhapus, apakah anda yakin?');">hapus</a> |
                                <a href="/dashboard/item/update-item/{{ $item->item_id }}">edit</a>
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
                                   onclick="return confirm('Semua data transaksi juga akan terhapus, apakah anda yakin?');">hapus</a> |
                                <a href="/dashboard/item/update-item/{{ $item->item_id }}">edit</a>
                            </td>
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
            @if($items->currentPage() > 1)
                <a href="?page={{ $items->currentPage() - 1 }}">previus</a>
            @else
                <p>previus</p>
            @endif
        </div>
        <div class="page">
            @if(!$items->currentPage() > ((int) ceil($items->currentPage() / $items->perPage())) || request('page') == null)
                @for($i = 1; $i <= (int) ceil($items->total() / $items->perPage()); $i++)
                    @if($i == $items->currentPage())
                        <a href="?page={{ $i }}" class="active">{{ $i }}</a>
                    @else
                        <a href="?page={{ $i }}" >{{ $i }}</a>
                    @endif
                @endfor
            @else
                @for($i = 1; $i <= (int) ceil($items->total() / $items->perPage()); $i++)
                    @if($i == $items->currentPage())
                        <a href="?page={{ $i }}" class="active">{{ $i }}</a>
                    @else
                        <a href="?page={{ $i }}" >{{ $i }}</a>
                    @endif
                @endfor
            @endif
        </div>
        <div class="next">
            @if($items->currentPage() < ceil($items->total() / $items->perPage()))
                <a href="?page={{ $items->currentPage() + 1 }}">next</a>
            @else
                <p>next</p>
            @endif
        </div>
    </div>
</section>

<script src="{{ asset('assets/js/item.js') }}"></script>
</body>
</html>
