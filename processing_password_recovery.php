<?php //session_start() ;

// include "database_functions.php";
include "functions.php";

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Extranet du Groupe GBAF | Récupération mot de passe</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="style.css" />
	</head>

	<body>
		<div class="container">

			<section class="row">
				<h1 class="col-lg-12">Réinitialisation de votre mot de passe</h1>

				<?php
					// on récupère les éléments envoyés par le formulaire
					if(isset($_POST["reponse"]) && isset($_POST["pseudo"]))
					{
						$reponse = $_POST["reponse"] ;
						$pseudo = $_POST["pseudo"] ;
					}

					else
					{
						?><script type="text/javascript">
							alert("Une erreur est survenue lors de l'envoi du formulaire. Merci de contacter le web-master si le problème persiste.") ;
							document.location.href="password_recovery_form.php" ;
						</script><?php
					}

					// on vérifie que la réponse est correcte
					// include("database_functions.php") ;
					// $db = database_connect() ;

					$res = $db->prepare("select reponse from account where username=?") ;
					$res->execute(array($pseudo)) ;

					$reponse_enregistree = $res->fetch() ;
					if($reponse == $reponse_enregistree["reponse"])
					{
						// on demande à l'utilisateur d'entrer un nouveau mot de passe
						?><form method="post" action="updating_password.php" class="col-lg-7 offset-lg-1">
							<div class="form-group">
								<label for="mdp1">nouveau mot de passe</label> :
								<input type="password" name="mdp1" id="mdp1" maxlength="50" required class="form-control" />
								<input type="hidden" name="pseudo" value="<?php echo $pseudo ; ?>" />
							</div>
							<center><input type="submit" value="changer mot de passe" class="btn btn-primary" /></center>
						</form><?php
					}

					else
					{
            echo "reponse_enregistree" . var_dump($reponse_enregistree) . "<br>";
            var_dump($reponse) . "<br>";
            var_dump($res) . "<br>";
						// ?>
            <script type="text/javascript">
							alert("Réponse incorrecte.") ;
							document.location.href="password_recovery_form.php" ;
						</script>
            <?php
					}
				?>

			</section>
		</div>
	</body>
</html>
