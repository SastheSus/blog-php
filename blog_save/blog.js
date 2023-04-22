var immaginiParagrafo = [];

const accedi = () =>{
    var xhr = new XMLHttpRequest();
    var email = document.getElementById('usernameLogin');
    var password = document.getElementById('passwordLogin')
    var warning = document.getElementById('warningLogin')
    xhr.open('GET', './accesso.php?email='+email.value+'&password='+password.value, true);
    xhr.send();
    xhr.onload = () => {
        if(xhr.response=="none"){
            email.value=""
            password.value=""
            warning.style.display="block"
            warning.innerHTML="Email o password incorrette"
        }
        else{
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
        xhr.open('GET', './registra.php?email='+email.value+'&username='+username.value+'&password='+password.value, true);
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
    xhr.open('GET', './chiudi.php', true);
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

const prevArt = () =>{
    const oArt = document.getElementById('container');
    const art = document.getElementById('1');

    if(oArt != null && art != null){
        oArt.scrollBy({
            left: art.offsetWidth*(-3)-(oArt.offsetWidth/100*15),
            behavior : "smooth"
        })
    }
}


const nextArt = () =>{
    const oArt = document.getElementById('container');
    const art = document.getElementById('1');

    if(oArt != null && art != null){
        oArt.scrollBy({
            left: art.offsetWidth*3+(oArt.offsetWidth/100*15),
            behavior : "smooth"
        })
    }
}

$old=0;
const goTo = ($i) =>{
    const oArt = document.getElementById('container');
    const art = document.getElementById('1');

    if(oArt != null && art != null){
        $unit = (art.offsetWidth*3+(oArt.offsetWidth/100*15))
        $position = (($unit*$i)+(($unit*$i)-($unit*$old)))
        oArt.scrollTo({
            left: ($position),
            behavior : "smooth"
        })
    }
    $old = $i;
}


const invia = () =>{
    const title = document.getElementById('editorTitolo')
    const img = document.getElementById('editorInputImg')
    const content = document.getElementById('editorDescArt')
    var style = 0;
    var artId = ''

    //if(title!=null && img!=null && content!=null){
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "uploadDesc.php?title=Testone" + /*title.value*/ "&img=" + /*img.value.replace('C:\\fakepath\\','')*/"gabri_briga.png&content=testiamolo"/* + content.value*/, true);
        xhr.send();
        xhr.onload = () => {
            if(xhr.response=="none"){
            }
            else{
                title.value=""
                img.value=""
                content.value=""
                artId = xhr.response
            }
        }
        xhr.onerror = function() {
            alert(`Network Error`);
        }
    //}
    var i = 1;
    const parag = document.getElementById('paragrafo1')
    while(parag!=null){
        const titPar = document.getElementById('subTitle'+i)
        const imgPar = document.getElementById('insertImgBtn'+i)
        const contentPar = document.getElementById('textarea'+i)

        if(parag.style.flexDirection=='row-reverse'){
            style=1;
        }

        xhr.open("GET", "uploadParag.php?article="+artId+"&style=" + style + "&title=" + titPar.value + "&content=" + contentPar.value + "&img=" + imgPar.value, true);
        xhr.send();
        xhr.onload = () => {

        }
    }
}


function getImgData(idImg, idInput) {
    const input = document.getElementById(""+idInput+"");
    const editorImgArt = document.getElementById(""+idImg+"");
    const files = input.files[0];
    if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
            editorImgArt.src= this.result;
            console.log(this.result);
            immaginiParagrafo.push([""+idInput+"", input.value.replace('C:\\fakepath\\','')])
            alert(immaginiParagrafo)
        });    
    }

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

function insertImg(id){
    var elem = document.getElementById(''+id+'');
    var text = document.getElementById('textarea'+id);
    elem.innerHTML = '<img id="immagine" class="immagine"><div class="onputImgContainer"><input class="inputImg" id="inputImg'+id+'" type="file" accept="image/*" onchange="getImgData(\'immagine\',\'inputImg'+id+'\')"/></div><button onclick="changePos(1)"></button>'
}
function changePos(id) {
    var parag = document.getElementById('paragrafo'+id);
    console.log(parag.style.flexDirection)
    if(parag.style.flexDirection=="row" || parag.style.flexDirection==""){
        parag.style.flexDirection = "row-reverse";
    }
    else{
        parag.style.flexDirection = "row";
    }
}