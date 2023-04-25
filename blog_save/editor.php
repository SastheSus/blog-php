<?php
session_start();
$elenco = '';
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" type="gif" href="./img/tank.gif" />
        <title>Blog</title>
        <link rel="stylesheet" href="./css/common.css">
        <link rel="stylesheet" href="./css/editor.css">
        <script src="blog.js"></script>
    </head>
    <body >
        <div id="root">
            <div>
            <nav>
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./editor.php">Editor</a></li>
                    <li><?php
                        $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");    
                        if(!empty($_SESSION['user'])){
                            $text = "SELECT ruolo FROM utenti WHERE username = ?";
                            $query= $pdo->prepare($text);
                            $query->execute([$_SESSION['user']]);
                            $row = $query->fetch();
                            if($row['ruolo']=='ADMIN'){
                                echo '<a href="./manager.php">users manager</a>';
                            }
                        }
                        $pdo = null;
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
                <div class="App">
                    <form action="editor.php?input=1&id=1" method="get" enctype="multipart/form-data">
                        <div id='editorContainer'>
                            <article>

                                <?php
                                $yes = 0;
                                if(!empty($_GET['id'])){
                                    $id = $_GET['id'];
                                    $yes = 1;
                                    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
                                    $text = "SELECT * FROM articoli WHERE id = ?";
                                    $query= $pdo->prepare($text);
                                    $query->execute([$id]);
                                    $articolo = $query->fetch();

                                    $text = "SELECT * FROM paragrafi WHERE articolo = ?";
                                    $query= $pdo->prepare($text);
                                    $query->execute([$id]);
                                    $paragrafi = $query->fetchAll();

                                    $immagini=array();
                                    $aus=array();
                                    $text = "SELECT nome, idParagrafo FROM immagini, immaginiDiParagrafi WHERE immagini.id = idImmagine AND idParagrafo = ?";
                                    $query= $pdo->prepare($text);
                                    foreach ($paragrafi as $value) {
                                        $query->execute([$value['id']]);
                                        $aus = $query->fetchAll();
                                        foreach ($aus as $val) {
                                            array_push($immagini,$val);
                                        }
                                    }
                                }
                                
                                ?>

                                <div id="ediTitContainer">
                                    <h3 id="editorH3">Titolo:</h3>
                                    <input id="editorTitolo" type="text" placeholder="inserire un titolo"<?php if($yes){echo 'value="'.$articolo["titolo"].'"';}?>></input>
                                </div>
                                <textarea id='editorDescArt'placeholder="inserire una descrizione"><?php if($yes){echo $articolo["descrizione"];}?></textarea>
                                <div id='editorImmagine'>
                                    <img id='editorImgArt'>
                                </div>
                                <div id='editorInputs'>
                                    <input id="editorInputImg" type="file" accept="image/*" onchange="getImgData('editorImgArt')"/>
                                </div>
                            </article>
                        </div>
                        <div id='bodyArticolo'>
                            <div id='formArticolo'>
                                <article id="paragZone">
                                    <div id="paragrafo1" class="paragrafo">
                                                <div id="subTitleContainer1" class="subTitleContainer">
                                                    <input id="subTitle1" class="subTitle" type="text" placeholder="inserire un titolo"<?php if($yes){if($paragrafi!=null){echo 'value="'.$paragrafi[0]["titolo"].'"';}}?>></input>
                                                </div>
                                                <div id="1" class="immagini">
                                                    <button type="button" class="insertImgBtn" onclick="insertImg(1)"></button>
                                                    <?php 
                                                    if($yes){
                                                        if($paragrafi!=null){
                                                            $img = 0;

                                                            foreach ($immagini as $val) {
                                                                if($paragrafi[0]['id']==$val['idParagrafo']){
                                                                    $img++;
                                                                    echo '<div id="imgAndBtnContainer1" class="imgAndBtnContainer">
                                                                    <img id="immagine1'.$img.'" class="immagine" src="./img/'.$val['nome'].'">
                                                                    <div class="onputImgContainer">
                                                                    <input class="inputImg" id="inputImg1'.$img.'" name="inputImg1'.$img.'" type="file" accept="image/*" onchange="getImgData(\'immagine1'.$img.'\',\'inputImg1'.$img.'\')"/>
                                                                    </div>
                                                                    <button class="changePos" type="button" onclick="changePos(1)">
                                                                    </button>
                                                                    </div>';
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <textarea id="textarea1" type="text" class="paragrafoContent"<?php if($yes){if($paragrafi!=null){echo 'value="'.$paragrafi[0]["contenuto"].'"';}}?>></textarea>
                                            </div>
                                </article>
                            <button type="button" onclick="insertParag()"></button>
                            <input type="submit" value="carica" <?php if($yes){echo 'onclick="modifica()"';}else{echo 'onclick="invia()"';}?>/>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php 
        if($_REQUEST!=null){
            var_dump($_FILES);
            $array = $_FILES;
            foreach ($array as $value) {
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
        ?>
    </body>
</html>