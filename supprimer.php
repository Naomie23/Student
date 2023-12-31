<?php
$e=$_GET['idInvite'];
$con = new PDO("mysql:host=localhost;dbname=gestion_etudiant", "root", "");
$re=$con->prepare("DELETE from etudiant where id = ? ");
$re->execute([$e]);
echo" suppression reussie!!";
header("location:list_eleve.php");
?>
