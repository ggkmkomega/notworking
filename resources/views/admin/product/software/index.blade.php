<head>
    <link rel="stylesheet" href="{{URL::asset('style/prodstyle.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="items-container">
        @foreach ($softwares as $sItem)
            <div class="item">
                <div class="name-container">
                    @php
                        $content = $sItem->prod_images()->get();
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
                    <a href="{{ route('softwares.show' , $sItem) }}"><p>{{$sItem->name}}</p></a><br>
                    <p>{{$sItem->header}}</p>
                </div>

                <div class="timestamps-container">
                    <p>ajouté en: {{$sItem->created_at}}</p>
                    <p>mis à jour en: {{$sItem->updated_at}}</p>
                </div>
                
                <div class="btn-container">
                    <a href="{{ route('softwares.edit' , $sItem) }}">Modifier</a>
                    <form action="{{ route('softwares.destroy', $sItem) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Suprimer">
                    </form>
                </div>
            </div>    
        @endforeach
    </div>
@endsection

@section('left-panel')
<div class="form-container">
    <h1>Ajouter un nouveau produit:</h1> <br>
    <form action="{{ route('softwares.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">nom:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>
        <label for="name">entête:</label><br>
        <input type="text" name="header" value="{{ old('header') }}"><br><br>
        <label for="name">description:</label><br>
        <textarea name="desc" id="" >{{ old('desc') }}</textarea><br><br>
        <label for="name">type de paiement:</label><br>
        <select name="payment" id="payment">
            <option value="" selected disabled hidden>sélectioner un type</option>
            <option value="subscription">Abonnement</option>
            <option value="one-time">Paiement Unique </option>
        </select><br><br>
        <label for="name">prix:</label><br>
        <input type="number" step="0.01" name="price" placeholder="0.00" min="0" max="9999999999"><br><br>
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