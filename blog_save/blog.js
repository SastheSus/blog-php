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
            window.location.replace("./index.php");
        }
    }
    xhr.onerror = function() {
      alert(`Network Error`);
    };
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

        if(title!=null && img!=null && content!=null){
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "uploader.php?title=" + title.value + "&img=" + img.value + "&content=" + content.value, true);
            xhr.send();
            xhr.onload = () => {
                if(xhr.response=="none"){
                }
                else{
                    title.value=""
                    img.value=""
                    content.value=""
                }
            }
            xhr.onerror = function() {
                alert(`Network Error`);
            }
        }
    }

    
    
    function getImgData() {
        const input = document.getElementById("editorInputImg");
        const editorImgArt = document.getElementById("editorImgArt");
      const files = input.files[0];
      if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
            editorImgArt.src= this.result;
            console.log(this.result);
        });    
      }
    }