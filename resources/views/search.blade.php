@extends('layouts.website-main')
@section('content')

    @if ($isFound)
        @if ($hwProductsList->isNotEmpty())
            <h1>Hardwares</h1>
            @foreach ($hwProductsList as $item)
                <p>{{$item->name}}</p>
            @endforeach
            <br><br>
        @endif

        @if ($swProductsList->isNotEmpty())
            <h1>Softwares</h1>
            @foreach ($swProductsList as $item)
                <p>{{$item->name}}</p>
            @endforeach
            <br><br>
        @endif

        @if ($crProductsList->isNotEmpty())
            <h1>Courses</h1>
            @foreach ($crProductsList as $item)
                <p>{{$item->name}}</p>
            @endforeach
            <br><br>
        @endif

        @if ($svProductsList->isNotEmpty())
            <h1>services</h1>
            @foreach ($svProductsList as $item)
                <p>{{$item->name}}</p>
            @endforeach
        @endif
        
    @else
        <h1>Nothing Found</h1>
    @endif
@endsection