<?php
session_start();
$elenco = '';
$id = $_GET["id"];
$num = 1;
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" type="gif" href="./img/tank.gif" />
        <title>Blog</title>
        <link rel="stylesheet" href="./css/common.css">
        <link rel="stylesheet" href="./css/editor.css">
        <script src="./js/articolo_modifica.js"></script>
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
                    $num += sizeof($paragrafi);

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
                    }
                ?>
                <div class="App">
                    <form action="editor.php?input=1&mode=1" method="post" enctype="multipart/form-data">
                        <div id='editorContainer'>
                            <article>
                                <div id="ediTitContainer">
                                    <h3 id="editorH3">Titolo:</h3>
                                    <input id="editorTitolo" type="text" placeholder="inserire un titolo" <?php echo 'value="'.$articolo['titolo'].'"'?>></input>
                                </div>
                                <textarea id='editorDescArt'placeholder="inserire una descrizione"><?php echo $articolo['descrizione']?></textarea>
                                <div id='editorImmagine'>
                                    <img id='editorImgArt' <?php echo 'src="./img/'.$articolo['nome'].'"'?>>
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
                                        $i = 0;
                                        foreach ($paragrafi as $value) {
                                            $i++;
                                            echo '
                                            <div id="paragrafo'.$num.'" class="paragrafo">
                                                <div id="subTitleContainer'.$num.'" class="subTitleContainer">
                                                    <input id="subTitle'.$num.'" class="subTitle" type="text" placeholder="inserire un titolo" value='.$value['titolo'].'></input>
                                                </div>
                                                <div id="'.$num.'" class="immagini">
                                                    <button type="button" class="insertImgBtn" onclick="insertImg('.$num.')"></button>'
                                            ;
                                            
                                            foreach ($immagini as $val) {
                                                if($val['idParagrafo']==$num){

                                                }
                                            }

                                            echo'
                                                </div>
                                                <textarea id="textarea'.$num.'" type="text" class="paragrafoContent">'.$value['contenuto'].'</textarea>
                                            </div>
                                            ';
                                        }
                                    ?>
                                    <div id="paragrafo<?php echo $num?>" class="paragrafo">
                                                <div id="subTitleContainer<?php echo $num?>" class="subTitleContainer">
                                                    <input id="subTitle<?php echo $num?>" class="subTitle" type="text" placeholder="inserire un titolo"></input>
                                                </div>
                                                <div id="<?php echo $num?>" class="immagini">
                                                    <button type="button" class="insertImgBtn" onclick="insertImg(<?php echo $num?>)"></button>
                                                </div>
                                                <textarea id="textarea<?php echo $num?>" type="text" class="paragrafoContent"></textarea>
                                            </div>
                                </article>
                            <button type="button" onclick="insertParag()"></button>
                            <input type="submit" value="carica" onclick="invia()"/>
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