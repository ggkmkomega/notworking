<form action="{{ route('hardwares.store') }}" method="POST">
    @csrf
    <label for="name">nom:</label><br>
    <input type="text" name="name" value="{{ old('name') }}"><br><br>
    <label for="name">en tete:</label><br>
    <input type="text" name="header" value="{{ old('header') }}"><br><br>
    <label for="name">description:</label><br>
    <textarea name="desc" id="" cols="30" rows="10">{{ old('desc') }}</textarea><br><br>
    <label for="name">fich technique:</label><br>
    <textarea name="datasheet" id="" cols="30" rows="10">{{ old('datasheet') }}</textarea><br><br>
    <label for="name">catégorie:</label><br>
    <input type="text" name="category" value="{{ old('category') }}"><br><br>
    <input type="submit" value="Ajouté">
</form>