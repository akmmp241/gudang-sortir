<form action="/dashboard/category/update-category/{{ $category->category_id }}" method="POST">
    @csrf
    @error('error')
        <p>{{ $message }}</p>
    @enderror
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <input type="text" name="name_category" id="nameCategory" value="{{ request()->old('name_category', '') }}" autocomplete="off" placeholder="nama kategori">
    <br>
    <input type="text" name="description" id="description" value="{{ request()->old('description', '') }}" autocomplete="off" placeholder="deskripsi (optional)">
    <br>
    <input type="submit" name="submit" id="submit">
</form>
