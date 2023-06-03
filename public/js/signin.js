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
var fnameerror = document.getElementById('fname-error');
var lnameerror = document.getElementById('lname-error');
var comperror = document.getElementById('comp-error');
var cityerror = document.getElementById('city-error');
var adresserror = document.getElementById('adress-error');
var emailerror = document.getElementById('email-error');
var phoneerror = document.getElementById('phone-error');
var ziperror = document.getElementById('zip-error');
var cpwderror = document.getElementById('cpwd-error');
var pwderror = document.getElementById('pwd-error');

var fnamelabel=document.getElementById('fname-label');
var lnamelabel=document.getElementById('lname-label');
var complabel=document.getElementById('comp-label');
var citylabel=document.getElementById('city-label');
var adresslabel=document.getElementById('adress-label');
var emaillabel=document.getElementById('email-label');
var phonelabel=document.getElementById('phone-label');
var ziplabel=document.getElementById('zip-label');
var pwdlabel=document.getElementById('pwd-label');
var cpwdlabel=document.getElementById('cpwd-label');

var submiterror = document.getElementById('submit-error');
function validatefname(){
    
    fnamelabel.style.bottom="30px";
   var fname=document.getElementById('fname-name').value;
   if(fname.length == 0){
    fnameerror.innerHTML="le nom est obligatoire";
    return false;
   }

   if(!fname.match(/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/ )){
    fnameerror.innerHTML="saisir le nom complet";
       return false;
   }
   else{
    fnameerror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;}
   
}
function validatelname(){
    
    lnamelabel.style.bottom="30px";
   var lname=document.getElementById('lname-name').value;
   if(lname.length == 0){
    lnameerror.innerHTML="le nom est obligatoire";
    return false;
   }

   if(!lname.match(/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/ )){
    lnameerror.innerHTML="saisir le nom complet";
       return false;
   }
   else{
    lnameerror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;}
   
}

function validatecomp(){
    complabel.style.bottom="25px";
    var compname=document.getElementById('comp-name').value;
    if(compname.length == 0){
     comperror.innerHTML="le nom est obligatoire";
     return false;
    }
    comperror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;
}

function validateadress(){
    adresslabel.style.bottom="25px";
    var adress=document.getElementById('adress-name').value;
    if(adress.length == 0){
        adresserror.innerHTML="l'adress est obligatoire";
     return false;
    }
    adresserror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;
}

function validatecity(){
    citylabel.style.bottom="25px";
    var city=document.getElementById('city-name').value;
    if(city.length == 0){
        cityerror.innerHTML="la ville est obligatoire";
     return false;
    }
    cityerror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;
}

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

function validatephone(){
    phonelabel.style.bottom="25px";
    var phone = document.getElementById('phone').value;
    if(phone.length == 0){
        phoneerror.innerHTML = 'telephone est obligatoire';
        return false;
    }
    if(!phone.match(/^(0[3567](\d){7,8})$/)){
        phoneerror.innerHTML= ' telephone invalide';
        return false;
    }
    phoneerror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;
}

function validatezip(){
    ziplabel.style.bottom="25px";
    var zip = document.getElementById('zip').value;
    if(zip.length == 0){
        ziperror.innerHTML = 'zip est obligatoire';
        return false;
    }
    if(!zip.match(/^((\d){5,5})$/)){
        ziperror.innerHTML= ' zip invalide';
        return false;
    }
    ziperror.innerHTML='<i class="fa-solid fa-circle-check"></i>';
   return true;
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
    if(!validateuser() || !validatecomp() || !validateemail() || !validatepwd() || !validatecpwd()){
        submiterror.style.display="block";
        submiterror.innerHTML="veuiller saisir tout les champs";
        return false;
    }
  }