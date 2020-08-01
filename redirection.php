<!--
	Extranet du groupe bancaire GBAF :
	- script de redirection vers formulaire de connexion

	développé par Jenny Rogeaux
-->

<?php
	// si aucune session n'est ouverte on redirige l'utilisateur
	if(isset($_SESSION["pseudo"])==false)
	{
		?><script type="text/javascript">
			alert("accès restreint") ;
			document.location.href="login_form.php" ;
		</script><?php
	}
?>
