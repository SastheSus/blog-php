var idRisposta = 0;

function risposta(id){
    if(idRisposta == id){
        idRisposta = 0;
        document.getElementById('c'+id).style="color:black"
    }
    else{
        idRisposta = id
        document.getElementById('c'+id).style="color:yellow"
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

async function sendComment(form) {
    try {
        var formData = new FormData(form);
        var content = formData.get('content');
        var article = formData.get('article');

        var response = await fetch(`http://localhost/blog-php/php_aus/uploadComment.php?content=${content}&article=${article}&risposta=${idRisposta}`);
        if (response.ok) {
            location.reload();
        } else {
            throw new Error('Something went wrong');
        }
    } catch (error) {
        location.reload();
        alert(error);
    }
    return false; // Prevent form submission
}

function delComment(id, idArt){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/blog-php/php_aus/eliminaComment.php?id="+id+"&idArt="+idArt, true);
    xhr.send();
    xhr.onload = () => {
        location.reload();
    }
}

function delRisp(id, idArt){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/blog-php/php_aus/eliminaRisp.php?id="+id+"&idArt="+idArt, true);
    xhr.send();
    xhr.onload = () => {
        location.reload();
    }
}