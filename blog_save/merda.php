<?php
session_start();
$id = 0;
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

    $text = "SELECT MAX(id) AS id FROM commenti WHERE idArticolo = ?";
    $query= $pdo->prepare($text);
    $query->execute([3]);
    $id += $query->fetch()['id'];
    echo $id;

    $text = "INSERT INTO commenti(id,idArticolo,idCommento) VALUES (?,?,?)";
    $query= $pdo->prepare($text);
    $query->execute([10,1,NULL]);
}
catch (PDOException $e){
    echo $e;
    exit();
}
?>