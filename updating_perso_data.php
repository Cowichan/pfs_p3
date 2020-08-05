<?php session_start() ;

include "database_functions.php";
include "functions.php";

?>
<!--
	Extranet du groupe bancaire GBAF :
	- mise à jour des données personnelles de l'utilisateur dans la base de données

	développé par Jenny Rogeaux
-->


<?php

if(isset($_POST['submit'])) {
  global $db;

  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $username = $_POST['pseudo'];
  // $mdp1 = $_POST['mdp1'];
  $question = $_POST['question'];
  $reponse = $_POST['reponse'];
	// on récupère les données envoyées par le formulaire
	$res = $db->prepare("UPDATE account set nom=:nom, prenom=:prenom, username=:nouv_pseudo, question=:question, reponse=:reponse where username=:pseudo") ;

	// on met à jour la base de données
	// include("database_functions.php") ;
	// $db = database_connect() ;
  if
  ($res->execute(array("pseudo"=>$_SESSION["pseudo"], "nom"=>$nom, "prenom"=>$prenom, "question"=>$question, "reponse"=>$reponse, "nouv_pseudo"=>$username))) {
    echo "update well";
  } else {
    echo "not updated <br>";
    die(print_r($db->errorInfo()));
  }

?>
  <script type="text/javascript">
    alert("Vos données ont bien été mises à jour. Vous devez vous reconnecter") ;
    document.location.href="logout.php" ;
  </script>
  <?php
} else {
  echo "pas de submit !";
  var_dump($res);
  die(print_r($db->errorInfo()));
}
	// on met à jour la session
	// new_session($nom, $prenom, $pseudo, $id["id_user"]) ;

	// on redirige l'utilisateur
?>


