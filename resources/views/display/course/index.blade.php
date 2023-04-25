@extends('layouts.website-main')
@section('content')
    @foreach ($categories as $cat)
        <h1>{{$cat}}</h1>
        @foreach ($hardwares as $item)
            @if ($item->category == $cat)
                <a href="{{route('hwSiteShow', $item)}}">{{$item->name}}</a><br>
            @endif
        @endforeach
    @endforeach
@endsection