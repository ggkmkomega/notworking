@extends('user.user-dashboard')

@section('section-content')
    <div class="mailnpw">
        <div class="input-section mail">
            <h3>Email</h3>
            <form action="{{route("updateUserEmail")}}" method="post">
                @csrf

                @php
                    $hiddenEmail = preg_replace('/(?<=.{3})(.*)(?=@)/', '***', $user->email);
                    $user = Auth::user();

                    
                @endphp

                @if ($user->hasVerifiedEmail())
                    <p>Email verifié <i class="fa-solid fa-circle-check"></i></p>
                @else
                <a href="{{route('resendVerificationMail')}}">Resend Verification Email</a>
                @endif
                
                <div><input type="email" name="email" id="email"  value="{{$hiddenEmail}}"></div>
                

                <button type="submit" id="mailSave" class="send-btn">Sauvegarder</button>
            </form>
            <button id="mailEditBtn" class="send-btn">Modifier</button>
        </div>

        <div class="input-section pw">
            <h3>Mot de Passe</h3>
            <form action="{{route("updateUserPassword")}}" method="post">
                @csrf
                <label for="pw">Ancien Mot de Passe</label><br>
                <div><input type="password" name="old_password" id="" placeholder="*************"></div>

                <div class="new_pw">
                    <label for="pw">Nouveau Mot de Passe</label><br>
                    <div><input type="password" name="new_password" id="new_password"></div>
    
                    <label for="pw">Re-taper le Nouveau Mot de Passe</label><br>
                    <div><input type="password" id="re_new_password"></div>
                </div>

                <button type="submit" id="pwSave" class="send-btn">Sauvegarder</button>
            </form>
            <button id="pwEditBtn" class="send-btn">Modifier</button>
        </div>
    </div>
    <br><hr><br>
    <div class="input-section others">
        <h3>General</h3><br>
        <form action="{{route("updateUserInfo")}}" method="post">
            @csrf
            <label for="">Nom:</label><br>
            <div><input style="width: 100%" type="text" name="fname" id="" value="{{$user->fname}}"></div>

            <label for="">Prénom:</label><br>
            <div><input style="width: 100%" type="text" name="lname" id="" value="{{$user->lname}}"></div>

            <label for="">Entreprise:</label><br>
            <div><input style="width: 100%" type="text" name="company" id="" value="{{$user->company}}"></div>

            <label for="">Pays:</label><br>
            <div><input style="width: 100%" type="text" name="country" id="" value="{{$user->country}}"></div>

            <label for="">Ville:</label><br>
            <div><input style="width: 100%" type="text" name="city" id="" value="{{$user->city}}"><br></div>

            <label for="">Adress:</label><br>
            <div><input style="width: 100%" type="text" name="adress" id="" value="{{$user->adress}}"></div>

            <label for="">Code ZIP:</label><br>
            <div><input style="width: 100%" type="number" name="zip" id="" value="{{$user->zip}}"></div>

            <label for="">Téléphone:</label><br>
            <div><input style="width: 100%" type="text" name="phone" id="" value="{{$user->phone}}"></div>

            <button type="submit" id="genSave" class="send-btn">Sauvegarder</button>
        </form>
        <button id="genEditBtn" class="send-btn">Modifier</button>
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
                reNewPwInput.style.backgroundColor = '#84fab5   ';
                pwSaveBtn.removeAttribute('disabled');
            }else{
                reNewPwInput.style.backgroundColor = '#fa8484';
                if(!pwSaveBtn.hasAttribute('disabled')){
                    pwSaveBtn.setAttribute('disabled', '');
                }
            }
        }
        

    </script>
@endsection