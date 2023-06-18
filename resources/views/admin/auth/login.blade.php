<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('style/adm-login.css')}}">
    <title>Control Panel: Login</title>
</head>
<body>
    <h1>U-Tech Control Panel</h1>
    <div class="container">
        <form action="{{ route('login-c') }}" method="post">
            @csrf
            <label for="name">Nom d'authentification:</label><br>
            <input class="text" type="text" name="authname" id="name" placeholder="your name..."><br>
            @if ($errors->has('authname'))
                <span class="error">{{ $errors->first('authname') }}</span>
            @endif
            <br>
            <label for="password">Mot de pass:</label><br>
            <input class="text" type="password" name="password" id="password" placeholder="your password..."><br>
            @if ($errors->has('password'))
                <span class="error">{{ $errors->first('password') }}</span>
            @endif
            @if ($errors->has('login'))
            <span class="error">{{ $errors->first('login') }}</span>
            @endif
            <br><br>
            <div class="submit">
                <input type="submit" value="Log In">
            </div>
        </form>
    </div>
</body>
</html>