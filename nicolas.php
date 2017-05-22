<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 22/05/2017
 * Time: 15:32
 */
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once "connect.php";
//    $sql = "INSERT INTO `personne`(`prenom`, `nom`, `genre`, `adresse_email`) VALUES (:prenom, :nom, 3, '')";
    $sql = "INSERT INTO `personne`(`prenom`, `nom`) VALUES (:prenom, :nom)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':prenom', $_POST['prenom']);
    $stmt->bindValue(':nom', $_POST['nom']);
    $stmt->execute();
    if($stmt->errorCode() !== '00000'){
        die($stmt->errorInfo()[2]);
    }
    header('Location: mike.php');
    die();
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
    <p>
        <label for="nom">Nom</label><br>
        <input type="text" name="nom" placeholder="nom" id="nom">
    </p>
    <p>
        <label for="prenom">Prenom</label><br>
        <input type="text" name="prenom" placeholder="prenom" id="prenom">
    </p>
    <p><input type="submit" value="Ajouter"></p>
</form>
</body>
</html>
