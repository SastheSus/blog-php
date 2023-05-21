<?php
session_start();
$title = $_REQUEST["title"];
$img = $_REQUEST["img"];
$content = $_REQUEST["content"];
$hint = "";
$user = "";
try{
    try{
      $pdo = new PDO("mysql:host=localhost; dbname=database_blog", "root", "");
      if($img!=""){
        $text = "INSERT INTO immagini(nome, logo) VALUES (?, ?)";
        $query= $pdo->prepare($text);
        $query->execute([$img,1]);

        $text = "SELECT id FROM immagini WHERE nome = ? ORDER BY id DESC";
        $query= $pdo->prepare($text);
        $query->execute([$img]);
        $aus = $query->fetchAll();
        $aus = $aus[0]['id'];
        
        $text = "INSERT INTO articoli(titolo, descrizione, giorno, utente, logo) VALUES (?, ?, ?, ?, ?)";
        $query= $pdo->prepare($text);
        $query->execute([$title,$content,date("Y-m-d H:i:s"),$_SESSION['user'],$aus]);
      }
      else{
        $text = "INSERT INTO articoli(titolo, descrizione, giorno, utente) VALUES (?, ?, ?, ?)";
        $query= $pdo->prepare($text);
        $query->execute([$title,$content,date("Y-m-d H:i:s"),$_SESSION['user']]);
      }

      $text = "SELECT id FROM articoli WHERE titolo = ? ";
      $query= $pdo->prepare($text);
      $query->execute([$title]);
      $hint = $query->fetch();
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