<?php
session_start();
$content = strip_tags($_REQUEST["content"]);
$article = $_REQUEST["article"];
$risposta = $_REQUEST["risposta"];
$articleRis = $article;
if($risposta == 0){
    $risposta = NULL;
    $articleRis = NULL;
}
$hint = "";
$id = 1;
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

    $text = "SELECT MAX(id) AS id FROM commenti WHERE idArticolo = ?";
    $query= $pdo->prepare($text);
    $query->execute([$article]);
    $id += $query->fetch()['id'];
    
    $text = "INSERT INTO commenti(id, idArticolo, contenuto, giorno, utente, idRisposta, idArticoloRis) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $query= $pdo->prepare($text);
    $query->execute([$id,$article,$content,date("Y-m-d H:i:s"),$_SESSION['user'],$risposta,$articleRis]);
}
catch (PDOException $e){
    echo "<p style='width: 100%; text-align: center; background-color: red;'>".$e."</p>";
    $hint="";
    exit();
}
$pdo=null;
echo "sas";
?>