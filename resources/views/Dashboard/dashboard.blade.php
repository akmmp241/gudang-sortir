<h1>this is dashboard</h1>

<h1>selamat datang, {{ $user->name }}</h1>

@if(session('message'))
    <p>{{ session('message') }}</p>
@endif

<a href="/dashboard/category">category</a>
<br>
<a href="/users/profile">profile</a>
<br>
<a href="/users/logout">logout</a>
