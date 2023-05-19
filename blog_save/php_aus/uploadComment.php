<?php
session_start();
$title = $_REQUEST["title"];
$img = $_REQUEST["img"];
$content = $_REQUEST["content"];
$hint = "";
$user = "";
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
    
    $text = "INSERT INTO commenti(titolo, descrizione, giorno, utente) VALUES (?, ?, ?, ?)";
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