var immaginiParagrafo = [];
var imgInputs = [];
var parags = 1;

const close_session = () =>{
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './php_aus/chiudi.php', true);
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

const invia = () =>{
    
    //e.preventDefault();
    var title = document.getElementById('editorTitolo')
    var img = document.getElementById('editorInputImg')
    var content = document.getElementById('editorDescArt')
    var titleVal = title.value.toLowerCase()
    var contentVal = content.value.toLowerCase()
    var artId = ''

    if(title.value!="" && content.value!=""){
        try{
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://localhost/blog-php/php_aus/uploadDesc.php?title=" + titleVal + "&img=" +img.value.replace('C:\\fakepath\\','')+"&content=" + contentVal, true);
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
                        invia2(artId)
                    }
                } catch (error) {
                    alert("5 "+error)
                }
                
            }
            xhr.onerror = function() {
                alert(`Network Error`);
            }
            xhr.send();
        }catch(error){
            //alert(error)
        }
        
    }
}
const invia2 = async (artId) =>{
    try{
    var style = 0;
    var i = 1;
    /*var parag = document.getElementById('paragrafo'+i)*/
    var area = document.getElementById('paragZone');
    var arr = area.querySelectorAll(".paragrafo")
    imgStr = ''
    imgIn = ''
    
    //alert("6 "+imgStr)
    //while(parag!=null){
    arr.forEach(par => {
        var paragNum = par.id.replace("paragrafo","")
        var subTitle = par.querySelector(".subTitle")
        var textarea = par.querySelector(".paragrafoContent")
        var subTitleVal = subTitle.value.toLowerCase()
        var textareaVal = textarea.value.toLowerCase()
        if(textarea.value!=""){
            if(par.querySelector('.imgAndBtnContainer')!=null && par.querySelector('.imgName').value!=""){
                var images = par.querySelectorAll('.imgName')
                images.forEach(i =>{
                    imgStr+=i.value+"|"
                    imgIn+=i.id.slice(-1)+"|";
                })
            }
            /*try {
                for (let q = 0; q<immaginiParagrafo.length; q++) {
                    if(immaginiParagrafo[q][0].startsWith(paragNum)){
                        imgStr+=immaginiParagrafo[q][1]+"|";
                        imgIn+=immaginiParagrafo[q][0]+"|";
                        //alert(imgStr+'€'+imgIn+'€')
                    }
                    else{
                        //alert(immaginiParagrafo[q][0]+' '+i)
                        //alert(imgStr+'£'+imgIn+'£')
                    }
                }
            } catch (error) {
                alert('invia2 error '+error+" "+i)
            }*/
            imgStr = imgStr.slice(0,-1);
            imgIn = imgIn.slice(0,-1);
            if(par.style.flexDirection=='row-reverse'){
                style=1;
            }
            else{
                style = 0;
            }
            try {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "./php_aus/uploadParag.php?article="+artId+"&paragrafo="+i+"&style=" + style + "&title=" + subTitleVal + "&content=" + textareaVal + "&img=" + imgStr + "&input=" + imgIn, true);
                xhr.send();
                xhr.onload = () => {
                    //alert(9)
                    //alert(xhr.responseText)
                }
                xhr.onerror = function() {
                    alert(xhr.responseText)
                }          
            } catch (error) {
                alert(error)
            }
            i++
        }
        imgStr = ''
        imgIn = ''
    });
        
}catch(e){alert (e)}
//window.location.replace('./editor.php?ok=1')
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
            alert(imgName.value)
            /*
            for(let i=0; i<immaginiParagrafo.length;i++){
                //alert(1)
                if(immaginiParagrafo[i].includes(idInput)){
                    //alert(2+immaginiParagrafo[i]);
                    pos = 1;
                    immaginiParagrafo[i][1] = input.value.replace('C:\\fakepath\\','')
                    //alert(immaginiParagrafo)
                    break
                }
            }
            if(pos==-1){
                immaginiParagrafo.push([""+idInput+"", input.value.replace('C:\\fakepath\\','')])
                //alert(immaginiParagrafo)
            } */
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
    clone.querySelector(".delBtn").setAttribute('onclick','annullaParag('+parags+')');
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
        imgInputs[id]=1
        //alert("1 "+imgInputs[id])
    }
    else{
        imgInputs[id]++;
        //alert("2 "+imgInputs[id])
    }
    var elem = document.getElementById(''+id+'');
    if(imgInputs[id]==1){
        elem.innerHTML += '<button class="changePos" type="button" onclick="changePos('+id+',this)">posizione</button><div id="imgAndBtnContainer'+id+'" class="imgAndBtnContainer"><img id="immagine'+id+''+imgInputs[id]+'" class="immagine"><div class="onputImgContainer"><input type="hidden" class="imgName" id="imgName'+id+''+imgInputs[id]+'" /><input class="inputImg" id="inputImg'+id+''+imgInputs[id]+'" name="inputImg'+id+''+imgInputs[id]+'" type="file" accept="image/*" onchange="getImgData(\'immagine'+id+''+imgInputs[id]+'\',\'inputImg'+id+''+imgInputs[id]+'\')"/></div></div>'
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
        clone.querySelector(".imgName").id = 'imgName'+id+''+imgInputs[id];
        clone.querySelector(".imgName").value = null;
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

function annullaParag(id){
    var l = document.querySelectorAll('.paragrafo').length;
    par = document.getElementById('paragrafo'+id)
    if(l>1){
        par.remove();
    }
    else{
        par.querySelector('#subTitle'+id).value = ''
        par.querySelector('#textarea'+id).value = ''
    }
}

function annullaImg(id){
    var div = document.getElementById('paragrafo'+id).querySelector('.immagini')
    var all = document.querySelectorAll("#imgAndBtnContainer"+id).length
    if(all!=null){
        if(all==1){
            imgInputs[id]=null
            div.querySelector('.changePos').remove()
        }
        var last = document.querySelectorAll("#imgAndBtnContainer"+id+":last-child")
        last[0].remove()
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



function test(){
    var area = document.getElementById('paragZone');

    var arr = area.querySelectorAll(".paragrafo")

    arr.forEach(val => {
        alert(val.id)
    });
}