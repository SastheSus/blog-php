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

async function updateProfili(e,form){
    var formData = new FormData(form)
    let formDataObject = Object.fromEntries(formData.entries());
    // Format the plain form data as JSON
    let formDataJsonString = JSON.stringify(formDataObject);
    await fetch("http://localhost/blog-php/php_aus/updateProfili.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: formDataJsonString
    }).then((response) => {
        if (response.ok) {
          return response.text();
        }
        throw new Error('Something went wrong');
      })
    .then((data) => {
        location.reload()
    }
    ).catch((data) => {
        alert(data)
        location.reload()
    })
}

function passChange(btn){
    var parent = btn.parentElement;
    var id = btn.id.replace('button','')
    var name = 'password'+id
    btn.remove();
    var child = document.createElement("input");
    child.setAttribute("type", "text");
    child.setAttribute("name", name);
    child.setAttribute("form", "roleform");
    parent.appendChild(child)
}

async function delProfilo(nome){
    await fetch("http://localhost/blog-php/php_aus/eliminaProfilo.php?nome="+nome)
    .then((response) => {
        if (response.ok) {
          return response.text();
        }
        throw new Error('Something went wrong');
      })
    .then((data) => {
        alert(data)
        location.reload()
    }
    ).catch((data) => {
        alert(data)
        location.reload()
    })
}