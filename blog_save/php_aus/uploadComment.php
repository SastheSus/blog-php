<?php
session_start();
$content = $_REQUEST["content"];
$article = $_REQUEST["article"];
$risposta = $_REQUEST["risposta"];
$hint = "";
$id = 0;
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

    try{
        $text = "SELECT ";
        $query= $pdo->prepare($text);
        $query->execute([$title,$content,date("Y-m-d H:i:s"),$_SESSION['user']]);
    }
    catch(){

    }
    
    $text = "INSERT INTO commenti(id, idArticolo, contenuto, giorno, utente, idCommento) VALUES (?, ?, ?, ?)";
    $query= $pdo->prepare($text);
    $query->execute([$title,$content,date("Y-m-d H:i:s"),$_SESSION['user']]);
}
catch (PDOException $e){
    echo "<p style='width: 100%; text-align: center; background-color: red;'>".$e."</p>";
    $hint="";
    exit();
}
$pdo=null;
echo $hint === ""  ? "none" : $hint[0];
?>