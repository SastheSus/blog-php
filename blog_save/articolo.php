<?php
session_start();
$id=$_GET["id"];
$pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
$text = "UPDATE articoli SET visualizzazioni = visualizzazioni+1 WHERE id = ?";
$query= $pdo->prepare($text);
$query->execute([$id]);

?>
<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="UTF-8" />
        <link rel="icon" type="gif" href="./img/tank.gif" />
        <title>Blog</title>
        <link rel="stylesheet" href="./css/common.css">
        <link rel="stylesheet" href="./css/articolo.css">
        <script src="./js/articolo.js"></script>
    </head>

    <body>
        <div id="root">
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
                        $pdo = null;
                        if($row['ruolo']=='ADMIN' || $row['ruolo']=='AUTHOR'){
                        echo '<a href="./editor.php">Editor</a>';
                        }else{
                        $title = "'Heads Up!'";
                        $content = "'This is a custom alert with heading.'";
                        echo '<a onclick="customAlert.alert('.$content.','.$title.')">Editor</a>';
                        }
                        }
                        ?>
                    </li>
                    <li></li>
                    <li id="logli">
                        <div id="loginBtn" 
                        <?php
                        $t="";
                        if(empty($_SESSION['user'])){
                        $t="window.location.replace('./login.php')";
                        echo 'onclick="'.$t.'"';
                        }
                        ?>
                        >
                            <img src="./img/account.png" alt="">
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
                        echo 
                        "<div class='dropdown-content'>
                            <a onclick='".$t."'>Logout</a>
                        </div>";
                        }
                        ?>
                    </li>
                </ul>
            </nav>
            <div class="App">
                <div id='bodyArticolo'>
                    <div id='formArticolo'>
                        <article>
                            <?php 
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
                            ?>
                            <h3 id="h3formArticolo"><?php echo $articolo['titolo'];?></h3>
                            <?php 

                            foreach ($paragrafi as $value) {
                                if($value['stile']==1){
                                    echo '<div class="notParagrafo">';
                                }
                                else{
                                    echo '<div class="paragrafo">';
                                }
                                if($immagini!=null){
                                    echo '<div class="immagini">';
                                    foreach ($immagini as $val) {
                                        if($value['id']==$val['idParagrafo']){
                                            echo '<div class="immagine"><img class="imgPar" src="./img/'.$val['nome'].'"></div>';
                                        }
                                    }
                                    echo '</div>';
                                }
                                echo '  <div id='.$value['id'].' class="paragrafoContent">
                                <h2 class="paragrafoTitle">'.$value['titolo'].'</h2>
                                <p class="paragrafoText">'.$value['contenuto'].'</p>
                                </div>';
                                echo '</div>';
                            }

                            ?>
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
    </body>
</html>