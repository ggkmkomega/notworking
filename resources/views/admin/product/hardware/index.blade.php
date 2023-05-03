<head>
    <link rel="stylesheet" href="{{URL::asset('style/prodstyle.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="items-container">
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
        
        {{$hardwares->links('vendor.pagination.default')}}
    </div>
@endsection

@section('left-panel')
<div class="form-container">
    <h1>Ajouter un nouveau produit:</h1> <br>
    <form action="{{ route('hardwares.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">nom:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>
        <label for="name">entête:</label><br>
        <input type="text" name="header" value="{{ old('header') }}"><br><br>
        <label for="name">description:</label><br>
        <textarea name="desc" id="" >{{ old('desc') }}</textarea><br><br>
        <label for="name">fiche technique:</label><br>
        <textarea name="datasheet" class="widgEditor" id="myTextarea">{{ old('datasheet') }}</textarea><br><br>
        
        <label for="name">catégorie:</label><br>
        <input type="text" name="category" value="{{ old('category') }}"><br><br>

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