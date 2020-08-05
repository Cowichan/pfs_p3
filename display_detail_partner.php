  <?php session_start();

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
    <title>Display partner</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php
      include("redirection.php") ;
      if(isset($_GET["xxx"]))
			{
				$id = (int)$_GET["xxx"] ;
			}

      idVerify();
      readDetailsActeurs();
      voteCouting();

      addVotes();

      nombreComments();

    ?>
    <p>
    <?php
      if (isset($_SESSION['id_user']) AND isset($_SESSION['pseudo']))
      {
        echo 'Bonjour ' . $_SESSION['pseudo'] . ' ton id_user est le ' . $_SESSION['id_user'] . ' et ton nom est ' . $_SESSION['nom'] . ' et ton prénom est ' . $_SESSION['prenom'] . ' et ta réponse à la question secrète est ' . $_SESSION['reponse'];
      }
    ?>
    </p>
    <p>
      Wanna go <a href="index.php">to accueil ?</a>
    </p>
    <p>
      <form class="col-lg-7 offset-lg-1" method="post" action="processing_comments.php">
        <legend><a name="formulaire">ajouter un commentaire en tant que <?php echo $_SESSION["pseudo"] ; ?> :</a></legend>
        <div class="form-group">
          <label for="commentaire">commentaire</label>
          <textarea class="form-control" name="commentaire" id="commentaire" required></textarea>
        </div>
        <input type="hidden" name="acteur" value="<?php echo $id; ?>" />
        <center><input type="submit" value="commenter" /></center>
      </form>
    </p>
    <p>
      <?php
      			// on récupère les commentaires
        $res = $db->prepare('select prenom, date_format(date_add, "%d/%m/%Y H:i") as date, post
        from post
        inner join account on post.id_user = account.id_user
        where id_acteur = ?
        order by id_post desc') ;
        $res->execute(array($id)) ;

      while($commentaires = $res->fetch())
      {
        ?><p class="col-lg-12">
          <br /><?php echo $commentaires["prenom"] ; ?>
          <br /><?php echo $commentaires["date"] ; ?>
          <br /><?php echo $commentaires["post"] ; ?>
        </p><?php

      }

      $res->closeCursor() ;
      ?>
    </p>




    <script src="" async defer></script>
  </body>
</html>
