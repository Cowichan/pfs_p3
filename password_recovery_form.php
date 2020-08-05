<?php //session_start() ;

// include "database_functions.php";
include "functions.php";

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Password Recovery</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
  </head>
  <body>
    <section class="row">

    </section>
      <h1 class="col-lg-12">Récupération de mot de passe</h1>

      <form class="clo-lg-7 offset-lg-1" method="post" action="#">
        <div class="form-group">
          <label for="pseudo">nom d'utilisateur :</label>
          <input type="text" name="pseudo" id="pseudo" maxlength="20" required class ="form-control" />
        </div>
        <center><input type="submit" value="afficher la question secrète" class="btn btn-primary" /></center>
      </form>

      <?php

				// on récupère l'identifiant envoyé par l'utilisateur
				if(isset($_POST["pseudo"]))
				{
					$pseudo = htmlspecialchars((string)$_POST["pseudo"]) ;

					// on cherche si l'identifiant existe dans la base de données
;
					if(search_username($pseudo))
					{


						$res = $db->prepare("select question, reponse from account where username=?") ;
						$res->execute(array($pseudo)) ;

						$question = $res->fetch() ;
						$res->closeCursor() ;

						?><form class="col-lg-7 offset-lg-1" method="post" action="processing_password_recovery.php" name="question">
							<legend>Questionx secrète : <?php echo $question["question"] ; ?></legend>
							<div class="form-group">
								<label for="reponse">réponse</label> :
								<input type="text" name="reponse" id="reponse" maxlength="100" required class="form-control" />
							</div>
							<input type="hidden" name="pseudo" value="<?php echo $pseudo ; ?>" />
							<center><input type="submit" value="envoyer" class="btn btn-primary" /></center>
						</form>
          <?php
          }

					else
					{
						?><script type="text/javascript">
							alert("Nom d'utilisateur inconnu dans la base de données") ;
							document.location.href="password_recovery_form.php" ;
						</script><?php
					}
				}

      ?>

    <script src="" async defer></script>
  </body>
</html>
