<?php session_start() ;
include "functions.php";
?>
<!--
	Extranet du groupe bancaire GBAF :
	- mise à jour du mot de passe de l'utilisateur dans la base de données

	développé par Jenny Rogeaux
-->

<?php
	// on récupère les données envoyées par le formulaire
	if(isset($_POST["mdp1"]))
	{
    $mdp1 = $_POST['mdp1'];


		if(isset($_SESSION["pseudo"]))
		{
			$username = $_SESSION["pseudo"] ;
		}

		else if(isset($_POST["pseudo"]))
		{
			$username = $_POST["pseudo"] ;
		}

		else
		{
			?><script type="text/javascript">
			alert("Une erreur est survenue lors de l'envoi du formulaire. Merci de contacter le web-master si le problème persiste.") ;
			document.location.href="display_perso_data.php" ;
		</script><?php
		}
	}

	else
	{
		?><script type="text/javascript">
			alert("Une erreur est survenue lors de l'envoi du formulaire. Merci de contacter le web-master si le problème persiste.") ;
			document.location.href="display_perso_data.php" ;
		</script><?php
	}


  $pass_hache = password_hash($mdp1, PASSWORD_DEFAULT);

	$res = $db->prepare("update account set password=:mdp1 where username=:pseudo") ;
	$res->execute(array("mdp1"=>$pass_hache, "pseudo"=>$username)) ;


  echo " reponse_enregistree" . var_dump($mdp1) . "reponse_enregistree<br>";
  var_dump($pass_hache) . "<br>";
  var_dump($username) . "<br>";
  var_dump($res) . "<br>";
	// on redirige l'utilisateur vers la page de connexion
?>
  <script type="text/javascript">
	alert("Votre mot de passe à bien été mis à jour.") ;
	document.location.href="logout.php" ;
  </script>



