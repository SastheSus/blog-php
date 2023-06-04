<?php
session_start();
$article = $_REQUEST["article"];
$paragrafo = $_REQUEST["paragrafo"];
$style = $_REQUEST["style"];
$title = $_REQUEST["title"];
$img = $_REQUEST["img"];
$input = $_REQUEST["input"];
$content = $_REQUEST["content"];
$hint = "";
$user = "";

try{
  $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");

  $text ="DELETE immagini.*, immaginidiparagrafi.* 
          FROM immagini,immaginidiparagrafi 
          WHERE immagini.id = immaginidiparagrafi.idImmagine 
          AND immaginidiparagrafi.idArticolo = ?
          AND immaginidiparagrafi.idParagrafo = ?
          AND logo = 0 ";
  $query= $pdo->prepare($text);
  $query->execute([$article, $paragrafo]);

  $text ="DELETE paragrafi.* 
          FROM paragrafi 
          WHERE paragrafi.articolo = ?
          AND paragrafi.id = ?";
  $query= $pdo->prepare($text);
  $query->execute([$article, $paragrafo]);

  $arrImg = explode("|",$img);
  $arrIn = explode("|",$input);

  $text = "INSERT INTO paragrafi(id, articolo, titolo, contenuto, stile) VALUES (?, ?, ?, ?, ?)";
  $query= $pdo->prepare($text);
  $query->execute([$paragrafo, $article, $title, $content, $style]);
  
  $i = 0;
  
  foreach ($arrImg as $value) {
    if($value!=""){
      $text = "INSERT INTO immagini(nome) VALUES (?)";
      $query= $pdo->prepare($text);
      $query->execute([$value]);

      $text = "SELECT id FROM immagini WHERE nome = ? AND logo = 0";
      $query= $pdo->prepare($text);
      $query->execute([$value]);
      $idImg = $query->fetch();

      $text = "INSERT INTO immaginiDiParagrafi(idParagrafo, idArticolo, idInput, idImmagine) VALUES (?, ?, ?, ?)";
      $query= $pdo->prepare($text);
      $query->execute([$paragrafo,$article,$arrIn[$i],$idImg[0]]);
      $i++;
    }
  }
}
catch (PDOException $e){
    echo "<p style='width: 100%; text-align: center; background-color: red;'>".$e."</p>";
    $hint="";
    exit();
}

$pdo=null;
echo $hint === ""  ? $article : $hint;
/*try{
  $arrImg = explode("|",$img);
  $arrIn = explode("|",$input);
  $pdo = new PDO("mysql:host=localhost; dbname=blog", "root", "");
  try{
    $text = "INSERT INTO paragrafi(id, articolo, titolo, contenuto, stile) VALUES (?, ?, ?, ?, ?)";
    $query= $pdo->prepare($text);
    $query->execute([$paragrafo, $article, $title, $content, $style]);
  }catch (PDOException $e){
    $text = "UPDATE paragrafi SET titolo= ?, contenuto= ?, stile= ? WHERE id=? AND articolo = ? AND (titolo != ? OR contenuto != ? OR stile != ?)";
    $query= $pdo->prepare($text);
    $query->execute([$title,$content,$style, $paragrafo,$article, $title,$content,$style]);
  }
    $i = 0;
    foreach ($arrImg as $value) {
      if($value!=""){
        $text = "INSERT INTO immagini(nome) VALUES (?)";
        $query= $pdo->prepare($text);
        $query->execute([$value]);

        $text = "SELECT id FROM immagini WHERE logo = 0 ORDER BY id DESC";
        $query= $pdo->prepare($text);
        $query->execute();
        $idImg = $query->fetch();

        try{
          $text = "INSERT INTO immaginiDiParagrafi(idParagrafo, idArticolo, idInput, idImmagine) VALUES (?, ?, ?, ?)";
          $query= $pdo->prepare($text);
          $query->execute([$paragrafo,$article,$arrIn[$i],$idImg[0]]);
        }catch (PDOException $e){
          $text = "UPDATE immaginiDiParagrafi SET idImmagine= ? WHERE idParagrafo= ? AND idArticolo= ? AND idInput= ? AND idImmagine != ? ";
          $query= $pdo->prepare($text);
          $query->execute([$idImg[0], $paragrafo, $article, $arrIn[$i], $idImg[0]]);
        }
        
        $i++;
      }
    }
}
catch (PDOException $e){
    $hint="";
    exit();
}*/
?>