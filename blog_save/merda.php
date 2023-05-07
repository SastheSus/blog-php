<?php
session_start();
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

    $text ="CREATE VIEW paragMaggiori AS
            SELECT id+1 AS id, articolo, titolo, contenuto, stile 
            FROM paragrafi
            WHERE articolo = ?
            AND id > ?
            ORDER BY id";
    $query= $pdo->prepare($text);
    $query->execute([6, 0]);
}
catch (PDOException $e){
    echo $e;
    exit();
}
?>