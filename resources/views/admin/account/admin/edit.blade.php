<head>

</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="items-container">
        <form action="{{route('admins.update', $admin)}}" method="post">
            <div class="edit-header">
                <input type="submit" value="Enregister">
            </div>
            <div>
                @csrf
                @method('put')
                <label for="fname">first name</label><br>
                <input type="text" name="fname" id="fname" value="{{ old('fname', $admin->fname) }}"><br><br>

                <label for="lname">last name</label><br>
                <input type="text" name="lname" id="lname" value="{{ old('lname', $admin->lname) }}"><br><br>

                <label for="company">nom d'auth</label><br>
                <input type="text" name="authname" id="authname" value="{{ old('authname', $admin->authname) }}"><br><br>

                <label for="country">role</label><br>
                <input type="text" name="role" id="role" value="{{ old('role', $admin->role) }}"><br><br>

                <label for="email">email</label><br>
                <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}"><br><br>

                
            </div>
        </form>
    </div>
@endsection