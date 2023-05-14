<head>
    <link rel="stylesheet" href="{{URL::asset('style\displayProduct.css')}}">
    <script src="{{URL::asset('script/picShowcase.js')}}" defer></script>
</head>
@extends('layouts.website-main')
@section('content')
    <div class="show-wrapper">
        <div class="page-container">
            <h1>{{$hardware->name}}</h1>
            <h3>{{$hardware->category}}</h3>
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
                        <p>{{$hardware->header}}</p>
                    </div>
                    <div class="prod-desc">
                        @php
                            echo $hardware->desc;
                        @endphp
                    </div>
                </div>
            </div>
            <div class="more-btn">
                <p>Display Product Datasheet</p>
            </div>
            
            <div class="datasheet">
                @php
                    echo $hardware->datasheet;
                @endphp
            </div>

            <script>
                
                const moreBtn = document.querySelector('.more-btn');
                const datasheet = document.querySelector('.datasheet');
                moreBtn.addEventListener('click', () => {
                    datasheet.classList.toggle('display');
                })
            </script>
        </div>
        @php
                    $category = $hardware->prod_category;
                    $id = $hardware->id;
                @endphp
        <form action="{{route('addProductToList', compact('category', 'id'))}}" method="get">
            <label>Volume:</label><br>
            <input type="number" name="volume"><br><br>
            <input type="submit" value="Place Order">
        </form>
    </div>
@endsection