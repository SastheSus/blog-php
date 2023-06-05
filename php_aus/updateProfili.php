<?php
session_start();
$hint = "";
$json = file_get_contents('php://input');
$data = json_decode($json);
$data = convert($data);
try{
    $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
    $i=0;
    for ($i =0; !empty($data['username'.$i]);$i++) {
      $text = "UPDATE utenti SET ruolo = ? WHERE username = ?";
      $query= $pdo->prepare($text);
      $query->execute([$data['rolelist'.$i], $data['username'.$i]]);

      if(!empty($data['password'.$i])){
        $text = "UPDATE utenti SET password = ? WHERE username = ?";
        $query= $pdo->prepare($text);
        $query->execute([password_hash($data['password'.$i], PASSWORD_DEFAULT), $data['username'.$i]]);
      }
    }
  }
  catch (Exception $e){
      $hint.=$e;
  }
  $pdo=null;
  echo $hint;

  function convert($data) {

    if (is_object($data)) {
        $data = get_object_vars($data);
    }

    if (is_array($data)) {
        return array_map(__FUNCTION__, $data);
    }
    else {
        return $data;
    }
}
?>