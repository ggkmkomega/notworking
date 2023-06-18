@extends('admin.layouts.main')
<head>
    <link rel="stylesheet" href="{{ URL::asset('style/profile.css')}}">
</head>
@section('main-content')

<div class="profile-wrapper">
    <div class="profile_pic">
        <img src="{{ URL::asset('assets/img/user.png')}}" alt="">
    </div>
    <div class="info">
        <h1>{{$admin->fname .' '. $admin->lname}}</h1>
        <h2>Accès: {{$admin->role}}</h2>
        <h3>Créé le: {{$admin->created_at}}</h3>
    </div>
</div>
@endsection
