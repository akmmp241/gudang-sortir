<h1>{{ $title }}</h1>
<div>
    <form action="/users/login" method="POST">
        @csrf
        @if(isset($error))
            <p>{{ $error }}</p>
        @endif
        <label for="oldPassword">old Password: </label><label>
            <input type="password" name="oldPassword" autocomplete="off" placeholder="old password" value="{{ old('oldPassword', '') }}">
        </label>
        <label for="newPassword">new Password: </label><label>
            <input type="password" name="newPassword" autocomplete="off" placeholder="new password" value="{{ old('newPassword', '') }}">
        </label>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
