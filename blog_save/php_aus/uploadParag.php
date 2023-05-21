<?php
session_start();
$article = $_REQUEST["article"];
$paragrafo = $_REQUEST["paragrafo"];
$style = $_REQUEST["style"];
$title = $_REQUEST["title"];
$img = $_REQUEST["img"];
$input = $_REQUEST["input"];
$content = $_REQUEST["content"];
$hint = "";
$user = "";
try{
    try{
      $arrImg = explode("|",$img);
      $arrIn = explode("|",$input);
      $pdo = new PDO("mysql:host=localhost; dbname=database_blog", "root", "");

      $text = "INSERT INTO paragrafi(id, articolo, titolo, contenuto, stile) VALUES (?, ?, ?, ?, ?)";
      $query= $pdo->prepare($text);
      $query->execute([$paragrafo, $article, $title, $content, $style]);
      /* 
      $text = "SELECT id FROM paragrafi WHERE titolo = ? AND articolo = ?";
      $query= $pdo->prepare($text);
      $query->execute([$title, $article]);
      $idPar = $query->fetch();
      */
      $i = 0;
      foreach ($arrImg as $value) {
        if($value!=""){
        $text = "INSERT INTO immagini(nome) VALUES (?)";
        $query= $pdo->prepare($text);
        $query->execute([$value]);

        $text = "SELECT id FROM immagini WHERE nome = ? AND logo = 0";
        $query= $pdo->prepare($text);
        $query->execute([$value]);
        $idImg = $query->fetch();

        $text = "INSERT INTO immaginiDiParagrafi(idParagrafo, idArticolo, idInput, idImmagine) VALUES (?, ?, ?, ?)";
        $query= $pdo->prepare($text);
        $query->execute([$paragrafo,$article,$arrIn[$i],$idImg[0]]);
        $i++;
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