<?php
session_start();
$id = $_REQUEST["id"];
$title = $_REQUEST["title"];
$img = $_REQUEST["img"];
$content = $_REQUEST["content"];
$hint = "";
$user = "";
try{
    try{
      $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
      if($img!=""){
        $text = "INSERT INTO immagini(nome, logo) VALUES (?, ?)";
        $query= $pdo->prepare($text);
        $query->execute([$img,1]);

        $text = "SELECT id FROM immagini WHERE nome = ? ORDER BY id DESC";
        $query= $pdo->prepare($text);
        $query->execute([$img]);
        $aus = $query->fetchAll();
        $aus = $aus[0]['id'];
        
        $text = "UPDATE articoli SET titolo= ?, descrizione= ?, logo= ? WHERE id=? AND (titolo != ? OR descrizione != ? OR logo != ?)";
        $query= $pdo->prepare($text);
        $query->execute([$title,$content,$aus,$id,$title,$content,$aus]);
      }
      else{
        $text = "UPDATE articoli SET titolo= ?, descrizione= ? WHERE id=? AND (titolo != ? OR descrizione != ?)";
        $query= $pdo->prepare($text);
        $query->execute([$title,$content,$id,$title,$content]);
      }
      /* 
      $text = "SELECT id FROM articoli WHERE titolo = ? ";
      $query= $pdo->prepare($text);
      $query->execute([$title]);*/
      $hint = "pino";//$query->fetch();
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
  echo $hint === ""  ? "none" : $hint[0];
?>