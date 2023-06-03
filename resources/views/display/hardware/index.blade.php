@extends('layouts.website-main')
<head>
    <link rel="stylesheet" href="{{ URL::asset('css/laptops.css')}}" >
</head>
@section('title')
Matériels
@endsection
@section('content')
    
<br><br>
<div class="container">
  <div><p class="lien"><a href="{{route('main')}}">Acceuil </a>/Matériel informatiques</p></div>
    <div class="laptop-section">

        @foreach ($hardwares as $item)
            @php
                $content = $item->prod_images()->get();
                $imgPath = '';
                if(count($content) > 0){
                    $imgPath = $content[0]->path;
                }else{
                    $imgPath = 'pre_assets/img/empty-img.png';
                }
            @endphp
        <a href="{{route('hwSiteShow', $item)}}">
           <div class="laptop-card">
               <img src="{{URL::asset('storage/' . $imgPath)}}" class="laptop-img">
               <p class="nom">{{$item->name}}</p>
               <p class="prix">{{$item->price}} DA</p>
           </div>
        </a>
        @endforeach


    </div>
</div>
<script src="{{ URL::asset('js/homepage.js')}}"></script>
@endsection


