<?php
session_start();
$article = $_REQUEST["article"];
$style = $_REQUEST["style"];
$title = $_REQUEST["title"];
$img = $_REQUEST["img"];
$content = $_REQUEST["content"];
$hint = "";
$user = "";
try{
    try{
      $arrImg = explode($img, "|");
      $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

      $text = "INSERT INTO paragrafi(articolo, titolo, contenuto, stile) VALUES (?, ?, ?, ?)";
      $query= $pdo->prepare($text);
      $query->execute([$article, $title, $content, $style]);
      
      $text = "SELECT id FROM paragrafi WHERE nome = ? AND logo = 0";
      $query= $pdo->prepare($text);
      $query->execute([$article, $title, $content]);

      foreach ($img as $value) {
        $text = "INSERT INTO immagini(nome) VALUES (?)";
        $query= $pdo->prepare($text);
        $query->execute([$value]);

        $text = "SELECT id FROM immagini WHERE nome = ? AND logo = 0";
        $query= $pdo->prepare($text);
        $query->execute([$value]);
        $result = $query->fetchAll();

        $text = "INSERT INTO immaginiDiParagrafi(idParagrafo, idImmagine) VALUES (?, ?)";
        $query= $pdo->prepare($text);
        $query->execute([$value]);
      }
      

      $text2 = "SELECT id FROM immagini WHERE nome = ? ORDER BY id DESC";
      $query= $pdo->prepare($text2);
      $query->execute([$img]);
      $aus = $query->fetchAll();
      $aus = $aus[0]['id'];
      
      $text3 = "INSERT INTO paragrafi(titolo, descrizione, giorno, logo) VALUES (?, ?, ?, ?)";
      $query= $pdo->prepare($text3);
      $query->execute([$title,$content,date("Y-m-d h:i:s"),$aus]);
      $hint="ok";
    }
    catch(Exception $e){
      $hint="";
    }
  }
  catch (PDOException $e){
      $hint="";
      exit();
  }
  $pdo=null;
  echo $hint === ""  ? "none" : $hint;
?>