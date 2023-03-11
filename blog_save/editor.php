<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="gif" href="./img/tank.gif" />
    <title>Blog</title>
    <link rel="stylesheet" href="./css/index.css">
    <script src="blog.js"></script>
</head>

<body>
    <div id="root">
        <div>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./editor.php">Editor</a></li>
                <li></li>
                <li id="logli"><div id="login" onclick="window.location.replace('./login.php')"><img src="./img/account.png" alt=""><?php echo '<p>'.($_SESSION["user"] === "" ? "Accedi" :$_SESSION["user"])."</p>"?></div></li>
            </ul>
            <div class="App">
                <div id='editorContainer'>
                    <article>
                        <div id="ediTitContainer">
                            <h3 id="editorH3">Titolo:</h3>
                            <input id="editorTitolo" type="text"></input>
                        </div>
                        <textarea id='editorDescArt'></textarea>
                        <div id='editorImmagine'>
                            <img id='editorImgArt' src={img} alt="sample" />
                        </div>
                        <div id='editorInputs'>
                            <input id="editorInputImg" type="file" accept=".png, .jpg, .jpeg" onChange={image}/>
                            <input type="button" onClick={invia}/>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>

</body>

</html>