<?php
session_start();
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
                            <input id="editorInputImg" type="file" accept="image/*" onchange="getImgData()"/>
                            <input type="button" value="carica" onclick="invia()"/>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>

</body>

</html>