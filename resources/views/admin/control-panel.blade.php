@extends('admin.layouts.main')
@section('main-content')
    <p>hello {{$admin->name . $admin->id}}</p>
@endsection