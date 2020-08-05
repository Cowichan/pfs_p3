<?php session_start() ;
include "functions.php"
// $_SESSION["username"] = $username;
// $_SESSION['nom'] = 'Dupont';
// $_SESSION['age'] = 24;
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

    <?php //include("redirection.php") ;
    if(isset($_SESSION['pseudo']))
    { ?>
    <div class="container">
      <!-- Content here -->
      <div class="row">
        <h1 class="col-lg-12">Espace privé connecté !!!</h1>

        <div class="col-sm-12">
          <p>
            One of three columns, You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.
            You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.
          </p>

          <p>
            <?php
              if (isset($_SESSION['id_user']) AND isset($_SESSION['pseudo']))
              {
                  echo 'Bonjour ' . $_SESSION['pseudo'] . ' ton id_user est le ' . $_SESSION['id_user'] . ' et ton nom est ' . $_SESSION['nom'] . ' et ton prénom est ' . $_SESSION['prenom'] . ' et ta question secrète est ' . $_SESSION['question'] . ' et ta réponse à la question secrète est ' . $_SESSION['reponse'] . ' et ton mot de passe est ' . $_SESSION['mdp1'];
              }
            ?>
          </p>
          <p>
              Modifier profil : <a href='display_perso_data.php'><?php echo $_SESSION['pseudo']; ?></a>
          </p>
          <p>
            <a href="logout.php">Se déconnecter</a>
          </p>
          <p>
            <?php

              readActeurs();
            ?>
          </p>

        </div>

      </div>
    </div>
        <?php } else { ?>
    <!-- <div class="container">

      <div class="row">
        <h1 class="col-lg-12">Espace privé non connecté !!!</h1>

        <div class="col-sm-12">
          <p>circuler y arien a voir, <a href="login_form.php">connectez-vous</a> ou <a href="registration_form.php">enregistrez-vous</a>!!</p>
        </div>

      </div>
    </div> -->
      <script type="text/javascript">
        document.location.href="login_form.php" ;
      </script>


        <?php } ?>
    </div>


    <script src="" async defer></script>
  </body>
</html>
