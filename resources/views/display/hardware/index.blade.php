<head>
    <link rel="stylesheet" href="{{URL::asset('style/indexProducts.css')}}">
    <script src="{{ URL::asset('script/indexByCategory.js')}}" defer></script>
</head>

@extends('layouts.website-main')
@section('content')
    <div class="wrapper">
        <div class="category-container">
            @foreach ($categories as $cat)
                <div class="btn-cat {{$cat}}">
                    <p>{{$cat}}</p>
                </div>
            @endforeach
        </div>
        <div class="items-container">
            @foreach ($categories as $cat)
                @foreach ($hardwares as $item)
                    @if ($item->category == $cat)
                    
                        <div class="item-container {{$cat}}">
                            <a href="{{route('hwSiteShow', $item)}}">
                            <div>
                                @php
                                    $content = $item->prod_images()->get();
                                    $imgPath = '';
                                    if(count($content) > 0){
                                        $imgPath = $content[0]->path;
                                    }else{
                                        $imgPath = 'pre_assets/img/empty-img.png';
                                    }
                                @endphp
                                <img src="{{URL::asset('storage/' . $imgPath)}}" alt="">
                                <h1>{{$item->name}}</h1>
                                <p>{{$item->header}}</p>
                            </div>
                            </a>
                        </div>
                    
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
    
@endsection