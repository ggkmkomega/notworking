<head>
    <link rel="stylesheet" href="{{URL::asset('style/show-product.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="show-wrapper">
        <div class="items-container">
            <h1>{{$software->name}}</h1><br>
            <p>{{$software->category}}</p><br>
            <h3>{{$software->header}}</h3><br>
            <p>{{$software->desc}}</p><br>
            <p>{{$software->payment}}</p><br>
            <p>{{$software->price}}</p><br>
            <div class="img-container">
                @foreach ($content as $img )
                    <div class="img-item">
                        <img src='{{URL::asset('storage/' . $img->path)}}' alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection