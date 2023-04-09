<ul>
    <li>name: {{ $user->name }}</li>
    <li>email: {{ $user->email }}</li>
</ul>

<form action="/users/profile" method="POST">
    @csrf
    <label for="name">fullname: </label><label>
        <input type="text" name="name" autocomplete="off" placeholder="your fullname" value="{{ $user->name ?? old('name', '') }}">
    </label>
    <label for="email">email: </label><label>
        <input type="email" name="email" autocomplete="off" placeholder="your email"
               value="{{ $user->email ?? old('email', '') }}">
    </label>
    <button type="submit" name="submit">Submit</button>
</form>

<a href="/users/update-password">change password</a>
