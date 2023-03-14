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
      
      $text = "INSERT INTO articoli(titolo, ";
      
      $query= $pdo->prepare($text);
      $query->execute([$email]);
      $risultati = $query->fetchAll();
      $pdo=null;
      if($risultati==null){
        $hint="";
      }
      else if(password_verify($password, $risultati[0]['password'])){
        $hint.=$risultati[0]['email'];
        $user=$risultati[0]['username'];
        $_SESSION["user"] = $user;
      }
      else{
        $hint="";
      }
    }
    catch(Exception $e){
      $hint="";
    }
  }
  catch (PDOException $e){
      $hint="";
      exit();
  }
  echo $hint === ""  ? "none" : $hint;
?>