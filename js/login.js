const accedi = () =>{
    var xhr = new XMLHttpRequest();
    var email = document.getElementById('usernameLogin');
    var password = document.getElementById('passwordLogin')
    var warning = document.getElementById('warningLogin')
    xhr.open('GET', 'http://localhost/blog-php/php_aus/accesso.php?email='+email.value+'&password='+password.value, true);
    xhr.send();
    xhr.onload = () => {
        if(xhr.response=="none"){
            alert("oks");
            email.value=""
            password.value=""
            warning.style.display="block"
            warning.innerHTML="Email o password incorrette"
        }
        else{
            alert("oks");
            window.location.replace("./index.php");
        }
    }
    xhr.onerror = function() {
        alert(`Network Error`);
    };
}

const registrati = () =>{
    var xhr = new XMLHttpRequest();
    var username = document.getElementById('usernameReg');
    var email = document.getElementById('emailReg')
    var password = document.getElementById('passwordReg')
    var warning = document.getElementById('warningReg')
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if (email.value.match(validRegex)) {
        xhr.open('GET', 'http://localhost/blog-php/php_aus/registra.php?email='+email.value+'&username='+username.value+'&password='+password.value, true);
        xhr.send();
        xhr.onload = () => {
            if(xhr.response=="none"){
                username.value=""
                email.value=""
                password.value=""
                warning.style.display="block"
                warning.innerHTML="Impossibile creare questo utente"
            }
            else{
                window.location.replace("./login.php");
            }
        }
        xhr.onerror = function() {
            alert(`Network Error`);
        };
    }
    else{
        warning.style.display="block"
        warning.innerHTML="email non valida"
    }
}

const close_session = () =>{
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/blog-php/php_aus/chiudi.php', true);
    xhr.send();
    xhr.onload = () => {
        window.location.replace("./index.php");
    }
    xhr.onerror = function() {
        alert(`Network Error`);
    };
}

const hidden = () =>{
    var warning = document.getElementById('warningLogin')

    warning.style.display="hidden"
    warning.innerHTML=""
}

function richiedi() {
    alert(
        "Non sei abilitato ad accedere a questa pagina.\nè necessario essere Autori o Admin per poter creare nuovi articoli. Manda una richiesta all'Admin per promuoverti."
    )    
}

function CustomAlert(){
    this.alert = function(message,title){
      document.body.innerHTML = document.body.innerHTML + '<div id="dialogoverlay"></div><div id="dialogbox" class="slit-in-vertical"><div><div id="dialogboxhead"></div><div id="dialogboxbody"></div><div id="dialogboxfoot"></div></div></div>';
  
      let dialogoverlay = document.getElementById('dialogoverlay');
      let dialogbox = document.getElementById('dialogbox');
      
      let winH = window.innerHeight;
      dialogoverlay.style.height = winH+"px";
      
      dialogbox.style.top = "100px";
  
      dialogoverlay.style.display = "block";
      dialogbox.style.display = "block";
      
      document.getElementById('dialogboxhead').style.display = 'block';
      document.getElementById('dialogboxhead').innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> '+ title;
      document.getElementById('dialogboxbody').innerHTML = message;
      document.getElementById('dialogboxfoot').innerHTML = '<button id="annulla" class="pure-material-button-contained active" onclick="customAlert.ok()">Annulla</button><button id="ok" class="pure-material-button-contained active" onclick="customAlert.ok()">OK</button>';
    }
    
    this.ok = function(){
      document.getElementById('dialogbox').style.display = "none";
      document.getElementById('dialogoverlay').style.display = "none";
    }
}

let customAlert = new CustomAlert();