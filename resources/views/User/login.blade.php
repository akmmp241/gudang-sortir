<head>
    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
</head>
<body>
<h1>{{ $title }}</h1>
<div>
    <form action="/users/login" method="POST">
        @csrf
        @error('error')
            <p>{{ $message }}</p>
        @enderror
        @if(session('message'))
            <p class="error">{{ session('message') }}</p>
        @endif
        <label for="email">email: </label><label>
            <input type="email" name="email" autocomplete="off" placeholder="your fullname"
                   value="{{ old('email', '') }}">
        </label>
        <label for="password">password: </label><label>
            <input type="password" name="password" autocomplete="off" placeholder="your fullname"
                   value="{{ old('password', '') }}">
        </label>
        <button type="submit" name="submit">Submit</button>
    </form>
    <p>belum punya akun? <a href="/users/register">Register</a></p>
</div>
</body>
