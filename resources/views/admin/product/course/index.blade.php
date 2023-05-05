<head>
    <link rel="stylesheet" href="{{URL::asset('style/prodstyle.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')

    <div class="index-header">
        <div class="search-bar">
            <form action="{{route('courses.index')}}" method="get">
                <input type="search" name="search" id="search-bar" value="{{old('search')}}">
                <button type="submit">Rechercher</button>
                <a href="{{route('courses.index')}}">Omettre</a>
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
                <h2>Ajouter un nouveau course</h2>
            </div>
            <div class="modal-body">
                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
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
                    <textarea name="desc" id="" >{{ old('desc') }}</textarea><br><br>

                    <label for="name">prof:</label><br>
                    <input type="text" name="prof" value="{{ old('prof') }}"><br><br>

                    <label for="name">period:</label><br>
                    <input type="text" name="period" value="{{ old('period') }}"><br><br>
                    
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
        @foreach ($courses as $cItem)
            <div class="item">
                <div class="name-container">
                    @php
                        $content = $cItem->prod_images()->get();
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
                    <a href="{{ route('crSiteShow' , $cItem) }}" target="_blank"><p>{{$cItem->name}}</p></a><br>
                    <p>{{$cItem->header}}</p>
                </div>

                <div class="timestamps-container">
                    <p>ajouté en: {{$cItem->created_at}}</p>
                    <p>mis à jour en: {{$cItem->updated_at}}</p>
                </div>
                
                <div class="btn-container">
                    <a href="{{ route('courses.edit' , $cItem) }}">Modifier</a>
                    <form action="{{ route('courses.destroy', $cItem) }}" method="POST">
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
        {{$courses->links('vendor.pagination.default')}}
        @endif
    </div>
@endsection
