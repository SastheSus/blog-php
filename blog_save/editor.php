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
                    <li></li>
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
                    <form action="editor.php?input=1&mode=1" method="post" enctype="multipart/form-data">
                        <div id='editorContainer'>
                            <article>
                                <div id="ediTitContainer">
                                    <h3 id="editorH3">Titolo:</h3>
                                    <input id="editorTitolo" type="text" placeholder="inserire un titolo"></input>
                                </div>
                                <textarea id='editorDescArt'placeholder="inserire una descrizione"></textarea>
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
                                    <?php
                                    ?>
                                    <h3 id="h3formArticolo"><?php ?></h3>
                                    <?php
                                        echo '<div id="paragrafo1" class="paragrafo">
                                                <div id="subTitleContainer1" class="subTitleContainer">
                                                    <input id="subTitle1" class="subTitle" type="text" placeholder="inserire un titolo"></input>
                                                </div>
                                                <div id="1" class="immagini">
                                                    <button type="button" class="insertImgBtn" onclick="insertImg(1)"></button>
                                                </div>
                                                <textarea id="textarea1" type="text" class="paragrafoContent"></textarea>
                                            </div>';
                                    ?>
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