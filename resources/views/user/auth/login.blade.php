<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Se connecter</title>
</head>
<body>
    <form action="{{route('userLogin')}}" method="post">

    <form>
        @csrf
        <div class="wrapper">
          <h1>Se connecter</h1>
          <div class="input-data">
             <input type="text" name="email" required id="email" onkeyup="validateemail()">
             <div class="underline"></div>
             <label id="email-label"> <i class="fa-solid fa-envelope iconemail"></i> Email</label>
             <span id="email-error"></span>
          </div>
        
          <div class="input-data">
            <input type="password" name="password" required id="pwd" onkeyup="return validatepwd()">
            <div class="underline"></div>
            <label id="pwd-label"><i class="fa-solid fa-lock icon"></i> mot de passe</label>
            <span id="pwd-error"></span>
         </div>
        
        
         <div class="pass"><a>Mot de passe oublié?</a></div>
         <input type="submit" name="" value="Se connecter" onclick="return validateform()">
         @if ($errors->has('login'))
            <span id="submit-error">{{ $errors->first('login') }}</span>
        @endif
        
        <div class="signin_lnk">
            pas de compte? <a href="{{route('registerForm')}}">S'inscrire</a>
        </div>
        </div>
        </form>
        <script src="{{ URL::asset('js/login.js')}}"></script>
    </body>
    </html>