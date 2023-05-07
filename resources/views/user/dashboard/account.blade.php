@extends('user.user-dashboard')

@section('section-content')
    <div class="mailnpw">
        <div class="mail">
            <h3>Email</h3>
            <form action="{{route("updateUserEmail")}}" method="post">
                @csrf

                @php
                    $hiddenEmail = preg_replace('/(?<=.{3})(.*)(?=@)/', '***', $user->email);
                @endphp

                <a href="{{route('resendVerificationMail')}}">Resend Verification Email</a> 

                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" value="{{$hiddenEmail}}"><br><br>
                

                <button type="submit" id="mailSave">Sauvegarder</button>
            </form>
            <button id="mailEditBtn">Modifier</button>
        </div>

        <div class="pw">
            <h3>Mot de Passe</h3>
            <form action="{{route("updateUserPassword")}}" method="post">
                @csrf
                <label for="pw">Ancien Mot de Passe</label><br>
                <input type="password" name="old_password" id="" placeholder="*************"><br><br>

                <div class="new_pw">
                    <label for="pw">Nouveau Mot de Passe</label><br>
                    <input type="password" name="new_password" id="new_password"><br><br>
    
                    <label for="pw">Re-taper le Nouveau Mot de Passe</label><br>
                    <input type="password" id="re_new_password"><br><br>
                </div>

                <button type="submit" id="pwSave">Sauvegarder</button>
            </form>
            <button id="pwEditBtn">Modifier</button>
        </div>
    </div>
    <br><hr><br>
    <div class="others">
        <h3>General</h3><br>
        <form action="{{route("updateUserInfo")}}" method="post">
            @csrf
            <label for="">Nom</label><br>
            <input type="text" name="fname" id="" value="{{$user->fname}}"><br><br>

            <label for="">Prénom</label><br>
            <input type="text" name="lname" id="" value="{{$user->lname}}"><br><br>

            <label for="">Entreprise</label><br>
            <input type="text" name="company" id="" value="{{$user->company}}"><br><br>

            <label for="">Pays</label><br>
            <input type="text" name="country" id="" value="{{$user->country}}"><br><br>

            <label for="">Ville</label><br>
            <input type="text" name="city" id="" value="{{$user->city}}"><br><br>

            <label for="">Adress</label><br>
            <input type="text" name="adress" id="" value="{{$user->adress}}"><br><br>

            <label for="">Code ZIP</label><br>
            <input type="number" name="zip" id="" value="{{$user->zip}}"><br><br>

            <label for="">Téléphone</label><br>
            <input type="text" name="phone" id="" value="{{$user->phone}}"><br><br>

            <button type="submit" id="genSave">Sauvegarder</button>
        </form>
        <button id="genEditBtn">Modifier</button>
    </div>

    <script>
        const genInputList = document.querySelectorAll('.content .others input');
        const genEditBtn = document.getElementById('genEditBtn');

        const mailInputList = document.querySelectorAll('.content .mail input');
        const mailEditBtn = document.getElementById('mailEditBtn');

        const pwInputList = document.querySelectorAll('.content .pw input');
        const pwEditBtn = document.getElementById('pwEditBtn');
        const pwSaveBtn = document.getElementById('pwSave');


        //onload

        document.getElementById('genSave').style.display = 'none';
        for (const input of genInputList) {
            input.setAttribute('readonly', '');
        }

        document.getElementById('mailSave').style.display = 'none';
        for (const input of mailInputList) {
            input.setAttribute('readonly', '');
        }

        pwSaveBtn.style.display = 'none';
        document.querySelector('.mailnpw .pw .new_pw').style.display = 'none';
        for (const input of pwInputList) {
            input.setAttribute('readonly', '');
        }


        //onedit

        genEditBtn.onclick = function () {
            for (const input of genInputList) {
                input.removeAttribute('readonly');
            }

            document.getElementById('genSave').style.display = 'inline-block';
            genEditBtn.style.display = 'none';
        };

        mailEditBtn.onclick = function () {
            for (const input of mailInputList) {

                if(input.id == 'email'){

                    input.removeAttribute('readonly');
                    input.value = '{{$user->email}}';
                }
            }

            document.getElementById('mailSave').style.display = 'inline-block';
            mailEditBtn.style.display = 'none';
        };

        pwEditBtn.onclick = function () {
            for (const input of pwInputList) {
                input.removeAttribute('readonly');
            }
            document.querySelector('.mailnpw .pw .new_pw').style.display = 'block';
            pwSaveBtn.style.display = 'inline-block';
            pwSaveBtn.setAttribute('disabled', '');
            pwEditBtn.style.display = 'none';
        };
        
        newPwInput = document.getElementById('new_password');
        reNewPwInput = document.getElementById('re_new_password');
        reNewPwInput.oninput = function () {
            if(reNewPwInput.value == newPwInput.value)
            {
                reNewPwInput.style.borderColor = 'green';
                pwSaveBtn.removeAttribute('disabled');
            }else{
                reNewPwInput.style.borderColor = 'red';
                if(!pwSaveBtn.hasAttribute('disabled')){
                    pwSaveBtn.setAttribute('disabled', '');
                }
            }
        }
        

    </script>
@endsection