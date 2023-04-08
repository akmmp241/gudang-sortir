<h1>{{ $title }}</h1>
<div>
    <form action="/users/register" method="POST">
        @csrf
        @error('error')
        <p>{{ $message }}</p>
        @enderror
        <label for="name">fullname: </label><label>
            <input type="text" name="name" autocomplete="off" placeholder="your fullname" value="{{ old('name', '') }}">
        </label>
        <label for="email">email: </label><label>
            <input type="email" name="email" autocomplete="off" placeholder="your fullname"
                   value="{{ old('email', '') }}">
        </label>
        <label for="password">password: </label><label>
            <input type="password" name="password" autocomplete="off" placeholder="your fullname"
                   value="{{ old('password', '') }}">
        </label>
        <label for="confirm">confirm: </label><label>
            <input type="password" name="confirm" autocomplete="off" placeholder="your fullname"
                   value="{{ old('confirm', '') }}">
        </label>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
