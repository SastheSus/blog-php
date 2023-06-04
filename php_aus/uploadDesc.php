<?php
session_start();
$id = $_REQUEST["id"];
$title = $_REQUEST["title"];
$img = $_REQUEST["img"];
$content = $_REQUEST["content"];
$hint = "";
$user = "";
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
    if($id == -1){
      $text = "INSERT INTO articoli(titolo, descrizione, giorno, utente, logo) VALUES (?, ?, ?, ?, ?)";
      $query= $pdo->prepare($text);
      $query->execute([$title,$content,date("Y-m-d H:i:s"),$_SESSION['user'],$aus]);
    }
    else{
      $text = "UPDATE articoli SET titolo= ?, descrizione= ?, logo= ? WHERE id=? AND (titolo != ? OR descrizione != ? OR logo != ?)";
      $query= $pdo->prepare($text);
      $query->execute([$title,$content,$aus,$id,$title,$content,$aus]);
    }
  }
  else{
    if($id == -1){
      $text = "INSERT INTO articoli(titolo, descrizione, giorno, utente) VALUES (?, ?, ?, ?)";
      $query= $pdo->prepare($text);
      $query->execute([$title,$content,date("Y-m-d H:i:s"),$_SESSION['user']]);
    }
    else{
      $text = "UPDATE articoli SET titolo= ?, descrizione= ? WHERE id=? AND (titolo != ? OR descrizione != ?)";
      $query= $pdo->prepare($text);
      $query->execute([$title,$content,$id,$title,$content]);
    }
    
  }
  
  $text = "SELECT id FROM articoli ORDER BY id DESC";
  $query= $pdo->prepare($text);
  $query->execute();

  $hint = $query->fetch()['id'];
}
catch (PDOException $e){
  echo $e;
  $hint="";
  exit();
}
$pdo=null;
echo $hint;
?>