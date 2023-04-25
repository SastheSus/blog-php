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
    <link rel="stylesheet" href="./css/login.css">
    <script src="blog.js"></script>
</head>

<body>
    <div id="root">
        <div>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li>
                    <?php
                    if(!empty($_SESSION['user'])){
                        $text = "SELECT ruolo FROM utenti WHERE username = ?";
                        $query= $pdo->prepare($text);
                        $query->execute([$_SESSION['user']]);
                        $row = $query->fetch();
                        if($row['ruolo']=='ADMIN' || $row['ruolo']=='AUTHOR'){
                            echo '<a href="./editor.php">Editor</a>';
                        }else{
                            $title = "'ALT!'";
                            $content = "'Questa sezione è accessibile solo alle persone autorizzate. Vuoi richiedere un ruolo da autore o admin?'";
                            echo '<a onclick="customAlert.alert('.$content.','.$title.')">Editor</a>';
                        }
                    }
                    ?>
                </li>
                <li><?php
                    if(!empty($_SESSION['user'])){
                        $text = "SELECT ruolo FROM utenti WHERE username = ?";
                        $query= $pdo->prepare($text);
                        $query->execute([$_SESSION['user']]);
                        $row = $query->fetch();
                        if($row['ruolo']=='ADMIN'){
                            echo '<a href="./manager.php">users manager</a>';
                        }
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
            <div class="App">
            <div id='bodyLogin'>
                <div id='formLogin'>
                        <article>
                            <h3 id="h3formLogin">Login</h3>
                            <input type="text" id='usernameLogin'placeholder="inserire e-mail o username"></input>
                            <input type="password" id='passwordLogin'placeholder="inserire password"></input>
                            <div id="pulsantieraLogin">
                                <a href="./registrazione.php">Devi ancora registrarti?</a>
                                <input type="button" id='buttonLogin' onclick='accedi()' value="Accedi"></input>
                            </div>
                            <p id="warningLogin"></p>
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