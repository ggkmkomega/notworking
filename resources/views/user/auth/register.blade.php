@extends('layouts.website-main')
@section('content')
    <form action="{{route('userRegister')}}" method="post">
        @csrf
        <label for="fname">first name</label><br>
        <input type="text" name="fname" id="fname"><br><br>

        <label for="lname">last name</label><br>
        <input type="text" name="lname" id="lname"><br><br>

        <label for="company">company</label><br>
        <input type="text" name="company" id="company"><br><br>

        <label for="country">country</label><br>
        <input type="text" name="country" id="country"><br><br>

        <label for="city">city</label><br>
        <input type="text" name="city" id="city"><br><br>

        <label for="zip">zip</label><br>
        <input type="number" name="zip" id="zip" min="0" max="999999999999"><br><br>

        <label for="adress">adress</label><br>
        <input type="text" name="adress" id="adress"><br><br>

        <label for="adress">phone</label><br>
        <input type="tel" name="phone" id="phone"><br><br>

        <label for="email">email</label><br>
        <input type="email" name="email" id="email"><br><br>

        <label for="password">password</label><br>
        <input type="password" name="password" id="password"><br><br>

        <input type="submit" value="Register">
    </form>
@endsection