<?php
session_start();
$hint = "";
$nome = $_REQUEST["nome"];
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

    try{
         
        $text ="SELECT id 
                FROM commenti 
                WHERE utente = ? 
                OR idRisposta IN (SELECT id 
                                    FROM commenti 
                                    WHERE utente = ?) 
                ORDER BY id DESC";
        $query= $pdo->prepare($text);
        $query->execute([$nome,$nome]);
        $commenti = $query->fetchAll();

        $text ="SELECT articoli.id AS idArt
                FROM articoli
                WHERE utente = ?";
        $query= $pdo->prepare($text);
        $query->execute([$nome]);
        $articoli = $query->fetchAll();

        foreach ($commenti as $value) {
            $text = "DELETE FROM commenti WHERE id = ?";
            $query= $pdo->prepare($text);
            $query->execute([$value['id']]);
        }
        foreach ($articoli as $value) {
            $text = "DELETE FROM commenti WHERE idArticolo = ?";
            $query= $pdo->prepare($text);
            $query->execute([$value['idArt']]);
        }

        foreach ($articoli as $value) {
            $text = "DELETE FROM immaginiDiParagrafi WHERE idArticolo = ?";
            $query= $pdo->prepare($text);
            $query->execute([$value['idArt']]);
        }

        foreach ($articoli as $value) {
            $text = "DELETE FROM paragrafi WHERE articolo = ?";
            $query= $pdo->prepare($text);
            $query->execute([$value['idArt']]);
        }
        foreach ($articoli as $value) {
            $text = "DELETE FROM articoli WHERE id = ?";
            $query= $pdo->prepare($text);
            $query->execute([$value['idArt']]);
        }

        $text = "DELETE FROM utenti WHERE username = ?";
        $query= $pdo->prepare($text);
        $query->execute([$nome]);
        /*
        $text = "DELETE FROM immaginiDiParagrafi WHERE idArticolo = ?";
        $query= $pdo->prepare($text);
        $query->execute([$idArt]);
         
        foreach ($hint as $value) {
            $text = "DELETE FROM immagini WHERE id = ?";
            $query= $pdo->prepare($text);
            $query->execute([$value]);
        }*/
        
    }
    catch(PDOException $e){
        echo $e;
    }
    /* 
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
    $query->execute([$idArt]);*/
    
  }
  catch (Exception $e){
      $hint=$e;
  }
  $pdo=null;
  echo $hint;
?>