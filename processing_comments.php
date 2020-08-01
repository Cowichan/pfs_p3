<?php
session_start();
include "functions.php";

	// on récupère les données envoyées par le formulaire
	if(isset($_POST["commentaire"]) && isset($_POST["acteur"]))
	{
		$commentaire = htmlspecialchars($_POST["commentaire"]) ;
		$id_acteur = (int)$_POST["acteur"] ;
  }
  	else
	{
    echo 'recupere pas les données !';
  }

  	if(!isset($_SESSION["pseudo"]))
	{
		echo 'ya pas le pseudo';
  }
  // global $db;
  $res = $db->prepare("select id_user from account where prenom=:prenom and nom=:nom") ;
	$res->execute(array("prenom"=>$_SESSION["prenom"], "nom"=>$_SESSION["nom"])) ;

	$user = $res->fetch() ;

	// enregistrer les données dans la base
	$res->closeCursor() ;

	$res = $db->prepare("insert into post(id_user, id_acteur, date_add, post) values(:user, :acteur, now(), :commentaire)") ;
	$res->execute(array("user"=>$user["id_user"], "acteur"=>$id_acteur, "commentaire"=>$commentaire)) ;

  // addComments();
  echo "j'ai recup les donnees";
  ?>

  <script type="text/javascript">
		document.location.href="display_detail_partner.php?xxx=<?php echo $id_acteur ;?>" ;
	</script>


