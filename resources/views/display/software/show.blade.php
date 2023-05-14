<head>
    <link rel="stylesheet" href="{{URL::asset('style\displayProduct.css')}}">
    <script src="{{URL::asset('script/picShowcase.js')}}" defer></script>
</head>
@extends('layouts.website-main')
@section('content')
    <div class="show-wrapper">
        <div class="page-container">
            <h1>{{$software->name}}</h1>
            <h3>{{$software->category}}</h3>
            <div class="main-container">
                <div class="pic-display">
                    <div class="showcasedImg">
                        <img class="showcased" src="">
                    </div>
                        <div class="thumbs">
                            @foreach ($content as $img )
                                <img class="nSel" src='{{URL::asset('storage/' . $img->path)}}' alt="">
                            @endforeach
                        </div>
                        
                </div>
                <div class="prod-info">
                    <div class="prod-head">
                        <p>{{$software->header}}</p>
                    </div>
                    <div class="prod-desc">
                        @php
                            echo $software->desc;
                        @endphp
                    </div>
                </div>
            </div>
            <div class="buy-container">
                <h1>{{$software->price}}
                    <span style="font-size:small;">
                        DZD
                    @if ($software->payment == 'subscription')
                        /Mo
                    @endif
                    </span>
                </h1>
                @php
                    $category = $software->prod_category;
                    $id = $software->id;
                @endphp
                <form action="{{route('addProductToList', compact('category', 'id'))}}" method="get">
                    <label>Number of Licences</label><br>
                    <input type="number" name="volume"><br><br>
                    <input type="submit" value="Place Order">
                </form>
            </div>
        </div>
    </div>
@endsection