@extends('layouts.website-main')
<head>
  <link rel="stylesheet" href="{{ URL::asset('css/pc.css')}}" >
</head>
@section('title')
{{$hardware->name}}
@endsection
@section('content')
    <br><br>
    <div class="container product">
        <div><p class="lien"><a href="{{route('main')}}">Acceuil </a>/<a href="laptops.html">Laptops</a>/{{$hardware->name}}</p></div>
         <div class="box">
             <div class="images" id="imageGallery">
                 <div class="img-holder active">
                    <img src="{{URL::asset('storage/' . $content[0]->path)}}" onclick="addActiveClass(this)">
                 </div>
                @for ($i = 1; $i < $content->count(); $i++)
                    <div class="img-holder ">
                        <img src="{{URL::asset('storage/' . $content[$i]->path)}}" onclick="addActiveClass(this)">
                    </div>   
                @endfor
                 
              
             </div>

             <div class="basic-info">
                    <h1>{{$hardware->name}}</h1>
                    <p class="entete">{{$hardware->header}}</p>
                    <div class="description">
                        @php
                            echo $hardware->desc;
                        @endphp
                    </div>
                    <span class="price">{{$hardware->price}} DA</span>
                    @php
                    $category = $hardware->prod_category;
                    $id = $hardware->id;
                    @endphp
                    <div>
                        <form action="{{route('addProductToList', compact('category', 'id'))}}" method="get">
                            <label>Qté</label>
                            <input style="width: 60px; height: 30px" type="number" name="volume" value="1">
                            <button type="submit" class="panier-btn">Ajouter au Panier</button>
                        </form>
                    </div>
             </div>
             <p class="fiche">La fiche technique <i class="fa-sharp fa-solid fa-caret-down fa-xs dropicon" onclick="displayfichetech()"  ></i></p>
             <div id="fiche-technique">
                @php
                    echo $hardware->datasheet;
                @endphp
             </div>
         </div>
    </div>
    <script src="{{ URL::asset('js/pc.js')}}"></script>
</body>
</html>