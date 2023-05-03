<?php
session_start();
$hint = array();
$idArt = $_REQUEST["idArt"];
$idPar = $_REQUEST["idPar"];
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
    try{

    $text = "SELECT idImmagine FROM immaginiDiParagrafi WHERE idParagrafo = ? AND idArticolo = ?";
    $query= $pdo->prepare($text);
    $query->execute([$idPar,$idArt]);
    $hint = $query->fetchAll();

    foreach ($hint as $value) {
        $text = "DELETE FROM immagini WHERE id = ?";
        $query= $pdo->prepare($text);
        $query->execute([$value]);
    }
      
    }
    catch(PDOException $e){
    }

    $text = "DELETE FROM paragrafi WHERE id = ? AND articolo = ?";
    $query= $pdo->prepare($text);
    $query->execute([$idPar,$idArt]);
  }
  catch (PDOException $e){
      $hint="";
      exit();
  }
  $pdo=null;
  echo $hint === ""  ? "none" : $hint[0];
?>