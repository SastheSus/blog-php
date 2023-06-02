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
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/manager.css">
    <script src="./js/manager.js"></script>
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
            <div id='bodyManager'>
                <div id="container">
                    <?php
                    try{
                        $text = "SELECT username, ruolo FROM utenti WHERE username NOT LIKE ? ORDER BY username";
                        $query= $pdo->prepare($text);
                        $query->execute([$_SESSION['user']]);
                        $row = $query->fetchAll();
                    }
                        catch (PDOException $e){
                        echo "Nessun utente modificabile: solo tu sei registrato quì".$e;
                        exit();
                    }
                    if ($row != null) {
                        for($i=0;$i<sizeof($row);$i++){
                            echo "<div class='top' id='1'>
                            <h3 id='titleArtSec'>".$row[$i]['username']."</h3>
                            <input type='hidden' name='username".$i."' value='".$row[$i]['username']."' form='roleform'></input>
                            <div class='passBtn'><button id='".$row[$i]['username']."' onclick='passChange(this)'></button></div>
                            <select id='choose' name='rolelist".$i."' form='roleform'>";
                            switch ($row[$i]['ruolo']) {
                                case 'BASE':
                                    echo "<option selected='selected' value='BASE'>BASE</option>
                                    <option value='AUTHOR'>AUTHOR</option>
                                    <option value='ADMIN'>ADMIN</option>";
                                    break;
                                case 'AUTHOR':
                                    echo "<option value='BASE'>BASE</option>
                                    <option selected='selected' value='AUTHOR'>AUTHOR</option>
                                    <option value='ADMIN'>ADMIN</option>";
                                    break;
                                case 'ADMIN':
                                    echo "<option value='BASE'>BASE</option>
                                    <option value='AUTHOR'>AUTHOR</option>
                                    <option selected='selected' value='ADMIN'>ADMIN</option>";
                                    break;
                                
                            }
                            echo "</select>
                            </div>";
                        }
                        /*echo '
                        <form action="" onsubmit="location.reload()" method="post" id="roleform">
                            <input name="btn" type="submit">
                        </form>';*/
                    }

                    /*if(!empty($_POST['btn'])){
                        $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
                        for($i=0;$i<sizeof($row);$i++){
                            $text = "UPDATE utenti SET ruolo = ? WHERE username = ?";
                            $query= $pdo->prepare($text);
                            $query->execute([$_POST['rolelist'.$i], $row[$i]['username']]);
                        }
                        header('./index.php');
                    }*/
                    ?>
                    <form action="" onsubmit="return updateProfili(event,this)" method="post" id="roleform" enctype="multipart/form-data">                        
                        <input id="send" type="submit">
                    </form>
                </div>
                
            </div>
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
</body>

</html>