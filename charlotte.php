<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 22/05/2017
 * Time: 15:32
 */
require_once "connect.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "UPDATE `personne` SET nom = :nom, prenom = :prenom WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':prenom', $_POST['prenom']);
    $stmt->bindValue(':nom', $_POST['nom']);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
    if($stmt->errorCode() !== '00000'){
        die($stmt->errorInfo()[2]);
    }
    header('Location: mike.php');
    die();
}
// si pas d'id dans l'URL, on arrete
if(!isset($_GET['id'])){
    die('L\'id pas spécifiée!');
}
// requete SQL
$sql = "SELECT
  `id`,
  `prenom`,
  `nom`
FROM
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
// fetch (solo parce que un seul enregistrement renvoyé!)
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// si le row est false, pas de données retournées par la requete
if(false === $row){
    die('L\'id n\'existe pas!');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajout de personne</title>
</head>
<body>
<h1>Ajout de personne</h1>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="hidden" name="id" value="<?=$row['id']?>">
    <p>
        <label for="nom">Nom</label><br>
        <input type="text" name="nom" placeholder="nom" id="nom" value="<?=$row['nom']?>">
    </p>
    <p>
        <label for="prenom">Prenom</label><br>
        <input type="text" name="prenom" placeholder="prenom" id="prenom" value="<?=$row['prenom']?>">
    </p>
    <p><input type="submit" value="Modifier"></p>
</form>
</body>
</html>
