<head>
    <link rel="stylesheet" href="{{URL::asset('style/prodstyle.css')}}">
    <script src="{{URL::asset('script/ckeditor/ckeditor.js')}}"></script>
</head>

@extends('admin.layouts.main')
@section('main-content')

    <div class="index-header">
        <div class="search-bar">
            <form action="{{route('hardwares.index')}}" method="get">
                <input type="search" name="search" id="search-bar" value="{{old('search')}}">
                <button type="submit">Rechercher</button>
                <a href="{{route('hardwares.index')}}">Omettre</a>
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
                <h2>Ajouter un nouveau produit</h2>
            </div>
            <div class="modal-body">
                <form action="{{ route('hardwares.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="name-cat-container">
                        <div class="name">
                            <label for="name">nom:</label><br>
                            <input type="text" name="name" value="{{ old('name') }}"><br><br>
                        </div>
                        <div class="category">
                            <label for="name">catégorie:</label><br>
                            <input type="text" name="category" value="{{ old('category') }}"><br><br>
                        </div>
                    </div>

                    <label for="name">entête:</label><br>
                    <input type="text" class="prodHeader" name="header" value="{{ old('header') }}"><br><br>

                    <label for="name">description:</label><br>
                    <textarea name="desc" class="ckeditor" >{{ old('desc') }}</textarea><br><br>

                    <label for="name">fiche technique:</label><br>
                    <textarea name="datasheet" class="ckeditor">{{ old('datasheet') }}</textarea><br><br>

                    
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
                    <input type="number" step="0.01" name="price" placeholder="0.00" min="0" max="9999999999"><br><br>
                    
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
                
        
        @foreach ($hardwares as $hItem)
            <div class="item">
                <div class="name-container">
                    @php
                        $content = $hItem->prod_images()->get();
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
                    <a href="{{ route('hwSiteShow' , $hItem) }}" target="_blank"><p>{{$hItem->name}}</p></a><br>
                    <p>{{$hItem->header}}</p>
                </div>

                <div class="timestamps-container">
                    <p>ajouté en: {{$hItem->created_at}}</p>
                    <p>mis à jour en: {{$hItem->updated_at}}</p>
                </div>
                
                <div class="btn-container">
                    <a href="{{ route('hardwares.edit' , $hItem) }}">Modifier</a>
                    <form action="{{ route('hardwares.destroy', $hItem) }}" method="POST">
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
        {{$hardwares->links('vendor.pagination.default')}}
        @endif
    </div>
@endsection