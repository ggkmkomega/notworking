
@extends('layouts.website-main')
<head>
  <link rel="stylesheet" href="{{ URL::asset('css/f-vmware.css')}}">
</head>
@section('title')
{{$course->name}}
@endsection
@section('content')
    <br><br>
        <div class="container vmware-info">
                 
                <img src="{{URL::asset('storage/' . $content[0]->path)}}" class=" vmware-photo">
                <h1>{{$course->name}}</h1>
                <h2>{{$course->header}}</h2>
                @php
                    echo $course->desc;
                @endphp

                @php
                    $category = $course->prod_category;
                    $id = $course->id;
                @endphp
                <br>
                <form action="{{route('addProductToList', compact('category', 'id'))}}" method="get">
                    <label>Nombre de licences</label>
                    <input type="number" name="volume" value="1" style="width: 30px">
                    <input type="submit" value="Ajouter au panier">
                </form>
               
        </div>
