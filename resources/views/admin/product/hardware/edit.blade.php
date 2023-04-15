<form action="{{ route('hardwares.update', $hardware) }}" method="POST">
    @csrf
    @method('patch')
    <label for="name">nom:</label><br>
    <input type="text" name="name" value="{{ old('name', $hardware->name) }}"><br><br>
    <label for="name">en tete:</label><br>
    <input type="text" name="header" value="{{ old('header', $hardware->header) }}"><br><br>
    <label for="name">description:</label><br>
    <textarea name="desc" id="" cols="30" rows="10">{{ old('desc', $hardware->desc) }}</textarea><br><br>
    <label for="name">fich technique:</label><br>
    <textarea name="datasheet" id="" cols="30" rows="10">{{ old('datasheet', $hardware->datasheet) }}</textarea><br><br>
    <label for="name">catégorie:</label><br>
    <input type="text" name="category" value="{{ old('category', $hardware->category) }}"><br><br>
    <input type="submit" value="Enregistrer">
</form>
<div class="content">