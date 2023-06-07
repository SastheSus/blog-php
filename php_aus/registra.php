<?php
session_start();
$email = strip_tags($_REQUEST["email"]);
$username = strip_tags($_REQUEST["username"]);
$password = password_hash($_REQUEST["password"], PASSWORD_DEFAULT);
$hint = "";
$user = "";
$result = "";
if($email!="" && $username!="" && !(password_verify("", $password))){
  
try{
  $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
  
  $text = "SELECT username, email FROM utenti WHERE email = ? OR username = ?";
  
  $query= $pdo->prepare($text);
  $query->execute([$username, $email]);
  $risultati = $query->fetchAll();
  
  if ($risultati == null) {
    $result="ok";
    $text = "INSERT INTO utenti(username, email, password) VALUES (?,?,?)";
    $query= $pdo->prepare($text);
    $query->execute([strip_tags($username), $email, $password]);
  }
  else{
    $hint=$risultati[0]['email'];
  }
  $pdo=null;
  }
  catch (PDOException $e){
      echo "Impossibile connettersi al server di database. ".$e;
      exit();
  }
  
}
  echo $result === "" ? "none" : $result;
?>