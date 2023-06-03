var usererror = document.getElementById('user-error');
var comperror = document.getElementById('comp-error');
var emailerror = document.getElementById('email-error');

var userlabel=document.getElementById('user-label');
var complabel=document.getElementById('comp-label');
var emaillabel=document.getElementById('email-label');

var submiterror = document.getElementById('submit-error');

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


function validateform(){
    if(!validateuser() ||  !validateemail() || !validatecomp()){
        submiterror.style.display="block";
        submiterror.innerHTML="veuiller saisir tout les champs";
        return false;
    }
  }



  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        // Get the target element
        const target = document.querySelector(this.getAttribute('href'));

        // Scroll to the target element
        target.scrollIntoView({
            behavior: 'smooth'
        });
    });
});
