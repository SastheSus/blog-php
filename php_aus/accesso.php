<?php
session_start();
$email = strip_tags($_REQUEST["email"]);
$password = $_REQUEST["password"];
$hint = "";
$user = "";
try{
    try{
      $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
      
      $text = "SELECT username, email, password FROM utenti WHERE username = ? OR email = ?";
      
      $query= $pdo->prepare($text);
      $query->execute([$email,$email]);
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