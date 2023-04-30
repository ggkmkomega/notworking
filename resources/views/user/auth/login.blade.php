@extends('layouts.website-main')
@section('content')
    <form action="{{route('userLogin')}}" method="post">
        @csrf
        <label for="email">email</label><br>
        <input type="email" name="email" id="email"><br><br>
        <label for="password">password</label><br>
        <input type="password" name="password" id="password"><br><br>
        <input type="submit" value="login">
    </form>
@endsection