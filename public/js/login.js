


var usererror = document.getElementById('user-error');
var emailerror = document.getElementById('email-error');
var pwderror = document.getElementById('pwd-error');

var userlabel=document.getElementById('user-label');
var emaillabel=document.getElementById('email-label');
var pwdlabel=document.getElementById('pwd-label');

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

function validateuser(){
    
    userlabel.style.bottom="25px";
   var name=document.getElementById('user-name').value;
   if(name.length == 0){
    usererror.innerHTML="le nom est obligatoire";
    return false;
   }

   if(!name.match(/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)* [a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/ )){
       usererror.innerHTML="saisir le nom complet";
       return false;
   }
   else{
   usererror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;}
   
}


function validatepwd(){
    
    pwdlabel.style.bottom="25px";
   var pwd=document.getElementById('pwd').value;
   if(pwd.length == 0){
    pwderror.innerHTML="le mot de passe est obligatoire";
    return false;
   }

   if(!pwd.match(/^((?=.*[a-z])|(?=.*[A-Z]))(?=.*\d)[a-zA-Z\d\S]{6,}$/)){
       pwderror.innerHTML="mot de passe invalide";
       return false;
   }
   else{
   pwderror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;}
   
}


function validateform(){
    if(!validateuser() ||  !validatepwd() ){
        submiterror.style.display="block";
        submiterror.innerHTML="veuiller saisir tout les champs";
        return false;
    }
  }