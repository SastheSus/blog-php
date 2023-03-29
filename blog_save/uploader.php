<?php
session_start();
$title = $_REQUEST["title"];
$img = $_REQUEST["img"];
$content = $_REQUEST["content"];
$hint = "";
$user = "";
try{
    try{
      $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

      $text = "INSERT INTO immagini(nome, logo) VALUES (?, ?)";
      $query= $pdo->prepare($text);
      $query->execute([$img,1]);

      $text2 = "SELECT id FROM immagini WHERE nome = ? ORDER BY id DESC";
      $query= $pdo->prepare($text);
      $query->execute([$img,1]);
      $aus = $query->fetchAll();
      $aus = $aus[0]['id'];
      
      $text3 = "INSERT INTO articoli(titolo, descrizione, giorno, logo) VALUES (?, ?, ?, ?)";
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