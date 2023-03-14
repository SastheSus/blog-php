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
      
      $text = "INSERT INTO articoli(titolo, descrizione, giorno, logo) VALUES (?, ?, ?, ?)";
      
      $query= $pdo->prepare($text);
      $query->execute([$title,$content,date("Y-m-d h:i:s"),$img]);
      $risultati = $query->fetchAll();
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