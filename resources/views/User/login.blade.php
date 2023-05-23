{{--<head>--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<h1>{{ $title }}</h1>--}}
{{--<div>--}}
{{--    <form action="/users/login" method="POST">--}}
{{--        @csrf--}}
{{--        @error('error')--}}
{{--            <p>{{ $message }}</p>--}}
{{--        @enderror--}}
{{--        @if(session('message'))--}}
{{--            <p class="error">{{ session('message') }}</p>--}}
{{--        @endif--}}
{{--        <label for="email">email: </label><label>--}}
{{--            <input type="email" name="email" autocomplete="off" placeholder="your fullname"--}}
{{--                   value="{{ old('email', '') }}">--}}
{{--        </label>--}}
{{--        <label for="password">password: </label><label>--}}
{{--            <input type="password" name="password" autocomplete="off" placeholder="your fullname"--}}
{{--                   value="{{ old('password', '') }}">--}}
{{--        </label>--}}
{{--        <button type="submit" name="submit">Submit</button>--}}
{{--    </form>--}}
{{--    <p>belum punya akun? <a href="/users/register">Register</a></p>--}}
{{--</div>--}}
{{--</body>--}}

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="{{ asset('assets/css/akoksad.css') }}"/>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>Sign In & Sign Up</title>
</head>
<body>
<div class="container @if(request('register')) {{ 'sign-up-mode' }} @endif">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="/users/login" class="sign-in-form" method="POST">
                @csrf

                @if(session('message'))
                    <p class="error">{{ session('message') }}</p>
                @endif
                <h2 class="title">Masuk</h2>
                @error('error')
                <p class="error">{{ $message }}</p>
                @enderror
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" autocomplete="off" placeholder="email anda" value="{{ request('email', '') }}"/>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input  type="password" name="password" autocomplete="off" placeholder="password anda"
                            value="{{ request('password', '') }}"/>
                </div>
                <input type="submit" value="submit" class="btn solid"/>
            </form>

            <form action="/users/register" class="sign-up-form" method="POST">
                @csrf

                @if(session('message'))
                    <p>{{ session('message') }}</p>
                @endif
                <h2 class="title">Daftar</h2>
                @error('error')
                <p class="error">{{ $message }}</p>
                @enderror
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" autocomplete="off" placeholder="nama" value="{{ request('name', '') }}"/>
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" autocomplete="off" placeholder="email"
                           value="{{ request('email', '') }}"/>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" autocomplete="off" placeholder="password"
                           value="{{ request('password', '') }}"/>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm" autocomplete="off" placeholder="konfirmasi password"
                           value="{{ request('confirm', '') }}"/>
                </div>
                <input type="submit" value="submit" class="btn solid"/>
            </form>
        </div>
    </div>
    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>Belum memiliki akun Gudagsortir?</h3>
                <p>Silahkan mendaftar untuk mendapatkan berbagai fitur menarik dari kami.</p>
                <button class="btn transparent" id="sign-up-btn">Daftar</button>
            </div>

            <img src="{{ asset("assets/img/masuk.png") }}" alt="" class="image"/>
        </div>

        <div class="panel right-panel">
            <div class="content">
                <h3>Sudah memiliki akun Gudangsortir?</h3>
                <p>Jika anda sudah memiliki akun silahkan masuk untuk menikmati layanan kami.</p>
                <button class="btn transparent" id="sign-in-btn">Masuk</button>
            </div>

            <img src="{{ asset("assets/img/daftar.png") }}" alt="" class="image"/>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('assets/js/script.js') }}"></script>
</html>
