<?php

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
if(isset($_POST["prenom"])&&isset($_POST["nom"])&&isset($_POST["age"])){
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $age = intval($_POST["age"]);
    $presence = 1;

    $prepared_sql = "INSERT INTO personne VALUES(NULL,:nom,:prenom,:age,:presence)";
    $prepared_query = $pdo->prepare($prepared_sql);
    // binder 
    $prepared_query->bindParam(":nom",$nom,PDO::PARAM_STR);
    $prepared_query->bindParam(":prenom",$prenom,PDO::PARAM_STR);
    $prepared_query->bindParam(":age",$age,PDO::PARAM_INT);
    $prepared_query->bindParam(":presence",$presence,PDO::PARAM_BOOL);
    //Execution
    $prepared_query->execute();
}

header("Location: page.php"); //redirection vers la page home
?>