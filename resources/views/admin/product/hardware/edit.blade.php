 <head>
    <link rel="stylesheet" href="{{URL::asset('style/edit-prod-style.css')}}">
    <script src="{{URL::asset('script/ckeditor/ckeditor.js')}}"></script>
 </head>
 @extends('admin.layouts.main')
 @section('main-content')
 <div class="form-container edit">
    <form action="{{ route('hardwares.update', $hardware) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="name">nom:</label><br>
        <input type="text" name="name" value="{{ old('name', $hardware->name) }}"><br><br>
        <label for="name">catégorie:</label><br>
        <input type="text" name="category" value="{{ old('category', $hardware->category) }}"><br><br>
        <label for="name">en tete:</label><br>
        <input type="text" name="header" value="{{ old('header', $hardware->header) }}"><br><br>

        <label for="name">description:</label><br>
        <textarea name="desc" class="ckeditor" cols="30" rows="10">{{ old('desc', $hardware->desc) }}</textarea><br><br>

        <label for="name">fich technique:</label><br>
        <textarea name="datasheet" class="ckeditor" cols="30" rows="10">{{ old('datasheet', $hardware->datasheet) }}</textarea><br><br>

        <script>
            const editors = document.querySelectorAll( '.ckeditor' );
            
            for (const editorItem of editors) {
                ClassicEditor
                        .create( editorItem, {
                            
                            licenseKey: '',
                        } )
                        .then( editor => {
                            window.editor = editor; 
                        } )
                        .catch( error => {
                            console.error( 'Oops, something went wrong!' );
                            //Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:
                            //Build id: 9ervub1d0yhe-9g3jsefq1ncx'
                            console.error( error );
                        } );
            }
        </script>
        <label for="name">prix:</label><br>
        <input type="number" step="0.01" name="price" placeholder="0.00" min="0" max="9999999999" value="{{ old('desc', $hardware->price) }}"><br><br>

        <label for="img">sélectionner une liste d'images:</label><br><br>
        <label for="img-input" class="custom-file-upload">Sélectionner</label>
        <input type="file" id="img-input" name="imgs[]" multiple accept="image/*" onchange="test()"><br><br>
        <div id="img-container">
            @foreach ($content as $img)
                <div class="img-item-db">
                    <a href="{{ route('hwdeleteImg', compact('hardware', 'img'))}}"><div class="delete-hover"><i class="fa-regular fa-circle-xmark"></i></div></a>
                    <img src="{{URL::asset('storage/' . $img->path)}}">
                </div>
            @endforeach
        </div>
        <script src="{{URL::asset('script/imgUploadPreview.js')}}"></script>

        

        <div class="submit-btn">
            <input class="btn" type="submit" value="Enregistrer">
        </div>
    </form>
 </div>
 @endsection
