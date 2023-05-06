 <head>
    <link rel="stylesheet" href="{{URL::asset('style/edit-prod-style.css')}}">
    <script src="{{URL::asset('script/ckeditor/ckeditor.js')}}"></script>
 </head>
 @extends('admin.layouts.main')
 @section('main-content')
 <div class="form-container edit">
    <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="name">nom:</label><br>
        <input type="text" name="name" value="{{ old('name', $service->name) }}"><br><br>
        <label for="name">en tete:</label><br>
        <input type="text" name="header" value="{{ old('header', $service->header) }}"><br><br>
        <label for="name">description:</label><br>
        <textarea name="desc" class="ckeditor" cols="30" rows="10">{{ old('desc', $service->desc) }}</textarea><br><br>
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

        <label for="name">page HTML:</label><br>
        <textarea name="page" id="htmlEditor" cols="30" rows="10">{{ old('desc', $service->page) }}</textarea><br><br>
        <script>
            const textarea = document.getElementById('htmlEditor');
          
            textarea.addEventListener('keydown', (event) => {
              if (event.key === 'Tab') {
                event.preventDefault();
                const start = textarea.selectionStart;
                const end = textarea.selectionEnd;
          
                // insert tab character at current cursor position
                textarea.value = textarea.value.substring(0, start) + '\t' + textarea.value.substring(end);
          
                // set cursor position after the inserted tab character
                textarea.selectionStart = textarea.selectionEnd = start + 1;
              }
            });
        </script>
        

        <label for="img">sélectionner une liste d'images:</label><br><br>
        <label for="img-input" class="custom-file-upload">Sélectionner</label>
        <input type="file" id="img-input" name="imgs[]" multiple accept="image/*" onchange="test()"><br><br>
        <div id="img-container">
            @foreach ($content as $img)
                <div class="img-item-db">
                    <a href="{{ route('swdeleteImg', compact('service', 'img'))}}"><div class="delete-hover"><i class="uil uil-minus"></i></div></a>
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
