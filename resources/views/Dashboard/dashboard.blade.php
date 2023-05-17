<head>
    <title>joko</title>
    <link rel="stylesheet" href="{{ asset('assets/css/error.css')}}">
</head>
<body>
<h1>this is dashboard</h1>

<h1>selamat datang, {{ $user->name }}</h1>

@if(session('message'))
    <p>{{ session('message') }}</p>
@endif

<a href="/dashboard/category">category</a>
<br>
<a href="/dashboard/item">item</a>
<br>
<a href="/dashboard/transaction">transaction</a>
<br>
<a href="/users/profile">profile</a>
<br>
<a href="/users/logout">logout</a>
</body>
