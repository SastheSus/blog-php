<?php
session_start();
$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$hint = "";
$user = "";
try{
  $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
  
  $text = "SELECT email, username, password FROM utenti WHERE email = ?";
  
  $query= $pdo->prepare($text);
  $query->execute([$email]);
  $risultati = $query->fetchAll();
  $pdo=null;
  if(password_verify($password, $risultati[0]['password'])){
    $hint.=$risultati[0]['email'];
    $user=$risultati[0]['username'];
    $_SESSION["user"] = $user;
  }
  else{
    $hint.="";
  }
  }
  catch (PDOException $e){
      echo "Impossibile connettersi al server di database. ".$e;
      exit();
  }
  echo $hint === "" ? "none" : $hint;
?>