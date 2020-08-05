<?php
include "database_functions.php";
include "functions.php";
// new_session();
processingLogin();

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Formulaire de connection - Accès restreint</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="">
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <section class="row">
      <h1 class="col-lg-12">Coonnexion</h1>

      <form class="col-lg-7 offset-lg-1" method="post" action="login_form.php">
        <div class="form-group">
          <label for="pseudo">nom d'utilisateur</label> :
          <input type="text" name="pseudo" id="pseudo" maxlength="20" class="form-control" />
        </div>
        <div class="form-group">
            <label for="mdp">mot de passe</label> :
            <input type="password" name="mdp1" id="mdp" maxlength="50" class="form-control" />
        </div>
        <center><input type="submit" value="me connecter" name="login" class="btn btn-primary" /></center>
      </form>

      <p class="col-lg-11 offset-lg-1">
        <a href="password_recovery_form.php">mot de passe oublié</a>
      </p>
    </section>

    <script src="" async defer></script>
  </body>
</html>
