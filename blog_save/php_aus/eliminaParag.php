<?php
session_start();
$id = $_REQUEST["id"];
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
    try{

    $text = "SELECT idImmagine FROM immaginiDiParagrafi WHERE idParagrafo = ? ";
    $query= $pdo->prepare($text);
    $query->execute([$id]);
    $hint = $query->fetchAll();

    foreach ($hint as $value) {
        $text = "DELETE FROM immagini WHERE id = ?";
        $query= $pdo->prepare($text);
        $query->execute([$value]);
    }
      
    }
    catch(PDOException $e){
    }

    $text = "DELETE FROM paragrafi WHERE id = ?";
    $query= $pdo->prepare($text);
    $query->execute([$id]);
  }
  catch (PDOException $e){
      $hint="";
      exit();
  }
  $pdo=null;
  echo $hint === ""  ? "none" : $hint[0];
?>