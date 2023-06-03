<head>
    <link rel="stylesheet" href="{{ URL::asset('style/search.css')}}">
</head>
@extends('layouts.website-main')
@section('content')
    <br><br><br>
    <div class="search-wrapper">
        @if ($isFound)
            @if ($hwProductsList->isNotEmpty())
                <h1>Materiels</h1>
                @foreach ($hwProductsList as $item)
                    <a href="{{route('hwSiteShow', $item)}}">{{$item->name}}</a>
                @endforeach
                <br><br>
            @endif
    
            @if ($swProductsList->isNotEmpty())
                <h1>Logiciels</h1>
                @foreach ($swProductsList as $item)
                <a href="{{route('swSiteShow', $item)}}">{{$item->name}}</a>
                @endforeach
                <br><br>
            @endif
    
            @if ($crProductsList->isNotEmpty())
                <h1>Formations</h1>
                @foreach ($crProductsList as $item)
                <a href="{{route('crSiteShow', $item)}}">{{$item->name}}</a>
                @endforeach
                <br><br>
            @endif
    
            @if ($svProductsList->isNotEmpty())
                <h1>Services</h1>
                @foreach ($svProductsList as $item)
                <a href="{{route('svSiteShow', $item)}}">{{$item->name}}</a>
                @endforeach
            @endif
            
        @else
        <h1><i class="fa-solid fa-triangle-exclamation fa-shake fa-2xl"></i> Rien n'a été trouvé</h1>
        @endif
    </div>
@endsection