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
      $arrImg = explode("|",$img);
      $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

      $text = "INSERT INTO paragrafi(articolo, titolo, contenuto, stile) VALUES (?, ?, ?, ?)";
      $query= $pdo->prepare($text);
      $query->execute([$article, $title, $content, $style]);
      
      $text = "SELECT id FROM paragrafi WHERE titolo = ? AND articolo = ?";
      $query= $pdo->prepare($text);
      $query->execute([$title, $article]);
      $idPar = $query->fetch();

      foreach ($arrImg as $value) {
        $text = "INSERT INTO immagini(nome) VALUES (?)";
        $query= $pdo->prepare($text);
        $query->execute([$value]);

        $text = "SELECT id FROM immagini WHERE nome = ? AND logo = 0";
        $query= $pdo->prepare($text);
        $query->execute([$value]);
        $idImg = $query->fetch();

        $text = "INSERT INTO immaginiDiParagrafi(idParagrafo, idImmagine) VALUES (?, ?)";
        $query= $pdo->prepare($text);
        $query->execute([$idPar[0],$idImg[0]]);
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