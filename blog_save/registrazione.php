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
            <div id='bodyReg'>
                <div id='formReg'>
                        <article>
                            <h3 id="h3formReg">Registrazione</h3>
                            <input type="text" id='usernameReg'placeholder="inserire un username"></input>
                            <input type="email" id='emailReg'placeholder="inserire una e-mail"></input>
                            <input type="password" id='passwordReg'placeholder="inserire una password"></input>
                            <div id="pulsantieraReg">
                                <a href="./login.php">Hai già un account?</a>
                                <input type="button" id='buttonReg' onclick='registrati()' value="Registrati"></input>
                            </div>
                            <p id="warningReg"></p>
                        </article>
                    </div> 
                </div>
                <footer>
                    <div class="foot" id="crediti">
                        <h5>Author:</h5>
                        <h5>Michele Bardotti</h5>
                    </div>
                    <div class="foot" id="contatti">
                        <h5>Contatti:</h5><a href="mailto:michele.bardotti.2004@calvino.edu.it">michele.bardotti.2004@calvino.edu.it</a>
                    </div>
                    <div class="foot" id="links">
                        <h5>Links:</h5><a>https://www.esempio.com</a>
                    </div>
                    <div>© Copyright 2023, Tutti i diritti riservati</div>
                </footer>
            </div>
        </div>
    </div>

</body>

</html>