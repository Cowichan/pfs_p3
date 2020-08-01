<?php
include "database_functions.php";
include "functions.php";
createRows();
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Copy_s Mine Only PHP</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="">
  </head>
  <body>

		<div class="container">

			<section class="row">
					<h1 class="col-lg-12">Inscription</h1>

					<form class="col-lg-7 offset-lg-1" method="post" action="registration_form.php">
						<div class="form-group">
							<label for="nom">nom</label> :
							<input type="text" name="nom" id="nom" maxlength="20" required class="form-control" />
						</div>
						<div class="form-group">
							<label for="prenom">prénom</label> :
							<input type="text" name="prenom" id="prenom" maxlength="20" required class="form-control"/>
						</div>
						<div class="form-group">
							<label for="pseudo">nom d'utilisateur</label> :
							<input type="text" name="pseudo" id="pseudo" maxlength="20" required class="form-control" />
						</div>
						<div class="form-group">
							<label for="mdp">mot de passe</label> :
							<input type="password" name="mdp1" id="mdp" maxlength="50" required class="form-control" />
						</div>
						<div class="form-group">
							<label for="question">question secrète</label> :
							<select name="question" id="question" class="form-control" required  >
								<option value="Quel est le nom de jeune fille de votre mère ?">Quel est le nom de jeune fille de votre mère ?</option>
								<option value="Où avez-vous grandi ?">Où avez-vous grandi ?</option>
								<option value="Quel était le nom de votre premier animal de compagnie ?">Quel était le nom de votre premier animal de compagnie ?</option>
								<option value="Quel est votre film préféré ?" selected>Quel est votre film préféré ?</option>
								<option value="Quel a été votre premier métier ?">Quel a été votre premier métier ?</option>
							</select>
						</div>
						<div class="form-group">
							<label for="reponse">réponse à la question secrète</label> :
							<input type="text" name="reponse" id="reponse" maxlength="100" required class="form-control" />
						</div>
						<center><input type="submit" name="submit" value="m'inscrire" class="btn btn-primary" /></center>
					</form>
			</section>

		</div>


    <script src="" async defer></script>
  </body>
</html>
