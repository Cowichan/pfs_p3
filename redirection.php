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
