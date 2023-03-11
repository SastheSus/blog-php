<?php
session_start();
$email = $_REQUEST["email"];
$username = $_REQUEST["username"];
$password = password_hash($_REQUEST["password"], PASSWORD_DEFAULT);
$hint = "";
$user = "";
$result = "";
try{
  $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
  
  $text = "SELECT email, username FROM utenti WHERE email = ? OR username = ?";
  
  $query= $pdo->prepare($text);
  $query->execute([$email, $username]);
  
  while ($row = $query->fetch()) {
      $hint.=$row['email'];
      $user=$row['username'];
  }
  if($hint==""){
    $result="ok";
    $text = "INSERT INTO utenti(email, username, password) VALUES (?,?,?)";
    $query= $pdo->prepare($text);
    $query->execute([$email, $username, $password]);
    $_SESSION["user"] = $username;
  }
  
  $pdo=null;
  }
  catch (PDOException $e){
      echo "Impossibile connettersi al server di database. ".$e;
      exit();
  }
  echo $result === "" ? "none" : $result;
?>