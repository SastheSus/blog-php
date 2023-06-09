<?php
session_start();
$elenco = '';
$id = -1;
if(!empty($_GET["id"]))
    $id = $_GET["id"];
$num = 1;
$pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
if(!empty($_SESSION['user'])){
    if($id>-1){
        $text = "SELECT articoli.utente AS username FROM articoli WHERE articoli.id = ?";
        $query= $pdo->prepare($text);
        $query->execute([$id]);
        $n = $query->fetch();
        if($_SESSION['user'] != $n['username']){
            header("Location: ./index.php");
            die();
        }
    }
    else{
        $text = "SELECT * FROM utenti WHERE username = ?";
        $query= $pdo->prepare($text);
        $query->execute([$_SESSION['user']]);
        $r = $query->fetch()['ruolo'];
        if($r != 'ADMIN' && $r != 'AUTHOR'){
            header("Location: ./index.php");
            die();
        }
    }
    
}
else{
    header("Location: ./index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="it" >
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" type="gif" href="./img/tank.gif" />
        <title>Blog</title>
        <link rel="stylesheet" href="./css/common.css">
        <link rel="stylesheet" href="./css/editor.css">
        <script src="./js/editor.js"></script>
    </head>
    <body>
        <div id="root">
            <div>
            <nav>
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./editor.php">Editor</a></li>
                    <li><?php
                        $text = "SELECT * FROM utenti WHERE username = ?";
                        $query= $pdo->prepare($text);
                        $query->execute([$_SESSION['user']]);
                        $row = $query->fetch();
                        if($row['ruolo']=='ADMIN'){
                            echo '<a href="./manager.php">users manager</a>';
                        }
                        ?>
                    </li>
                    <li id="logli"><div id="loginBtn" 
                    <?php
                        $t="";
                        if(empty($_SESSION['user'])){
                            $t="window.location.replace('./login.php')";
                            echo 'onclick="'.$t.'"';
                        }
                    ?>
                    ><img src="./img/account.png" alt="">
                    <?php 
                        if(!empty($_SESSION['user'])){
                            echo '<p>'.$_SESSION["user"]."</p>";
                        }
                        else{
                            echo '<p>Accedi</p>';
                        }
                    ?>
                    </div>
                    <?php 
                        if(!empty($_SESSION['user'])){
                            $t='close_session()';
                            echo "<div class='dropdown-content'>
                            <a onclick='".$t."'>Logout</a>
                            </div>";
                        }
                    ?>
                </li>
                </ul>
                </nav>
                <?php 
                    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
                    $text = "SELECT articoli.*, immagini.nome FROM articoli, immagini WHERE articoli.id = ? AND articoli.logo = immagini.id";
                    $query= $pdo->prepare($text);
                    $query->execute([$id]);
                    $articolo = $query->fetch();

                    $text = "SELECT * FROM paragrafi WHERE articolo = ?";
                    $query= $pdo->prepare($text);
                    $query->execute([$id]);
                    $paragrafi = $query->fetchAll();
                    //$num += sizeof($paragrafi);

                    $immagini=array();
                    $aus=array();
                    $text = "SELECT nome, idParagrafo FROM immagini, immaginiDiParagrafi WHERE immagini.id = idImmagine AND idParagrafo = ? AND idArticolo = ?";
                    $query= $pdo->prepare($text);
                    foreach ($paragrafi as $value) {
                        $query->execute([$value['id'], $value['articolo']]);
                        $aus = $query->fetchAll();
                        foreach ($aus as $val) {
                            array_push($immagini,$val);
                        }
                    };
                ?>
                <div class="App">
                    <form action="editor.php?id=<?php echo $id ?>&m=1" method="post" enctype="multipart/form-data">
                        <div id='editorContainer'>
                            <article>
                                <div id="ediTitContainer">
                                    <h3 id="editorH3">Titolo:</h3>
                                    <input id="editorTitolo" type="text" placeholder="inserire un titolo" <?php if($articolo!=null)echo 'value="'.$articolo['titolo'].'"'?>></input>
                                    <?php if($id != -1)echo '<button id="eliminaArt" type=button onclick="delArt('.$id.')">el</button>'?>
                                </div>
                                <textarea id='editorDescArt'placeholder="inserire una descrizione"><?php if($articolo!=null)echo $articolo['descrizione']?></textarea>
                                <div id='editorImmagine'>
                                    <img id='editorImgArt' <?php if($articolo!=null)echo 'src="./img/'.$articolo['nome'].'"'?>>
                                </div>
                                <div id='editorInputs'>
                                    <input id="editorInputImg" type="file" accept="image/*" name="inputImg0" onchange="getImgData('editorImgArt','editorInputImg')"/>
                                </div>
                            </article>
                        </div>
                        <div id='bodyArticolo'>
                            <div id='formArticolo'>
                                <article id="paragZone">
                                    <?php 
                                        foreach ($paragrafi as $value) {
                                            echo '
                                            <div id="paragrafo'.$num.'" class="paragrafo" ';
                                            if($value['stile']==1)echo 'style="flex-direction: row-reverse;"';
                                            echo '>
                                                <div id="subTitleContainer'.$num.'" class="subTitleContainer">
                                                    <input id="subTitle'.$num.'" class="subTitle" type="text" placeholder="inserire un titolo" value='.$value['titolo'].'></input>
                                                </div>
                                                <div id="'.$num.'" class="immagini">
                                                    <button type="button" class="insertImgBtn" onclick="insertImg('.$num.')">+</button>
                                                    <button type="button" class="delBtnImg" onclick="annullaImg('.$num.')">El</button>'
                                            ;
                                            $i = 0;
                                            foreach ($immagini as $val) {
                                                if($val['idParagrafo']==$value['id']){
                                                    $i++;
                                                    echo '  <div id="imgAndBtnContainer'.$num.'" class="imgAndBtnContainer">
                                                                <img id="immagine'.$num.''.$i.'" class="immagine" src="./img/'.$val['nome'].'">
                                                                <div class="onputImgContainer">
                                                                    <input type="hidden" class="imgName" id="imgName'.$num.''.$i.'" value="'.$val['nome'].'"/>
                                                                    <input class="inputImg" id="inputImg'.$num.''.$i.'" name="inputImg'.$num.''.$i.'" type="file" accept="image/*" onchange="getImgData(\'immagine'.$num.''.$i.'\',\'inputImg'.$num.''.$i.'\')"/>
                                                                </div>
                                                                </div>
                                                                '
                                                    ;
                                                }
                                            }
                                            if($i>0){
                                                echo '<button class="changePos" type="button" onclick="changePos('.$num.')">posizione</button>';
                                            }

                                            echo'
                                                </div>
                                                <textarea id="textarea'.$num.'" type="text" class="paragrafoContent">'.$value['contenuto'].'</textarea>
                                                <div style="width=fit-content; margin-left:auto; margin-right:auto;">
                                                    <button type="button" class="delBtnPar" onclick="annullaParag('.$num.')">El</button>
                                                    <button type="button" class="insertParag" onclick="insertParag('.$num.')">+</button>
                                                </div>
                                            </div>
                                            ';
                                            $num++;
                                        }
                                    ?>
                                    <div id="paragrafo<?php echo $num?>" class="paragrafo">
                                                <div id="subTitleContainer<?php echo $num?>" class="subTitleContainer">
                                                    <input id="subTitle<?php echo $num?>" class="subTitle" type="text" placeholder="inserire un titolo"></input>
                                                </div>
                                                <div id="<?php echo $num?>" class="immagini">
                                                    <button type="button" class="delBtnImg" onclick="annullaImg(<?php echo $num?>)">El</button>
                                                    <button type="button" class="insertImgBtn" onclick="insertImg(<?php echo $num?>)">+</button>
                                                </div>
                                                <textarea id="textarea<?php echo $num?>" type="text" class="paragrafoContent"></textarea>
                                                <div style="width=fit-content; margin-left:auto; margin-right:auto;">
                                                    <button type="button" class="delBtnPar" onclick="annullaParag(<?php echo $num?>)">El</button>
                                                    <button type="button" class="insertParag" onclick="insertParag(<?php echo $num?>)">+</button>
                                                </div>
                                            </div>
                                </article>
                            <input id="invio" type="submit" value="carica" onclick="invia(<?php echo $id;?>)"/>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php 
        if($_REQUEST!=null){
            //var_dump($_FILES);
            $array = $_FILES;
            foreach ($array as $value) {
                if($value["name"]!=""){
                $inputName = $value["name"];
                $target_dir = "./img/";
                $target_file = $target_dir . basename($inputName);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                /* 
                if($imageFileType != "txt") {
                echo "Sorry, only TXT files are allowed.";
                $uploadOk = 0;
                }
                */
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                }
                else {
                    if (move_uploaded_file($value["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $inputName)). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
        //echo "<script>  </script>";
        }
        ?>
        <script>
        setVar(<?php echo $num;?>)
        <?php 
        if(!empty($_GET['m'])){
            if($id == -1){
                $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
                $text = "SELECT MAX(id) AS id FROM articoli ";
                $query= $pdo->prepare($text);
                $query->execute();
                $id = $query->fetch()['id'];
            }
            
            echo "location.replace('articolo.php?id=$id')";
        }
        ?>
        </script>
    </body>
</html>