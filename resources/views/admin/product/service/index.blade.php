@extends('admin.layouts.main')
<head>
    <link rel="stylesheet" href="{{URL::asset('style/prodstyle.css')}}">
    <script src="{{URL::asset('script/ckeditor/ckeditor.js')}}"></script>
</head>

@section('main-content')

    <div class="index-header">
        <div class="search-bar">
            <form action="{{route('services.index')}}" method="get">
                <input type="search" name="search" id="search-bar" value="{{old('search')}}">
                <button type="submit">Rechercher</button>
                <a href="{{route('services.index')}}">Omettre</a>
            </form>
        </div>
        <button id="modalAddBtn">Ajouter</button>
    </div>

    <!----------------- Modal ---------------->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Ajouter un nouveau service</h2>
            </div>
            <div class="modal-body">
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="name-cat-container">
                        <div class="name">
                            <label for="name">nom:</label><br>
                            <input type="text" name="name" value="{{ old('name') }}"><br><br>
                        </div>
                    </div>

                    <label for="name">entête:</label><br>
                    <input type="text" class="prodHeader" name="header" value="{{ old('header') }}"><br><br>

                    <label for="name">description:</label><br>
                    <textarea name="desc" class="ckeditor" >{{ old('desc') }}</textarea><br><br>

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
                    <textarea name="page" id="htmlEditor" >{{ old('page' , "<!DOCTYPE html>\n<html lang='en'>\n<head>\n\t<meta charset='UTF-8'>\n\t<meta http-equiv='X-UA-Compatible' content='IE=edge'>\n\t<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n\t<style>\n\t\n\t</style>\n</head>\n<body>\n\n</body>\n</html>") }}</textarea><br><br>
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
            
                    </div>
                    <script src="{{URL::asset('script/imgUploadPreview.js')}}"></script>


                    <div class="submit-btn">
                        <input class="btn" type="submit" value="Ajouté">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("modalAddBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <!----------------- End Modal ---------------->

    <div class="items-container">
        @if (($searching && $isFound) || (!$searching))
        @foreach ($services as $svItem)
            <div class="item">
                <div class="name-container">
                    @php
                        $content = $svItem->prod_images()->get();
                        $imgPath = '';
                        if(count($content) > 0){
                            $imgPath = $content[0]->path;
                        }else{
                            $imgPath = 'pre_assets/img/empty-img.png';
                        }
                    @endphp
                    <img src="{{URL::asset('storage/' . $imgPath)}}" alt="">
                    
                </div>

                <div class="desc">
                    <a href="{{ route('svSiteShow' , $svItem) }}" target="_blank"><p>{{$svItem->name}}</p></a><br>
                    <p>{{$svItem->header}}</p>
                </div>

                <div class="timestamps-container">
                    <p>ajouté en: {{$svItem->created_at}}</p>
                    <p>mis à jour en: {{$svItem->updated_at}}</p>
                </div>
                
                <div class="btn-container">
                    <a href="{{ route('services.edit' , $svItem) }}">Modifier</a>
                    <form action="{{ route('services.destroy', $svItem) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Suprimer">
                    </form>
                </div>
            </div>    
        @endforeach
        @else
        <h1>Not found</h1>
        @endif

        @if (($searching && $isFound) || (!$searching))
        {{$services->links('vendor.pagination.default')}}
        @endif
    </div>
@endsection