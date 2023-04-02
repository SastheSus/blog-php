<?php
session_start();
$pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
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
                <div id="content">
                    <div id="introduction">
                        <h1>Benvenuti su Tank Mania</h1>
                        <h3>Qui' puoi trovare notizie e curiosita' riguardo il mondo dei veicoli militari e i loro impieghi sul campo, recenti e passati.</h3>
                    </div>
                    <div id="articles">
                        <div id="titoli">
                            <h4>Novita'</h4>
                            <h4>Il più visto</h4>
                        </div>
                        <?php
                            $text = "SELECT articoli.id, titolo, nome, descrizione FROM articoli, immagini WHERE articoli.logo = immagini.id ORDER BY giorno DESC";
                            $query= $pdo->prepare($text);
                            $query->execute();
                            $row = $query->fetch();
                        ?>
                        <div id="new">                                
                                <h3 id='titleArtPrinc'><?php echo $row['titolo']?></h3>
                                <div id="immagine"><img id="imgArt" src="./img/<?php echo $row['nome']?>" alt="leopard"></div>
                                <p class="descArtPrinc"><?php echo $row['descrizione']?></p>
                                <input type="button" name='<?php echo $row['id']?>'>
                        </div>
                        <?php
                            $text = "SELECT articoli.id, titolo, nome, descrizione FROM articoli, immagini WHERE articoli.logo = immagini.id ORDER BY visualizzazioni DESC";
                            $query= $pdo->prepare($text);
                            $query->execute();
                            $row = $query->fetch();
                        ?>
                        <div id="main">
                                <h3 id='titleArtPrinc'><?php echo $row['titolo']?></h3>
                                <div id="immagine"><img id="imgArt" src="./img/<?php echo $row['nome']?>" alt="leopard"></div>
                                <p class="descArtPrinc"><?php echo $row['descrizione']?></p>
                        </div>
                        <div id="otherArticles">
                            <h2>Altri articoli</h2>
                            <?php 
                            try{
                                $text = "SELECT titolo, nome, descrizione FROM articoli, immagini WHERE articoli.logo = immagini.id ORDER BY titolo";
                                
                                $query= $pdo->prepare($text);
                                $query->execute();
                                $row = $query->fetchAll();
                            }
                                catch (PDOException $e){
                                echo "Impossibile connettersi al server di database. ".$e;
                                exit();
                            }
                            ?>
                            <div id="container">
                                <?php
                                if ($row != null) {
                                    for($i=0;$i<sizeof($row);$i++){
                                        echo "<div class='top' id='1'><h3 id='titleArtSec'>".$row[$i]['titolo']."</h3><div id='immagine'><img id='imgArt' src='./img/".$row[$i]['nome']."' alt='immagine'></div><p class='descArtSec'>".$row[$i]['descrizione']."</p></div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div id="console"><button class="move" id="prev" onclick="prevArt()">⮜</button>
                        <?php 
                            if ($row != null && sizeof($row)>3) {
                                $max=((sizeof($row))+(sizeof($row))%3)/3;
                                for($i=0;$i<$max;$i++){
                                    echo '<button class="round" onclick="goTo('.($i).')">'.($i+1).'</button>';
                                }
                                
                            }
                        ?>
                        <button class="move" id="next" onclick="nextArt()">⮞</button></div>
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