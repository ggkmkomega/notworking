<head>
    <link rel="stylesheet" href="{{URL::asset('style/show-product.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="show-wrapper">
        <div class="items-container">
            <h1>{{$service->name}}</h1><br>
            <h3>{{$service->header}}</h3><br>
            <p>{{$service->desc}}</p><br>
            <iframe srcdoc="{{$service->page}}" frameborder="0" sandbox="allow-forms allow-popups"></iframe>
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
