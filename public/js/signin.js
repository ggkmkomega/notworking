/*function validation(){
    if(document.formfill.username.value==""){
        document.getElementById("resultuser").innerHTML="saisir le nom*";
        return false;
    }
    else if(document.formfill.username.value.length<6){
        document.getElementById("resultuser").innerHTML="saisir plus de six lettre*";
        return false;
    }

    else if(document.formfill.email.value=""){
        document.getElementById("resultemail").innerHTML="saisir votre email*";
        return false;
    }

    else if(document.formfill.pwd.value=""){
        document.getElementById("resultpwd").innerHTML="saisir votre mot de passe*";
        return false;
    }

    else if(document.formfill.pwd.value.length<8){
        document.getElementById("resultpwd").innerHTML="plus de huit lettre*";
        return false;
    }

    else if(document.formfill.pwd.value!==document.formfill.cpwd.value){
        document.getElementById("resultcpwd").innerHTML="le mot de passe incorrect*";
        return false;
    }

    else if(document.formfill.cpwd.value=""){
        document.getElementById("resultcpwd").innerHTML="confirmer votre mot de passe*";
        return false;
    }
}*/

var comperror = document.getElementById('comp-error');
var emailerror = document.getElementById('email-error');
var cpwderror = document.getElementById('cpwd-error');
var pwderror = document.getElementById('pwd-error');

var complabel=document.getElementById('comp-label');
var emaillabel=document.getElementById('email-label');
var pwdlabel=document.getElementById('pwd-label');
var cpwdlabel=document.getElementById('cpwd-label');
var submiterror = document.getElementById('submit-error');


function validateemail(){
    emaillabel.style.bottom="25px";
    var email = document.getElementById('email').value;
    if(email.length == 0){
        emailerror.innerHTML = 'email est obligatoire';
        return false;
    }
    if(!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)){
        emailerror.innerHTML= ' email invalide';
        return false;
    }
    emailerror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;
}


function validatepwd(){
    
    pwdlabel.style.bottom="25px";
   var pwd=document.getElementById('pwd').value;
   if(pwd.length == 0){
    pwderror.innerHTML="le mot de passe est obligatoire";
    return false;
   }
   else{
   pwderror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;}
   
}

function validatecpwd(){
    
    cpwdlabel.style.bottom="25px";
   var cpwd=document.getElementById('cpwd').value;
   var pwd=document.getElementById('pwd').value;
   if(cpwd.length == 0){
    cpwderror.innerHTML="confirmer le mot de passe";
    return false;
   }

   if(cpwd !== pwd){
       cpwderror.innerHTML="mot de passe invalide";
       return false;
   }
   
     cpwderror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;
   
   
}


  function validateform(){
    if(!validateemail() || !validatepwd() || !validatecpwd()){
        submiterror.style.display="block";
        submiterror.innerHTML="veuiller saisir tout les champs";
        return false;
    }
  }