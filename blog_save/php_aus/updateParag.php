<?php
session_start();
$article = $_REQUEST["article"];
$paragrafo = $_REQUEST["paragrafo"];
$style = $_REQUEST["style"];
$title = $_REQUEST["title"];
$img = $_REQUEST["img"];
$content = $_REQUEST["content"];
$hint = "";
$user = "";
try{
    try{
      $arrImg = explode("|",$img);
      $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
      /* 
      $text = "INSERT INTO paragrafi(id, articolo, titolo, contenuto, stile) VALUES (?, ?, ?, ?, ?)";
      $query= $pdo->prepare($text);
      $query->execute([$paragrafo, $article, $title, $content, $style]);
      */
      $text = "UPDATE paragrafi SET titolo= ?, contenuto= ?, stile= ? WHERE id=? AND articolo = ? AND (titolo != ? OR contenuto != ? OR stile != ?)";
      $query= $pdo->prepare($text);
      $query->execute([$title,$content,$style, $paragrafo,$article, $title,$content,$style]);
      
      foreach ($arrImg as $value) {
        if($value!=""){
        $text = "INSERT INTO immagini(nome) VALUES (?)";
        $query= $pdo->prepare($text);
        $query->execute([$value]);

        $text = "SELECT id FROM immagini WHERE nome = ? AND logo = 0";
        $query= $pdo->prepare($text);
        $query->execute([$value]);
        $idImg = $query->fetch();

        $text = "INSERT INTO immaginiDiParagrafi(idParagrafo, idArticolo, idImmagine) VALUES (?, ?, ?)";
        $query= $pdo->prepare($text);
        $query->execute([$paragrafo,$article,$idImg[0]]);
      }
      }
    }
    catch(Exception $e){
      echo "<p style='width: 100%; text-align: center; background-color: red;'>".$e."</p>";
      $hint="";
    }
  }
  catch (PDOException $e){
      echo "<p style='width: 100%; text-align: center; background-color: red;'>".$e."</p>";
      $hint="";
      exit();
  }
  $pdo=null;
  echo $hint === ""  ? $article : $hint;
?>