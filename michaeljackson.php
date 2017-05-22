<?php
require_once "connect.php";
// si pas d'id dans l'URL, on arrete
if(!isset($_GET['id'])){
    die('L\'id pas spécifiée!');
}
$sql = "DELETE FROM
  `personne`
WHERE
  id = :id
";
// prepare
$stmt = $pdo->prepare($sql);
// bind
$stmt->bindValue(':id', $_GET['id']);
// execute
$stmt->execute();
// gestion des erreurs
if($stmt->errorCode() !== '00000'){
    die($stmt->errorInfo()[2]);
}
header('Location: mike.php');
die();
