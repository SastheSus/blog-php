<?php
session_start();
$hint = "";
$idArt = $_REQUEST["idArt"];
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

    try{
        /* 
        $text = "SELECT idImmagine FROM immaginiDiParagrafi WHERE idParagrafo = ? AND idArticolo = ?";
        $query= $pdo->prepare($text);
        $query->execute([$idPar,$idArt]);
        $hint = $query->fetchAll();*/

        $text = "DELETE FROM immaginiDiParagrafi WHERE idArticolo = ?";
        $query= $pdo->prepare($text);
        $query->execute([$idArt]);
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

    $text = "DELETE FROM paragrafi WHERE articolo = ?";
    $query= $pdo->prepare($text);
    $query->execute([$idArt]);
    
    $text = "DELETE FROM commenti WHERE idArticoloRis = ?";
    $query= $pdo->prepare($text);
    $query->execute([$idArt]);

    $text = "DELETE FROM commenti WHERE idArticolo = ?";
    $query= $pdo->prepare($text);
    $query->execute([$idArt]);

    $text = "DELETE FROM articoli WHERE id = ?";
    $query= $pdo->prepare($text);
    $query->execute([$idArt]);
    
  }
  catch (Exception $e){
      $hint=$e;
  }
  $pdo=null;
  echo $hint;
?>