<head>
    <link rel="stylesheet" href="{{URL::asset('style/show-product.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="show-wrapper">
        <div class="items-container">
            <h1>{{$course->name}}</h1><br>
            <h3>{{$course->header}}</h3><br>
            <p>{{$course->desc}}</p><br>
            <p>{{$course->prof}}</p><br>
            <p>{{$course->period}}</p><br>
            <p>{{$course->price}}</p><br>
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