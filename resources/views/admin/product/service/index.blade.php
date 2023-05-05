<head>
    <link rel="stylesheet" href="{{URL::asset('style/prodstyle.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="items-container">
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
        {{$services->links('vendor.pagination.default')}}
    </div>
@endsection

@section('left-panel')
<div class="form-container">
    <h1>Ajouter un nouveau produit:</h1> <br>
    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">nom:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>
        <label for="name">entête:</label><br>
        <input type="text" name="header" value="{{ old('header') }}"><br><br>
        <label for="name">description:</label><br>
        <textarea name="desc" id="" >{{ old('desc') }}</textarea><br><br>

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
@endsection