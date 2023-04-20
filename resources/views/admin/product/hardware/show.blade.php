<head>
    <link rel="stylesheet" href="{{URL::asset('style/show-product.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="show-wrapper">
        <div class="items-container">
            <h1>{{$hardware->name}}</h1><br>
            <h3>{{$hardware->header}}</h3><br>
            <p>{{$hardware->desc}}</p><br>
            <p>{{$hardware->datasheet}}</p><br>
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