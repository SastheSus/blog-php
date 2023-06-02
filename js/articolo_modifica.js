var immaginiParagrafo = [];
var imgInputs = [];
var parags = 1;
var paragsPhp = 0;

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

function setVar(val) {
    paragsPhp = val-1;
    parags +=val;
    //alert(parags);
}

const hidden = () =>{
    var warning = document.getElementById('warningLogin')

    warning.style.display="hidden"
    warning.innerHTML=""
}

const invia = (id) =>{
    var xhr = new XMLHttpRequest();
    var title = document.getElementById('editorTitolo')
    var img = document.getElementById('editorInputImg')
    var content = document.getElementById('editorDescArt')
    var titleVal = title.value.toLowerCase()
    var contentVal = content.value.toLowerCase()
    var artId = ''

    if(title.value!="" && content.value!=""){
        //alert("|"+title.value+"|"+content.value+"|")
        xhr.open("GET", "http://localhost/blog-php/php_aus/updateDesc.php?id="+id+"&title=" + titleVal + "&img=" +img.value.replace('C:\\fakepath\\','')+"&content=" + contentVal, true);
        xhr.send();
        xhr.onload = () => {
            try {
                //alert("1 "+xhr.responseText)
                if(xhr.response=="none"){
                    //alert("2 "+xhr.responseText)
                    document.getElementById('formArticolo').innerHTML+=xhr.responseText
                }
                else{
                    //alert("3 "+xhr.responseText)
                    title.val=""
                    img.value=""
                    content.val=""
                    artId = xhr.response
                    //alert("4 "+xhr.responseText)
                    invia2(id)
                }
            } catch (error) {
                alert("5 "+error)
            }
            
        }
        xhr.onerror = function() {
            alert(`Network Error`);
        }
    }
    return "ok"
}
const invia2 = (artId) =>{
    var style = 0;
    var i = 1;
    var area = document.getElementById('paragZone');
    var arr = area.querySelectorAll(".paragrafo")
    imgStr = ''
    imgIn = ''
    try {
        arr.forEach(par => {
        var paragNum = par.id.replace("paragrafo","")
        var subTitle = par.querySelector(".subTitle")
        var textarea = par.querySelector(".paragrafoContent")
        var subTitleVal = subTitle.value.toLowerCase()
        var textareaVal = textarea.value.toLowerCase()
        if(textarea.value!=""){
            if(par.querySelector('.imgAndBtnContainer')!=null && (par.querySelector('.imgName').value!=null || par.querySelector('.imgName').value!="")){
                var images = par.querySelectorAll('.imgName')
                images.forEach(i =>{
                    imgStr+=i.value+"|"
                    imgIn+=i.id.slice(-1)+"|";
                })
            }
            imgStr = imgStr.slice(0,-1);
            imgIn = imgIn.slice(0,-1);
            if(par.style.flexDirection=='row-reverse'){
                style=1;
            }
            else{
                style = 0;
            }
            try {var xhr = new XMLHttpRequest();
                xhr.open("GET", "http://localhost/blog-php/php_aus/updateParag.php?article="+artId+"&paragrafo="+i+"&style=" + style + "&title=" + subTitleVal + "&content=" + textareaVal + "&img=" + imgStr + "&input=" + imgIn, true);
                xhr.send();
                xhr.onload = () => {
                    //alert(9)
                    alert(xhr.responseText)
                }
                xhr.onerror = function() {
                    alert("1"+xhr.responseText)
                }
            } catch (error) {
                alert("2"+error)
            }
            i++
        }
        imgStr = ''
        imgIn = ''
    });
    } catch (error) {
        alert(error)
    }
    
}


function getImgData(idImg, idInput) {
    const input = document.getElementById(""+idInput+"");
    const editorImgArt = document.getElementById(""+idImg+"");
    idInput = idInput.replace('inputImg','')
    const imgName = document.getElementById("imgName"+idInput+"");
    const files = input.files[0];
    var pos = -1;
    if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function f () {
            editorImgArt.src= fileReader.result;
            console.log(fileReader.result);
            imgName.value = input.value.replace('C:\\fakepath\\','')
            alert("3"+imgName.value)
        });   
    }
    pos=-1
}


function insertParag(p){
    var area = document.getElementById('paragZone');

    var tag = document.getElementById('paragrafo'+p);
    const clone = tag.cloneNode(true);
    parags++;
    clone.id = 'paragrafo'+parags;
    clone.querySelector(".subTitleContainer").id = 'subTitleContainer'+parags;
    clone.querySelector(".subTitle").id = "subTitle"+parags;
    clone.querySelector(".subTitle").value = null;
    clone.querySelector(".immagini").id = parags;
    while(clone.querySelector(".imgAndBtnContainer")!=null){
        clone.querySelector(".imgAndBtnContainer").remove()
    }
    clone.querySelector(".delBtnImg").setAttribute('onclick','annullaImg('+parags+')');
    clone.querySelector(".delBtnPar").setAttribute('onclick','annullaParag('+parags+')');
    clone.querySelector(".insertImgBtn").setAttribute('onclick','insertImg('+parags+')');
    clone.querySelector(".insertParag").setAttribute('onclick','insertParag('+parags+')');
    clone.querySelector(".paragrafoContent").id = "textarea"+parags;
    clone.querySelector(".paragrafoContent").value = null;
    while(clone.querySelector(".imgAndBtnContainer")!=null){
        clone.querySelector(".imgAndBtnContainer").remove()
    }
    tag.after(clone)
    //area.appendChild(clone)
}

function insertImg(id){
    if(imgInputs[id]==null){
        console.log("null = "+imgInputs[id])
        imgInputs[id]=1
        //alert("1 "+imgInputs[id])
    }
    else{
        console.log("!null = "+imgInputs[id])
        imgInputs[id]++;
        //alert("2 "+imgInputs[id])
    }
    var elem = document.getElementById(''+id+'');
    if(imgInputs[id]==1){
        console.log(imgInputs[id])
        elem.innerHTML += '<button class="changePos" type="button" onclick="changePos('+id+',this)">posizione</button><div id="imgAndBtnContainer'+id+'" class="imgAndBtnContainer"><img id="immagine'+id+''+imgInputs[id]+'" class="immagine"><div class="onputImgContainer"><input type="hidden" class="imgName" id="imgName'+id+''+imgInputs[id]+'" value=""/><input class="inputImg" id="inputImg'+id+''+imgInputs[id]+'" name="inputImg'+id+''+imgInputs[id]+'" type="file" accept="image/*" onchange="getImgData(\'immagine'+id+''+imgInputs[id]+'\',\'inputImg'+id+''+imgInputs[id]+'\')"/></div></div>'
    }
    else{
        console.log(imgInputs[id])
        var tag = document.getElementById(''+id+'').lastChild;
        const clone = tag.cloneNode(true);
        clone.id = 'imgAndBtnContainer'+id;
        clone.querySelector(".immagine").id = 'immagine'+id+''+imgInputs[id];
        clone.querySelector(".immagine").src = "";
        clone.querySelector(".inputImg").id = 'inputImg'+id+''+imgInputs[id];
        clone.querySelector(".inputImg").name = 'inputImg'+id+''+imgInputs[id];
        clone.querySelector(".inputImg").setAttribute('onchange','getImgData(\'immagine'+id+''+imgInputs[id]+'\',\'inputImg'+id+''+imgInputs[id]+'\')');
        clone.querySelector(".inputImg").value = null;
        clone.querySelector(".imgName").id = 'imgName'+id+''+imgInputs[id];
        clone.querySelector(".imgName").value = "";
        elem.appendChild(clone)
    }
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

function eliminaParag(idArt, idPar){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/blog-php/php_aus/eliminaParag.php?idArt="+idArt+"&idPar="+idPar, true);
    xhr.send();
    xhr.onload = () => {
        //alert(xhr.responseText)
        location.reload();
    }
}

function delArt(idArt){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/blog-php/php_aus/eliminaArt.php?idArt="+idArt, true);
    xhr.send();
    xhr.onload = () => {
        //alert(xhr.responseText)
        window.location.replace('./index.php');
    }
}

function annullaParag(id){
    var l = document.querySelectorAll('.paragrafo').length;
    if(l>1){
        document.getElementById('paragrafo'+id).remove();
        imgInputs[id]=null
    }
    else{
        document.getElementById('subTitle'+id).value = ''
        document.getElementById('textarea'+id).value = ''
        while(imgInputs[id]>0){
            annullaImg(id)
        }
    }
}

function annullaImg(id){
    var div = document.getElementById('paragrafo'+id).querySelector('.immagini')
    var all = document.querySelectorAll("#imgAndBtnContainer"+id).length
    console.log("before="+imgInputs[id]+" "+all)
    if(all>0){
        if(all==1){
            div.querySelector('.changePos').remove()
        }
        var last = document.querySelectorAll("#imgAndBtnContainer"+id+":last-child")
        imgInputs[id]--
        last[0].remove()
    }
    console.log("before="+imgInputs[id])
    
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
      document.getElementById('dialogoverlay').style.display = "nonee";
    }
}

let customAlert = new CustomAlert();
