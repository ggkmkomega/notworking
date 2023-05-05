@extends('admin.layouts.main')
@section('main-content')
    <p>hello {{$admin->fname .' '. $admin->lname}}</p>
@endsection