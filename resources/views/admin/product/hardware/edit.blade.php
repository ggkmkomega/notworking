 <head>
    <link rel="stylesheet" href="{{URL::asset('style/prodstyle.css')}}">
 </head>
 @extends('admin.layouts.main')
 @section('main-content')
 <div class="form-container edit">
    <form action="{{ route('hardwares.update', $hardware) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="name">nom:</label><br>
        <input type="text" name="name" value="{{ old('name', $hardware->name) }}"><br><br>
        <label for="name">en tete:</label><br>
        <input type="text" name="header" value="{{ old('header', $hardware->header) }}"><br><br>
        <label for="name">description:</label><br>
        <textarea name="desc" id="" cols="30" rows="10">{{ old('desc', $hardware->desc) }}</textarea><br><br>
        <label for="name">fich technique:</label><br>
        <textarea name="datasheet" id="" cols="30" rows="10">{{ old('datasheet', $hardware->datasheet) }}</textarea><br><br>
        

        <label for="img">sélectionner une liste d'images:</label><br><br>
        <label for="img-input" class="custom-file-upload">Sélectionner</label>
        <input type="file" id="img-input" name="imgs[]" multiple accept="image/*" onchange="test()"><br><br>
        <div id="img-container">
            @foreach ($content as $img)
                <div class="img-item-db">
                    <a href="{{ route('hwdeleteImg', compact('hardware', 'img'))}}"><div class="delete-hover"><i class="uil uil-minus"></i></div></a>
                    <img src="{{URL::asset('storage/' . $img->path)}}">
                </div>
            @endforeach
        </div>
        <script src="{{URL::asset('script/imgUploadPreview.js')}}"></script>

        <label for="name">catégorie:</label><br>
        <input type="text" name="category" value="{{ old('category', $hardware->category) }}"><br><br>

        <div class="submit-btn">
            <input class="btn" type="submit" value="Enregistrer">
        </div>
    </form>
 </div>
 @endsection
