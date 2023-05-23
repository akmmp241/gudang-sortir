{{--<head>--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<h1>{{ $title }}</h1>--}}
{{--<div>--}}
{{--    <form action="/users/update-password" method="POST">--}}
{{--        @csrf--}}
{{--        @error('error')--}}
{{--            <p class="error">{{ $message }}</p>--}}
{{--        @enderror--}}
{{--        @if(session('message'))--}}
{{--            <p>{{ session('message') }}</p>--}}
{{--        @endif--}}
{{--        <label for="oldPassword">old Password: </label><label>--}}
{{--            <input type="password" name="oldPassword" autocomplete="off" placeholder="old password"--}}
{{--                   value="{{ old('oldPassword', '') }}">--}}
{{--        </label>--}}
{{--        <label for="newPassword">new Password: </label><label>--}}
{{--            <input type="password" name="newPassword" autocomplete="off" placeholder="new password"--}}
{{--                   value="{{ old('newPassword', '') }}">--}}
{{--        </label>--}}
{{--        <button type="submit" name="submit">Submit</button>--}}
{{--    </form>--}}
{{--</div>--}}
{{--</body>--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/password.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
          integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" rel="stylesheet">
    <title>Ganti Password</title>
</head>
<body>
<section>
    <header class="header">
        <nav class="nav">
            <div>
                <a href="#"><img class="logo" src="{{ asset('assets/img/LOGO.svg') }}" alt="logo"></a>
            </div>
        </nav>
        <div class="header-content">
            <div>
                <h2>Ganti Password</h2>
                <p>perbarui password untuk menghindati celah keamanan</p>
                <a href="/users/profile">
                    <div class="kembali">
                        <p>Profil</p>
                        <img src="{{ asset('assets/img/panah.png') }}" alt="kembali">
                    </div>
                </a>
            </div>
        </div>
    </header>
</section>

<section>
    <div class="wrap">
        <div class="content">
            <form action="/users/update-password" method="POST">
                <fieldset>
                    @csrf
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
                        <label for="oldpassword">Password lama</label>
                        <input type="password" name="oldPassword" id="oldpassword" placeholder="password lama anda" value="{{ request('oldPassword') ?? '' }}" />
                    </div>
                    <div class="separator">
                        <label for="newpassword">Password baru</label>
                        <input type="password" name="newPassword" id="newpassword" placeholder="password baru anda" value="{{ request('newPassword') ?? '' }}"/>
                    </div>
                    <div class="separator">
                        <label for=""></label>
                        <button type="submit" name="submit" class="pure-button">Ganti</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>
</body>
</html>
