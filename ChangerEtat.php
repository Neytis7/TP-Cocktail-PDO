<?php
session_start();
//phpinfo();
// se connecter a la base
// login mdp url port database
//3306 8889
define ('LOGIN','root');
define ('MDP','');
define ('HOST','localhost');
define ('BASE','tp-cocktail');

try{
	$db="mysql:host=".HOST.";dbname=".BASE.";charset=utf8";
	$pdo = new PDO($db,LOGIN,MDP);
	$pdo->setAttribute(
		PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $e){
	echo " PB connection :".$e->getMessage();
}
//----------------------------------------
if(isset($_GET["x"])&&isset($_GET["id"])){
    $x = intval($_GET["x"]);
    $id = intval($_GET["id"]);
    $prepared_sql = "UPDATE `personne` SET `presence` = ".$x." WHERE `personne`.`id_Personne` = ".$id;
    $prepared_query = $pdo->prepare($prepared_sql);
    $prepared_query->execute();
}
header("Location: page.php"); //redirection vers la page home
?>