<?php
session_start();
$hint = array();
$idArt = $_REQUEST["idArt"];
$idPar = $_REQUEST["idPar"];
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

    $text ="CREATE VIEW paragMaggiori AS
            SELECT id-1 AS id, articolo, titolo, contenuto, stile 
            FROM paragrafi
            WHERE articolo = ?
            AND id > ?
            ORDER BY id";
    $query= $pdo->prepare($text);
    $query->execute([$idArt, $idPar]);

    try{
        $text ="CREATE VIEW imgMaggiori AS
                SELECT idParagrafo-1 AS idParagrafo, idArticolo, idInput, idImmagine 
                FROM immaginiDiParagrafi
                WHERE idArticolo = ?
                AND idParagrafo > ?
                ORDER BY idParagrafo";
        $query= $pdo->prepare($text);
        $query->execute([$idArt, $idPar]);
    }
    catch(PDOException $e){
    }
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
    }

    $text = "DELETE FROM paragrafi WHERE id = ? AND articolo = ?";
    $query= $pdo->prepare($text);
    $query->execute([$idPar,$idArt]);

    $text = "INSERT INTO paragrafi SELECT * FROM paragMaggiori";
    $query= $pdo->prepare($text);
    $query->execute();

    $text = "INSERT INTO immaginiDiParagrafi SELECT * FROM imgMaggiori";
    $query= $pdo->prepare($text);
    $query->execute();

    
    $text = "DROP VIEW imgMaggiori";
    $query= $pdo->prepare($text);
    $query->execute();
    
    $text = "DROP VIEW paragMaggiori";
    $query= $pdo->prepare($text);
    $query->execute();
  }
  catch (Exception $e){
      $hint=$e;
      exit();
  }
  $pdo=null;
  echo $hint;
?>