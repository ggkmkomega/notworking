<head>

</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="items-container">
        <form action="{{route('users.update', $user)}}" method="post">
            <div class="edit-header">
                <input type="submit" value="Enregister">
            </div>
            <div>
                @csrf
                @method('put')
                <label for="fname">first name</label><br>
                <input type="text" name="fname" id="fname" value="{{ old('name', $user->fname) }}"><br><br>

                <label for="lname">last name</label><br>
                <input type="text" name="lname" id="lname" value="{{ old('name', $user->lname) }}"><br><br>

                <label for="company">company</label><br>
                <input type="text" name="company" id="company" value="{{ old('name', $user->company) }}"><br><br>

                <label for="country">country</label><br>
                <input type="text" name="country" id="country" value="{{ old('name', $user->country) }}"><br><br>

                <label for="city">city</label><br>
                <input type="text" name="city" id="city" value="{{ old('name', $user->city) }}"><br><br>

                <label for="zip">zip</label><br>
                <input type="number" name="zip" id="zip" min="0" max="999999999999" value="{{ old('name', $user->zip) }}"><br><br>

                <label for="adress">adress</label><br>
                <input type="text" name="adress" id="adress" value="{{ old('name', $user->adress) }}"><br><br>

                <label for="adress">phone</label><br>
                <input type="tel" name="phone" id="phone" value="{{ old('name', $user->phone) }}"><br><br>

                <label for="email">email</label><br>
                <input type="email" name="email" id="email" value="{{ old('name', $user->email) }}"><br><br>

                
            </div>
        </form>
    </div>
@endsection