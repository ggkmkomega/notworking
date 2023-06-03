
@extends('layouts.website-main')
<head>
    <link rel="stylesheet" href="{{ URL::asset('css/logiciel.css')}}" >
</head>
@section('title')
{{$software->name}}
@endsection
@section('content')
    <br><br>
    <div class="container product">
        <div><p class="lien"><a href="index.html">Acceuil </a>/<a href="{{route('swSiteIndex')}}">Logiciels</a>/{{$software->name}}</p></div>
            <div class="box">
                @php
                    $content = $software->prod_images()->get();
                    $imgPath = '';
                    if(count($content) > 0){
                        $imgPath = $content[0]->path;
                    }else{
                        $imgPath = 'pre_assets/img/empty-img.png';
                    }
                @endphp
                <div class="images" id="imageGallery">
                    <div class="img-holder active">
                        <img src="{{URL::asset('storage/' . $imgPath)}}" onclick="addActiveClass(this)">
                    </div>
                </div>

                <div class="basic-info">
                    <h1>{{$software->name}}</h1>
                    <p class="entete">{{$software->header}}</p>
                    <div class="description">
                        @php
                            echo $software->desc;
                        @endphp
                    </div>
                    <span class="price">{{$software->price}} DA
                        @if ($software->payment == 'subscription')
                        /Mois
                        @endif
                    </span>
                    @php
                    $category = $software->prod_category;
                    $id = $software->id;
                    @endphp
                    <div>
                        <form action="{{route('addProductToList', compact('category', 'id'))}}" method="get">
                            <label>Qté</label>
                            <input style="width: 60px; height: 30px" type="number" name="volume" value="1">
                            <button type="submit" class="panier-btn">Ajouter au Panier</button>
                        </form>
                    </div>
                </div>
             
            </div>
    </div>
    <script src="{{ URL::asset('js/pc.js')}}"></script>
