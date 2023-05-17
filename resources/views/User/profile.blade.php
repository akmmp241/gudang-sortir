<head>
    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
</head>

<body>
<ul>
    <li>name: {{ $user->name }}</li>
    <li>email: {{ $user->email }}</li>
</ul>
<form action="/users/profile" method="POST">
    @csrf
    @error('error')
    <p class="error">{{ $message }}</p>
    @enderror
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <label for="name">fullname: </label><label>
        <input type="text" name="name" autocomplete="off" placeholder="your fullname"
               value="{{ $user->name ?? old('name', '') }}">
    </label>
    <label for="email">email: </label><label>
        <input type="email" name="email" autocomplete="off" placeholder="your email"
               value="{{ $user->email ?? old('email', '') }}">
    </label>
    <button type="submit" name="submit">Submit</button>
</form>

<a href="/users/update-password">change password</a>
</body>
