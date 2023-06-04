<?php
session_start();
$hint = "";
$idArt = $_REQUEST["idArt"];
$idPar = $_REQUEST["idPar"];
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

    try{
        /* 
        $text = "SELECT idImmagine FROM immaginiDiParagrafi WHERE idParagrafo = ? AND idArticolo = ?";
        $query= $pdo->prepare($text);
        $query->execute([$idPar,$idArt]);
        $hint = $query->fetchAll();*/

        $text = "DELETE FROM immaginiDiParagrafi WHERE idParagrafo = ? AND idArticolo = ?";
        $query= $pdo->prepare($text);
        $query->execute([$idPar,$idArt]);
        /* 
        foreach ($hint as $value) {
            $text = "DELETE FROM immagini WHERE id = ?";
            $query= $pdo->prepare($text);
            $query->execute([$value]);
        }*/
        
    }
    catch(PDOException $e){
        echo $e;
    }

    $text = "DELETE FROM paragrafi WHERE id = ? AND articolo = ?";
    $query= $pdo->prepare($text);
    $query->execute([$idPar,$idArt]);
     
    $text = "UPDATE paragrafi SET id = id-1 WHERE id > ? AND articolo = ?";
    $query= $pdo->prepare($text);
    $query->execute([$idPar,$idArt]);
    
  }
  catch (Exception $e){
      $hint=$e;
  }
  $pdo=null;
  echo $hint .= "DELETE FROM paragrafi WHERE id >= ".$idPar." AND articolo = ".$idArt;
?>