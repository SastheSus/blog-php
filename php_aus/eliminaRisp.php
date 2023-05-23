<?php
session_start();
$hint = "";
$id = $_REQUEST["id"];
$idArt = $_REQUEST["idArt"];
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
    
    $text = "DELETE FROM commenti WHERE id = ? AND idArticolo = ?";
    $query= $pdo->prepare($text);
    $query->execute([$id, $idArt]);
    
  }
  catch (Exception $e){
      $hint=$e;
  }
  $pdo=null;
  echo $hint;
?>