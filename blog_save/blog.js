var immaginiParagrafo = [];
var imgInputs = [];
var parags = 1;

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
    var artId = ''

    if(title.value!="" && content.value!=""){
        alert("|"+title.value+"|"+content.value+"|")
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "uploadDesc.php?title=" + title.value + "&img=" +img.value.replace('C:\\fakepath\\','')+"&content=" + content.value, true);
        xhr.send();
        xhr.onload = () => {
            try {
                alert("1 "+xhr.responseText)
                if(xhr.response=="none"){
                    alert("2 "+xhr.responseText)
                    document.getElementById('formArticolo').innerHTML+=xhr.responseText
                }
                else{
                    alert("3 "+xhr.responseText)
                    title.value=""
                    img.value=""
                    content.value=""
                    artId = xhr.response
                    alert("4 "+xhr.responseText)
                    invia2(artId)
                }
            } catch (error) {
                //alert("5 "+error)
            }
            
        }
        xhr.onerror = function() {
            alert(`Network Error`);
        }
    }
}
const invia2 = (artId) =>{
    var style = 0;
    var i = 1;
    var parag = document.getElementById('paragrafo'+i)
    imgStr = ''
    
    //alert("6 "+imgStr)
    while(parag!=null){
        alert(parag.id)
        idAus = 'subTitle'+i
        const titPar = document.getElementById('subTitle'+i)
        const contentPar = document.getElementById('textarea'+i)
        alert("pino")
        try {
            for (let q = 0; q<immaginiParagrafo.length; q++) {
                if(immaginiParagrafo[q][0].startsWith(i)){
                    imgStr+=immaginiParagrafo[q][1]+"|";
                }
                else{
                    alert(immaginiParagrafo[q][0]+' '+i)
                }
            }
        } catch (error) {
            alert(error+" "+i)
        }
            
        
        
        
        alert("paolo")
        imgStr = imgStr.slice(0,-1);

        if(parag.style.flexDirection=='row-reverse'){
            style=1;
        }
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "uploadParag.php?article="+artId+"&style=" + style + "&title=" + titPar.value + "&content=" + contentPar.value + "&img=" + imgStr, true);
        xhr.send();
        xhr.onload = () => {
            document.getElementById('formArticolo').innerHTML+=xhr.responseText
        }
        
        i++;
        imgStr = ''
        parag = document.getElementById('paragrafo'+i)
        alert(parag.id)
    }
}


function getImgData(idImg, idInput) {
    const input = document.getElementById(""+idInput+"");
    const editorImgArt = document.getElementById(""+idImg+"");
    const files = input.files[0];
    var pos = -1;
    if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
            idInput = idInput.replace('inputImg','')
            editorImgArt.src= this.result;
            console.log(this.result);
            for(let i=0; i<immaginiParagrafo.length;i++){
                alert(1)
                if(immaginiParagrafo[i].includes(idInput)){
                    alert(2+immaginiParagrafo[i]);
                    pos = 1;
                    immaginiParagrafo[i][1] = input.value.replace('C:\\fakepath\\','')
                    alert(immaginiParagrafo)
                    break
                }
            }
            if(pos==-1){
                immaginiParagrafo.push([""+idInput+"", input.value.replace('C:\\fakepath\\','')])
                alert(immaginiParagrafo)
            }
        });    
    }
    pos=-1
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

function insertParag(){
    var area = document.getElementById('paragZone');

    var tag = document.getElementById('paragrafo'+parags);
    const clone = tag.cloneNode(true);
    parags++;
    clone.id = 'paragrafo'+parags;
    clone.querySelector(".subTitleContainer").id = 'subTitleContainer'+parags;
    clone.querySelector(".subTitle").id = "subTitle"+parags;
    clone.querySelector(".subTitle").value = "";
    clone.querySelector(".immagini").id = parags;
    clone.querySelector(".insertImgBtn").setAttribute('onclick','insertImg('+parags+')');
    clone.querySelector(".paragrafoContent").id = "textarea"+parags;
    clone.querySelector(".paragrafoContent").value = "";
    clone.querySelector(".inputImg").remove()
    clone.querySelector(".changePos").remove()
    area.appendChild(clone)
}

function insertImg(id){
    if(imgInputs[id]!=1){
        imgInputs[id]=1
        alert("1 "+imgInputs[id])
    }
    else{
        imgInputs[id]++;
        alert("2 "+imgInputs[id])
    }
    var elem = document.getElementById(''+id+'');
    if(imgInputs[id]==1){
        elem.innerHTML += '<div id="imgAndBtnContainer'+id+'" class="imgAndBtnContainer"><img id="immagine'+id+''+imgInputs[id]+'" class="immagine"><div class="onputImgContainer"><input class="inputImg" id="inputImg'+id+''+imgInputs[id]+'" name="inputImg'+id+''+imgInputs[id]+'" type="file" accept="image/*" onchange="getImgData(\'immagine'+id+''+imgInputs[id]+'\',\'inputImg'+id+''+imgInputs[id]+'\')"/></div><button class="changePos" type="button" onclick="changePos('+id+')"></button></div>'
    }
    else{
        var tag = document.getElementById(''+id+'').lastChild;
        const clone = tag.cloneNode(true);
        clone.id = 'imgAndBtnContainer'+id;
        clone.querySelector(".immagine").id = 'immagine'+id+''+imgInputs[id];
        clone.querySelector(".immagine").src = "";
        clone.querySelector(".inputImg").id = 'inputImg'+id+''+imgInputs[id];
        clone.querySelector(".inputImg").name = 'inputImg'+id+''+imgInputs[id];
        clone.querySelector(".inputImg").setAttribute('onchange','getImgData(\'immagine'+id+''+imgInputs[id]+'\',\'inputImg'+id+''+imgInputs[id]+'\')');
        clone.querySelector(".inputImg").value = null;
        elem.appendChild(clone)
    }
    //var text = document.getElementById('textarea'+id);
    //elem.innerHTML += '<img id="immagine'+id+''+imgInputs+'" class="immagine"><div class="onputImgContainer"><input class="inputImg" id="inputImg'+id+''+imgInputs+'" name="inputImg'+id+''+imgInputs+'" type="file" accept="image/*" onchange="getImgData(\'immagine'+id+''+imgInputs+'\',\'inputImg'+id+''+imgInputs+'\')"/></div><button type="button" onclick="changePos('+id+')"></button>'

    //const clone = tag.cloneNode(true);

    //document.getElementById(elem).appendChild(clone);
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