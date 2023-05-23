{{--<head>--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">--}}
{{--</head>--}}

{{--<body>--}}
{{--<ul>--}}
{{--    <li>name: {{ $user->name }}</li>--}}
{{--    <li>email: {{ $user->email }}</li>--}}
{{--</ul>--}}
{{--<form action="/users/profile" method="POST">--}}
{{--    @csrf--}}
{{--@error('error')--}}
{{--<p class="error">{{ $message }}</p>--}}
{{--@enderror--}}
{{--    @if(session('message'))--}}
{{--        <p>{{ session('message') }}</p>--}}
{{--    @endif--}}
{{--    <label for="name">fullname: </label><label>--}}
{{--        <input type="text" name="name" autocomplete="off" placeholder="your fullname"--}}
{{--               value="{{ $user->name ?? old('name', '') }}">--}}
{{--    </label>--}}
{{--    <label for="email">email: </label><label>--}}
{{--        <input type="email" name="email" autocomplete="off" placeholder="your email"--}}
{{--               value="{{ $user->email ?? old('email', '') }}">--}}
{{--    </label>--}}
{{--    <button type="submit" name="submit">Submit</button>--}}
{{--</form>--}}

{{--<a href="/users/update-password">change password</a>--}}
{{--</body>--}}

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
          integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" rel="stylesheet">
    <title>Profil</title>
</head>
<body>
<section>
    <header class="header">
        <nav class="nav">
            <div>
                <a href="#"><img class="logo" src="{{ asset('assets/img/LOGO.svg') }}" alt="logo"></a>
                <h3 class="profile"><a href="/users/logout">logout</a></h3>
            </div>
        </nav>
        <div class="header-content">
            <div>
                <h2>Profil User</h2>
                <p>ubah profil anda</p>
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
        <a href="/users/update-password">
            <div>
                <img src="{{ asset('assets/img/password.png') }}" alt="barang">
                <p>Ganti password</p>
            </div>
        </a>
    </div>
</section>

<section>
    <div class="wrap">
        <div class="content">
            <form action="/users/profile" method="POST">
                @csrf
                <fieldset>
                    @error('error')
                    <div class="separator">
                        <label></label>
                        <p class="error">{{ $message }}</p>
                    </div>
                    @enderror
                    @if(session('message'))
                        <div class="separator">
                            <label></label>
                            <p>{{ session('message') }}</p>
                        </div>
                    @endif
                    <div class="separator">
                        <label for="nama">Nama</label>
                        <input type="text" name="name" id="nama" placeholder="Nama anda" value="{{ request('name') ?? $user->name }}"/>
                    </div>
                    <div class="separator">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email anda" value="{{ request('email') ?? $user->email }}"/>
                    </div>
                    <div class="separator">
                        <label></label>
                        <button type="submit" name="submit" class="pure-button">Simpan</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>
</body>
</html>
