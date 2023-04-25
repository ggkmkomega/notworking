@extends('layouts.website-main')
@section('content')
    <div class="show-wrapper">
        <div class="items-container">
            <h1>{{$hardware->name}}</h1>
            <h2>{{$hardware->category}}</h2>
            <h3>{{$hardware->header}}</h3>
            @php
                echo $hardware->desc;
            @endphp
            <br>
            @php
                echo $hardware->datasheet;
            @endphp
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